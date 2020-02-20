<?php
Yii::import("xupload.models.XUploadForm");
class QnasController extends ShController
{
	public $model2;
	public $_model;
	//private $keywordSearchColumnArray = array('title', 'keywords'); //Columns to search 
	public $currentSearchValue; //Current keword search string
	
 
	
	public function filters()
	{
		return array(
				'accessControl',
				);
	}	

	public function accessRules() {
		return array(
				array('allow',
					'actions'=>array('view', 'index', 'getVariations','ipn', 'galleryIpn','list','byPetId'),
					'users' => array('*'),
					),
				array('allow',
					'actions'=>array('admin','delete','create','update', 'active','inactive','upload','paypal','galleryPaypal','success','failure','gallerySuccess','galleryFailure','updateDiscount'),
					'users' => array('@'),
					//'users' => array('admin'),
					),
				array('deny',  // deny all other users
					'users'=>array('*'),
					),
				);
	}

	// This method returns a set of variations that is possible for a given
	// product. This is used in the Image Upload Widget as a ajax response,
	// for example.
	public function actionGetVariations() {
		if(Yii::app()->request->isAjaxRequest && isset($_POST['qna'])) {
			$qna = Qnas::model()->findByPk($_POST['qna']); 
			echo CHtml::hiddenField('product_id', $qna->product_id);

			if($variations = $qna->getVariations()) {
				foreach($variations as $variation) {
					$field = "Variations[{$variation[0]->specification_id}][]";
					
					echo '<div class="shop-variation-element">';
					
					
					echo '<strong>'.CHtml::label($variation[0]->specification->title.'</strong>',
							$field, array(
								'class' => 'lbl-header'));

					if($variation[0]->specification->required)
						echo ' <span class="required">*</span>';

					echo '<br />';

					if($variation[0]->specification->input_type == 'textfield') {
						echo CHtml::textField($field);
					} else if ($variation[0]->specification->input_type == 'select'){

						// If the specification is required, preselect the first field.
						// Otherwise  let the customer choose which one to pick
						// 	$product->variationCount > 1 ? true : false means, that the
						// widget should display the _absolute_ price if only 1 variation
						// is available, otherwise the relative (+ X $)
						echo CHtml::radioButtonList($field,
								$variation[0]->specification->required 
								? $variation[0]->id 
								: null,
								QnaVariation::listData($variation, 
									$product->variationCount > 1 ? true : false
									), array(
										'template' => '{input} {label}',
										'separator' =>'<div class="clear"></div>',
										));
					} else if ($variation[0]->specification->input_type == 'image') {
						echo CHtml::fileField('filename');
					}
					echo '</div>';
				}
			}

		} else
			throw new CHttpException(404);

	}

	public function beforeAction($action) {
		 
		if ($this->action->Id=="view")
		$this->layout = Shop::module()->layout_stephen;
		else
		$this->layout = Shop::module()->layout;
		return parent::beforeAction($action);
	}

	public function actionList()
	{
		$searchForm=new SearchProductsForm();
		
		if(isset($_GET['SearchProductsForm']))
			$searchForm->attributes=$_GET['SearchProductsForm'];
			
		if(isset($_GET['keywords']) and strlen(trim($_GET['keywords'])) > 0)
			$searchForm->keywords=$_GET['keywords'];
			
		//$model=$this->loadModel($searchForm->store_id);
		
		$this->render('list',array(
			//'model'=>$this->loadModel($id),
			//'model'=>$model,
			'searchForm'=>$searchForm,
		));
	}
	
	 

	/* created on 2016051
	amendment 8 from stephen */
	public function actionByPetId($id){
		$qnas=Qnas::model()->find('pet_id=?',array($id));
		$this->redirect(array('qnas/'.$qnas->id));
		
	}	

