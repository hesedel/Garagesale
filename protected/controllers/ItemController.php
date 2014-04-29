<?php

class ItemController extends Controller
{
	public $layout='//layouts/column1';

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
				'actions'=>array('index','view','search','search_autoComplete'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('create','update','delete'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('admin'),
				'roles'=>array('admin','super'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

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
					$body=new CSSToInlineStyles(
						Yii::app()->controller->renderPartial(
							'/site/_emailWrapper',
							array(
								'data'=>Yii::app()->controller->renderPartial(
									'_sendMessage-email',
									array(
										'name_replier'=>$model_contact->replier_name,
										'name_poster'=>$model->user->name_first,
										'message'=>$model_contactForm->body,
									),true
								)
							),true
						),file_get_contents(Yii::getPathOfAlias('webroot').'/css/emailWrapper.css')
					);
					$headers="From: ".$model_contact->replier_name." <".$model_contact->getReplierEmail().">\r\nContent-Type: text/html";
					mail($model_contact->user->email, Yii::app()->name.' New Message', $body->convert(), $headers);

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
			$model->delete();

			if(!isset($_GET['ajax']))
				$this->redirect(Yii::app()->homeUrl);
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

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

	public function actionSearch()
	{
		$this->model_itemSearchForm->keywords=$this->processKeywords($this->model_itemSearchForm->keywords);
		$keywords=addslashes($this->model_itemSearchForm->keywords);
		$keywords=str_replace('\\','\\\\',$keywords);
		$keywords=str_replace('\\\\\'','\\\'',$keywords);

		$dataProvider=new CActiveDataProvider('Item',array(
			'criteria'=>array(
				'condition'=>'title LIKE \'%'.str_replace(' ','%',$keywords).'%\'',
			),
			'pagination'=>array(
				'pageSize'=>isset($_GET['ajax_pageSize']) ? $_GET['ajax_pageSize'] : 5,
			),
		));

		Yii::app()->theme='responsive';
		$this->render('search',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionSearch_autoComplete($term)
	{
		$term=$this->processKeywords($term);
		$term=addslashes($term);
		$term=str_replace('\\','\\\\',$term);
		$term=str_replace('\\\\\'','\\\'',$term);

		$dataProvider=new CActiveDataProvider('Item',array(
			'criteria'=>array(
				'condition'=>'title LIKE \'%'.str_replace(' ','%',$term).'%\'',
				//'limit'=>5,
			),
			'pagination'=>false,
		));

		$items=array();
		foreach($dataProvider->getData() as $item)
		{
			$items[]=array('label'=>$item->title,'value'=>$item->title);
		}

		echo CJSON::encode($items);
	}

	public function loadModel($id)
	{
		$model=Item::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	protected function processKeywords($keywords)
	{
		// remove unnecessary spaces
		$keywords=trim($keywords);
		$keywords=preg_replace('/ +/',' ',$keywords);
		return $keywords;
	}
}
