<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php if($model->hasErrors()) { ?>
	<div class="alert">
		<?php echo CHtml::errorSummary($model); ?>
	</div>
	<?php } ?>

	<p class="note"><?php echo Yum::t('Fields with {star} are required.',array('{star}'=>'<span class="required">*</span>')); ?></p>

	<div class="row">
		<?php
			if(Yum::module()->loginType & UserModule::LOGIN_BY_USERNAME)
				echo CHtml::activeLabelEx($model,'username');
			if(Yum::module()->loginType & UserModule::LOGIN_BY_EMAIL)
				printf ('<label for="YumUserLogin_username">%s <span class="required">*</span></label>', Yum::t('E-Mail address')); 
		?>
		<?php echo $form->textField($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
	</div>

	<div class="row">
		<p class="hint">
			<?php 
				if(Yum::hasModule('registration') && Yum::module('registration')->enableRegistration)
					echo CHtml::link(Yum::t("Registration"),
					Yum::module('registration')->registrationUrl);
				if(Yum::hasModule('registration') 
				  && Yum::module('registration')->enableRegistration
				  && Yum::module('registration')->enableRecovery)
					echo ' | ';
				if(Yum::hasModule('registration') 
				  && Yum::module('registration')->enableRecovery) 
					echo CHtml::link(Yum::t("Lost password?"),
					Yum::module('registration')->recoveryUrl);
			?>
		</p>
	</div>
		
	<div class="row">
		<?php
			if ($model->scenario == 'captcha' && CCaptcha::checkRequirements()) {
				echo $form->labelEx($model, 'verifyCode');
				$this->widget('CCaptcha');
				echo $form->textField($model, 'verifyCode');
			}
		?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yum::t('Login')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