	public function actionView()
	{
		$feedback = new Feedback();
		$upload = new XUploadForm;
		$chatForm = new ChatForm();
		$chatQuestionForm = new ChatForm();
		$qna = $this->loadModel();
		 
		$chatForm->product_id=$qna->id;
		$chatForm->product_name=$qna->title;
		$chatForm->pet_id=$qna->id;
		 
		$chatQuestionForm->product_id=$qna->id;
		$chatQuestionForm->product_name=$qna->title;
		$chatQuestionForm->pet_id=$qna->id;
		$feedbacks = new AppComment('search');
		$feedbacks->unsetAttributes();  // actionGetVariations any default values
		$feedbacks->id = $qna->id;
		$feedbacks->table_name ="app_qna";
		if(!$qna )
			throw new CHttpException(404);

		$fb_image_path=$this->findProdImgPath($qna);

		$fb_desc="I have recently lost my pet ".$qna->title.", the details are all in this link, If you see ".$qna->title." or have any info, please reach out!!!! PLEASE HELP!!!!";
		//fb metatag 20160321
 		//Yii::app()->clientScript->registerMetaTag('Whospets | '.$product->title,null,null,array('property'=>'og:title'));
		Yii::app()->clientScript->registerMetaTag('支持「領養代替購買」Why buy when you can adopt',null,null,array('property'=>'og:title'));
		// Yii::app()->clientScript->registerMetaTag($fb_desc,null,null,array('property'=>'og:description'));
		 Yii::app()->clientScript->registerMetaTag(' ',null,null,array('property'=>'og:description'));
		Yii::app()->clientScript->registerMetaTag(Yii::app()->getBaseUrl(true).$fb_image_path,null,null,array('property'=>'og:image'));


		// Update View Count
		if($qna)
		$this->render(Shop::module()->qnaView,array(
					'qna'=>$qna,
					 
					'feedback'=>$feedback,
					'feedbacks'=>$feedbacks,
					 'chatForm'=>$chatForm,
					'upload'=>$upload,
					'chatQuestionForm'=>$chatQuestionForm,
					));
	}
	
 
	
	public function actionUpload( ) {
		$this->checkStore();
		Yii::import( "xupload.models.XUploadForm" );
		//Here we define the paths where the files will be stored temporarily
		$path = realpath( Yii::app( )->getBasePath( )."/../".Shop::module()->imageUploadPath."/" )."/";
		$thumbPath = realpath( Yii::app( )->getBasePath( )."/../".Shop::module()->imageThumbUploadPath."/" )."/";
		$publicPath = Yii::app( )->getBaseUrl( )."/".Shop::module()->imageUploadPath;
	 
		//This is for IE which doens't handle 'Content-type: application/json' correctly
		header( 'Vary: Accept' );
		if( isset( $_SERVER['HTTP_ACCEPT'] ) 
			&& (strpos( $_SERVER['HTTP_ACCEPT'], 'application/json' ) !== false) ) {
			header( 'Content-type: application/json' );
		} else {
			header( 'Content-type: text/plain' );
		}
	 
		//Here we check if we are deleting and uploaded file
		if( isset( $_GET["_method"] ) ) {
			if( $_GET["_method"] == "delete" ) {
				if( $_GET["file"][0] !== '.' ) {
					$file = $path.$_GET["file"];
					if( is_file( $file ) ) {
						unlink( $file );
					}
				}
				echo json_encode( true );
			}
		 
		} else {
			$model = new XUploadForm;
			$model->file = CUploadedFile::getInstance( $model, 'file' );
			//We check that the file was successfully uploaded
			if( $model->file !== null ) {
				//Grab some data
				$model->mime_type = $model->file->getType( );
				$model->size = $model->file->getSize( );
				$model->name = $model->file->getName( );
				//(optional) Generate a random name for our file
				$filename = md5( Yii::app( )->user->id.microtime( ).$model->name);
				$filename .= ".".$model->file->getExtensionName( );
				if( $model->validate( ) ) {
					//Move our file to our temporary dir
					$model->file->saveAs( $path.$filename );
					chmod( $path.$filename, 0777 );
					//here you can also generate the image versions you need 
					//using something like PHPThumb
					$thumb=Yii::app()->phpThumb->create($path.$filename);
					$thumb->adaptiveresize(Shop::module()->productImageThumbWidth,Shop::module()->productImageThumbHeight);
					$thumb->save($thumbPath.$filename);
					
					$thumb=Yii::app()->phpThumb->create($path.$filename);
					$thumb->adaptiveresize(Shop::module()->productImageWidth,Shop::module()->productImageHeight);
					$thumb->save($path.$filename);
	 
					//Now we need to save this path to the user's session
					if( Yii::app( )->user->hasState( 'images' ) ) {
						$userImages = Yii::app( )->user->getState( 'images' );
					} else {
						$userImages = array();
					}
					 $userImages[] = array(
						//"path" => $path.$filename,
						"path" => $path.$filename,
						//the same file or a thumb version that you generated
						//"thumb" => $path.$filename,
						"thumb" => $thumbPath.$filename,
						"filename" => $filename,
						'size' => $model->size,
						'mime' => $model->mime_type,
						'name' => $model->name,
					);
					Yii::app( )->user->setState( 'images', $userImages );
	 
					//Now we need to tell our widget that the upload was succesfull
					//We do so, using the json structure defined in
					// https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
					echo json_encode( array( array(
							"name" => $model->name,
							"type" => $model->mime_type,
							"size" => $model->size,
							"url" => $publicPath.$filename,
							//"thumbnail_url" => $publicPath."thumbs/$filename",
							"thumbnail_url" => $publicPath."$filename",
							"delete_url" => $this->createUrl( "upload", array(
								"_method" => "delete",
								"file" => $filename
							) ),
							"delete_type" => "POST"
						) ) );
				} else {
					//If the upload failed for some reason we log some data and let the widget know
					echo json_encode( array( 
						array( "error" => $model->getErrors( 'file' ),
					) ) );
					Yii::log( "XUploadAction: ".CVarDumper::dumpAsString( $model->getErrors( ) ),
						CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction" 
					);
				}
			} else {
				throw new CHttpException( 500, "Could not upload file" );
			}
		}
	}
	
