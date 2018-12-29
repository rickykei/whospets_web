<?php

class ImageController extends Controller
{
	public $_model;

	public function beforeAction($action) {
		$this->layout = Shop::module()->layout;
		return parent::beforeAction($action);
	}

	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	public function actionCreate()
	{
		$product = Products::model()->findByPk($_GET['product_id']);
		$images = $product->images;
		$model=new Image;

		if(isset($_POST['Image']))
		{
			$model->attributes=$_POST['Image'];
			//$model->setScenario('imageUpload');
			$model->filename = CUploadedFile::getInstance($model, 'filename');
			if($model->save()) {
				$folder = Yii::app()->controller->module->productImagesFolder; 
				$model->filename->saveAs($folder . '/' . $model->filename);
				$this->redirect(array('//shop/image/create','product_id'=>$model->product_id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'images'=>$images,
		));
	}

	public function actionUpdate()
	{
		$model=$this->loadModel();

		// $this->performAjaxValidation($model);

		if(isset($_POST['Image']))
		{
			$model->attributes=$_POST['Image'];
			//$model->setScenario('imageUpload');
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	public function actionSetDefault()
	{
		$model=$this->loadModel();
		if($this->checkAccessRight($model))
			if($model->setDefault())
				Shop::setFlash('Image has been updated');

		if(!isset($_POST['ajax'])) {
			$this->redirect(array('//shop/products/update','id'=>$model->Product->product_id));
		}
	}


	public function actionDelete()
	{
		$model=$this->loadModel();
		if($this->checkAccessRight($model))
			if($model->delete())
				Shop::setFlash('Image has been deleted');

		if(!isset($_POST['ajax'])) {
			$this->redirect(array('//shop/products/update','id'=>$model->Product->product_id));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Image');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$product = Products::model()->findByPk($_GET['product_id']);

		$images = $product->images;

		$this->render('admin',array( 'images'=>$images, 'product' => $product));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Image::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='image-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	private function checkAccessRight($model)
	{
		if($model->Product->store->user_id==Yii::app()->user->id)
			return true;
		else
			return false;
	}
}
