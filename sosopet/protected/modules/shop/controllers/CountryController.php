<?php

class CountryController extends Controller
{
	public $_model;

	public function beforeAction($action) {
		$this->layout = Shop::module()->layout;
		return parent::beforeAction($action);
	}

	public function actionView()
	{
		//$category=$this->loadModel();
		$searchForm=new SearchProductsForm();
		//$searchForm->category=$model->category_id;
		if(isset($_GET['SearchProductsForm']))
			$searchForm->attributes=$_GET['SearchProductsForm'];
		
		if(isset($_GET['id'])){
			$cat = Country::model()->findByPk($_GET['id']);
			if(isset($cat)){
				if($cat->parent_id==0){
					$searchForm->sub_country_id=$_GET['id'];
				}else{
					$searchForm->sub_country_id=$cat->parent_id;
					$searchForm->country_id=$_GET['id'];
				}
			}else{
				$searchForm->country=$_GET['id'];
			}
			//$searchForm->category=$_GET['id'];
		}
		
	 

		$this->render('view',array(
			'model'=>$searchForm,
		));
	}

	public function actionCreate()
	{
		$model=new Country;

		$this->performAjaxValidation($model);

		if(isset($_POST['Country']))
		{
			$model->attributes=$_POST['Country'];
			if($model->save())
				$this->redirect(array('shop/admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate()
	{
		$model=$this->loadModel();

		$this->performAjaxValidation($model);

		if(isset($_POST['Country']))
		{
			$model->attributes=$_POST['Country'];
			if($model->save())
				$this->redirect(array('shop/admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_POST['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Country');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Country('search');
		if(isset($_GET['Country']))
			$model->attributes=$_GET['Country'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionShow()
	{
		//$category=$this->loadModel();
		$searchForm=new BannerProductsForm();
		
		if(isset($_GET['id']))
			$searchForm->id=$_GET['id'];

		$this->render('show',array(
			'model'=>$searchForm,
		));
	}
	
	public function actionDynamicCou()
    {
		if(isset($_POST['SearchProductsForm']))
			$cateData = Country::model()->findAll('parent_id = '.$_POST['SearchProductsForm']['country_id']);
		elseif (isset($_POST['YumProfile']))
			$cateData = Country::model()->findAll('parent_id = '.$_POST['YumProfile']['country_id']);
		else
			$cateData = Country::model()->findAll('parent_id = '.$_POST['Products']['country_id']);
		
		if (Yii::app()->language=='zh')
			$dataOptions = array(''=>Yii::t('shop','-- Please Select --'));
		else
			$dataOptions = array(''=>'-- Please Select --');
			
		
        foreach ($cateData as $cat) {
				if (Yii::app()->language=='zh')
					$dataOptions[$cat->country_id] = $cat->title_zh;
				else
					$dataOptions[$cat->country_id] = $cat->title;
        }
	
        //$dataOptions=UtilityHtml::getStateData(isset($_POST['VkUsers']['country']));
        $state = isset($_POST['hidden_cou']);
        foreach($dataOptions as $value=>$name) {
            $opt = array();
            $opt['value'] = $value;
            if($state == $value) $opt['selected'] = "selected";
            echo CHtml::tag('option', $opt , CHtml::encode($name),true);
        }
        die;
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
				$this->_model=Country::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='country-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
