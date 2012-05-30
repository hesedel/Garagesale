<?php

function db_image($table, $id, $options = array()) {
	$defaults = array(
		'unlink'=>false,
	);
	$options = array_merge($defaults, $options);

	$image = Yii::app()->db->createCommand()
		->select('type, data')
		->from($table)
		->where('id=:id', array(':id'=>$id))
		->queryRow();
	if($image) {
		$file = '/images/uploads/cache/'.md5($table.$id).'.'.$image['type'];
		if(!$options['unlink']) {
			if(!file_exists(Yii::getPathOfAlias('webroot').$file))
				file_put_contents(Yii::getPathOfAlias('webroot').$file, $image['data']);
		} else if(file_exists(Yii::getPathOfAlias('webroot').$file))
			unlink(Yii::getPathOfAlias('webroot').$file);
		return $file;
	} else
		return false;
}

function email_sendVerification($id,$message)
{
	$user = Yii::app()->db->createCommand()
		->select('id, email, name_first')
		->from('user')
		->where('id=:id or email=:id', array(':id'=>$id))
		->queryRow();
	$user_verifyId = Yii::app()->db->createCommand()
		->select('id')
		->from('user_verify')
		->where('user_id=:id', array(':id'=>$user['id']))
		->queryScalar();
	if(!$user_verifyId) {
		$model_userVerify = new UserVerify;
		$model_userVerify->user_id = $id;
		$model_userVerify->save();
		$user_verifyId = $model_userVerify->id;
	}
	$link=Yii::app()->params['serverName'].'admin/user/verify/?id='.$user_verifyId;
	$body=new CSSToInlineStyles(
		Yii::app()->controller->renderPartial(
			'/site/_emailWrapper',
			array(
				'data'=>Yii::app()->controller->renderPartial(
					'/admin/user/_sendVerification-email',
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
	mail($user['email'], Yii::app()->name.' Email Verification', $body->convert(), $headers);
	//Yii::app()->controller->render('/admin/user/sendVerification', array('message'=>$message,'email'=>$user['email']));
	//Yii::app()->end();
}

function env_is($envs)
{
	foreach($envs as $env) {
		if(Yii::app()->params['env'] === $env)
			return true;
	}
	return false;
}

function time_local($time, $options = array())
{
	$defaults = array(
		'timeZone'=>Yii::app()->params['timeZone'],
		'format'=>false,
		'offset'=>0,
	);
	$options = array_merge($defaults, $options);

	$serverTime = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone(date_default_timezone_get()));
	$targetTime = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone($options['timeZone']));
	$timeZoneOffset = $targetTime->getOffset() - $serverTime->getOffset();
	$dateTime = new DateTime($time);
	$unix = $dateTime->format('U') + $timeZoneOffset + $options['offset'];
	if(!$options['format'])
		return Yii::app()->dateFormatter->formatDateTime($unix);
	else
		return date($options['format'], $unix);
}

function user_login($id)
{
	$identity=new UserIdentity('','');
	$identity->setId($id);
	Yii::app()->user->login($identity,60); // one minute
}