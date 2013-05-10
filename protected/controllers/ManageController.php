<?php

class ManageController extends Controller
{

    public function actionIndex()
    {
        $this->render('index');
    }
    public function actionManageStaffAttendance()
    {
        $message = '';
        $staff_id = $_GET['staff_id'];
        $staff = Staff::model()->findByPk($staff_id);
        //echo $staff->id;
        //break;
         if (count($staff->lessons)==0) {
                    throw new CHttpException('Staff is currently enroll to no lesson!');
                }
        $this->render('manageStaffAttendance', array('staff' => $staff));

        
    }
        public function actionManageStudentAttendance()
    {
         
        $message = '';
        $student_id = $_GET['student_id'];
        $student = Student::model()->findByPk($student_id);
         if (count($student->lessons)==0) {
                    throw new CHttpException('Student is currently enroll to no lesson!');
                }
        $this->render('manageStudentAttendance', array('student' => $student));

    }
    public function actionManageSessionAttendance()
    {
        {
$message = null;

            $session_id = $_GET['session_id'];
            $session = Session::model()->findByPk($session_id);
            $staff_id = $session->staff_id;
            $students_id=$session->students_id;
            if (isset($_POST['staff']))
            {
             $attend ='';
             // attend for staff
             if ($_POST['staff']=='on') { $attend=$attend.'1'; } else {$attend=$attend.'0';}
             // attend for student
             $s = explode(',',$students_id);
             for ($i=0;$i<count($s);$i++)
             {
                $j=$i+1;
                if ($_POST['student_'.$j]=='on') { $attend=$attend.'1'; } else {$attend=$attend.'0';}
             }
             $session->attendance=$attend;
                if (!($session->save())) {
                    throw new CHttpException('Unable to save!');
                }
                      $message = 'Save Successful<br/>';
             
            }
            
            $this->render('manageSessionAttendance',array('staff_id'=>$staff_id,'students_id'=>$students_id,'message'=>$message,'session'=>$session));
        }
    }

    public function actionManageCurrentTerm()
    {
        $message = null;
        if (isset($_POST['term'])) {
            Yii::app()->session['current_term'] = $_POST['term'];
            echo ' Yii app session:' . Yii::app()->session['current_term'];
            $message = "Save Successful!!!";
        }

        $term = Term::model()->getLatest();
        echo ' Yii app session:' . Yii::app()->session['current_term'];
        echo ' latest term id:' . $term->id;
        $this->render('manageCurrentTerm', array('term' => $term->id, 'message' => $message));
    }
    public function actionManageLessonGroup()
    {
        //$data = lesson tuong ung
        $message = null;
        if (isset($_GET['lesson_id'])) {
            $data = Lesson::model()->findByPk($_GET['lesson_id']);
        }


        if (isset($_POST['student'])) {
            // check if the student already enroll for that lesson
            {
                for ($i = 0; $i < count($data->students); $i++) {
                    if ($data->students[$i]->student_id == $_POST['student']) {

                        throw new CHttpException('The student already enrolled in the lesson!');
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
            if (!($s->save())) {
                throw new CHttpException('Unable to save!');
            }

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

        $this->render('manageLessonGroup', array('message' => $message, 'data' => $data));

    }
    public function actionManageInvoice()
    {
        $invoice = new Invoice('search');
                if (isset($_GET['student_id']))
            {
                $dataProvider = $invoice->search($_GET['student_id']);
            }
            else
            {
                  $dataProvider = $invoice->search();
            }
            $student_id = $_GET['student_id'];

		$model=new Invoice('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Invoice']))
			$model->attributes=$_GET['Invoice'];

		$this->render('manageInvoice',array(
			'model'=>$model,
                    'dataProvider'=>$dataProvider,
		));
    }
               public function actionManagePrice()
           {
                $model=Price::model()->findAll();

		$this->render('managePrice',array(
			'model'=>$model,
		));
           }
	public function actionUpdatePrice($id)
	{
            	$model=Price::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Price']))
		{
			$model->attributes=$_POST['Price'];
			if($model->save())
				$this->redirect(array('managePrice'));
		}

		$this->render('updatePrice',array(
			'model'=>$model,
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
