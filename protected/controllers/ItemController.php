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
				'actions'=>array('create','index','view','search','search_autoComplete'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('create','createWanted','update','updateWanted','delete','ajaxRemoveImage'),
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
		if(Yii::app()->user->hasState('item') && Yii::app()->user->getState('item')===$id)
		{
			Item::model()->updateByPk($id,array('user_id'=>Yii::app()->user->id));
			Yii::app()->user->setState('item',null);
		}
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
				if(Yii::app()->user->isGuest)
				{
					$model_contact->replier_email=$model_contactForm->email;
					$model_contact->replier_name=$model_contactForm->name;
				}
				else
				{
					$model_contact->user_id_replier=Yii::app()->user->id;
				}
				$model_contact->user_id_poster=$model->user_id;
				if($model_contact->save() || isset($model_contact->id))
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
						),file_get_contents(Yii::getPathOfAlias('webroot').'/themes/responsive/css/emailWrapper.css')
					);
					$headers="From: ".$model_contact->replier_name." <".$model_contact->getReplierEmail().">\r\nContent-Type: text/html";

					if(mail($model->user->name_first.' <'.$model->user->email.'>',Yii::app()->name.' New Message',$body->convert(),$headers))
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
				$i=0;
				foreach($images as $image) {
					$name=md5($image->name.time().$i).'.'.strtolower($image->extensionName);
					image_autoOrient($image);
					$image->saveAs(Yii::getPathOfAlias('webroot').'/img/uploads/temp/'.$name);
					$uploads[]=array('name'=>$image->name,'tempName'=>$name,'new'=>true);
					$i++;
				}
				$photos=CUploadedFile::getInstances($model,'photo');
				foreach($photos as $photo) {
					$name=md5($photo->name.time().$i).'.'.strtolower($photo->extensionName);
					image_autoOrient($photo);
					$photo->saveAs(Yii::getPathOfAlias('webroot').'/img/uploads/temp/'.$name);
					$uploads[]=array('name'=>$photo->name,'tempName'=>$name,'new'=>true);
					$i++;
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

				if(Yii::app()->user->isGuest)
				{
					Yii::app()->user->setState('user',array(
						'location'=>$model->location_id,
						'phone'=>$model->phone,
					));
					Yii::app()->user->setState('item',$model->id);
					Yii::app()->user->setReturnUrl(array('/item/view','id'=>$model->id));
					$this->redirect(array('/site/login'));
				}
				else
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
				$i=0;
				foreach($images as $image) {
					$name=md5($image->name.time().$i).'.'.strtolower($image->extensionName);
					image_autoOrient($image);
					$image->saveAs(Yii::getPathOfAlias('webroot').'/img/uploads/temp/'.$name);
					$uploads[]=array('name'=>$image->name,'tempName'=>$name,'new'=>true);
					$i++;
				}
				$photos=CUploadedFile::getInstances($model,'photo');
				foreach($photos as $photo) {
					$name=md5($photo->name.time().$i).'.'.strtolower($photo->extensionName);
					image_autoOrient($photo);
					$photo->saveAs(Yii::getPathOfAlias('webroot').'/img/uploads/temp/'.$name);
					$uploads[]=array('name'=>$photo->name,'tempName'=>$name,'new'=>true);
					$i++;
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

	public function actionCreateWanted()
	{
		$model=new WantedForm;
		$model->wanted=true;

		$this->performAjaxValidation($model);

		if(isset($_POST['WantedForm']))
		{
			$model->attributes=$_POST['WantedForm'];
			
			if($model->save())
			{
				Yii::app()->user->setFlash('success','Your wanted item has been posted successfully');
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		Yii::app()->theme='responsive';
		$this->render('createWanted',array(
			'model'=>$model,
		));
	}

	public function actionUpdateWanted($id)
	{
		$model=$this->loadModel($id);
			

		$params=array('WantedForm'=>$model);
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

		if(isset($_POST['WantedForm']))
		{
				if($model->save())
					$this->redirect(array('view','id'=>$model->id));
			}

		Yii::app()->theme='responsive';
		$this->render('updateWanted',array(
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
			'criteria'=>array(
				'condition'=>'user_id IS NOT NULL',
			),
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

		$criteria=new CDbCriteria;
		$criteria->condition='title LIKE \'%'.str_replace(' ','%',$keywords).'%\''.
			' AND user_id IS NOT NULL';

		// university
		if(!Yii::app()->user->isGuest) {
			$criteria->join='LEFT JOIN user ON user_id=user.id';
			$criteria->addCondition('user.university_id='.Yii::app()->params['user']->university_id);
		}

		// course
		if(isset($_GET['course'])) {
			$criteria->addCondition('course=true', 'AND');
			if($_GET['course'] > 0) {
				$criteria->join='LEFT JOIN user ON user_id=user.id';
				$criteria->addCondition('user.course_id='.$_GET['course'],'AND');
			}
		}

		// price
		if(isset($_GET['price-max'])) {
			$criteria->addCondition('price<='.$_GET['price-max'],'AND');
		}

		// categories
		$categories = [];
		$subcategories = [];
		if(isset($_GET['category'])) {
			$model_category=ItemCategory::model()->findByPk($_GET['category']);

			$condition='(category_id='.$model_category->id;
			$children=Yii::app()->db->createCommand()
				->select('id,title')
				->from('item_category')
				->where('parent_id=:cat',array(':cat'=>$model_category->id))
				//->order('title')
				->queryAll();
			$subcategories+=array(''=>'select a subcategory');
			foreach($children as $child) {
				$condition.=' || category_id='.$child['id'];
				$subcategories+=array($child['id']=>$child['title']);
			}
			$condition.=')';
			$criteria->addCondition($condition,'&');

			// for breadcrumbs
			$categories=array($model_category->title=>array('/item/search','category'=>$model_category->id));
			while($model_category->parent_id)
			{
				$model_category=ItemCategory::model()->findByPk($model_category->parent_id);
				$categories=array($model_category->title=>array('/item/search','category'=>$model_category->id))+$categories;
			}
		}
		else
		{
			$children=Yii::app()->db->createCommand()
				->select('id,title')
				->from('item_category')
				->where('parent_id IS NULL')
				//->order('title')
				->queryAll();
			$subcategories+=array(''=>'select a category');
			foreach($children as $child) {
				$subcategories+=array($child['id']=>$child['title']);
			}
		}

		// sort
		if(isset($_GET['sort'])) {
			switch($_GET['sort']) {
				case 'price-low':
					$criteria->order='price';
					break;
				case 'price-high':
					$criteria->order='price DESC';
					break;
				default:
					$criteria->order='updated DESC';
			}
		} else
			$criteria->order='updated DESC';

		$dataProvider=new CActiveDataProvider('Item',array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>isset($_GET['ajax_pageSize']) ? $_GET['ajax_pageSize'] : 5,
			),
		));

		Yii::app()->theme='responsive';
		$this->render('search',array(
			'categories'=>$categories,
			'subcategories'=>$subcategories,
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
				'condition'=>'title LIKE \'%'.str_replace(' ','%',$term).'%\''.
					' AND user_id IS NOT NULL',
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

	public function actionAjaxRemoveImage()
	{
		$this->renderPartial('ajax/_removeImage');
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
