<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">
	<div class="container">
	<?php 
		$user=YumUser::model()->find('id=?',array(Yii::app()->user->id));
		$this->widget('application.components.widgets.BreadcrumbsWidget',array(
							'items'=>array(
											array('description'=>'Home', 'href'=>Yii::app()->createUrl('/site/index'),),
											array('description'=>'My Account', 'href'=>Yii::app()->request->baseUrl.'/profile/profile/update/'.Yii::app()->user->id),
											array('description'=>$user->username),
										)
						)
					);
	?>
	<?php 
		$this->renderPartial('profile.views.profile._left_menu');
	?>
	<?php
		$form=$this->beginWidget('CActiveForm', array(
							'action'=>Yii::app()->request->baseUrl.'/avatar/avatar/editAvatar', 
							'id' => $model->id, 
							'method'=>'POST', 
							'htmlOptions'=>array(
								'enctype' => 'multipart/form-data')
							)
						);
	?>
	<main class="col-md-9 col-sm-8">
		<?php 
			echo CHtml::errorSummary($model);
		?>
		<div class="form-title">Upload Avatar</div>
		<ul class="form-fields">
		<?php 
			echo '<li>';
			if(Yii::app()->user->isAdmin())
				echo Yum::t('Set Avatar for user ' . $model->username);
			else 
				echo $model->getAvatar();
				echo '<br />';
			echo '</li>';
			if(Yum::module('avatar')->avatarMaxWidth != 0)
				echo '<p>' . Yum::t('The image should have at least 50px and a maximum of 200px in width and height. Supported filetypes are .jpg, .gif and .png') . '</p>';
				
			echo '<li>';
			echo CHtml::activeFileField($model, 'avatar');
			echo '</li>';
		?>
		</ul>
		<br>
		<a class="button_dark_grey middle_btn" href="<?php echo Yii::app()->request->baseUrl; ?>/avatar/avatar/removeAvatar" title="Remove Avatar"><span><span>Remove Avatar</span></span></a>
		<input class="button_blue middle_btn" type="submit" value="Upload Avatar" />
	</main><!--/ [col]-->
	<?php
		//echo CHtml::endForm();
		$this->endWidget();
	?>
	</div><!--/ .container-->
</div><!--/ .page_wrapper-->			
<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->


