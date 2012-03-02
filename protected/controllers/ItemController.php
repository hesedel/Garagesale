<?php

class ItemController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','ajaxRemoveImage'),
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
		$model=new Item;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Item']))
		{
			$model->attributes=$_POST['Item'];
			if($model->save())
			{
				$uploads = unserialize(base64_decode($model->uploads));
				$images = CUploadedFile::getInstances($model, 'images');
				foreach($images as $image) {
					$name = md5($image->name.time()).'.'.strtolower($image->extensionName);
					$image->saveAs(Yii::getPathOfAlias('webroot').'/images/uploads/temp/'.$name);
					$uploads[] = array('name'=>$image->name, 'tempName'=>$name, 'new'=>true);
				}
				if($uploads) {
					$i = 0;
					foreach($uploads as $upload) {
						$file = pathinfo($upload['tempName']);
						$model_itemImage=new ItemImage();
						$model_itemImage->type=$file['extension'];
						$model_itemImage->size=filesize(Yii::getPathOfAlias('webroot').'/images/uploads/temp/'.$upload['tempName']);
						$model_itemImage->data=file_get_contents(Yii::getPathOfAlias('webroot').'/images/uploads/temp/'.$upload['tempName']);
						$model_itemImage->index=$i;
						$model_itemImage->item_id=$model->id;
						if($model_itemImage->save())
							//if(copy(Yii::getPathOfAlias('webroot').'/images/uploads/temp/'.$upload['tempName'], Yii::getPathOfAlias('webroot').'/images/uploads/items/'.$model_itemImage->id.'.'.$model_itemImage->type))
							unlink(Yii::getPathOfAlias('webroot').'/images/uploads/temp/'.$upload['tempName']);
						$i++;
					}
				}

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
		$this->performAjaxValidation($model);

		if(isset($_POST['Item']))
		{
			$model->attributes=$_POST['Item'];
			if($model->save())
			{
				$uploads = unserialize(base64_decode($model->uploads));
				$images = CUploadedFile::getInstances($model, 'images');
				foreach($images as $image) {
					$name = md5($image->name.time()).'.'.strtolower($image->extensionName);
					$image->saveAs(Yii::getPathOfAlias('webroot').'/images/uploads/temp/'.$name);
					$uploads[] = array('name'=>$image->name, 'tempName'=>$name, 'new'=>true);
				}
				$array1 = array();
				if($uploads) {
					$i = 0;
					foreach($uploads as $upload) {
						if($upload['new']) {
							$file = pathinfo($upload['tempName']);
							$model_itemImage=new ItemImage();
							$model_itemImage->type=$file['extension'];
							$model_itemImage->size=filesize(Yii::getPathOfAlias('webroot').'/images/uploads/temp/'.$upload['tempName']);
							$model_itemImage->data=file_get_contents(Yii::getPathOfAlias('webroot').'/images/uploads/temp/'.$upload['tempName']);
							$model_itemImage->index=$i;
							$model_itemImage->item_id=$model->id;
							if($model_itemImage->save()) {
								//if(copy(Yii::getPathOfAlias('webroot').'/images/uploads/temp/'.$upload['tempName'], Yii::getPathOfAlias('webroot').'/images/uploads/items/'.$model_itemImage->id.'.'.$model_itemImage->type))
								unlink(Yii::getPathOfAlias('webroot').'/images/uploads/temp/'.$upload['tempName']);
								$array1[] = $model_itemImage->id;
							}
							$i++;
						} else if(sizeof(Yii::app()->db->createCommand()->select('id')->from('item_image')->where('id=:id', array(':id'=>$upload['name']))->queryAll()) > 0) {
							Yii::app()->db->createCommand()->update('item_image', array(
								'index'=>$i,
							), 'id=:id', array(':id'=>$upload['name']));
							$array1[] = $upload['name'];
							$i++;
						}
					}
				}
				$images = Yii::app()->db->createCommand()
					->select('id')
					->from('item_image')
					->where('item_id=:item_id', array(':item_id'=>$id))
					->queryAll();
				$array2 = array();
				foreach($images as $image) {
					$array2[] = $image['id'];
				}
				$deletes = array_diff($array2, $array1);
				foreach($deletes as $delete) {
					$image = Yii::app()->db->createCommand()
						->select('id')
						->from('item_image')
						->where('id=:id', array(':id'=>$delete))
						->queryRow();
					Yii::app()->db->createCommand()->delete('item_image', 'id=:id', array(':id'=>$delete));
					//unlink(Yii::getPathOfAlias('webroot').'/images/uploads/items/'.$delete.'.'.$image['type']);
				}

				$this->redirect(array('view','id'=>$model->id));
			}
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			/*
			$images = Yii::app()->db->createCommand()
				->select('*')
				->from('item_image')
				->where('item_id=:item_id', array(':item_id'=>$id))
				->queryAll();
			*/
			Yii::app()->db->createCommand()->delete('item_image', 'item_id=:item_id', array(':item_id'=>$id));
			/*
			foreach($images as $image)
				unlink(Yii::getPathOfAlias('webroot').'/images/uploads/items/'.$image['id'].'.'.$image['type']);
			*/

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
		$dataProvider=new CActiveDataProvider('Item',array(
			'pagination'=>array('pageSize'=>3),
		));
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

	public function actionAjaxRemoveImage()
	{
		$this->renderPartial('ajax/_removeImage');
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
