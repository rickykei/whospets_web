<?php

class StoreController extends Controller
{
	public $_model;
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view','feedback','search'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function beforeAction($action) {
		$this->layout = Shop::module()->layout;
		return parent::beforeAction($action);
	}
		
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{

		$searchForm=new SearchProductsForm();
		
		if(isset($_GET['SearchProductsForm']))
			$searchForm->attributes=$_GET['SearchProductsForm'];
			
		if(isset($_GET['id']))
			$searchForm->store_id=$_GET['id'];
			
		$model=$this->loadModel($searchForm->store_id);
		
		$this->render('view',array(
			//'model'=>$this->loadModel($id),
			'model'=>$model,
			'searchForm'=>$searchForm,
		));
	}
	
	public function actionSearch()
	{

		$searchForm=new SearchProductsForm();
			
		//if(isset($_GET['id']))
		//	$searchForm->store_name=$_GET['id'];
			
		//$model=$this->loadModelByName($searchForm->store_name);
		$model=$this->loadModelByName(CHtml::decode($_GET['id']));
$searchForm->store_id=$model->id;		
		$this->render('view',array(
			//'model'=>$this->loadModel($id),
			'model'=>$model,
			'searchForm'=>$searchForm,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Store;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		//if(isset($_POST['Store']))
		//{
			$_POST['Store']['user_id'] = Yii::app()->user->id;
			$_POST['Store']['store_email'] = 'email';
			$_POST['Store']['store_description'] = 'store_description';
			$_POST['Store']['store_phone'] = '91239123';
			$model->attributes=$_POST['Store'];
			if($model->save())
		 Yum::setFlash('Your store was updated successfully');
		//$this->redirect(array('view','id'=>$model->id));
			
		//}

		//$this->render('update',array(
		//	'model'=>$model,
		//));
		$this->redirect(Yii::app()->createUrl('/shop/products/create'));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id = null) {
		if(!$id)
			$id = Yii::app()->user->id;

		$model=Store::model()->find('user_id=?',array($id));
		
		if(!$model) {
			$this->actionCreate();
		}else{
			//$model=$this->loadModel($id);

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
			$tmpBanner = $model->store_banner;
			$tmpLogo = $model->store_logo;
			if(isset($_POST['Store']))
			{
				$model->attributes=$_POST['Store'];
				$model->user_id = $id;
					
				$model->setScenario('imageSizeCheck');
				
				$model->store_banner = CUploadedFile::getInstanceByName('Store[store_banner]');
				$model->store_logo = CUploadedFile::getInstanceByName('Store[store_logo]');
				if($model->validate()) {
					$model->setScenario(null);
					if ($model->store_banner instanceof CUploadedFile) {
						// Prepend the id of the user to avoid filename conflicts
						$filename = Shop::module()->bannerUploadPath .'/'.  $model->id . '_' . $_FILES['Store']['name']['store_banner'];
						$model->store_banner->saveAs($filename);
						$model->store_banner = $filename;
						//echo Yii::trace(CVarDumper::dumpAsString($model->attributes),'vardump');
						//echo Yii::trace(CVarDumper::dumpAsString(getimagesize($filename)),'vardump');
						//echo Yii::trace(CVarDumper::dumpAsString(isset($_POST['Store']['store_banner'])),'vardump');
					}else{
						$model->store_banner = $tmpBanner;
					}
					if ($model->store_logo instanceof CUploadedFile) {
						// Prepend the id of the user to avoid filename conflicts
						$filename = Shop::module()->logoUploadPath .'/'.  $model->id . '_' . $_FILES['Store']['name']['store_logo'];
						$model->store_logo->saveAs($filename);
						$model->store_logo = $filename;
					}else{
						$model->store_logo = $tmpLogo;
					}
				
					if($model->save()){
						Yum::setFlash('Your store was updated successfully');
						$this->redirect(array('update'));
					}
				}else{
					$model->store_banner = $tmpBanner;
					$model->store_logo = $tmpLogo;
				}
			}

			$this->render('update',array(
				'model'=>$model,
			));
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Store');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Store('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Store']))
			$model->attributes=$_GET['Store'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionFeedback($id)
	{
		$this->render('feedback',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Store the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Store::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModelByName($store_name)
	{
		$model=Store::model()->findByAttributes(array('store_name'=>$store_name));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Store $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='store-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function _feedback_grid($data, $row){
		return $this->renderPartial('_feedback_grid', array('feedback'=>$data), true);
	}
	
	public function _product_grid($data, $row){
		return $this->renderPartial('_product_grid', array('order'=>$data->order), true);
	}
}