	public function actionCreate()
	{
		$this->checkStore();
		$upload = new XUploadForm;
		
		$product = new Products;
		$store = Store::model()->find('user_id=?',array(Yii::app()->user->id));
				
		//$this->layout = Shop::module()->adminLayout;
		// Store should be created before product
		//if(false){
		if($store){
			// We assume we want to create a _active_ product
			if(!isset($product->status)) {
				$product->status = 1;
				$product->view = 0;
			}
			
			$this->performAjaxValidation($product);

			if(isset($_POST['Products']))
			{
				$product->attributes = $_POST['Products'];
				
				// Update store_id
				$store=Store::model()->find('user_id=?',array(Yii::app()->user->id));
				$product->store_id=$store->id;
				
				if(isset($_POST['Specifications']))
					$product->setSpecifications($_POST['Specifications']);

				//Start a transaction in case something goes wrong
				$transaction = Yii::app( )->db->beginTransaction( );
				try {
					if($product->save()){
						$transaction->commit();
						Shop::setFlash('Your changes have been saved');
						//if($product->status==1)
						//	$this->redirect(array('active'));
						//else
						//	$this->redirect(array('inactive'));
						$this->redirect(array('update','id'=>$product->product_id));
					}
				} catch(Exception $e) {
					$transaction->rollback( );
					Yii::app( )->handleException( $e );
				}
			}
		}else{
			Shop::setFlash('Please create your own store first');
		}

		$this->render('create',array(
					'model'=>$product,
					'upload'=>$upload,
					));
	}

