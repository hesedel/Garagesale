<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	public $model_itemSearchForm;

	protected function beforeAction($action)
	{
		if(Yii::app()->params['maintenance'])
		{
			if($this->getRoute() !== 'site/maintenance')
				$this->redirect(Yii::app()->createUrl('site/maintenance'));
		}
		else
		{
			if($this->getRoute() === 'site/maintenance')
				$this->redirect(Yii::app()->homeUrl);
		}

		// force user logout when session is not valid
		Yii::app()->params['user']=false;
		if(!Yii::app()->user->isGuest)
		{
			Yii::app()->params['user']=User::model()->findByPk(Yii::app()->user->getId());
			if(!Yii::app()->params['user']) {
				Yii::app()->user->logout();
				$this->redirect(Yii::app()->homeUrl);
			}
		}
		// set return url
		$route='/'.$this->getRoute();
		if(
			preg_match('/^\/site\/error/',$route) == 0 &&
			preg_match('/^\/site\/login/',$route) == 0 &&
			preg_match('/^\/site\/register/',$route) == 0 &&
			preg_match('/^\/site\/captcha/',$route) == 0 &&
			preg_match('/^\/item\/create/',$route) == 0 &&
			preg_match('/^\/item\/update/',$route) == 0 &&
			preg_match('/^\/item\/search_autocomplete/',$route) == 0 &&
			preg_match('/^\/admin\/user\/password_forgot/',$route) == 0 &&
			preg_match('/^\/admin\/user\/password_change/',$route) == 0 &&
			preg_match('/^\/admin\/user\/unverified/',$route) == 0 &&
			preg_match('/^\/admin\/user\/verify/',$route) == 0 &&
			preg_match('/^\/admin\/user\/image_delete/',$route) == 0 &&
			preg_match('/^\/admin\/user\/email_change/',$route) == 0 &&
			preg_match('/^\/admin\/user\/email_change_cancel/',$route) == 0 &&
			preg_match('/^\/admin\/user\/email_change_reverify/',$route) == 0 &&
			preg_match('/^\/admin\/user\/email_change_verify/',$route) == 0
		)
		{
			if($route==='/site/index')
				$route='/';
			$actionParams=$this->getActionParams();
			//$actionParamsString='';
			$actionParamsArray=array();
			$actionParamsStringAjax='';
			foreach(array_keys($actionParams) as $actionParamKey)
			{
				if($actionParamKey==='ajax' || preg_match('/^ajax_.*$/',$actionParamKey,$matches) > 0)
				{
					// do nothing
				}
				else if(preg_match('/^.+_page$/',$actionParamKey,$matches) > 0)
					$actionParamsStringAjax .=(strlen($actionParamsStringAjax)==0 ? '?' : '&').$matches[0].'='.$actionParams[$actionParamKey];
				else
				{
					//$actionParamsString .=(strlen($actionParamsString)==0 ? '/' : '').$actionParams[$actionParamKey].'/';
					$actionParamsArray[$actionParamKey] = $actionParams[$actionParamKey];
				}
			}
			Yii::app()->user->setReturnUrl((sizeof($actionParamsArray) == 0 ? (strlen(Yii::app()->createUrl($route)) > 0 ? Yii::app()->createUrl($route) : '/') : Yii::app()->createUrl($route,$actionParamsArray)).$actionParamsStringAjax);
		}
		else if(Yii::app()->user->getReturnUrl()==='/index.php')
		{
			Yii::app()->user->setReturnUrl('/');
		}

		// search
		$this->model_itemSearchForm=new ItemSearchForm;
		if(isset($_GET['ItemSearchForm']))
			$this->model_itemSearchForm->attributes=$_GET['ItemSearchForm'];

		return true;
	}
}
