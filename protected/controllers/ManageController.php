<?php
require_once (dirname(__file__) . '/../components/PaymentHelper.php');
/**
 * Class for managing multi purpose in the application
 */
class ManageController extends Controller
{
    public $layout = '//layouts/column2';
    public function filters()
    {
        return array('accessControl',
                // perform access control for CRUD operations // we only allow deletion via POST request
                );
    }
    public function accessRules()
    {
        return array(array(
                'deny',
                'actions' => array('index'),
                'users' => array('?'),
                ), );
    }
    /**
     *  Display a message when call
     */
    public function actionManageDisplayMessage()
    {
        $message = $_GET['message'];
        $this->render('manageDisplayMessage', array('message' => $message));
    }
    public function actionIndex()
    {
        $this->render('index');
    }
    public function actionManageSlot()
    {
        $this->render('manageSlot');

    }
    /**
     * retrieve and display the staff attendance
     */
    public function actionManageStaffAttendance()
    {
        $message = '';
        $staff_id = $_GET['staff_id'];
        $staff = Staff::model()->findByPk($staff_id);
        //echo $staff->id;
        //break;
        if (count($staff->lessons) == 0) {
            throw new CHttpException('Staff is currently enroll to no lesson!');
        }
        $this->render('manageStaffAttendance', array('staff' => $staff));


    }
    /**
     * retrieve and display the student attendance
     */
    public function actionManageStudentAttendance()
    {

        $message = '';
        $student_id = $_GET['student_id'];
        $student = Student::model()->findByPk($student_id);
        if (count($student->lessons) == 0) {
            throw new CHttpException('Student is currently enroll to no lesson!');
        }
        $this->render('manageStudentAttendance', array('student' => $student));

    }
    /**
     * manage the attendance for staff and students in a partucular session
     */
    public function actionManageSessionAttendance()
    {        {
            $message = null;

            $session_id = $_GET['session_id'];
            $session = Session::model()->findByPk($session_id);
            $staff_id = $session->staff_id;
            $students_id = $session->students_id;
            if (isset($_POST['staff'])) {
                $attend = '';
                // attend for staff
                if ($_POST['staff'] == 'on') {
                    $attend = $attend . '1';
                } else {
                    $attend = $attend . '0';
                }
                // attend for student
                $s = explode(',', $students_id);
                for ($i = 0; $i < count($s); $i++) {
                    $j = $i + 1;
                    if ($_POST['student_' . $j] == 'on') {
                        $attend = $attend . '1';
                    } else {
                        $attend = $attend . '0';
                    }
                }
                $session->attendance = $attend;
                if (!($session->save())) {
                    throw new CHttpException('Unable to save!');
                }
                $message = 'Save Successful<br/>';

            }

            $this->render('manageSessionAttendance', array(
                'staff_id' => $staff_id,
                'students_id' => $students_id,
                'message' => $message,
                'session' => $session));
        }
    }
    /**
     * manage the current term 
     */
    public function actionManageCurrentTerm()
    {
        $message = null;
        if (isset($_POST['term'])) {
            Yii::app()->session['current_term'] = $_POST['term'];
            //  echo ' Yii app session:' . Yii::app()->session['current_term'];
            $current_term = Yii::app()->session['current_term'];
            $message = "$current_term has been selected";
        }

        $term = Term::model()->getLatest();
        // echo ' Yii app session:' . Yii::app()->session['current_term'];
        // echo ' latest term id:' . $term->id;
        $this->render('manageCurrentTerm', array('term' => $term->id, 'message' => $message));
    }
    /**
     * manage to enroll another student in an existing group
     */
    public function actionManageLessonGroup()
    {
        //$data = lesson tuong ung
        $message = null;
        if (isset($_GET['lesson_id']) && isset($_GET['student'])) {
            $data = Lesson::model()->findByPk($_GET['lesson_id']);
        }

        $lesson_id = $_GET['lesson_id'];
        $old_student_id = $_GET['student'];
        if (isset($_POST['student'])) {
            // check if the student already enroll for that lesson
            {
                for ($i = 0; $i < count($data->students); $i++) {
                    if ($data->students[$i]->student_id == $_POST['student']) {

                        throw new CHttpException('The student ' . $_POST['student'] .
                            'already enrolled in the lesson!');
                    }
                }
            }


            if (count($data->students) >= 4) {
                throw new CHttpException('The maximum students in the lesson is 4 !');
            }
            // save student lesson
            $s = new Studentlesson;
            $s->student_id = $_POST['student'];
            $s->lesson_id = $data->id;
            // save invoice
            $in = Invoice::model()->findByAttributes(array('student_id' => $old_student_id));
            $price_id = $data->price_id;
            $in->date_create = date('y-m-d h:m:s');
            $price = Price::model()->findByPk($price_id)->rate;
            $total_week = $data->total;
            $in->lesson_id = $lesson_id;
            $in->total = $price * $total_week;
            $gg = $in->total;

            if (!($in->save())) {
                throw new CHttpException('Unable to save old invoice!');
            }
            if (!($s->save())) {
                throw new CHttpException('Unable to save!');
            }
            // change old invoice

            // new invoice
            $invoice = new Invoice;
            $invoice->number = $_POST['student'] . '000000';
            $invoice->date_create = date('y-m-d h:m:s');
            $invoice->status = 1;
            $price_rate = Price::model()->findByPk($price_id)->rate;

            $invoice->total = $price_rate * $total_week;
            $invoice->student_id = $_POST['student'];
            $invoice->lesson_id = $lesson_id;
            $invoice->save();
            //save changes to sessions
            $count = count($data->sessions);
            $new_student = (string )$_POST['student'];
            for ($i = 0; $i < $count; $i++) {
                $session = Session::model()->findByPk($data->sessions[$i]->id);

                if (count(explode(',', $session->students_id)) >= 4) {
                    throw new CHttpException('only 4 students in the sessions!');
                }
                //echo $session->students_id;
                //break;
                $session->students_id = $session->students_id . ',' . $new_student;
                if (!($session->save())) {
                    throw new CHttpException('Unable to save!');
                }
            }
            //break;
            //

            $message = "Save Successful!!!";
        }

        $this->render('manageLessonGroup', array(
            'message' => $message,
            'data' => $data,
            'test' => $old_student_id));

    }
    /**
     * manage the invoice page
     */
    public function actionManageInvoice()
    {
        $invoice = new Invoice('search');
        if (isset($_GET['student_id'])) {
            $dataProvider = $invoice->search($_GET['student_id']);
        } else {
            $dataProvider = $invoice->search();
        }
        $student_id = $_GET['student_id'];

        $model = new Invoice('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Invoice']))
            $model->attributes = $_GET['Invoice'];

        $this->render('manageInvoice', array(
            'model' => $model,
            'dataProvider' => $dataProvider,
            ));
    }
    /**
     * manage the price page
     */
    public function actionManagePrice()
    {
        $model = Price::model()->findAll();

        $this->render('managePrice', array('model' => $model, ));
    }
    /**
     * Update the price for a particular one
     */
    public function actionUpdatePrice($id)
    {
        $model = Price::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Price'])) {
            $model->attributes = $_POST['Price'];
            if ($model->save())
                $this->redirect(array('managePrice'));
        }

        $this->render('updatePrice', array('model' => $model, ));
    }
    /**
     * manage the paygrade page
     */
    public function actionManagePayGrade()
    {
        $model = PayGrade::model()->findAll();

        $this->render('managePayGrade', array('model' => $model, ));
    }
    /**
     * Update paygrade for a particular one
     */
    public function actionUpdatePayGrade($id)
    {
        $model = Paygrade::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Paygrade'])) {
            $model->attributes = $_POST['Paygrade'];
            if ($model->save())
                $this->redirect(array('managePaygrade'));
        }

        $this->render('updatePayGrade', array('model' => $model, ));
    }
    /**
     * manage the payslip page
     */
    public function actionManagePayslip()
    {
        $day_test = 0;
        $tester = 0;
        $data = new Payslip('search');
        if (isset($_GET['staff_id'])) {
            $dataProvider = $data->search($_GET['staff_id']);
        } else {
            $dataProvider = $data->search();
        }
        // Checking for payslip
        // If not in the avalaible time, throw exception: no payslip
        // Else, check if not payslip, create one
        // Else check the next available time to create one
        $staff_id = $_GET['staff_id'];
        $term = Term::model()->getLatest();
        $start_date = new DateTime($term->start_time);
        // $start_date = date_format(new DateTime(Day::model()->findByPk($session->day_id)->date),'Y/m/d');
        $current_date = new DateTime();
        //if ($start_date < $current_date)
        //  throw new CHttpException("test");
        $daydiff = getDayBetweenDate($start_date, $current_date);
        $remainDay = 14 - $daydiff;
        if ($daydiff < 14)
            throw new CHttpException("There is .$remainDay. days to the first pay of the payslip");
        $Criteria = new CDbCriteria();
        $Criteria->condition = "staff_id =$staff_id";
        $Criteria->order = "date_end DESC";
        $findingPayslip = new Payslip;
        $findingPayslip = Payslip::model()->findAll($Criteria);
        if (!$findingPayslip) {
            $date_change = new DateTime($term->start_time);
            $date_end = $date_change->modify('+2 weeks');
            // $date_test = $date_end->format('Y-m-d');
            // $date_end = new DateTime($date_end);
            $vailon = $start_date->format('Y-m-d');
            $testing = new Payslip;
            $testing = savePayment($start_date, $date_end, $staff_id);
            if (!$testing)
                throw new CHttpException("Cant create new payslip object");

        } else // check if the next payslip available or not
        {
            $count = count($findingPayslip);
            $date_start1 = new DateTime($findingPayslip[0]->date_end);
            $daydiff1 = getDayBetweenDate($date_start1, $current_date);
            $day_test = $daydiff1 / 14 - 1;
            if ($day_test >= 1 && $date_start1 <= $current_date) {
                for ($i = 0; $i < $day_test; $i++) {
                    $Criteria1 = new CDbCriteria();
                    $Criteria1->condition = "staff_id =$staff_id";
                    $Criteria1->order = "date_end DESC";
                    $findingPayslip1 = new Payslip;
                    $findingPayslip1 = Payslip::model()->findAll($Criteria1);
                    $date_change2 = new DateTime($findingPayslip1[0]->date_end);
                    $date_start2 = new DateTime($findingPayslip1[0]->date_end);
                    $date_end2 = $date_change2->modify('+2 weeks');
                    $testing = new Payslip;
                    $testing = savePayment($date_start2, $date_end2, $staff_id);
                    if (!$testing)
                        throw new CHttpException("Cant create new payslip object");
                } // create  new payslip
            }
        }
        $model = new Payslip('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Payslip']))
            $model->attributes = $_GET['Payslip'];

        $this->render('managePayslip', array(
            'model' => $model,
            'dataProvider' => $dataProvider,
            //  'data1'=>$date_test,
            //  'data2'=>$testing,
            'data3' => $day_test,
            ));
    }
    /**
     * View a particular payslip for a staff
     */
    public function actionViewPayslip($staff_id, $payslip_id)
    {
        $payslip = Payslip::model()->findByPk($payslip_id);
        $staff = Staff::model()->findByPk($staff_id);
        $totalsession = $payslip->total / Paygrade::model()->findByPk($staff->
            paygrade_id)->session;
        if ($payslip === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $this->render('viewPayslip', array(
            'payslip' => $payslip,
            'staff' => $staff,
            'sessions' => $totalsession,
            ));
    }
    /**
     * View a particular invoce for a student
     */
    public function actionViewInvoice($student_id, $invoice_id)
    {
        $invoice = Invoice::model()->findByPk($invoice_id);
        $student = Student::model()->findByPk($student_id);
        $lesson = Lesson::model()->findByPk($invoice->lesson_id);
        //  $totalsession = $payslip->total / Paygrade::model()->findByPk($staff->paygrade_id)->session;
        //if($payslip===null)
        //	throw new CHttpException(404,'The requested page does not exist.');
        //
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $this->render('viewInvoice', array(
            'invoice' => $invoice,
            'student' => $student,
            'lesson' => $lesson,
            //  'sessions'=>$totalsession,
            ));
    }
    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
    // return the filter configuration for this controller, e.g.:
    return array(
    'inlineFilterName',
    array(
    'class'=>'path.to.FilterClass',
    'propertyName'=>'propertyValue',
    ),
    );
    }

    public function actions()
    {
    // return external action classes, e.g.:
    return array(
    'action1'=>'path.to.ActionClass',
    'action2'=>array(
    'class'=>'path.to.AnotherActionClass',
    'propertyName'=>'propertyValue',
    ),
    );
    }
    */
}
