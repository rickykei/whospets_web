<?php
Yii::import('zii.widgets.CPortlet');

class SocialLoginWidget extends CPortlet
{
	public $view = 'SocialLoginWidget';
	public $title = null;

	public function init()
	{
		//if($this->title === NULL)
		//	$this->title=Yum::t('Express Login / Sign Up');
		parent::init();
	}

	protected function renderContent()
	{
		$this->render($this->view);
	}
} 
?>
