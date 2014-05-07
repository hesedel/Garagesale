<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $email
 * @property string $created
 * @property string $updated
 * @property string $password
 * @property string $name_first
 * @property string $name_last
 * @property string $phone
 * @property string $image
 * @property string $image_type
 * @property string $image_size
 * @property integer $verified
 * @property integer $location_id
 * @property integer $course_id
 *
 * The followings are the available model relations:
 * @property Item[] $items
 * @property ItemContact[] $itemContacts
 * @property ItemContact[] $itemContacts1
 * @property UserCourse $course
 * @property UserLocation $location
 * @property UserEmailChange[] $userEmailChanges
 * @property UserMessage[] $userMessages
 * @property UserMessage[] $userMessages1
 * @property UserPasswordChange[] $userPasswordChanges
 * @property UserVerify[] $userVerifies
 */
class User extends CActiveRecord
{
	public $image_temp;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, email, name_first', 'required'),
			array('verified, location_id, course_id', 'numerical', 'integerOnly'=>true),
			array('id, password, name_first, name_last', 'length', 'max'=>32),
			array('email', 'length', 'max'=>64),
			array('phone', 'length', 'max'=>16),
			array('image_type', 'length', 'max'=>4),
			array('image_size', 'length', 'max'=>10),
			array('created, image', 'safe'),
			array('created', 'default', 'value'=>new CDbExpression('now()'), 'setOnEmpty'=>false, 'on'=>'insert'),
			array('updated', 'default', 'value'=>new CDbExpression('now()'), 'setOnEmpty'=>false, 'on'=>'update'),
			array('name_last', 'default', 'value'=>null),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, created, updated, name_first, name_last, phone, verified, location_id, course_id', 'safe', 'on'=>'search'),
			array('id', 'length', 'min'=>4),
			array('id', 'match', 'pattern'=>'/^[\d_a-z]+$/', 'message'=>'Only small letters, numbers, and underscores are allowed.'),
			array('id', 'match', 'pattern'=>'/^[a-z].*$/', 'message'=>'Username must begin with a small letter.'),
			array('id', 'match', 'pattern'=>'/^[a-z]+(_?[^_])+$/', 'message'=>'Username cannot consist of consecutive underscores or end with it.'),
			array('id, email', 'unique'),
			array('email', 'email'),
			array('email', 'match', 'pattern'=>'/^.+\.edu\.au$/', 'message'=>'Email needs to be from an educational account, like name@school.edu.au.'),
			array('email', 'authenticateEmail'),
			array('password', 'required', 'on'=>'insert'),
			array('password', 'length', 'min'=>8),
			array('image_temp', 'file', 'allowEmpty'=>true, 'types'=>'gif, jpg, jpeg, png', 'safe'=>true, 'minSize'=>16*1024, 'maxSize'=>3*(1024*1024)), // minSize 16KB, maxSize 3MB
			array('image_temp', 'ImageValidator', 'allowEmpty'=>true, 'safe'=>true),
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
			'items' => array(self::HAS_MANY, 'Item', 'user_id'),
			'itemContacts' => array(self::HAS_MANY, 'ItemContact', 'user_id_replier'),
			'itemContacts1' => array(self::HAS_MANY, 'ItemContact', 'user_id_poster'),
			'course' => array(self::BELONGS_TO, 'UserCourse', 'course_id'),
			'location' => array(self::BELONGS_TO, 'UserLocation', 'location_id'),
			'userEmailChanges' => array(self::HAS_MANY, 'UserEmailChange', 'user_id'),
			'userMessages' => array(self::HAS_MANY, 'UserMessage', 'user_id_from'),
			'userMessages1' => array(self::HAS_MANY, 'UserMessage', 'user_id_to'),
			'userPasswordChanges' => array(self::HAS_MANY, 'UserPasswordChange', 'user_id'),
			'userVerifies' => array(self::HAS_MANY, 'UserVerify', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Username',
			'email' => 'Email',
			'created' => 'Joined',
			'updated' => 'Updated',
			'password' => 'Password',
			'name_first' => 'First Name',
			'name_last' => 'Last Name',
			'phone' => 'Phone',
			'image' => 'Image',
			'image_type' => 'Image Type',
			'image_size' => 'Image Size',
			'verified' => 'Verified',
			'location_id' => 'Location',
			'course_id' => 'Course',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('name_first',$this->name_first,true);
		$criteria->compare('name_last',$this->name_last,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('verified',$this->verified);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('course_id',$this->course_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function authenticateEmail($attribute)
	{
		$email=Yii::app()->db->createCommand()
			->select('email')
			->from('user_email_change')
			->where('email=:email', array(':email'=>$this->email))
			->queryScalar();
		if($email)
			$this->addError($attribute, 'Email "'.$this->email.'" has already been taken.');
	}

	public function getImage($options=array())
	{
		$defaults=array(
			'color'=>'black',
		);
		$options=array_merge($defaults, $options);

		$image='/img/uploads/cache/'.md5('user'.$this->id).'.'.$this->image_type;
		if($this->image && (!file_exists(Yii::getPathOfAlias('webroot').$image)) || filesize(Yii::getPathOfAlias('webroot').$image) !== strlen($this->image))
			file_put_contents(Yii::getPathOfAlias('webroot').$image, $this->image);
		if(file_exists(Yii::getPathOfAlias('webroot').$image))
			return $image;
		else
		{
			switch($options['color'])
			{
				case 'black':
					return '/img/user/no-image-black.gif';
					break;
				case 'white':
					return '/img/user/no-image-white.gif';
					break;
				default:
					return '/img/user/no-image-black.gif';
			}
		}
	}

	public function deleteImage($id)
	{
		Yii::app()->db->createCommand()->update('user',array(
			'image'=>null,
			'image_type'=>null,
			'image_size'=>null,
		), 'id=:id', array(':id'=>$id));

		$image='/img/uploads/cache/'.md5('user'.$id).'.'.$this->image_type;
		if(file_exists(Yii::getPathOfAlias('webroot').$image))
			unlink(Yii::getPathOfAlias('webroot').$image);

		return true;
	}

	protected function beforeSave()
	{
		$this->password = strlen($this->password) == 0 ? $this->password_old() : md5(md5($this->password).Yii::app()->params['salt']);

		if($this->image_temp) {
			image_autoOrient($this->image_temp);
			$this->image=file_get_contents($this->image_temp->tempName);
			$this->image_type=basename($this->image_temp->type);
			$this->image_size=$this->image_temp->size;
		}

		return true;
	}

	protected function beforeDelete() {
		$items=Yii::app()->db->createCommand()
			->select('id')
			->from('item')
			->where('user_id=:user_id', array(':user_id'=>$this->id))
			->queryAll();
		foreach($items as $item)
			Item::model()->findByPk($item['id'])->delete();
		$this->deleteImage($this->id);
		return true;
	}

	private function password_old()
	{
		return Yii::app()->db->createCommand()
			->select('password')
			->from('user')
			->where('id=:id', array(':id'=>$this->id))
			->queryScalar();
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

	public function getCourseDropDownList()
	{
		// get the courses
		$courses = Yii::app()->db->createCommand()
			->select('*')
			->from('user_course')
			->order('title')
			->queryAll();

		// store the categories in a real array
		$listData = array();
		foreach($courses as $course)
			$listData[] = array('id'=>$course['id'], 'title'=>CHtml::encode($course['title']));

		return CHtml::activeDropDownList($this, 'course_id', CHtml::listData($listData, 'id', 'title'), array('encode'=>false, 'empty'=>'select a course'));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
