<?php

/**
 * This is the model class for table "user_message".
 *
 * The followings are the available columns in table 'user_message':
 * @property string $id
 * @property string $created
 * @property string $message
 * @property integer $read
 * @property integer $from
 * @property integer $to
 * @property string $user_id_from
 * @property string $user_id_to
 * @property string $parent_id
 * @property string $item_id
 *
 * The followings are the available model relations:
 * @property Item $item
 * @property User $userIdFrom
 * @property UserMessage $parent
 * @property UserMessage[] $userMessages
 * @property User $userIdTo
 */
class UserMessage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserMessage the static model class
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
		return 'user_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('message, user_id_to', 'required'),
			array('read, from, to', 'numerical', 'integerOnly'=>true),
			array('user_id_from, user_id_to', 'length', 'max'=>64),
			array('parent_id, item_id', 'length', 'max'=>10),
			array('created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created, message, read, from, to, user_id_from, user_id_to, parent_id, item_id', 'safe', 'on'=>'search'),
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
			'item' => array(self::BELONGS_TO, 'Item', 'item_id'),
			'userIdFrom' => array(self::BELONGS_TO, 'User', 'user_id_from'),
			'parent' => array(self::BELONGS_TO, 'UserMessage', 'parent_id'),
			'userMessages' => array(self::HAS_MANY, 'UserMessage', 'parent_id'),
			'userIdTo' => array(self::BELONGS_TO, 'User', 'user_id_to'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created' => 'Created',
			'message' => 'Message',
			'read' => 'Read',
			'from' => 'From',
			'to' => 'To',
			'user_id_from' => 'User Id From',
			'user_id_to' => 'User Id To',
			'parent_id' => 'Parent',
			'item_id' => 'Item',
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
		$criteria->compare('message',$this->message,true);
		$criteria->compare('read',$this->read);
		$criteria->compare('from',$this->from);
		$criteria->compare('to',$this->to);
		$criteria->compare('user_id_from',$this->user_id_from,true);
		$criteria->compare('user_id_to',$this->user_id_to,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('item_id',$this->item_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}