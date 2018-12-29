<!--==================================
		Login modal window
======================================-->
<section class="col-sm-1">
</section>
<section class="col-sm-10">
<div id="login_mw" class="modal_window">
	<header class="on_the_sides">
		<div class="left_side">
			<h2><?php echo Yii::t('shop','Log In');?></h2>
		</div>
		<div class="right_side">
			<a href="<?php echo Yii::app()->createUrl('registration/registration/registration'); ?>" class="button_grey middle_btn"><?php echo Yii::t('shop','Register');?></a>
		</div>
	</header><!--/ .on_the_sides-->
	<?php echo CHtml::errorSummary($model); ?>
	<?php Yum::renderFlash();?>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		'htmlOptions'=>array(
			'class'=>'type_2',
		),
	)); ?>
	<ul>
		<li>
			<?php echo CHtml::activeLabelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username'); ?>
		</li>

		<li>
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password'); ?>
		</li>

		<li>
			<?php
				if ($model->scenario == 'captcha' && CCaptcha::checkRequirements()) {
					echo $form->labelEx($model, 'verifyCode');
					$this->widget('CCaptcha');
					echo $form->textField($model, 'verifyCode');
				}
			?>
		</li>

		<li class="v_centered">
			<button class="button_blue middle_btn"><?php echo Yii::t('shop','Login');?></button>
			<a href="<?php echo Yii::app()->createUrl('registration/registration/recovery'); ?>" class="small_link"><?php echo Yii::t('shop','Forgot your password?');?></a>
		</li>

	</ul>
	<?php $this->endWidget(); ?>

	<hr>

	<div class="streamlined">	
		<h4 class="streamlined_title"><?php echo Yii::t('shop','OR Log In With');?></h4>
		<!--Social icon's list-->
		<ul class="horizontal_list social_btns">
			<?php 
				foreach(Yum::module()->hybridAuthProviders as $provider) {
					$hybridLink = Yii::app()->createUrl('/user/auth/login', array('hybridauth'=>$provider));
					echo '<li><a href="'.$hybridLink.'" class="icon_btn middle_btn social_'.$provider.' tooltip_container"><i class="icon-'.$provider.'-1"></i><span class="tooltip top">'.$provider.'</span></a></li>';
				}
			?>
		</ul><!--/ .horizontal_list.wrapper.social_btns-->
		<!--End social icon's list-->
	</div><!--/ .streamlined-->
</div>

</section>
<section class="col-sm-1">
</section>

<!--==================================
		End login modal window
======================================-->

<!-- form -->



