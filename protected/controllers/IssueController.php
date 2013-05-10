<?php

class IssueController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */

/**
* @var private property containing the associated Project model instance.
* Y NGHIA CUA FILTER DO LA TRUOC KHI LOAD CONTROLLER NAO THI TA SE LOAD CAC CAI FILTER TRUOC, VA SAU DO MOI THUC HIEN CAC ACTIONS SAU
* NGHIA LA KHI TA DUNG FILTER THI NO SE LOAD CAI PROJECT TUONG UNG VOI CAC ISSUE DE VAO BIEN _PROJECT TRUYEN VAO CAC VIEW
* ??? VAN DE CHUA HIEU O DAY LA CAI $_GET['pid']] O DAU RA MA THOI.
* KHI MUON HIEN RA ERROR THI TA CU THROW NEW EXCEPTION RA LA OK
*/
// DINH NGHIA RA 2 HAM DE TRICH XUAT RA STATUS AND TYPE DE DISPLAY KHI TA HIEN THI RA FORM CREATE CUA ISSUE



private $_project = null;
/**
* Protected method to load the associated Project model class
* @param integer projectId the primary identifier of the associated Project
* @return object the Project data model based on the primary key
*/

protected function loadProject($projectId)
{
	//if the project property is null, create it based on input id
	if($this->_project===null)
	{
	$this->_project=Project::model()->findByPk($projectId);
		if($this->_project===null)
		{
	throw new CHttpException(404,'Project not exist!');
		}
	}
	return $this->_project;
}
/**
* In-class defined filter method, configured for use in the above filters()
* method. It is called before the actionCreate() action method is run in
* order to ensure a proper project context
*/

public function filterProjectContext($filterChain)
{
	//set the project identifier based on GET input request variables
	if(isset($_GET['pid']))
	$this->loadProject($_GET['pid']);
	else
	throw new CHttpException(403,'Chi cac project dac biet hien ra truoc khi thuc hien action nay.');
	//complete the running of other filters and execute the requested action
	$filterChain->run();
}

/*..THEM VAO O TRUOC..*/

    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'projectContext + create index admin', //
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
		$model=new Issue;
        $model->project_id= $this->_project->id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Issue']))
		{
		  // 1 Model se duoc luu duoi dang post khi create check xom co khong
			$model->attributes=$_POST['Issue'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
        // neu khong ton tai bien POST create thi ta se hien thi form create ra.
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

		if(isset($_POST['Issue']))
		{
			$model->attributes=$_POST['Issue'];
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
		$dataProvider=new CActiveDataProvider('Issue',array('criteria'=>array('condition'=>'project_id=:project_id','params'=>array(':projectId'=>$this->_project->id)
  )
        )
        );
        // nghia la cai viec index ra cac cai issue lien quan toi project
        // them cai condition va dinh nghia bien duoc su dung trong condition
        // TAT CA NHUNG CONG VIEC TREN CHI DE LAM 1 DIEU DO LA DAM BAO KHI TA
        // IN RA THI TA SE CHI IN RA TAT CA NHUNG ISSU THUOC VE PROJECT DO MA THOI
        // O DAY CO NGHIA LA TA SE CHI LAM VIEC VOI P?TICULAR PROJECT NHAT DINH MA THOI
        
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Issue('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Issue']))
			$model->attributes=$_GET['Issue'];
        $model->project_id = $this->_project->id; 

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Issue the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Issue::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Issue $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='issue-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
}
