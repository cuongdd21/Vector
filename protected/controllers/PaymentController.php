<?php
require_once(dirname(__FILE__).'/../components/PaymentHelper.php');
class PaymentController extends Controller
{
    	public $layout='//layouts/column2';
        	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations // we only allow deletion via POST request
		);
	}
        public function accessRules()
    {
        return array(
            array('deny',
                'actions'=>array('index'),
                'users'=>array('?'),
            ),
        );
    }
    public function actionIndex()
    {
        $this->render('index');
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
               public function actionManagePayGrade()
           {
                $model=PayGrade::model()->findAll();

		$this->render('managePayGrade',array(
			'model'=>$model,
		));
           }
           public function actionUpdatePayGrade($id)
	{
            	$model=Paygrade::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Paygrade']))
		{
			$model->attributes=$_POST['Paygrade'];
			if($model->save())
				$this->redirect(array('managePaygrade'));
		}

		$this->render('updatePayGrade',array(
			'model'=>$model,
		));
	}
    public function actionManagePayslip()
    {
            $day_test = 0;
             $tester = 0;
             $data = new Payslip('search');
                if (isset($_GET['staff_id']))
            {
                $dataProvider = $data->search($_GET['staff_id']);
            }
            else
            {
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
                if(!$findingPayslip)
                {
                    $date_change = new DateTime($term->start_time);
                    $date_end = $date_change->modify('+2 weeks');
                   // $date_test = $date_end->format('Y-m-d');
                   // $date_end = new DateTime($date_end);
                        $vailon = $start_date->format('Y-m-d');
                    $testing = new Payslip;
                     $testing = savePayment($start_date, $date_end, $staff_id);
                     if(!$testing)
                         throw new CHttpException("Cant create new payslip object");
                    
                }
                else // check if the next payslip available or not
                {
                    $count = count($findingPayslip);
                        $date_start1 = new DateTime($findingPayslip[0]->date_end);
                        $daydiff1 = getDayBetweenDate($date_start1, $current_date);
                        $day_test = $daydiff1/14 -1;
                        if ($day_test >= 1 && $date_start1 <= $current_date)
                       {
                            for ($i=0; $i<$day_test; $i++)
                            {
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
                               if(!$testing)
                                   throw new CHttpException("Cant create new payslip object");  
                            }// create  new payslip
                       }                   
                }
		$model=new Payslip('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Payslip']))
			$model->attributes=$_GET['Payslip'];

		$this->render('managePayslip',array(
			'model'=>$model,
                    'dataProvider'=>$dataProvider,
                  //  'data1'=>$date_test,
                  //  'data2'=>$testing,
                    'data3'=>$day_test,
		));
    }      
    public function actionViewPayslip($staff_id, $payslip_id)
	{
            	$payslip = Payslip::model()->findByPk($payslip_id);
                $staff = Staff::model()->findByPk($staff_id);
                $totalsession = $payslip->total / Paygrade::model()->findByPk($staff->paygrade_id)->session;
		if($payslip===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$this->render('viewPayslip',array(
			'payslip'=>$payslip,
                        'staff'=>$staff,
                        'sessions'=>$totalsession,
		));
	}
        public function actionViewInvoice($student_id, $invoice_id)
	{
            	$invoice = Invoice::model()->findByPk($invoice_id);
                $student = Student::model()->findByPk($student_id);
              //  $totalsession = $payslip->total / Paygrade::model()->findByPk($staff->paygrade_id)->session;
		//if($payslip===null)
		//	throw new CHttpException(404,'The requested page does not exist.');
		//
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$this->render('viewInvoice',array(
			'invoice'=>$invoice,
                        'student'=>$student,
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
