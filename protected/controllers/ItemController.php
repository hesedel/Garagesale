<?php

class ItemController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
		$model=$this->loadModel($id);
		$model_contactForm=new ItemContactForm;
		$model_contactForm_success=false;

		if(!Yii::app()->user->isGuest)
		{
			$model_contactForm->email=Yii::app()->params['user']->email;
			$model_contactForm->name=Yii::app()->params['user']->name_first;
		}

		if(isset($_POST['ItemContactForm']))
		{
			$model_contactForm->attributes=$_POST['ItemContactForm'];
			if($model_contactForm->validate())
			{
				$model_contact=new ItemContact;
				$model_contact->item_id=$id;
				$model_contact->replier_email=$model_contactForm->email;
				$model_contact->replier_name=$model_contactForm->name;
				$model_contact->user_id_poster=$model->user_id;
				if($model_contact->save())
				{
					$model_contactForm_success=true;
				}
			}
		}

		Yii::app()->theme='responsive';
		if(isset($_POST['ajax']) && $_POST['ajax']==='item-contact-form') {
			$this->renderPartial('view/_contact',array(
				'model'=>$model_contactForm,
				'model_success'=>$model_contactForm_success,
			));
			Yii::app()->end();
		}
		$this->render('view',array(
			'model'=>$model,
			'model_contactForm'=>$model_contactForm,
			'model_contactForm_success'=>$model_contactForm_success,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Item;
		$model->location_id=Yii::app()->db->createCommand()
			->select('location_id')
			->from('user')
			->where('id=:user_id',array(':user_id'=>Yii::app()->user->id))
			->queryScalar();
		$model->phone=Yii::app()->db->createCommand()
			->select('phone')
			->from('user')
			->where('id=:user_id',array(':user_id'=>Yii::app()->user->id))
			->queryScalar();

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Item']))
		{
			$model->attributes=$_POST['Item'];
			$model->location_id=$_POST['Item']['location_id'];
			if($model->save())
			{
				$uploads=unserialize(base64_decode($model->uploads));
				$images=CUploadedFile::getInstances($model,'images');
				foreach($images as $image) {
					$name=md5($image->name.time()).'.'.strtolower($image->extensionName);
					$image->saveAs(Yii::getPathOfAlias('webroot').'/img/uploads/temp/'.$name);
					$uploads[]=array('name'=>$image->name,'tempName'=>$name,'new'=>true);
				}
				if($uploads) {
					$i=0;
					foreach($uploads as $upload) {
						$file=pathinfo($upload['tempName']);
						$model_itemImage=new ItemImage();
						$model_itemImage->type=$file['extension'];
						$model_itemImage->size=filesize(Yii::getPathOfAlias('webroot').'/img/uploads/temp/'.$upload['tempName']);
						$model_itemImage->data=file_get_contents(Yii::getPathOfAlias('webroot').'/img/uploads/temp/'.$upload['tempName']);
						$model_itemImage->index=$i;
						$model_itemImage->item_id=$model->id;
						if($model_itemImage->save())
							//if(copy(Yii::getPathOfAlias('webroot').'/img/uploads/temp/'.$upload['tempName'],Yii::getPathOfAlias('webroot').'/img/uploads/items/'.$model_itemImage->id.'.'.$model_itemImage->type))
							unlink(Yii::getPathOfAlias('webroot').'/img/uploads/temp/'.$upload['tempName']);
						$i++;
					}
				}

				$this->redirect(array('view','id'=>$model->id));
			}
		}

		Yii::app()->theme='responsive';
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
		$model->location_id=Yii::app()->db->createCommand()
			->select('location_id')
			->from('user')
			->where('id=:user_id',array(':user_id'=>$model->user_id))
			->queryScalar();
		$model->phone=Yii::app()->db->createCommand()
			->select('phone')
			->from('user')
			->where('id=:user_id',array(':user_id'=>$model->user_id))
			->queryScalar();

		$params=array('Item'=>$model);
		if(
			Yii::app()->user->checkAccess('updateOwnItem',$params) ||
			(
				Yii::app()->user->checkAccess('admin') &&
				!sizeof(preg_grep('/admin|super/', array_keys(Yii::app()->authManager->getRoles($model->user_id))))
			) ||
			Yii::app()->user->checkAccess('super')
		) {
			// do nothing
		} else
			throw new CHttpException(403,'You are not authorized to perform this action.');

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Item']))
		{
			$model->attributes=$_POST['Item'];
			$model->location_id=$_POST['Item']['location_id'];
			if($model->save())
			{
				$uploads=unserialize(base64_decode($model->uploads));
				$images=CUploadedFile::getInstances($model,'images');
				foreach($images as $image) {
					$name=md5($image->name.time()).'.'.strtolower($image->extensionName);
					$image->saveAs(Yii::getPathOfAlias('webroot').'/img/uploads/temp/'.$name);
					$uploads[]=array('name'=>$image->name,'tempName'=>$name,'new'=>true);
				}
				$array1=array();
				if($uploads) {
					$i=0;
					foreach($uploads as $upload) {
						if($upload['new']) {
							$file=pathinfo($upload['tempName']);
							$model_itemImage=new ItemImage();
							$model_itemImage->type=$file['extension'];
							$model_itemImage->size=filesize(Yii::getPathOfAlias('webroot').'/img/uploads/temp/'.$upload['tempName']);
							$model_itemImage->data=file_get_contents(Yii::getPathOfAlias('webroot').'/img/uploads/temp/'.$upload['tempName']);
							$model_itemImage->index=$i;
							$model_itemImage->item_id=$model->id;
							if($model_itemImage->save()) {
								//if(copy(Yii::getPathOfAlias('webroot').'/img/uploads/temp/'.$upload['tempName'],Yii::getPathOfAlias('webroot').'/img/uploads/items/'.$model_itemImage->id.'.'.$model_itemImage->type))
								unlink(Yii::getPathOfAlias('webroot').'/img/uploads/temp/'.$upload['tempName']);
								$array1[]=$model_itemImage->id;
							}
							$i++;
						} else if(sizeof(Yii::app()->db->createCommand()->select('id')->from('item_image')->where('id=:id',array(':id'=>$upload['name']))->queryAll()) > 0) {
							Yii::app()->db->createCommand()->update('item_image',array(
								'index'=>$i,
							),'id=:id',array(':id'=>$upload['name']));
							$array1[]=$upload['name'];
							$i++;
						}
					}
				}
				$images=Yii::app()->db->createCommand()
					->select('id')
					->from('item_image')
					->where('item_id=:item_id',array(':item_id'=>$id))
					->queryAll();
				$array2=array();
				foreach($images as $image) {
					$array2[]=$image['id'];
				}
				$deletes=array_diff($array2,$array1);
				foreach($deletes as $delete) {
					$image=Yii::app()->db->createCommand()
						->select('id')
						->from('item_image')
						->where('id=:id',array(':id'=>$delete))
						->queryRow();
					db_image('item_image',$image['id'],array('unlink'=>true));
					Yii::app()->db->createCommand()->delete('item_image','id=:id',array(':id'=>$delete));
				}

				$this->redirect(array('view','id'=>$model->id));
			}
		}

		Yii::app()->theme='responsive';
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

		$params=array('Item'=>$model);
		if(
			Yii::app()->user->checkAccess('deleteOwnItem',$params) ||
			(
				Yii::app()->user->checkAccess('admin') &&
				!sizeof(preg_grep('/admin|super/', array_keys(Yii::app()->authManager->getRoles($model->user_id))))
			) ||
			Yii::app()->user->checkAccess('super')
		) {
			// do nothing
		} else
			throw new CHttpException(403,'You are not authorized to perform this action.');

		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
				$this->redirect(Yii::app()->homeUrl);
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Item',array(
			'pagination'=>array('pageSize'=>12),
		));
		Yii::app()->theme='responsive';
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Item('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Item']))
			$model->attributes=$_GET['Item'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Item::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
