<?php

/**
 * This is the model class for table "user_email_change".
 *
 * The followings are the available columns in table 'user_email_change':
 * @property string $id
 * @property string $user_id
 * @property string $email
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserEmailChange extends CActiveRecord
{
	public $password;
	public $email_repeat;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_email_change';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password, email_repeat', 'required'),
			array('id', 'length', 'max'=>32),
			array('user_id, email, email_repeat', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, email', 'safe', 'on'=>'search'),
			array('email', 'email'),
			array('email', 'authenticateEmail'),
			array('password', 'authenticatePassword'),
			array('email_repeat', 'compare', 'compareAttribute'=>'email'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'email' => 'New Email',
			'password' => 'Password',
			'email_repeat' => 'Repeat New Email',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function authenticateEmail($attribute)
	{
		$id=Yii::app()->db->createCommand()
			->select('id')
			->from('user')
			->where('email=:email',array(':email'=>$this->email))
			->queryScalar();
		$email=Yii::app()->db->createCommand()
			->select('email')
			->from('user_email_change')
			->where('user_id!=:id and email=:email',array(':id'=>Yii::app()->user->id,':email'=>$this->email))
			->queryScalar();
		if($id || $email)
			$this->addError($attribute,'Email "'.$this->email.'" has already been taken.');
	}

	public function authenticatePassword($attribute) {
		if(md5(md5($this->password).Yii::app()->params['salt']) !== $this->password())
			$this->addError($attribute,'Incorrect password.');
	}

	public function sendEmailChangeVerification()
	{
		$user=Yii::app()->db->createCommand()
			->select('name_first')
			->from('user')
			->where('id=:id',array(':id'=>$this->user_id))
			->queryRow();

		$link=Yii::app()->params['serverName'].'admin/user/email_change_verify/?id='.$this->id;
		$body=new CSSToInlineStyles(
			Yii::app()->controller->renderPartial(
				'/site/_emailWrapper',
				array(
					'data'=>Yii::app()->controller->renderPartial(
						'/admin/user/_sendEmailChangeVerification-email',
						array(
							'name'=>$user['name_first'],
							'link'=>CHtml::link(
								$link,
								$link
							)
						),true
					)
				),true
			),file_get_contents(Yii::getPathOfAlias('webroot').'/css/emailWrapper.css')
		);
		$headers="From: ".Yii::app()->name." <".Yii::app()->params['noReplyEmail'].">\r\nContent-Type: text/html";
		mail($this->email, Yii::app()->name.' Email Change Verification', $body->convert(), $headers);
	}

	protected function beforeSave()
	{
		$this->id=md5($this->user_id.time());
		$this->user_id=Yii::app()->user->id;
		$this->sendEmailChangeVerification();
		return true;
	}

	private function password()
	{
		return Yii::app()->db->createCommand()
			->select('password')
			->from('user')
			->where('id=:id', array(':id'=>Yii::app()->user->id))
			->queryScalar();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserEmailChange the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
