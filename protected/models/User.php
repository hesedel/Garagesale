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
 * @property integer $role
 * @property string $name_first
 * @property string $name_last
 * @property string $phone
 * @property string $image
 * @property string $image_type
 * @property string $image_size
 * @property integer $verified
 *
 * The followings are the available model relations:
 * @property Item[] $items
 * @property UserChangePassword[] $userChangePasswords
 * @property UserVerify[] $userVerifies
 */
class User extends CActiveRecord
{
	public $image_temp;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
			array('role, verified', 'numerical', 'integerOnly'=>true),
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
			// Please remove those attributes that should not be searched.
			array('id, email, created, updated, role, name_first, name_last, phone, verified', 'safe', 'on'=>'search'),
			array('id', 'length', 'min'=>4),
			array('id', 'match', 'pattern'=>'/^[\d_a-z]+$/', 'message'=>'Only small letters, numbers, and underscores are allowed.'),
			array('id', 'match', 'pattern'=>'/^[a-z].*$/', 'message'=>'Username must begin with a small letter.'),
			array('id', 'match', 'pattern'=>'/^[a-z]+(_?[^_])+$/', 'message'=>'Username cannot consist of consecutive underscores or end with it.'),
			array('id, email', 'unique'),
			array('email', 'email'),
			array('password', 'required', 'on'=>'insert'),
			array('password', 'length', 'min'=>8),
			array('image_temp', 'file', 'allowEmpty'=>true, 'types'=>'gif, jpg, jpeg, png', 'minSize'=>1024, 'maxSize'=>2.5*(1024*1024)), // minSize 1KB, maxSize 2.5MB
			array('image_temp', 'ImageValidator', 'allowEmpty'=>true, 'minWidth'=>190, 'minHeight'=>190),
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
			'userChangePasswords' => array(self::HAS_MANY, 'UserChangePassword', 'user_id'),
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
			'role' => 'Role',
			'name_first' => 'First Name',
			'name_last' => 'Last Name',
			'phone' => 'Phone',
			'image' => 'Image',
			'image_type' => 'Image Type',
			'image_size' => 'Image Size',
			'verified' => 'Verified',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('name_first',$this->name_first,true);
		$criteria->compare('name_last',$this->name_last,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('verified',$this->verified);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getImage()
	{
		$image='/images/uploads/cache/'.md5('user'.$this->id).'.'.$this->image_type;
		if($this->image && !file_exists(Yii::getPathOfAlias('webroot').$image))
			file_put_contents(Yii::getPathOfAlias('webroot').$image, $this->image);
		if(file_exists(Yii::getPathOfAlias('webroot').$image))
			return $image;
		else
			return '/images/user/no-image.gif';
		return ;
	}

	protected function beforeSave()
	{
		$this->password = strlen($this->password) == 0 ? $this->password_old() : md5(md5($this->password).Yii::app()->params['salt']);

		if($this->image_temp) {
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
			->where('user_id=:user_id',array(':user_id'=>$this->id))
			->queryAll();
		foreach($items as $item)
			Item::model()->findByPk($item['id'])->delete();
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
}