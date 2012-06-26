<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property string $id
 * @property string $created
 * @property string $updated
 * @property string $title
 * @property integer $price
 * @property string $description
 * @property integer $category_id
 * @property integer $condition_id
 * @property string $user_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property ItemCategory $category
 * @property ItemCondition $condition
 * @property ItemImage[] $itemImages
 */
class Item extends CActiveRecord
{
	public $location_id;
	public $images;
	public $uploads;
	public $phone;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Item the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, price, description', 'required'),
			array('price, category_id, condition_id', 'numerical', 'integerOnly'=>true),
			array('title, user_id', 'length', 'max'=>64),
			array('phone', 'length', 'max'=>16),
			array('created, uploads', 'safe'),
			array('created', 'default', 'value'=>new CDbExpression('now()'), 'setOnEmpty'=>false, 'on'=>'insert'),
			array('updated', 'default', 'value'=>new CDbExpression('now()'), 'setOnEmpty'=>false, 'on'=>'update'),
			array('category_id, condition_id, user_id', 'default', 'value'=>null),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created, updated, title, price, description, category_id, condition_id, user_id', 'safe', 'on'=>'search'),
			array('images', 'file', 'allowEmpty'=>true, 'types'=>'gif, jpg, jpeg, png', 'minSize'=>1024, 'maxSize'=>2.5*(1024*1024), 'maxFiles'=>5), // minSize 1KB, maxSize 2.5MB
			array('images', 'ImageValidator', 'allowEmpty'=>true, 'minWidth'=>190, 'minHeight'=>190),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'category' => array(self::BELONGS_TO, 'ItemCategory', 'category_id'),
			'condition' => array(self::BELONGS_TO, 'ItemCondition', 'condition_id'),
			'itemImages' => array(self::HAS_MANY, 'ItemImage', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created' => 'Posted',
			'updated' => 'Updated',
			'title' => 'Title',
			'price' => 'Price',
			'description' => 'Description',
			'category_id' => 'Category',
			'condition_id' => 'Condition',
			'user_id' => 'User',
			'images' => 'Image(s)',
			'location_id' => 'Location',
			'phone' => 'Phone',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('condition_id',$this->condition_id);
		$criteria->compare('user_id',$this->user_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		if(strlen($this->location_id)==0)
			$this->location_id=null;
		Yii::app()->db->createCommand()
			->update('user',array(
				'location_id'=>$this->location_id,
				'phone'=>$this->phone,
			),'id=:user_id',array(':user_id'=>$this->user_id));

		return true;
	}

	protected function afterDelete()
	{
		$images=Yii::app()->db->createCommand()
			->select('id')
			->from('item_image')
			->where('item_id=:item_id',array(':item_id'=>$this->id))
			->queryAll();
		foreach($images as $image)
			db_image('item_image',$image['id'],array('unlink'=>true));
	}

	/**
	 * Custom Functions
	 * array						getCategories()
	 * string						getCategoriesString($options=array())
	 * CHtml::activeDropDownList	getCategoryDropDownList()
	 * string						getConditionClass()
	 * mixed						getExpiry()
	 * array						getImage($index=0)
	 * array						getImages()
	 * CHtml::activeDropDownList	getLocationDropDownList()
	 * array						getOtherItems()
	 * bool							userCanUpdate()
	 * bool							userCanDelete()
	 * 
	 */

	public function getCategories()
	{
		
	}

	public function getCategoriesString($options=array())
	{
		$defaults=array(
			'separator'=>', ',
		);
		$options=array_merge($defaults,$options);

		if($this->category_id != null)
		{
			$category = '';
			$category_parent = $this->category->parent_id;
			while($category_parent != null) {
				$category_parent = Yii::app()->db->createCommand()
					->select('*')
					->from('item_category')
					->where('id=:id', array(':id'=>$category_parent))
					->queryRow();
				$category = CHtml::encode($category_parent['title']).$options['separator'].$category;
				$category_parent = $category_parent['parent_id'];
			}
			return $category.CHtml::encode($this->category->title);
		} else
			return false;
	}

	public function getCategoryDropDownList()
	{
		// get the categories
		$categories = Yii::app()->db->createCommand()
			->select('*')
			->from('item_category')
			->order('title')
			->queryAll();

		// store the categories in a real array
		$listData = array();
		foreach($categories as $category)
			$listData[] = array('id'=>$category['id'], 'title'=>CHtml::encode($category['title']), 'parent_id'=>$category['parent_id']);

		// indent descendant categories
		$level_max = 0;
		foreach($listData as $i=>$data)
		{
			$level = 0;
			$parent_id = $data['parent_id'];
			while($parent_id) {
				$parent = Yii::app()->db->createCommand()
					->select('*')
					->from('item_category')
					->where('id=:parent_id', array(':parent_id'=>$parent_id))
					->queryRow();
				if($parent)
					$parent_id = $parent['parent_id'];
				else
					$parent_id = false;
				$level++;
				if($level > $level_max)
					$level_max++;
			}
			$listData[$i]['level'] = $level;
			$indentation = '';
			for($j = 0; $j < $level; $j++)
				$indentation .= '&#160; &#160;';
			$listData[$i]['title'] = $indentation.$data['title'];
		}

		// sort the categories by their ancestors
		$listData_sorted = array();
		for($i = 0; $i <= $level_max; $i++)
		{
			foreach(array_reverse($listData) as $data)
			{
				if($data['level'] == $i)
				{
					if($i == 0)
					{
						array_unshift($listData_sorted, $data);
					}
					else
					{
						$popped = array();
						$j = sizeOf($listData_sorted) - 1;
						while($listData_sorted[$j]['id'] != $data['parent_id'])
						{
							$popped[] = array_pop($listData_sorted);
							$j--;
						}
						$listData_sorted[] = $data;
						for($k = sizeOf($popped) - 1; $k >= 0; $k--)
						{
							$listData_sorted[] = $popped[$k];
						}
					}
				}
			}
		}

		return CHtml::activeDropDownList($this, 'category_id', CHtml::listData($listData_sorted, 'id', 'title'), array('encode'=>false, 'empty'=>'select a category'));
	}

	public function getConditionClass()
	{
		if($this->condition_id != null)
		{
			$condition = '';
			switch($this->condition_id) {
				case 1:
					$condition = 'old';
					break;
				default:
					$condition = 'new';
			}
			return $condition;
		} else
			return false;
	}

	public function getExpiry()
	{
		$last_update = $this->updated;
		$day = (int) 60 * 60 * 24;
		$expiry = (Yii::app()->params['item_expire'] * $day) + strtotime($last_update);
		$time_left = $expiry - time();

		if($time_left > 0)
		{
			return $time_left;
		}

		return false;
	}

    public function getImage($index=0)
	{
		$image=Yii::app()->db->createCommand()
			->select('id, type, data')
			->from('item_image')
			->where('item_id=:id and `index`='.$index, array(':id'=>$this->id))
			->queryRow();
		if($image) {
			$image['path']='/images/uploads/cache/'.md5('item_image'.$image['id']).'.'.$image['type'];
			if(!file_exists(Yii::getPathOfAlias('webroot').$image['path']))
				file_put_contents(Yii::getPathOfAlias('webroot').$image['path'], $image['data']);
			return $image;
		} else
			return false;
	}

	public function getImages()
	{
		$images = Yii::app()->db->createCommand()
			->select('id, type')
			->from('item_image')
			->where('item_id=:item_id and `index`>0', array(':item_id'=>$this->id))
			->order('index')
			->queryAll();
		if($images)
		{
			$i=0;
			foreach($images as $key=>$image)
			{
				$path=$this->getImage($i);
				$images[$key]['path']=$path['path'];
				$i++;
			}
			return $images;
		} else
			return false;
	}

	public function getLocationDropDownList()
	{
		// get the locations
		$locations = Yii::app()->db->createCommand()
			->select('*')
			->from('user_location')
			->order('name')
			->queryAll();

		// store the locations in a real array
		$listData = array();
		foreach($locations as $location)
			$listData[] = array('id'=>$location['id'], 'name'=>CHtml::encode($location['name']));

		return CHtml::activeDropDownList($this, 'location_id', CHtml::listData($listData, 'id', 'name'), array('encode'=>false, 'empty'=>'select a location'));
	}

	public function getOtherItems($options=array())
	{
		$defaults=array(
			'limit'=>3,
		);
		$options=array_merge($defaults,$options);

		$items=Yii::app()->db->createCommand()
			->select('id')
			->from('item')
			->where('id!=:id and user_id=:user_id',array(':id'=>$this->id,':user_id'=>$this->user_id))
			->queryAll();
		$array=array();
		if($items)
		{
			foreach($items as $item)
			{
				$array[]=Item::model()->findByPk($item['id']);
			}
			return $array;
		} else
			return false;
	}

	public function userCanUpdate()
	{
		$params=array('Item'=>$this);
		if(
			Yii::app()->user->checkAccess('updateOwnItem',$params) ||
			(
				Yii::app()->user->checkAccess('admin') &&
				!sizeof(preg_grep('/admin|super/', array_keys(Yii::app()->authManager->getRoles($model->user_id))))
			) ||
			Yii::app()->user->checkAccess('super')
		)
			return true;
		else
			return false;
	}

	public function userCanDelete()
	{
		$params=array('Item'=>$this);
		if(
			Yii::app()->user->checkAccess('deleteOwnItem',$params) ||
			(
				Yii::app()->user->checkAccess('admin') &&
				!sizeof(preg_grep('/admin|super/', array_keys(Yii::app()->authManager->getRoles($model->user_id))))
			) ||
			Yii::app()->user->checkAccess('super')
		)
			return true;
		else
			return false;
	}
}