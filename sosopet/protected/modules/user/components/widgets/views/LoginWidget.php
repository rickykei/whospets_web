<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<script language="JavaScript" type="text/javascript">
	<!--
	function login()
	{
		$('#<?php echo $form->id ?>').submit();
	}
	-->
	</script>
	<h1 class="page-title">Login or Create an Account</h1>
	<div class="account-login">
		<div class="col-1 new-users">
			<div class="content">
				<h2>New </h2>
				<p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
			</div>
			<div class="buttons-set">
				<?php
					echo CHtml::link('Create an Account', 
						Yum::module('registration')->registrationUrl, array(
							'class'=>'colors-btn',
							'title'=>'Create an Account',
						)
					);
				?>
				<div class="clear"></div>
			</div>
		</div>
		<div class="col-2 registered-users">
			<div class="content">
				<h2>Registered </h2>
				<?php 
					if($model->hasErrors()) {
						echo CHtml::errorSummary($model);
					} 
				?>
				<p>If you have an account with us, please log in.</p>
				<ul class="form-list">
					<li>
						<?php echo CHtml::activeLabelEx($model,'username'); ?>
						<div class="input-box">
							<?php echo $form->textField($model,'username'); ?>
						</div>
						<div class="clear"></div>
					</li>
					<li>
						<?php echo $form->labelEx($model,'password'); ?>
						<div class="input-box">
							<?php echo $form->passwordField($model,'password'); ?>
						</div>
						<div class="clear"></div>
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
				</ul>
				<p class="required">* Required Fields</p>
			</div>
			<div class="buttons-set">
				<?php
					echo CHtml::link('Forgot Your Password?', 
						Yum::module('registration')->recoveryUrl, array(
							'class'=>'f-left',
						)
					);
				?>
				<input class="colors-btn" type="submit" value="Login">
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
