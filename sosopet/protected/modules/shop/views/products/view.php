<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">
	<div class="container">
		<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->
		<div class="special_handle_stephen stephen">
		<?php
			$this->widget('application.components.widgets.BreadcrumbsWidget',array(
								'items'=>array(
												array('description'=>Yii::t('shop','Home'), 'href'=>Yii::app()->createUrl('/site/index'),),
												array('description'=>$product->title),
											)
							)
						);
		?>
		</div>
		<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->
		<div class="row">
			<!-- - - - - - - - - - - - - - Product images & description - - - - - - - - - - - - - - - - -->
			<?php
			 
				$slides = array();
				$default_image = '';
				$slide_count = 0;
				if($product->images) {
					$folder = Shop::module()->productImagesFolder;
					$thumb_image_folder = Shop::module()->productThumbImagesFolder;
					foreach($product->images as $image) {
						$slides[] = array('image' => Yii::app()->baseUrl.'/'.$folder.'/'.$image->filename,
											'thumbImage' => Yii::app()->baseUrl.'/'.$thumb_image_folder.'/'.$image->filename,
										);
						if($image->is_default=='Y' || $default_image=='')
							$default_image = Yii::app()->baseUrl.'/'.$folder.'/'.$image->filename;
					}
				
					//$this->widget('application.components.widgets.ProductSlide',array('defaultImage'=>$default_image,'thumbImages'=>$slides));
				} else {
					$default_image= Shop::register('no-pic.jpg');
				}
				
				$variationOption = '';
				if($variations = $product->getVariations()) {
					$i = 0;
					foreach($variations as $variation) {
						$i++;
						$field = "Variations[{$variation[0]->specification_id}][]";
						if($variation[0]->specification->input_type == 'textfield') {
							$variationOption = $variationOption.CHtml::textField($field);
						} else if ($variation[0]->specification->input_type == 'select'){
							$variationOption = $variationOption.CHtml::dropDownList($field,
									$variation[0]->specification->required ? $variation[0]->id : null,
									ProductVariation::listSimpleVar($variation));
						} else if ($variation[0]->specification->input_type == 'image'){
							$variationOption = $variationOption.CHtml::fileField($field);
						}
						if($i % 2 == 0)
							$variationOption = $variationOption.'<div style="clear: both;"></div>';
					}
				}
				 
				$this->widget('application.components.widgets.ProductWidget',array(
								'item'=>array(
												'defaultImage' => $default_image,
												'productID' => $product->product_id,
												'images' => $slides,
												'title' => $product->title,
												'description' => $product->description,
												'subCatTitle' => $category->title,
												'brand' => $product->getDetailCategory(),
												'styleCode' => $product->style_code,
												'color' => $product->color,
												'size' => $product->size,
												'dateLost' => $product->date_lost && $product->pet_status!=0?date('Y-m-d', strtotime($product->date_lost)):null,
												'dateBorn' => $product->date_born?date('Y-m-d', strtotime($product->date_born)):'',
												'subCatID' => $product->category_id,
												'weight' => $product->weight,
												'height' => $product->height,
												'nameOfPet' => $product->name_of_pet,
												'country' => $product->getParentCountryTitle(),
												'subCountryTitle' => (Yii::app()->language=='en')?$sub_country->title:$sub_country->{'title_'.Yii::app()->language},
												//'country' => $product->country,
												//'country' => isset($product->country ) && $product->country!=''?Shop::module()->validCountries[$product->country]:'',
												'contact' => $product->contact,
												'pet_status' => $product->pet_status,
												'petStatus' => isset(Shop::module()->petStatusOpt[$product->pet_status])?Shop::module()->petStatusOpt[$product->pet_status]:$product->pet_status,
												//'condition' => $product->condition,
												'price' => $product->getRegularPrice(),
												//'discountPrice' => $product->getDiscountPrice()?$product->getDiscountPrice():null,
												'variationOption' => $variationOption,
												//'wishlistLink' => Yii::app()->createUrl('/shop/wishlist/update',array('product_id' => $product->product_id)),
												'lastSeen' => $product->last_seen_appearance,
												'questions' => $product->questions,
												'mailLink' => Yii::app()->user->isGuest?Yii::app()->createUrl('/user/auth'):'#openModal',
												'petId' => $product->pet_id,
												'gender' => $product->gender,
											)
							)
						);
			?>
			<!-- - - - - - - - - - - - - - End of product images & description - - - - - - - - - - - - - - - - -->
