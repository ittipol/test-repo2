<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	// public function actions()
	// {
	// 	return array(
	// 		// captcha action renders the CAPTCHA image displayed on the contact page
	// 		'captcha'=>array(
	// 			'class'=>'CCaptchaAction',
	// 			'backColor'=>0xFFFFFF,
	// 		),
	// 		// page action renders "static" pages stored under 'protected/views/site/pages'
	// 		// They can be accessed via: index.php?r=site/page&view=FileName
	// 		'page'=>array(
	// 			'class'=>'CViewAction',
	// 		),
	// 	);
	// }

	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
	    return array(
			array('allow',
				'actions'=>array('login','error','assignRole','createUser','updatePerm'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('index','logout'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$university_id = Yii::app()->user->getState('university_id');

		$data['reports'] = array();

		$total_member = Member::model()->getTotalMemberBySchoolId($university_id);
		$data['total_member'] = $total_member;

		// total paid
		$total_invoice = Invoice::model()->getTotalInvoice("รอชำระเงิน",$university_id);
		$data['total_invoice_not_paid'] = $total_invoice;

		$total_invoice = Invoice::model()->getTotalInvoice("ชำระเงินเรียบร้อยเเล้ว",$university_id);
		$data['total_invoice_paid'] = $total_invoice;

		$data['total_invoice'] = $data['total_invoice_not_paid'] + $data['total_invoice_paid'];

		$total_course = Course::model()->getTotalCouresBySchoolId($university_id);
		$data['total_course'] = $total_course;

		$this->render('index',$data);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}


	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	// public function actionUpdatePerm()
	// {
	// 	$auth=Yii::app()->authManager;
		 
	// 	// $auth->createOperation('createAction','create action');
	// 	// $auth->createOperation('readAction','read action');
	// 	// $auth->createOperation('updateAction','update action');
	// 	// $auth->createOperation('deleteAction','delete action');

	// 	// $role=$auth->createRole('administrator');

	// 	$user_model = new User();

	// 	$user_model->username = '1';
	// 	$user_model->password = md5(1);
	// 	$user_model->date_added =  date("Y-m-d H:i:s");
	// 	$user_model->save(false);

	// 	$auth=Yii::app()->authManager;
	// 			if($auth->assign('administrator',$user_model->user_id)) {
	// 	            Yii::app()->authManager->save();
	// 			}

		
	// 	// $auth=Yii::app()->authManager;
		
	// 	// if($auth->assign('administrator','admin')) {
 //  //           Yii::app()->authManager->save();
	// 	// }
		
	// 	// if($auth->assign('staff','staff')) {
 //  //           Yii::app()->authManager->save();
	// 	// }	

	// 	// if($auth->assign('teacher','teacher')) {
 //  //           Yii::app()->authManager->save();
	// 	// }	
	// }

	public function actionCreateUser(){

		$username = "teacher";
		$password = "teacher";
		$role = "staff";
		$university_id = 0;

		$user = new User();

		$user->username = $username;
		$user->password = $password;
		// $user->repeat_password = $password;
		$user->firstname = "global";
		$user->lastname = "admin";
		$user->role = $role;
		$user->date_added = date("Y-m-d H:i:s");
		$user->university_id = $university_id;

		$user->save(false);

		$auth=Yii::app()->authManager;

		if($auth->assign($role, $user->username)) {
            Yii::app()->authManager->save();
		}

	}

	public function actionAssignRole(){

		$auth=Yii::app()->authManager;

		// $auth->createOperation('createPost','create a post');
		// $auth->createOperation('readPost','read a post');
		// $auth->createOperation('updatePost','update a post');
		// $auth->createOperation('deletePost','delete a post');

		// $role=$auth->createRole('teacher');
		// $role->addChild('createPost');
		// $role->addChild('updatePost');
		// $role->addChild('deletePost');
		// $role->addChild('readPost');

		$role=$auth->createRole('staff');
		// $role->addChild('teacher');

		$role=$auth->createRole('administrator');
		$role->addChild('staff');

	}

	public function actionUpdatePerm()
	{
		$auth=Yii::app()->authManager;
		 
		// $auth->createOperation('createAction','create action');
		// $auth->createOperation('readAction','read action');
		// $auth->createOperation('updateAction','update action');
		// $auth->createOperation('deleteAction','delete action');
		 
		$role=$auth->createRole('teacher');
		 
		$role=$auth->createRole('staff');
		$role->addChild('teacher');

		$role=$auth->createRole('administrator');
		$role->addChild('staff');

		$this->actionCreateUser();
		
	}

}
