<?php
require_once( dirname(__FILE__) . '/../components/ScheduleHelper.php');
require_once( dirname(__FILE__) . '/../components/PaymentHelper.php');

class LessonController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Lesson;
                $invoice = new Invoice;
                $price=Price::model()->findAll();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Lesson']))
		{
		  
       // get param
                $day= $_POST['Lesson']['day']-1;
                $slot=$_POST['Lesson']['slot'];
                $staff_id = $_POST['Lesson']['staff_id'];
                $start_week = $_POST['Lesson']['start_week']-1;
                $end_week = $_POST['Lesson']['end_week']-1;
                $student_id = (String)$_POST['Lesson']['student_id'];
                $total_week = $_POST['Lesson']['end_week'] - $_POST['Lesson']['start_week'] + 1;
            // check if ok to create sessions
            $term =Term::model()->getLatest();
              for($i=$start_week;$i<$end_week+1;$i++)
                {
                    
                    $session = getSessionAvailable($term->weeks[$i]->days[$day], $slot);
                    //print_r($session);
  
                    if (($session !=null))
                    {
                        throw new CHttpException('Unable to enrol this Lesson due to Week '.($i+1).' '.getDayText($day+1).' Slot is not available!');
                    }
                    }

                   
                    if(isset($_POST['pricePackage']) && isset($_POST['priceGroup']) && isset($_POST['priceDegree']))
                    {
                        $inputPrice = $_POST['pricePackage'].$_POST['priceGroup'].$_POST['priceDegree'];
                        $priceId = getPriceId($inputPrice);
                    } else throw new CHttpException('Unable to input price list');
                    
          // save lesson
			$model->attributes=$_POST['Lesson'];
                        $model->price_id=$priceId;
          
          // save lesson
			$model->attributes=$_POST['Lesson'];
                        $model->group = 0;
			if($model->save())
            {
                $day= $model->day-1;
                $slot=$model->slot;
                $staff_id = $model->staff_id;
                $start_week = $model->start_week-1;
                $end_week = $model->end_week-1;
                $student_id = (String)$model->student_id;
                $student_id_int = $model->student_id;
                $id=$model->id;
                
                // create invoice
                $lastInvoice = Invoice::model()->findAll(array('order'=>"id DESC",'limit'=>1));
                if(!$lastInvoice)
                    $latest_id = 0;
                else
                $latest_id = $lastInvoice[0]->id;
                $invoice->number = 'S'.$student_id .'IN'.$latest_id;
                $invoice->date_create = date('y-m-d h:m:s');
                $invoice->status = 1;
                $pricerate = Price::model()->findByPk($priceId)->rate;
                $invoice->total = $total_week * $pricerate;
                $invoice->student_id = $student_id;
                $invoice->save();
                // create student lesson
                $studentlesson = New Studentlesson;
                $studentlesson->student_id = $student_id_int;
                $studentlesson->lesson_id = $id;
                if (!($studentlesson->save()))
                {
                     throw new CHttpException('Unable to create Lesson and Student relationship!');
                }
                
                
                
                
                
                
            
                
              
         // create session
                
                for($i=$start_week;$i<$end_week+1;$i++)
                {
                    $session = getSessionAvailable($term->weeks[$i]->days[$day], $slot);
                    if ($session ===null)
                    {
                    $session = New Session;
                    $session->day_id=$term->weeks[$i]->days[$day]->id;
                    $session->staff_id=$staff_id;
                    $session->slot = $slot;
                    $session->students_id = $student_id;
                    $session->lesson_id = $id;
//                    $session->attendance ="";
                 
                                        
                    if (!$session->save())
                    {
                        
                     throw new CHttpException('unable to save session');
                    
                    }
                    }
                    //else
                    //{
                    //    if (checkStudentInString((String)$student_id, $session->students_id)===false)
                    //    {
                    //    $session->students_id = $session->students_id.','.$student_id;
                    //    }
                    //    else
                    //    {
                    //        throw new CHttpException('The student already enrolled in the lesson!');
                    //   }
                        //chen them vao trong truong hop da ton tai.
                        
                        // hien thi error neu nhu student da ton tai
                        // throw new CHttpException('The specified post cannot be found.');
                    //}
                    
                }
                

                
                
                
                
                
                
                
                
                
				$this->redirect(array('view','id'=>$model->id));
                }
		}

		$this->render('create',array(
			'model'=>$model,
                        'price'=>$price,                    
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Lesson']))
		{
			$model->attributes=$_POST['Lesson'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
	   $lesson =$this->loadModel($id);
       echo $lesson->id;
       //lesson = 6 student = 2
       break;
       
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Lesson');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Lesson('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Lesson']))
			$model->attributes=$_GET['Lesson'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Lesson the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Lesson::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Lesson $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='lesson-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
