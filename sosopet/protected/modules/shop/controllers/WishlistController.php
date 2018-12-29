<?php

class WishlistController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
		/*
			array('deny',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
		*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				//'actions'=>array('create','update'),
				'actions'=>array('update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Wishlist;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Wishlist']))
		{
			$model->attributes=$_POST['Wishlist'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($product_id)
	{
		$model=$this->loadModelbyProductId($product_id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(!$model) {
			$model=new Wishlist;
			$model->user_id=Yii::app()->user->id;
			$model->product_id=$product_id;
			
			$model->save();
		}else{
			// Do nothing
		}
		
		$this->redirect(array('admin'));
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
		$dataProvider=new CActiveDataProvider('Wishlist');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		/********
		$crit = new CDbCriteria();
		$product = new Products();        // the model class
		$crit->condition = "product_id IN (SELECT product_id FROM ".Shop::module()->wishlistTable." WHERE user_id = ".Yii::app()->user->id.")";
		$products = $product->findAll($crit);
		***********/
	
		$model=new Wishlist('search');
		$model->unsetAttributes();  // clear any default values
		//$model->user_id=Yii::app()->user->id;
		if(isset($_GET['Wishlist']))
			$model->attributes=$_GET['Wishlist'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Wishlist the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		//$model=Wishlist::model()->findByPk($id);
		$model=Wishlist::model()->find('id=:id AND user_id=:user_id',
			array(
			  ':id'=>$id,
			  ':user_id'=>Yii::app()->user->id,
			));
			
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModelbyProductId($id)
	{
		//$model=Wishlist::model()->findByPk($id);
		$model=Wishlist::model()->find('product_id=:product_id AND user_id=:user_id',
			array(
			  ':product_id'=>$id,
			  ':user_id'=>Yii::app()->user->id,
			));
		
		// Load Product
		$product=Products::model()->findByPk($id);
		if($product===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		//if($model===null)
		//	throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	
	/**
	 * Performs the AJAX validation.
	 * @param Wishlist $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='wishlist-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function _admin_grid($data,$row)
	{
		return $this->renderPartial('_grid', array('product'=>$data->product), true);
	}
}
