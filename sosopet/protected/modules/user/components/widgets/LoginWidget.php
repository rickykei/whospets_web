<?php
Yii::import('zii.widgets.CPortlet');

class LoginWidget extends CPortlet
{
	public $view = 'LoginWidget';
	public $title = null;
	public $model;

	public function init()
	{
		//if($this->title === NULL)
		//	$this->title=Yum::t('Login');
			
		if (isset($_POST['YumUserLogin']))
			$this->model->attributes = $_POST['YumUserLogin'];
		else
			$this->model = new YumUserLogin('login');
		parent::init();
	}

	protected function renderContent()
	{
		$this->render($this->view, array('model' => $this->model));
	}
} 
?>
