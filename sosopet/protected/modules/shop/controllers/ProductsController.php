<?php
Yii::import("xupload.models.XUploadForm");
class ProductsController extends ShController
{
	public $model2;
	public $_model;
	//private $keywordSearchColumnArray = array('title', 'keywords'); //Columns to search 
	public $currentSearchValue; //Current keword search string
	
	/*
	public function actions() {
		return array(
			'upload' => array(
				'class' => 'xupload.actions.XUploadAction', 
				'path' => Yii::app() -> getBasePath() . "/../images/uploads", 
				"publicPath" => Yii::app()->getBaseUrl()."/images/uploads" 
			),
		);
	}
	*/
	
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
		if(Yii::app()->request->isAjaxRequest && isset($_POST['product'])) {
			$product = Products::model()->findByPk($_POST['product']); 
			echo CHtml::hiddenField('product_id', $product->product_id);

			if($variations = $product->getVariations()) {
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
								ProductVariation::listData($variation, 
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
	
	/*
	public function actionList()
	{
	
		//Original demo code to create a criteria object  
		
        //$criteria=new CDbCriteria(array(
        //        'condition'=>'status='.Post::STATUS_PUBLISHED,
        //        'order'=>'priority',
        //        'with'=>'commentCount',
        //));
		
		$criteria = new CDbCriteria();
        
        //New code for the keyword search
        if(isset($_GET['keywords']) and strlen(trim($_GET['keywords'])) > 0)
        {
                $this->currentSearchValue = trim($_GET['keywords']);
                $additionalCriteria = $this->makeKeywordSearchCondition($_GET['keywords']);
                $criteria->addCondition($additionalCriteria);
        }       
        
        //Original demo code for the tag cloud search   
        if(isset($_GET['tag']))
                $criteria->addSearchCondition('tags',$_GET['tag']);                     
        
		//Advanced search
		$product=new Products('search');
		if(isset($_GET['Products']))
			$product->attributes=$_GET['Products'];
		
		//Pagination
		$item_count = Products::model()->count($criteria);
                
        $pages = new CPagination($item_count);
        $pages->setPageSize(Shop::module()->noOfShoes);
        $pages->applyLimit($criteria);  // the trick is here!
		
		$this->render('list',array(
                        'model'=> Products::model()->findAll($criteria), // must be the same as $item_count
                'item_count'=>$item_count,
                'page_size'=>Shop::module()->noOfShoes,
                'items_count'=>$item_count,
                'pages'=>$pages,
				'product'=>$product,
        ));
	}
	*/
	
	/**
	 * Make the keyword search SQL. 
	 * @param       String  Search string input by user
	 * @return      String  SQL condition 
	 */     
	/*
	private function makeKeywordSearchCondition($keywordStr){
			$criteriaSql='';           //Search condition      
			
			//Split the string into an array of words and phrases
			//The string: Android "Web Apps" 
			//will produce a two element array containing 'Android' and 'Web Apps' 
			$elementArray = array();
			$regX = "/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|[\s,]+/"; 
			$tempArray = preg_split  ($regX, trim($keywordStr),  0, PREG_SPLIT_DELIM_CAPTURE);
			foreach($tempArray as $ind => $str){
					if(trim($str)){
							array_push($elementArray, $str);
					}                       
			}
			
			//Construct the search sql  
			foreach($this->keywordSearchColumnArray as $column)
			{       
					foreach($elementArray as $value){
							$value =  addSlashes($value);
							$value = '"%'.$value.'%"';      
							if($criteriaSql){

									$criteriaSql .= ' OR';
							}
							$criteriaSql .= " $column LIKE $value";
					}

			}                       
			return $criteriaSql;
	}
	*/

	/* created on 2016051
	amendment 8 from stephen */
	public function actionByPetId($id){
		$products=Products::model()->find('pet_id=?',array($id));
		$this->redirect(array('products/'.$products->product_id));
		
	}	

	public function actionView()
	{
		$feedback = new Feedback();
		$upload = new XUploadForm;
		$chatForm = new ChatForm();
		$chatQuestionForm = new ChatForm();
		$product = $this->loadModel();
		$store = Store::model()->find('id=?',array($product->store_id));
		$category = Category::model()->find('category_id=?',array($product->category_id));
		$country = Country::model()->find('country_id=?',array($product->country_id));
		$sub_country = Country::model()->find('country_id=?',array($product->sub_country_id));
		$chatForm->recipient=$store->user->id;
		$chatForm->product_id=$product->product_id;
		$chatForm->product_name=$product->title;
		$chatForm->pet_id=$product->pet_id;
		$chatQuestionForm->recipient=$store->user->id;
		$chatQuestionForm->product_id=$product->product_id;
		$chatQuestionForm->product_name=$product->title;
		$chatQuestionForm->pet_id=$product->pet_id;
		$feedbacks = new Feedback('search');
		$feedbacks->unsetAttributes();  // clear any default values
		$feedbacks->product_id = $product->product_id;

		if(!$product && $product->status != 1)
			throw new CHttpException(404);

		$fb_image_path=$this->findProdImgPath($product);

		$fb_desc="I have recently lost my pet ".$product->title.", the details are all in this link, If you see ".$product->title." or have any info, please reach out!!!! PLEASE HELP!!!!";
		//fb metatag 20160321
 		//Yii::app()->clientScript->registerMetaTag('Whospets | '.$product->title,null,null,array('property'=>'og:title'));
		Yii::app()->clientScript->registerMetaTag('支持「領養代替購買」Why buy when you can adopt',null,null,array('property'=>'og:title'));
		// Yii::app()->clientScript->registerMetaTag($fb_desc,null,null,array('property'=>'og:description'));
		 Yii::app()->clientScript->registerMetaTag(' ',null,null,array('property'=>'og:description'));
		Yii::app()->clientScript->registerMetaTag(Yii::app()->getBaseUrl(true).$fb_image_path,null,null,array('property'=>'og:image'));


		// Update View Count
		if($product && !$this->updateViewCount($product))
			throw new CHttpException(404);
		$this->render(Shop::module()->productView,array(
					'product'=>$product,
					'store'=>$store,
					'category'=>$category,
					'country'=>$country,
					'sub_country'=>$sub_country,
					'chatForm'=>$chatForm,
					'upload'=>$upload,
					'feedback'=>$feedback,
					'feedbacks'=>$feedbacks,
					'chatQuestionForm'=>$chatQuestionForm,
					));
	}
	
	public function actionPaypal() {
		//echo Yii::trace(CVarDumper::dumpAsString($_GET['day']),'vardump10');
		//Yii::app()->end;
		$model=$this->loadModel();
		if(isset($_GET['day']))
			$day=$_GET['day'];
		else
			$day=1;
		if($this->checkAccessRight($model)){
			$paypal = new PayPalForm();
			echo $paypal->handleFeaturePayPal($model,$day);
		}

		//$this->redirect(array('//shop/products/update','id'=>$model->product_id));
		$this->actionUpdate($model->product_id);
	}
	
	public function actionGalleryPaypal() {
		//echo Yii::trace(CVarDumper::dumpAsString($_GET['day']),'vardump10');
		//Yii::app()->end;
		$model=$this->loadModel();
		if(isset($_GET['day']))
			$day=$_GET['day'];
		else
			$day=1;
		if($this->checkAccessRight($model)){
			$paypal = new PayPalForm();
			echo $paypal->handleGalleryPayPal($model,$day);
		}

		//$this->redirect(array('//shop/products/update','id'=>$model->product_id));
		$this->actionUpdate($model->product_id);
	}
	
	public function actionSuccess($id)
	{
		Shop::setFlash('Feature payment completed');
		$this->actionUpdate($id);
	}

	public function actionFailure($id)
	{
		Shop::setFlash('Feature payment cancelled');
		$this->actionUpdate($id);
	}
	
	public function actionGallerySuccess($id)
	{
		Shop::setFlash('Gallery payment completed');
		$this->actionUpdate($id);
	}

	public function actionGalleryFailure($id)
	{
		Shop::setFlash('Gallery payment cancelled');
		$this->actionUpdate($id);
	}
	
	public function actionIpn() {
		Yii::import('application.modules.shop.components.payment.Paypal');

		$paypal = new Paypal();
		Shop::log('Paypal payment attempt');

		// Log the IPN results
		$paypal->ipnLog = TRUE;
		$paypal->ipnLogFile = Shop::module()->payPalLog;

		if(Shop::module()->payPalTestMode)
			$paypal->enableTestMode();

		// Check validity and write down it
		if ($paypal->validateIpn())
		{
			// Find ipnap
			$featureIpn = FeatureIpn::model()->find('id = :id ', array(':id' => $paypal->ipnData['custom']));
			
			if (!$featureIpn){
				$fp = fopen($paypal->ipnLogFile,'a');
				fwrite($fp, 'Invalid ipn data' . "\n\n");
				fclose($fp);
				Shop::log('Invalid ipn data :'.var_dump($paypal));
				return false;
			}else{
				if($this->_validate_ipn_data($featureIpn, $paypal->ipnData)){
					$this->_update_ipn_data($featureIpn, $paypal->ipnData);
					if (strtolower($paypal->ipnData['payment_status']) == 'completed')
					{
						// Proceed Order
						$featureIpn->updateFeatureDate();
						Shop::log('Paypal payment arrived :'.var_dump($paypal));
					}
					else
					{
						Shop::log('Paypal payment raised an error :'.var_dump($paypal));
					}
				}else{
					$fp = fopen($paypal->ipnLogFile,'a');
					fwrite($fp, 'Invalid ipn data' . "\n\n");
					fclose($fp);
					Shop::log('Invalid ipn data :'.var_dump($paypal));
				}
			}	
		} 
	}
	
	public function actionGalleryIpn() {
		Yii::import('application.modules.shop.components.payment.Paypal');

		$paypal = new Paypal();
		Shop::log('Paypal payment attempt');

		// Log the IPN results
		$paypal->ipnLog = TRUE;
		$paypal->ipnLogFile = Shop::module()->payPalLog;

		if(Shop::module()->payPalTestMode)
			$paypal->enableTestMode();

		// Check validity and write down it
		if ($paypal->validateIpn())
		{
			// Find ipnap
			$featureIpn = FeatureIpn::model()->find('id = :id ', array(':id' => $paypal->ipnData['custom']));
			
			if (!$featureIpn){
				$fp = fopen($paypal->ipnLogFile,'a');
				fwrite($fp, 'Invalid ipn data' . "\n\n");
				fclose($fp);
				Shop::log('Invalid ipn data :'.var_dump($paypal));
				return false;
			}else{
				if($this->_validate_ipn_data($featureIpn, $paypal->ipnData)){
					$this->_update_ipn_data($featureIpn, $paypal->ipnData);
					if (strtolower($paypal->ipnData['payment_status']) == 'completed')
					{
						// Proceed Order
						$featureIpn->updateGalleryDate();
						Shop::log('Paypal payment arrived :'.var_dump($paypal));
					}
					else
					{
						Shop::log('Paypal payment raised an error :'.var_dump($paypal));
					}
				}else{
					$fp = fopen($paypal->ipnLogFile,'a');
					fwrite($fp, 'Invalid ipn data' . "\n\n");
					fclose($fp);
					Shop::log('Invalid ipn data :'.var_dump($paypal));
				}
			}	
		} 
	}

	private function _validate_ipn_data($featureIpn, $ipnData)
	{
		//$fp = fopen('images/ipnap.log','a');
		if($ipnData['receiver_email']!==$featureIpn->receiver_email)
			return false;
		//fwrite($fp, 'email1 passed' . "\n\n");
		
		//fwrite($fp, number_format(trim($ipnData['transaction[0].amount'],'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ '),6,'.','') . "\n\n");
		//fwrite($fp, number_format($orderIpn->amount_1,6,'.','') . "\n\n");
		//fwrite($fp, number_format(trim($ipnData['transaction[1].amount'],'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ '),6,'.','') . "\n\n");
		//fwrite($fp, number_format($orderIpn->amount_2,6,'.','') . "\n\n");
		
		if(number_format(trim($ipnData['payment_gross'],'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ '),6,'.','')!==number_format($featureIpn->amount,6,'.',''))
			return false;
		//fwrite($fp, 'amount1 passed' . "\n\n");
		
		//fwrite($fp, 'validation passed' . "\n\n");
		//fclose($fp);
		return true;
		
		//number_format($number, 2, '.', '');
	}
	
	private function _update_ipn_data($featureIpn, $ipnData)
	{
		//$fp = fopen('images/ipnap.log','a');
		//fwrite($fp, 'check status'.strtolower($orderIpn->status) . "\n\n");
		//fclose($fp);
		if (strtolower($featureIpn->status)!=='completed'){
			$featureIpn->status = $ipnData['payment_status'];
			$featureIpn->receive_time = date('Y-m-d H:i:s');
			$featureIpn->sender_email = $ipnData['payer_email'];
			//$featureIpn->pay_key = $ipnData['pay_key'];
			
			//$fp = fopen('images/ipnap.log','a');
			//fwrite($fp, 'save orderIpn' . "\n\n");
			//fclose($fp);
			if ($featureIpn->save())
				return true;
			else
				return false;
		}else{
			// already completed
			//$fp = fopen('images/ipnap.log','a');
			//fwrite($fp, 'status = complete' . "\n\n");
			//fclose($fp);

			return false;
		}
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
		/*
		}elseif ($_GET["_method"] == "list"){
                $intProductId = $_GET['id'];
                $objProductImages = Image::model()->sorted()->findAllByAttributes(array('product_id' => $intProductId));
                if ($objProductImages !== null)
                {
                    $arrProductImages = array();
                    foreach ($objProductImages as $objProductImage)
                    {
                        $arrProductImages[] = array(
                            "name" => $objProductImage->name,
                            "id" => $objProductImage->getPrimaryKey(),
                            "type" => $objProductImage->mimeType,
                            "size" => $objProductImage->size,
                            "url" => $objProductImage->path,
                            "thumbnail_url" => $objProductImage->thumb,
                            "delete_url" => $this->getController()->createUrl("upload", array("_method" => "delete", "id" => $objProductImage->id)),
                            "delete_type" => "GET",
                        );
                    }
                    echo json_encode($arrProductImages);
                }
		*/
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
	/***
	$model=new Products('search');
		if(isset($_GET['Products']))
			$model->attributes=$_GET['Products'];

		$this->render('index',array(
					'model'=>$model,
					));
					
					$dataProvider = new CActiveDataProvider('Products', array(
					'criteria' => array(
						'condition' => 'status = 1')));

		$this->render('index',array(
					'dataProvider'=>$dataProvider,
					));
	
	***/
					
		$products_model=new Products('search');
		/*
		$top10products_ds=$products_model->searchTop10();
		$top10products=$top10products_ds->getData();
		
		$galleryProducts_ds=$products_model->searchGallery();
		if($galleryProducts_ds->totalItemCount==0)
			$galleryProducts_ds=$products_model->searchRandom();
		$galleryProducts=$galleryProducts_ds->getData();
		
		$galleryProducts_ds2=$products_model->searchGallery();
		if($galleryProducts_ds2->totalItemCount==0)
			$galleryProducts_ds2=$products_model->searchRandom();
		$galleryProducts2=$galleryProducts_ds2->getData();
		
		$featureProducts_ds=$products_model->searchFeature();
		if($featureProducts_ds->totalItemCount==0)
			$featureProducts_ds=$products_model->searchRandom();
		$featureProducts=$featureProducts_ds->getData();
		
		$featureProducts_ds2=$products_model->searchFeature();
		if($featureProducts_ds2->totalItemCount==0)
			$featureProducts_ds2=$products_model->searchRandom();
		$featureProducts2=$featureProducts_ds2->getData();
		
		$newProducts_ds=$products_model->searchNew();
		$newProducts=$newProducts_ds->getData();
		//if(isset($_GET['Products']))
		//	$products->attributes=$_GET['Products'];
		$top10stores_model=new Store('search');
		$top10stores=$top10stores_model->searchTop10()->getData();
		
		$todaysDealProducts_ds=$products_model->searchTodaysDeal();
		if($todaysDealProducts_ds->totalItemCount==0)
			$todaysDealProducts_ds=$products_model->searchRandom();
		$todaysDealProducts=$todaysDealProducts_ds->getData();
		*/
		
		
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
					//'top10products'=>$top10products,
					//'galleryProducts'=>$galleryProducts,
					//'galleryProducts2'=>$galleryProducts2,
					//'featureProducts'=>$featureProducts,
					//'featureProducts2'=>$featureProducts2,
					//'newProducts'=>$newProducts,
					//'top10stores'=>$top10stores,
					//'todaysDealProducts'=>$todaysDealProducts,
					
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
		$model=new Products('search');
		if(isset($_GET['Products']))
			$model->attributes=$_GET['Products'];

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
						
		$model=new Products('search');
		$model->unsetAttributes();
		
		if(isset($_GET['Products']))
			$model->attributes=$_GET['Products'];
		$model->store_id=$store->id;
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
				$this->_model=Products::model()->findbyPk($_GET['id']);
			if(isset($_GET['title']))
				$this->_model=Products::model()->find('title = :title', array(
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
	
	/**
	 * View Formula
	 * @param CModel the model to be validated
	 */
	protected function updateViewCount($product)
	{
		$product->view = $product->view + 1;
		return $product->save();
	}
	
	public function _admin_grid($data,$row)
	{
		return $this->renderPartial('_grid', array('product'=>$data), true);
	}
	
	private function checkAccessRight($model)
	{
		if($model->store->user_id==Yii::app()->user->id)
			return true;
		else
			return false;
	}
	private function findProdImgPath($product){
			if($product->images) {
                                        $folder = Shop::module()->productImagesFolder;
                                        $thumb_image_folder = Shop::module()->productThumbImagesFolder;
                                        foreach($product->images as $image) {
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
