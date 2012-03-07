<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $created
 * @property string $updated
 * @property string $password
 * @property integer $role
 * @property string $name_first
 * @property string $name_last
 *
 * The followings are the available model relations:
 * @property Item[] $items
 */
class User extends CActiveRecord
{
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
			array('id, name_first', 'required'),
			array('role', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>64),
			array('password, name_first, name_last', 'length', 'max'=>32),
			array('created', 'safe'),
			array('created', 'default', 'value'=>new CDbExpression('now()'), 'setOnEmpty'=>false, 'on'=>'insert'),
			array('updated', 'default', 'value'=>new CDbExpression('now()'), 'setOnEmpty'=>false, 'on'=>'update'),
			array('name_last', 'default', 'value'=>null),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created, updated, role, name_first, name_last', 'safe', 'on'=>'search'),
			array('id', 'email'),
			array('id', 'unique'),
			array('password', 'required', 'on'=>'insert'),
			array('password', 'length', 'min'=>8),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Email',
			'created' => 'Created',
			'updated' => 'Updated',
			'password' => 'Password',
			'role' => 'Role',
			'name_first' => 'First Name',
			'name_last' => 'Last Name',
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
		$criteria->compare('password',$this->password);
		$criteria->compare('role',$this->role);
		$criteria->compare('name_first',$this->name_first,true);
		$criteria->compare('name_last',$this->name_last,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave()
	{
		$this->password = strlen($this->password) == 0 ? $this->password_old() : md5(md5($this->password).Yii::app()->params['salt']);
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