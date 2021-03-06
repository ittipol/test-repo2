<?php

class UserController extends Controller
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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update','admin','delete'),
				'users'=>array('@'),
				'expression'=>'Yii::app()->user->checkAccess("staff")',
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
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$_POST['User']['date_added'] = date("Y-m-d H:i:s");

			if($_POST['User']['role'] == "administrator"){
				$_POST['User']['university_id'] = 0;
			}

			$model->attributes=$_POST['User'];
			if($model->save()){

				$auth=Yii::app()->authManager;

				if($auth->assign($model->role, $model->username)) {
		            Yii::app()->authManager->save();
				}

				$this->redirect(array('view','id'=>$model->user_id));
			}
		}

		if(Yii::app()->user->getState('university_id') > 0){

			// user role
			$this->data['roles'] = array(
					"teacher"=>"teacher",
					"staff"=>"staff",
				);

		}else{

			$this->data['roles'] = array(
				"teacher"=>"teacher",
				"staff"=>"staff",
				"administrator"=>"administrator",
			);

		}

		// get school name
		$school_data = School::model()->findAll();
		
		$schools = array();
		foreach ($school_data as $data) {
			$schools[$data->university_id] = $data->school_name;
		}

		$this->data['schools'] = $schools;
		$this->data['university_id'] = Yii::app()->user->getState('university_id');
		$this->data['scenario'] = "insert";
		$this->data['model'] = $model;

		$this->render('create',$this->data);
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

		if(isset($_POST['User']))
		{
			if($_POST['User']['role'] == "administrator"){
				$_POST['User']['university_id'] = 0;
			}

			$model->attributes=$_POST['User'];
			if($model->save(false))
				$this->redirect(array('view','id'=>$model->user_id));
		}

		if(Yii::app()->user->getState('university_id') > 0){

			// user role
			$this->data['roles'] = array(
					"teacher"=>"teacher",
					"staff"=>"staff",
				);

		}else{

			$this->data['roles'] = array(
				"teacher"=>"teacher",
				"staff"=>"staff",
				"administrator"=>"administrator",
			);

		}


		// get school name
		$school_data = School::model()->findAll();
		
		$schools = array();
		foreach ($school_data as $data) {
			$schools[$data->university_id] = $data->school_name;
		}

		$this->data['schools'] = $schools;
		$this->data['university_id'] = Yii::app()->user->getState('university_id');
		$this->data['scenario'] = "update";
		$this->data['model'] = $model;

		$this->render('update',$this->data);
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
		$university_id = Yii::app()->user->getState('university_id');

		if($university_id > 0){
			$dataProvider=new CActiveDataProvider('User',array(
					'criteria'=>array(
				        'condition'=>'university_id='.$university_id,
				        'order'=>'user_id ASC',
				    ),
			));
		}else{
			$dataProvider=new CActiveDataProvider('User');
		}
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$university_id = Yii::app()->user->getState('university_id');

		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
			'university_id' => $university_id,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
