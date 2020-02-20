<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">
	<div class="container">
		<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->
		<div class="special_handle_stephen stephen">
		<?php
			$this->widget('application.components.widgets.BreadcrumbsWidget',array(
								'items'=>array(
												array('description'=>Yii::t('shop','Home'), 'href'=>Yii::app()->createUrl('/site/index'),),
												array('description'=>$lifestyle->title),
											)
							)
						);
		?>
		</div>
		<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->
		<div class="row">
			<!-- - - - - - - - - - - - - - sell images & description - - - - - - - - - - - - - - - - -->
			<?php
			 
				$slides = array();
				$default_image = '';
				$slide_count = 0;
				if($lifestyle->images) {
					$folder = Shop::module()->lifestyleImagesFolder;
					$thumb_image_folder = Shop::module()->lifestyleThumbImagesFolder;
					foreach($lifestyle->images as $image) {
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
				
				/*
				$variationOption = '';
				if($variations = $sell->getVariations()) {
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
				}*/
				 
				$this->widget('application.components.widgets.LifestyleWidget',array(
								'item'=>array(
												'defaultImage' => $default_image,
												'productID' => $lifestyle->id,
												'images' => $slides,
												'title' => $lifestyle->title,
												'description' => $lifestyle->description,
											  
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
 
			<!-- - - - - - - - - - - - - - Tabs - - - - - - - - - - - - - - - - -->
			<div class="section_offset">
				<div class="tabs type_2">
					<!-- - - - - - - - - - - - - - Navigation of tabs - - - - - - - - - - - - - - - - -->
					<ul class="tabs_nav clearfix">
						<li><a href="#tab-1"><?php echo Yii::t('shop','Comments');?></a></li>
					 
</ul>				
					<!-- - - - - - - - - - - - - - End navigation of tabs - - - - - - - - - - - - - - - - -->
					<!-- - - - - - - - - - - - - - Tabs container - - - - - - - - - - - - - - - - -->
					<div class="tab_containers_wrap">
					 
						<!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->
						<div id="tab-1" class="tab_container">
						 
							<?php $form=$this->beginWidget('CActiveForm', array(
								'id'=>'feedback-form',
								'action'=>Yii::app()->createUrl('//shop/feedback/create'),
								'enableAjaxValidation'=>false,
							)); 
							
							$comments = array();
							foreach($feedbacks->searchAll()->getData() as $comment) {
								$comments[] = array('date'=>$comment->created_date,'author'=>$comment->user->username,'comment'=>$comment->comment);							
							}
							
							$this->widget('application.components.widgets.ReviewListWidget',array(
									'items'=>$comments
								)
							);
							
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
