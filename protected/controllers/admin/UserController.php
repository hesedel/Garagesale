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
				'actions'=>array('index','view','password_change','verify','email_change_verify'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('password_forgot','unverified'),
				'users'=>array('?'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('account','image_delete','email_change','email_change_cancel','email_change_reverify','dashboard'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update','admin','delete'),
				//'users'=>array('admin'),
				'roles'=>array('admin','super'),
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
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		$params=array('User'=>$model);
		if(
			!sizeof(preg_grep('/admin|super/', array_keys(Yii::app()->authManager->getRoles($model->id)))) ||
			Yii::app()->user->checkAccess('super')
		) {
			// do nothing
		} else
			throw new CHttpException(403,'You are not authorized to perform this action.');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
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
		$model=$this->loadModel($id);

		$params=array('User'=>$model);
		if(
			Yii::app()->user->checkAccess('deleteSelf',$params) ||
			(
				Yii::app()->user->checkAccess('admin') &&
				!sizeof(preg_grep('/admin|super/', array_keys(Yii::app()->authManager->getRoles($model->id))))
			) ||
			Yii::app()->user->checkAccess('super')
		) {
			// do nothing
		} else
			throw new CHttpException(403,'You are not authorized to perform this action.');

		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionPassword_forgot()
	{
		if(!isset($_GET['id']))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

		$user=Yii::app()->db->createCommand()
			->select('id, email, name_first')
			->from('user')
			->where('id=:id or email=:id',array(':id'=>$_GET['id']))
			->queryRow();
		if($user)
		{
			$user_changePasswordId=Yii::app()->db->createCommand()
				->select('id')
				->from('user_changePassword')
				->where('user_id=:id',array(':id'=>$user['id']))
				->queryScalar();
			if(!$user_changePasswordId) {
				$model_userChangePassword=new UserChangePassword;
				$model_userChangePassword->user_id=$user['id'];
				$model_userChangePassword->save();
				$user_changePasswordId=$model_userChangePassword->id;
			}
			$link=Yii::app()->params['serverName'].'admin/user/password_change/?id='.$user_changePasswordId;
			$body=new CSSToInlineStyles(
				Yii::app()->controller->renderPartial(
					'/site/_emailWrapper',
					array(
						'data'=>Yii::app()->controller->renderPartial(
							'/admin/user/_sendChangePassword-email',
							array(
								'name'=>$user['name_first'],
								'link'=>CHtml::link(
									$link,
									$link
								)
							),true
						)
					),true
				),file_get_contents(Yii::getPathOfAlias('webroot').'/css/emailWrapper.css')
			);
			$headers="From: ".Yii::app()->name." <".Yii::app()->params['noReplyEmail'].">\r\nContent-Type: text/html";
			mail($user['email'], Yii::app()->name.' Password Change', $body->convert(), $headers);
			$this->render('forgotPassword',array('email'=>$user['email']));
		}	
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionPassword_change()
	{
		/*
		$model_passwordChangeForm=new PasswordChangeForm;

		if(isset($_POST['ajax']) && $_POST['ajax']==='user-passwordChange-form')
		{
			echo CActiveForm::validate($model_passwordChangeForm);
			Yii::app()->end();
		}
		*/

		if(!isset($_GET['id']))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

		$id=Yii::app()->db->createCommand()
			->select('user_id')
			->from('user_changePassword')
			->where('id=:id',array(':id'=>$_GET['id']))
			->queryScalar();
		if($id)
		{
			/*
			$model_passwordChangeForm=PasswordChangeForm::model()->findByPk($id);
			$model_passwordChangeForm->password='';
			if(isset($_POST['PasswordChangeForm']))
			{
				$model_passwordChangeForm->attributes=$_POST['PasswordChangeForm'];
				if($model_passwordChangeForm->validate() && $model_passwordChangeForm->save())
					$this->redirect(array('/site/login','username'=>$id));
			}
			*/

			Yii::app()->user->logout();

			$identity=new UserIdentity('','');
			$identity->setId($id);
			Yii::app()->user->login($identity,60); // one minute

			$this->redirect(array('/admin/user/account'));

			//$this->render('changePassword',array('model'=>$model_passwordChangeForm));
		}	
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionUnverified()
	{
		if(isset($_POST['email']))
		{
			$id=Yii::app()->db->createCommand()
				->select('id')
				->from('user')
				->where('email=:email and verified=0',array(':email'=>$_POST['email']))
				->queryScalar();
			email_sendVerification($id,'Email verification resent!');
		}

		if(!isset($_GET['email']))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

		$email=Yii::app()->db->createCommand()
			->select('email')
			->from('user')
			->where('email=:email and verified=0',array(':email'=>$_GET['email']))
			->queryScalar();
		if($email)
			$this->render('unverified',array('email'=>$email));
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionVerify()
	{
		if(!isset($_GET['id']))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

		$id=Yii::app()->db->createCommand()
			->select('user_id')
			->from('user_verify')
			->where('id=:id',array(':id'=>$_GET['id']))
			->queryScalar();
		if($id)
		{
			Yii::app()->user->logout();
			Yii::app()->db->createCommand()->update('user',array(
				'verified'=>1,
			),'id=:id',array(':id'=>$id));
			Yii::app()->db->createCommand()->delete('user_verify','id=:id',array(':id'=>$_GET['id']));
			$email=Yii::app()->db->createCommand()
				->select('email')
				->from('user')
				->where('id=:id',array(':id'=>$id))
				->queryScalar();

			$identity=new UserIdentity('','');
			$identity->setId($id);
			Yii::app()->user->login($identity,60); // one minute

			$this->redirect(Yii::app()->homeUrl);
			//$this->render('verify',array('username'=>$id,'email'=>$email));
		}	
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionAccount()
	{
		$model=AccountForm::model()->findByPk(Yii::app()->user->id);
		$success=false;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AccountForm']))
		{
			$model->attributes=$_POST['AccountForm'];
			$model->password_old=$_POST['AccountForm']['password_old'];
			$model->password_repeat=$_POST['AccountForm']['password_repeat'];
			$model->image_temp=CUploadedFile::getInstance($model,'image_temp');
			if($model->save())
			{
				$success=true;
				$model->password_old='';
				$model->password='';
				$model->password_repeat='';
			}
		}

		$this->render('account',array(
			'model'=>$model,
			'success'=>$success,
		));
	}

	public function actionImage_delete($id=null)
	{
		if(!isset($id))
			$id=Yii::app()->user->id;

		$model=$this->loadModel($id);

		$params=array('User'=>$model);
		if(
			Yii::app()->user->checkAccess('updateSelf',$params) ||
			(
				Yii::app()->user->checkAccess('admin') &&
				!sizeof(preg_grep('/admin|super/', array_keys(Yii::app()->authManager->getRoles($model->id))))
			) ||
			Yii::app()->user->checkAccess('super')
		) {
			// do nothing
		} else
			throw new CHttpException(403,'You are not authorized to perform this action.');

		if($model->deleteImage($id))
		{
			if(isset($_POST['ajax'])) {
				$this->renderPartial('_noImage',array(
					'model'=>$model,
				));
			} else {
				$this->redirect(Yii::app()->user->getReturnUrl());
			}
		}
	}

	public function actionEmail_change()
	{
		$model=UserChangeEmail::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->id));
		if(!$model)
			$model=new UserChangeEmail;
		$success=false;

		if(isset($_POST['UserChangeEmail']))
		{
			$model->attributes=$_POST['UserChangeEmail'];
			if($model->save())
				$success=true;
		}

		$this->render('changeEmail',array(
			'model'=>$model,
			'success'=>$success,
		));
	}

	public function actionEmail_change_cancel($id=null)
	{
		if(!$id)
			$id=Yii::app()->user->id;

		$model=UserChangeEmail::model()->find('user_id=:user_id',array(':user_id'=>$id));
		if($model)
			$model->delete();

		if(isset($_GET['ajax']))
		{
			$model->email=Yii::app()->db->createCommand()
				->select('email')
				->from('user')
				->where('id=:id',array(':id'=>$id))
				->queryScalar();
			$this->renderPartial('account/_email',array('model'=>$model));
		}
		else
			$this->redirect(array('/admin/user/account'));
	}

	public function actionEmail_change_reverify($id=null)
	{
		if(!$id)
			$id=Yii::app()->user->id;

		$model=UserChangeEmail::model()->find('user_id=:user_id',array(':user_id'=>$id));
		if($model)
			$model->sendEmailChangeVerification();

		$this->redirect(array('/admin/user/account'));
	}

	public function actionEmail_change_verify()
	{
		if(!isset($_GET['id']))
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');

		$user=Yii::app()->db->createCommand()
			->select('user_id, email')
			->from('user_changeEmail')
			->where('id=:id',array(':id'=>$_GET['id']))
			->queryRow();
		if($user)
		{
			Yii::app()->user->logout();
			Yii::app()->db->createCommand()->update('user',array(
				'email'=>$user['email'],
			),'id=:id',array(':id'=>$user['user_id']));
			Yii::app()->db->createCommand()->delete('user_changeEmail','id=:id',array(':id'=>$_GET['id']));

			$identity=new UserIdentity('','');
			$identity->setId($user['user_id']);
			Yii::app()->user->login($identity,60); // one minute

			$this->redirect(Yii::app()->createUrl('admin/user/account'));
		}	
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionDashboard()
	{
		$dataProvider=new CActiveDataProvider('Item',array(
			'criteria'=>array(
                'condition'=>'user_id = :user_id',
				'order'=>'updated DESC',
                'params'=>array(':user_id'=>Yii::app()->user->id)
			),
			'pagination'=>array(
				'pageSize'=>isset($_GET['ajax_pageSize']) ? $_GET['ajax_pageSize'] : 4,
			),
		));

		$this->render('dashboard', array('dataProvider'=>$dataProvider));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
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
	 * @param CModel the model to be validated
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
