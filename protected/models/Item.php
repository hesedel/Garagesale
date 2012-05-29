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

	public function getLocationId()
	{
		
	}

	public function getLocationName()
	{
		$location_id=Yii::app()->db->createCommand()
			->select('location_id')
			->from('user')
			->where('id=:user_id',array(':user_id'=>$this->user_id))
			->queryScalar();
		if($location_id)
		{
			return Yii::app()->db->createCommand()
				->select('name')
				->from('user_location')
				->where('id=:location_id',array(':location_id'=>$location_id))
				->queryScalar();
		}
		return false;
	}

	public function getImage()
	{
		
	}

	public function getImages()
	{
		
	}

	protected function beforeSave()
	{
		if(strlen($this->location_id)==0)
			$this->location_id=null;
		Yii::app()->db->createCommand()
			->update('user',array(
				'location_id'=>$this->location_id,
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
}