<style>
	.modalDialog {
		position: fixed;
		font-family: Arial, Helvetica, sans-serif;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		background: rgba(0,0,0,0.8);
		z-index: 99999;
		opacity:0;
		-webkit-transition: opacity 400ms ease-in;
		-moz-transition: opacity 400ms ease-in;
		transition: opacity 400ms ease-in;
		pointer-events: none;
	}

	.modalDialog:target {
		opacity:1;
		pointer-events: auto;
	}

	.modalDialog > div {
		width: 600px;
		position: relative;
		margin: 2% auto;
		padding: 5px 20px 13px 20px;
		border-radius: 10px;
		background: #fff;
		background: -moz-linear-gradient(#fff, #999);
		background: -webkit-linear-gradient(#fff, #999);
		background: -o-linear-gradient(#fff, #999);
	}

	.dialogclose {
		background: #606061;
		color: #FFFFFF;
		line-height: 25px;
		position: absolute;
		right: -12px;
		text-align: center;
		top: -10px;
		width: 24px;
		text-decoration: none;
		font-weight: bold;
		-webkit-border-radius: 12px;
		-moz-border-radius: 12px;
		border-radius: 12px;
		-moz-box-shadow: 1px 1px 3px #000;
		-webkit-box-shadow: 1px 1px 3px #000;
		box-shadow: 1px 1px 3px #000;
	}

	.dialogclose:hover { background: #00d9ff; }
	</style>
<div id="openModal" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="dialogclose">X</a>
		<h3><?php echo Yii::t('shop','Message to Owner');?></h3>
		<!-- - - - - - - - - - - - - - Review form - - - - - - - - - - - - - - - - -->
		<!--<form class="type_2">-->
		<div id="chatdialog">
			<?php 
				//$default_subject = 'Product: '.$product->title;
				Yii::import('user.models.*');
				$rcp = YumUser::model()->findByPk($chatForm->recipient);
				$default_subject = Yii::t('shop','Hi').' '.$rcp->username.', '.Yii::t('shop','I have found your pet').' '.$product->title.'!';
				$default_message = Yii::t('shop',"Please contact me to arrange the best possible way to reunite with your pet, my contact detail is as follow:\r\n\r\n\r\nName:\r\n\r\nMobile number:\r\n\r\nEmail:\r\n\r\n");
				$form=$this->beginWidget('CActiveForm', array(
				'id'=>'chat-form',
				'action'=>Yii::app()->createUrl('//shop/chat/create'),
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// There is a call to performAjaxValidation() commented in generated controller code.
				// See class documentation of CActiveForm for details on this.
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('class'=>'type_2',),
				)); ?>
			<?php echo $form->hiddenField($chatForm,'recipient'); ?>
			<?php echo $form->hiddenField($chatForm,'product_id'); ?>
			<?php echo $form->hiddenField($chatForm,'pet_id'); ?>
			<?php echo $form->hiddenField($chatForm,'product_name'); ?>
			<ul>
				<li class="row">
					<!--<div class="col-sm-6">
						<label for="nickname">Nickname</label>
						<input type="text" name="" id="nickname">
					</div>-->
					<div class="col-xs-12">
						<div id="chat_error"></div>
						<?php echo $form->labelEx($chatForm,'title'); ?>
						<?php 
						echo $form->textField($chatForm,'title',array('size'=>50,'maxlength'=>255,'value'=>$default_subject)); ?>
					</div>
				</li>
				<li class="row">
					<div class="col-xs-12">
						<?php echo $form->labelEx($chatForm,'message'); ?>
						<?php 
echo $form->textArea($chatForm,'message',array('maxlength' => 255, 'rows' => 6, 'cols' => 50,'value' => $default_message,'style' => 'display:inline;')); 
?>
					</div>
				</li>
				<li class="row">
					<?php if(CCaptcha::checkRequirements()): ?>
					<div class="captcha col-xs-12">
						<?php echo $form->labelEx($chatForm,'verifyCode'); ?>
						<div>
						<?php $this->widget('CCaptcha', array('captchaAction' => '/shop/chat/captcha')); ?>
						<?php echo $form->textField($chatForm,'verifyCode'); ?>
						</div>
						<div class="hint"><?php echo Yii::t('shop','Please enter the letters as they are shown in the image above.');?>
						<br/><?php echo Yii::t('shop','Letters are not case-sensitive.');?></div>
						<?php echo $form->error($chatForm,'verifyCode'); ?>
					</div>
					<?php endif; ?>
				</li>
				<li class="row">
					<div class="col-xs-12">
						<button class="button_dark_grey small_btn" type='button' onclick="sendMessage();"><?php echo Yii::t('shop','Submit Message');?></button>
					</div>
				</li>
			</ul>
			<?php
			
				$this->widget('xupload.XUpload', array(
									'url' => Yii::app()->createUrl("shop/chat/upload", array("parent_id" => 1)),
									'model' => $upload,
									'attribute' => 'file',
									'multiple' => true,
									'cssFile' => false,
									//'scriptFile' => false,
									'options' => array(
										'maxNumberOfFiles'=>Shop::module()->imageLimit,
										//'maxFileSize' => 3000000,
										//'acceptFileTypes' => "js:/(\.|\/)(jpe?g|png|gif|bmp)$/i",
									),
									'htmlOptions' => array('id'=>'chat-form'),
				));
			?>
			<?php $this->endWidget(); ?>
		<!--</form>-->
		</div>
		<!-- - - - - - - - - - - - - - End of review form - - - - - - - - - - - - - - - - -->
	</div>
</div>

			<!-- - - - - - - - - - - - - - Tabs - - - - - - - - - - - - - - - - -->
			<div class="section_offset">
				<div class="tabs type_2">
					<!-- - - - - - - - - - - - - - Navigation of tabs - - - - - - - - - - - - - - - - -->
					<ul class="tabs_nav clearfix">
						<li><a href="#tab-1"><?php echo Yii::t('shop','Write Something');?></a></li>
						<li><a href="#tab-2"><?php echo Yii::t('shop','Questions');?></a></li>
					<li><a href="#tab-3"><?php echo Yii::t('shop','Last Seen Appearance');?></a></li>
</ul>				
					<!-- - - - - - - - - - - - - - End navigation of tabs - - - - - - - - - - - - - - - - -->
					<!-- - - - - - - - - - - - - - Tabs container - - - - - - - - - - - - - - - - -->
					<div class="tab_containers_wrap">
						<!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->
						<div id="tab-3" class="tab_container">
							<p><?php echo $product->last_seen_appearance; ?></p>
						</div><!--/ #tab-1-->
						<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->
						<!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->
						<div id="tab-2" class="tab_container">
							<p><?php echo $product->questions; ?></p>
							<?php 
								$question_link = Yii::app()->user->isGuest?Yii::app()->createUrl('/registration/registration/registration'):'#openModal';
							?>
							<?php
								$this->renderPartial('_question_form', array('model'=>$chatQuestionForm,'defaultSubject'=>'Hi '.$rcp->username.', I have question for your pet '.$product->title.'!',));		
							?>
							<!--<button class="button_blue middle_btn middle_btn email tooltip_container" onclick="javascript:resetQuestionDialog();location.href='<?php echo $question_link ?>'"><span class="tooltip right">Message to Owner</span>Ask</button>-->
						</div><!--/ #tab-2-->
						<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->
						<!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->
						<div id="tab-1" class="tab_container">
							<?php
								/*$this->widget('zii.widgets.grid.CGridView', array(
									'id'=>'feedback-grid',
									'dataProvider'=>$feedbacks->search(),
									'columns'=>array(
										array(
											'name'=>'Date',
											'header'=>'Date',
											'value'=>'Yii::app()->dateFormatter->format("d MMM y HH:mm:ss",strtotime($data->create_date))',
											'htmlOptions'=>array('style' => 'vertical-align:middle;width:100px;'),
										),
										array(
											'name'=>'User',
											'type'=>'html',
											'value'=>'$data->user->username',
											'htmlOptions'=>array('style' => 'vertical-align:middle;width:130px;'),
										),
										array(
											'name'=>'Comment',
											'type'=>'html',
											'value'=>'$data->comment',
											//'htmlOptions'=>array('style' => 'vertical-align:middle;width:130px;'),
										),
									),
								));*/
							?>
							<?php $form=$this->beginWidget('CActiveForm', array(
								'id'=>'feedback-form',
								// Please note: When you enable ajax validation, make sure the corresponding
								// controller action is handling ajax validation correctly.
								// There is a call to performAjaxValidation() commented in generated controller code.
								// See class documentation of CActiveForm for details on this.
								'action'=>Yii::app()->createUrl('//shop/feedback/create'),
								'enableAjaxValidation'=>false,
							)); 
							
							$comments = array();
							foreach($feedbacks->searchAll()->getData() as $comment) {
								$comments[] = array('date'=>$comment->create_date,'author'=>$comment->user->username,'comment'=>$comment->comment);							
							}
							
							$this->widget('application.components.widgets.ReviewListWidget',array(
									'items'=>$comments
								)
							);
							
							?>
							
							<h2 id="review-title"><?php echo Yii::t('shop','Text me');?></h2>
							<?php 
								Shop::renderFlash();
								echo $form->errorSummary($feedback); 
							?>
							<ul>
								<li>
									<label><?php echo Yii::t('shop','Your Name');?></label>
									<div>
									<?php echo CHtml::textField('tempUsername',Yii::app()->user->isGuest?'Guest':Yii::app()->user->name,array('size'=>32,'maxlength'=>32,'disabled'=>true));
									?>
									</div>
								</li>
								<li>
									<?php echo $form->labelEx($feedback,'comment'); ?>
									<?php echo $form->textArea($feedback, 'comment', array('maxlength' => 300,'rows' => 6,));
									?>
								</li>
								<li>
								<div style="float: right;"><button class="button_blue small_btn"><?php echo Yii::t('shop','Post');?></button></div>
								</li>
							</ul>
							<?php
								echo $form->hiddenField($feedback, 'product_id', array('value' => $product->product_id));
								echo $form->hiddenField($feedback, 'store_id', array('value' => $store->id));
								echo $form->hiddenField($feedback, 'feedback', array('value' => 1));
							?>
							<?php $this->endWidget(); ?>
						</div><!--/ #tab-3-->
						<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->
					</div><!--/ .tab_containers_wrap -->
					<!-- - - - - - - - - - - - - - End of tabs containers - - - - - - - - - - - - - - - - -->
				</div><!--/ .tabs-->
			</div><!--/ .section_offset -->
			<!-- - - - - - - - - - - - - - End of tabs - - - - - - - - - - - - - - - - -->
		</div><!--/ .row-->
	</div><!--/ .container-->
</div><!--/ .page_wrapper-->
<script type="text/javascript">
// here is the magic
function sendMessage()
{
	//alert($('#chatdialog form').serialize());
    <?php echo CHtml::ajax(array(
		'url'=>array('chat/create'),
		'data'=> "js:$('#chatdialog form').serialize()",
		'type'=>'post',
		'dataType'=>'json',
		'success'=>"function(data)
		{
			if (data.status == 'success')
			{
				$('#chatdialog form #ChatForm_message').val('');
				$('#chatdialog form #ChatForm_verifyCode').val('');
				$('#chatdialog form div.captcha a').trigger('click');
				$('#chatdialog form #chat_error').html('<div class=\"alert\">Message has been sent.</div>');
				
			}
			else if (data.status == 'failure')
			{
				$('#chatdialog form #chat_error').html(data.error);
			}else{
				location.href='".Yii::app()->createUrl('/registration/registration/registration')."';
			}
		} ",
		'error'=> "function(err){   
              location.href='".Yii::app()->createUrl('/registration/registration/registration')."'; 
			}", 
		))?>
    return false; 
 
}
function resetQuestionDialog()
{
	$('#chatdialog form #ChatForm_title').val('<?php echo 'Hi '.$rcp->username.', I have question for your pet '.$product->title.'!'; ?>');
	$('#chatdialog form #ChatForm_message').val('');
	$('#chatdialog form #ChatForm_verifyCode').val('');
	//$('#chatdialog form div.captcha a').trigger('click');
}

function resetMessageDialog()
{
	$('#chatdialog form #ChatForm_title').val('<?php echo 'Hi '.$rcp->username.', I have found your pet '.$product->title.'!'; ?>');
	//$('#chatdialog form #ChatForm_message').val('');
	$('#chatdialog form #ChatForm_verifyCode').val('');
	//$('#chatdialog form div.captcha a').trigger('click');
}
</script>
<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
