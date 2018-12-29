<?php
Yii::import("xupload.models.XUploadForm");
class ChatController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
			//array('allow',  // allow all users to perform 'index' and 'view' actions
			//	'actions'=>array('index','view','inbox','captcha'),
			//	'users'=>array('@'),
			//),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('captcha'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				//'actions'=>array('create','update','inbox','sent','captcha'),
				'actions'=>array('create','update','inbox','sent', 'upload'),
				'users'=>array('@'),
			),
			//array('allow', // allow admin user to perform 'admin' and 'delete' actions
			//	'actions'=>array('admin','delete'),
			//	'users'=>array('@'),
			//),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
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
		/*
		$model=new Chat;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Chat']))
		{
			$model->attributes=$_POST['Chat'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
		*/
		$model=new ChatForm;
		//echo Yii::trace(CVarDumper::dumpAsString('chatactioncreate'),'vardump10');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
 
        if(isset($_POST['ChatForm']))
        {
            $model->attributes=$_POST['ChatForm'];
            if($model->save())
            {
				// Send email
				$this->sendNotificationFromChat($model);
			
                if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status'=>'success', 
                        //'div'=>"Classroom successfully added"
                        ));
                    exit;               
                }
                else
                    $this->redirect(array('view','id'=>$model->id));
            }
        }
 
        if (Yii::app()->request->isAjaxRequest)
        {
			//echo Yii::trace(CVarDumper::dumpAsString($_POST['ChatForm']),'vardump10');
            echo CJSON::encode(array(
				'status'=>'failure', 
				//'div'=>$this->renderPartial('shop.views.chat._create_form', array('model'=>$model), true),
				'error'=>CHtml::errorSummary($model),
				));
            exit;
			//$this->layout=null;
			//$this->render('create',array('model'=>$model,));
        }
        else
            $this->render('create',array('model'=>$model,));
		
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$upload = new XUploadForm;
		$model=$this->loadModel($id);
		$messageForm = new ChatMessageForm();
		$messageForm->chat_id = $id;
		$chatMessages = new ChatMessage();
		$chatMessages->chat_id = $id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$model->updateMessageRead();
		//echo Yii::trace(CVarDumper::dumpAsString('chatactionupdate'),'vardump10');
		if(isset($_POST['ChatMessageForm']))
		{
			$messageForm->attributes=$_POST['ChatMessageForm'];
			if($messageForm->save()) {
				// Send email
				$this->sendNotificationFromChatMessage($messageForm);
				
				$this->redirect(array('update','id'=>$messageForm->chat_id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'chatMessages'=>$chatMessages,
			'messageForm'=>$messageForm,
			'upload'=>$upload,
		));
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
		$dataProvider=new CActiveDataProvider('Chat');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Chat('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Chat']))
			$model->attributes=$_GET['Chat'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionInbox()
	{
		$model=new Chat('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Chat']))
			$model->attributes=$_GET['Chat'];

		$this->render('inbox',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionSent()
	{
		$model=new Chat('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Chat']))
			$model->attributes=$_GET['Chat'];

		$this->render('sent',array(
			'model'=>$model,
		));
	}
	
	public function actionUpload( ) {
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
					$thumb->resize(Shop::module()->productImageThumbWidth,Shop::module()->productImageThumbHeight);
					$thumb->save($thumbPath.$filename);
					
					$thumb=Yii::app()->phpThumb->create($path.$filename);
					$thumb->resize(Shop::module()->productImageWidth,Shop::module()->productImageHeight);
					$thumb->save($path.$filename);
	 
					//Now we need to save this path to the user's session
					if( Yii::app( )->user->hasState( 'chatimages' ) ) {
						$userImages = Yii::app( )->user->getState( 'chatimages' );
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
					Yii::app( )->user->setState( 'chatimages', $userImages );
	 
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
	
	private function sendNotificationFromChat($chatform)
	{
		Yii::import('profile.models.*');
		//echo Yii::trace(CVarDumper::dumpAsString('from chat'),'vardump10');
		
		$profile = YumProfile::model()->findByAttributes(array('user_id'=>$chatform->recipient,));
		if (isset($profile))
			$this->sendNotification(AppProfile::model()->getEmailUsername(),$profile->email,$chatform->title."[".$chatform->product_name."/".$chatform->pet_id."]",$chatform->message);
	}
	
	private function sendNotificationFromChatMessage($chatmsgform)
	{
		Yii::import('profile.models.*');
		//echo Yii::trace(CVarDumper::dumpAsString('from chat message'),'vardump10');
		$chat = Chat::model()->findByPk($chatmsgform->chat_id);
		if (isset($chat)) {
			$profile = YumProfile::model()->findByAttributes(array('user_id'=>$chat->recipient_id,));
			if (isset($profile))
				return $this->sendNotification(AppProfile::model()->getEmailUsername(),$profile->email,$chat->title,$chatmsgform->message);
			else
				return false;
		}else{
			return false;
		}
	}
	
	private function sendNotification($from, $to, $subject, $body)
	{
		Yii::import('user.components.*');
		//echo Yii::trace(CVarDumper::dumpAsString('sendnotify'),'vardump10');
		$mail = array(
			//'from' => AppProfile::model()->getEmailUsername(),
			'from' => $from,
			'to' => $to,//$user->profile->email,
			'subject' => $subject,
			'body' => $body,
		);
		$sent = YumMailer::send($mail);

		return $sent;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Chat the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Chat::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Chat $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='chat-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function _admin_grid($data,$row)
	{
		return $this->renderPartial('_message_grid', array('message'=>$data), true);
	}
}
