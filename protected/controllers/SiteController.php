<?php

class SiteController extends Controller
{
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
				'actions'=>array('captcha','page','index','error','contact','maintenance'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('login','register'),
				'users'=>array('?'),
			),
			array('allow',
				'actions'=>array('logout'),
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xEEEEEA,
				'foreColor'=>0x000000,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$dataProvider_featured=new CActiveDataProvider('Item',array(
			'criteria'=>array(
				'order'=>'updated DESC',
			),
			'pagination'=>array(
				'pageSize'=>isset($_GET['ajax_pageSize']) ? $_GET['ajax_pageSize'] : 5,
			),
		));
		$dataProvider_latest=new CActiveDataProvider('Item',array(
			'criteria'=>array(
				'order'=>'created DESC',
			),
			'pagination'=>array(
				'pageSize'=>5,
			),
		));
		Yii::app()->theme='responsive';
		$this->render('index',array(
			'dataProvider_featured'=>$dataProvider_featured,
			'dataProvider_latest'=>$dataProvider_latest,
		));
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
	        	$this->render('error',$error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
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
			$model->validate();
			if($model->getErrorCode()==3)
			{
				$email=Yii::app()->params['user']=Yii::app()->db->createCommand()
					->select('email')
					->from('user')
					->where('id=:id or email=:id',array(':id'=>$model->username))
					->queryScalar();
				$this->redirect(array('/admin/user/unverified','email'=>$email));
			}
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->getReturnUrl());
		}
		if(isset($_REQUEST['username']))
			$model->username=$_REQUEST['username'];
		// display the login form
		Yii::app()->theme='responsive';
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

	public function actionRegister()
	{
		$model=new RegisterForm;

		// uncomment the following code to enable ajax-based validation
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['RegisterForm']))
		{
			$model->attributes=$_POST['RegisterForm'];
			if($model->validate() && $model->save())
			{
				user_login($model->id);

				email_sendVerification($model->id,'Registration successful!');

				Yii::app()->user->setFlash('success','You\'ve successfully registered! Please verify your email soon.');

				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		Yii::app()->theme='responsive';
		$this->render('register',array('model'=>$model));
	}

	public function actionMaintenance() {
		Yii::app()->theme='responsive';
		$this->render('maintenance');
	}
}
