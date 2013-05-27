<?php

class TermController extends Controller
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
		$model=new Term;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Term']))
		{
		  
			$model->attributes=$_POST['Term'];
  //echo date('D',strtotime($_POST['Term']['start_time']));
  //break;
            if (date('D',strtotime($_POST['Term']['start_time']))!="Mon")
            {
                throw new CHttpException('The start date is supposed to be Monday!');
            }
			if($model->save())
            {
            $start_time_new = $model->start_time;
            $model->start_time = date_create((String)$model->start_time)->format('Y-m-d');
            $model->save(); 
            $term_id = $model->id;
        // we gonna create new things in here
        // TAO 7 WEEK///////////////////////////////////////////////////////////////////
        
        $string_date=(String)$start_time_new;

        //break;

        //date_add($start_date, date_interval_create_from_date_string('40 days'));
        //print_r($start_date->format('Y-m-d'));
        //echo "aaa";
        //$day = new Day;
        //$day->day_no = 111;
        //$str = 18;
        //$str = (String)$str.' days';
        //$date_temp = $start_date;
        //date_add($date_temp, date_interval_create_from_date_string('40 days'));
        //$day->date = $date_temp->format('Y-m-d');
        //$day->save();
        ////////////////////////////////////////////////////////////////////////////////
        
        
        for ($i=0;$i<12;$i++)
        {
        // tao 12 tuan cho term do
        $week = new Week;
        $week->term_id = $term_id;
        $week->week_no = $i+1;
        $week->save();
        $week_id = $week->id;
        
        for ($j=0;$j<7;$j++)
        // moi tuan tao 7 ngay
        {
        $date_temp = date_create($string_date); 
        $day = new Day;
        $day->week_id = $week_id;
        $day->day_no = $j+1;
        $str = 0;
        $str = $i*7+$j;
        $str = (String)$str.' days';
        date_add($date_temp, date_interval_create_from_date_string($str));
        
        $day->date = $date_temp->format('Y-m-d');
        $day->save();
        }
        }
        

        
        // end of creation    
				$this->redirect(array('view','id'=>$model->id));
                }
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['Term']))
		{
			$model->attributes=$_POST['Term'];
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            $message = null;
            if (isset($_POST['term'])) {
            Yii::app()->session['current_term'] = $_POST['term'];
          //  echo ' Yii app session:' . Yii::app()->session['current_term'];
            $current_term = Yii::app()->session['current_term'];
            $message = "Term number : $current_term has been selected";
            }
            $term = Term::model()->getLatest();
            //echo ' Yii app session:' . Yii::app()->session['current_term'];
            //echo ' latest term id:' . $term->id;

            $this->render('index', array('term' => $term->id, 'message' => $message));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Term('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Term']))
			$model->attributes=$_GET['Term'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Term the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Term::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Term $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='term-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
