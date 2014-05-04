<?php

/**
 * This is the model class for table "item_contact".
 *
 * The followings are the available columns in table 'item_contact':
 * @property string $id
 * @property string $created
 * @property string $updated
 * @property string $item_id
 * @property string $user_id_replier
 * @property string $replier_email
 * @property string $replier_name
 * @property string $user_id_poster
 *
 * The followings are the available model relations:
 * @property User $userIdPoster
 * @property Item $item
 * @property User $userIdReplier
 */
class ItemContact extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item_contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, user_id_poster', 'required'),
			array('item_id', 'length', 'max'=>10),
			array('user_id_replier, replier_email, user_id_poster', 'length', 'max'=>64),
			array('replier_name', 'length', 'max'=>32),
			array('created', 'safe'),
			array('created', 'default', 'value'=>new CDbExpression('now()'), 'setOnEmpty'=>false, 'on'=>'insert'),
			array('updated', 'default', 'value'=>new CDbExpression('now()'), 'setOnEmpty'=>false, 'on'=>'update'),
			array('user_id_replier, replier_email, replier_name', 'default', 'value'=>null),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, created, updated, item_id, user_id_replier, replier_email, replier_name, user_id_poster', 'safe', 'on'=>'search'),
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
			'userIdPoster' => array(self::BELONGS_TO, 'User', 'user_id_poster'),
			'item' => array(self::BELONGS_TO, 'Item', 'item_id'),
			'userIdReplier' => array(self::BELONGS_TO, 'User', 'user_id_replier'),
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
			'updated' => 'Updated',
			'item_id' => 'Item',
			'user_id_replier' => 'User Id Replier',
			'replier_email' => 'Replier Email',
			'replier_name' => 'Replier Name',
			'user_id_poster' => 'User Id Poster',
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
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('item_id',$this->item_id,true);
		$criteria->compare('user_id_replier',$this->user_id_replier,true);
		$criteria->compare('replier_email',$this->replier_email,true);
		$criteria->compare('replier_name',$this->replier_name,true);
		$criteria->compare('user_id_poster',$this->user_id_poster,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		$replier_email=Yii::app()->db->createCommand()
			->select('id,replier_email')
			->from('item_contact')
			->where(
				'item_id=:item_id and replier_email=:replier_email',
				array(
					':item_id'=>$this->item_id,
					':replier_email'=>$this->replier_email,
				)
			)
			->queryRow();
		if($replier_email!=null)
		{
			extract($replier_email);
			Yii::app()->db->createCommand()
				->update(
					'item_contact',
					array('replier_name'=>$this->replier_name),
					'id=:id',
					array(':id'=>$id)
				);
		}
		$user_id_replier=Yii::app()->db->createCommand()
			->select('id,user_id_replier')
			->from('item_contact')
			->where(
				'item_id=:item_id and user_id_replier=:user_id_replier',
				array(
					':item_id'=>$this->item_id,
					':user_id_replier'=>$this->user_id_replier,
				)
			)
			->queryRow();
		if($user_id_replier!=null)
		{
			extract($user_id_replier);
			$this->replier_name=User::model()->findByPk($user_id_replier)->name_first;
		}
		if($replier_email!=null || $user_id_replier!=null)
		{
			$this->id=$id;
		}
		else {
			if($this->user_id_replier!=null)
			{
				$this->replier_name=$user_id_replier=Yii::app()->db->createCommand()
				->select('name_first')
				->from('user')
				->where(
					'id=:user_id_replier',
					array(
						':user_id_replier'=>$this->user_id_replier,
					)
				)
				->queryScalar();
			}
			return true;
		}
	}

	protected function afterSave()
	{
		parent::afterSave();
		if(Yii::app()->params['cp.emailAccountManager-url'])
		{
			// create email accounts
			file_get_contents(Yii::app()->params['cp.emailAccountManager-url'].'?key='.Yii::app()->params['cp.emailAccountManager-key'].'&action=create&email=replier.'.$this->item_id.'.'.base_convert($this->id,10,36).'&domain='.Yii::app()->params['usersEmailDomain'].'&password='.Yii::app()->params['cp.emailAccountManager-key']);
			file_get_contents(Yii::app()->params['cp.emailAccountManager-url'].'?key='.Yii::app()->params['cp.emailAccountManager-key'].'&action=create&email=poster.'.$this->item_id.'.'.base_convert($this->id,10,36).'&domain='.Yii::app()->params['usersEmailDomain'].'&password='.Yii::app()->params['cp.emailAccountManager-key']);

			// create email forwarders
			Yii::trace(file_get_contents(Yii::app()->params['cp.emailAccountManager-url'].'?key='.Yii::app()->params['cp.emailAccountManager-key'].'&action=forwarder_create&email=replier.'.$this->item_id.'.'.base_convert($this->id,10,36).'&domain='.Yii::app()->params['usersEmailDomain'].'&fwdopt=pipe&pipefwd=|'.$_SERVER['DOCUMENT_ROOT'].'/pipe.php'));
			file_get_contents(Yii::app()->params['cp.emailAccountManager-url'].'?key='.Yii::app()->params['cp.emailAccountManager-key'].'&action=forwarder_create&email=poster.'.$this->item_id.'.'.base_convert($this->id,10,36).'&domain='.Yii::app()->params['usersEmailDomain'].'&fwdopt=pipe&pipefwd=|'.$_SERVER['DOCUMENT_ROOT'].'/pipe.php');
		}
	}

	protected function beforeDelete()
	{
		if(Yii::app()->params['cp.emailAccountManager-url'])
		{
			// delete email forwarders
			file_get_contents(Yii::app()->params['cp.emailAccountManager-url'].'?key='.Yii::app()->params['cp.emailAccountManager-key'].'&action=forwarder_delete&email=replier.'.$this->item_id.'.'.base_convert($this->id,10,36).'&domain='.Yii::app()->params['usersEmailDomain'].'&emaildest=|'.$_SERVER['DOCUMENT_ROOT'].'/pipe.php');
			file_get_contents(Yii::app()->params['cp.emailAccountManager-url'].'?key='.Yii::app()->params['cp.emailAccountManager-key'].'&action=forwarder_delete&email=poster.'.$this->item_id.'.'.base_convert($this->id,10,36).'&domain='.Yii::app()->params['usersEmailDomain'].'&emaildest=|'.$_SERVER['DOCUMENT_ROOT'].'/pipe.php');

			// delete email accounts
			file_get_contents(Yii::app()->params['cp.emailAccountManager-url'].'?key='.Yii::app()->params['cp.emailAccountManager-key'].'&action=delete&email=replier.'.$this->item_id.'.'.base_convert($this->id,10,36).'&domain='.Yii::app()->params['usersEmailDomain']);
			file_get_contents(Yii::app()->params['cp.emailAccountManager-url'].'?key='.Yii::app()->params['cp.emailAccountManager-key'].'&action=delete&email=poster.'.$this->item_id.'.'.base_convert($this->id,10,36).'&domain='.Yii::app()->params['usersEmailDomain']);
		}
		return true;
	}

	public function getPosterEmail()
	{
		return 'poster.'.$this->item_id.'.'.base_convert($this->id,10,36).'@'.Yii::app()->params['usersEmailDomain'];
	}

	public function getReplierEmail()
	{
		return 'replier.'.$this->item_id.'.'.base_convert($this->id,10,36).'@'.Yii::app()->params['usersEmailDomain'];
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ItemContact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