	public function actionUpdate($id, $return = null)
	{
		$this->checkStore();
		//$this->layout = Shop::module()->adminLayout;
		$model=$this->loadModel();
		
		$upload = new XUploadForm;

		$this->performAjaxValidation($model);
		
		if(isset($_POST['Products']))
		{
			$model->attributes = $_POST['Products'];

			if(isset($_POST['Specifications']))
				$model->setSpecifications($_POST['Specifications']);
			if(isset($_POST['Variations']))
				$model->setVariations($_POST['Variations']);
			
			//Start a transaction in case something goes wrong
				$transaction = Yii::app( )->db->beginTransaction( );
			try {
				if($model->save()){
					$transaction->commit();
					//Yum::setFlash('Your changes have been saved');
					Shop::setFlash('Your changes have been saved');
					//if($model->status==1)
					//	$this->redirect(array('active'));
					//else
					//	$this->redirect(array('inactive'));
				}
			}catch(Exception $e) {
				$transaction->rollback( );
				Shop::setFlash($e->getMessage());
			}
		}

		$this->render('update',array(
					'model'=>$model,
					'upload'=>$upload,
					));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	//public function actionDelete()
	public function actionDelete($id)
	{
		/*
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			//$this->loadModel()->delete();
			if(!$this->loadModel()->delete()){
				throw new CHttpException(400,'Invalid request. Product is used.  Please try to mark it as inactive product.');
			}

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_POST['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		*/
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			$this->redirect(isset(Yii::app()->request->urlReferrer) ? Yii::app()->request->urlReferrer : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
 
					
		$products_model=new Products('search');
	 
		
		
		// Recent Lost
		$recentLostProducts_ds=$products_model->searchRecentLost();
		$recentLostProducts=$recentLostProducts_ds->getData();
		
		// Highest Reward
		$highestRewardProducts_ds=$products_model->searchHighestReward();
		$highestRewardProducts=$highestRewardProducts_ds->getData();
		
		// Youngest
		$youngestProducts_ds=$products_model->searchYoungest();
		$youngestProducts=$youngestProducts_ds->getData();
		
		// Most Popular
		$mostPopularProducts_ds=$products_model->searchPetForAdoption();
		$mostPopularProducts=$mostPopularProducts_ds->getData();
		
		// Recent Found
		$recentFoundProducts_ds=$products_model->searchRecentFound();
		$recentFoundProducts=$recentFoundProducts_ds->getData();

		//echo Yii::trace(CVarDumper::dumpAsString($top10products),'vardump10');
		//echo Yii::trace(CVarDumper::dumpAsString($featureProducts),'vardumpF');
		//echo Yii::trace(CVarDumper::dumpAsString($newProducts),'vardump');
		
		$this->render('index',array(
			 
					'recentLostProducts'=>$recentLostProducts,
					'highestRewardProducts'=>$highestRewardProducts,
					'youngestProducts'=>$youngestProducts,
					'mostPopularProducts'=>$mostPopularProducts,
					'recentFoundProducts'=>$recentFoundProducts,
					//'model'=>$model,
					));

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout = Shop::module()->adminLayout;
		$model=new Qnas('search');
		if(isset($_GET['Qnas']))
			$model->attributes=$_GET['Qnas'];

		$this->render('admin',array(
					'model'=>$model,
					));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionActive()
	{
		$this->checkStore();
		//$this->layout = Shop::module()->adminLayout;
		$store = Store::model()->find('user_id = :user_id ', array(
						':user_id' => Yii::app()->user->id));
						
		$model=new Qnas('search');
		$model->unsetAttributes();
		
		if(isset($_GET['Qnas']))
		$model->attributes=$_GET['Qnas'];
		$model->status=1;
		$this->render('active',array(
					'model'=>$model,
					));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionInactive()
	{
		$this->checkStore();
		//$this->layout = Shop::module()->adminLayout;
		$store = Store::model()->find('user_id = :user_id ', array(
						':user_id' => Yii::app()->user->id));
						
		$model=new Products('search');
		$model->unsetAttributes();
		
		if(isset($_GET['Products']))
			$model->attributes=$_GET['Products'];
		$model->store_id=$store->id;
		$model->status=0;
		
		$this->render('inactive',array(
					'model'=>$model,
					));
	}
	
	public function actionUpdateDiscount()
	{
		$model=new DiscountForm;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DiscountForm']))
		{
			$model->attributes=$_POST['DiscountForm'];
			if ($model->save())
				Shop::setFlash('Discount has been updated');
		}

		$this->render('updateDiscount',array(
			'model'=>$model,
		));
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
				$this->_model=Qnas::model()->findbyPk($_GET['id']);
			if(isset($_GET['title']))
				$this->_model=Qnas::model()->find('title = :title', array(
							':title' => $_GET['title']));
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='products-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
 
	
	public function _admin_grid($data,$row)
	{
		return $this->renderPartial('_grid', array('sell'=>$data), true);
	}
	
	private function checkAccessRight($model)
	{
		if($model->store->user_id==Yii::app()->user->id)
			return true;
		else
			return false;
	}
	private function findProdImgPath($qna){
			if($qna->images) {
                                        $folder = Shop::module()->qnaImagesFolder;
                                        $thumb_image_folder = Shop::module()->qnaThumbImagesFolder;
                                        foreach($qna->images as $image) {
                                                /*
$slides[] = array('image' => Yii::app()->baseUrl.'/'.$folder.'/'.$image->filename,
                                                                                        'thumbImage' => Yii::app()->baseUrl.'/'.$thumb_image_folder.'/'.$image->filename,
                                                                                );
*/
                                                if($image->is_default=='Y' || empty($default_image))
                                                        $default_image = '/'.$folder.$image->filename;
                                        }
		return $default_image;
		}
	}
	 
}
