<main class="col-md-9 col-sm-8">
<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'profile-form',
		)); ?>
<?php 
	Yum::renderFlash();
	echo $form->errorSummary(array($user, $changePassword, $profile)); 
?>
<section class="section_offset">
	<div class="theme_box">
	
	<h3><?php echo Yii::t('shop','Account Information');?></h3>
	 
	<ul>
	<li class="row">
		<div class="col-sm-6">
		<?php
			echo $form->labelEx($user, 'username');
			echo $form->textField($user,'username',array('disabled'=>'disabled'));
		?>
		</div>
	</li>
	<li class="row">
		<div class="col-sm-6">
		<?php
			echo $form->labelEx($changePassword, 'currentPassword');
			echo $form->textField($changePassword, 'currentPassword');
		?>
		</div>
	</li>
	<li class="row">
		<div class="col-sm-6">
		<?php
			echo $form->labelEx($changePassword, 'password');
			echo $form->textField($changePassword, 'password');
		?>
	</li>
	<li class="row">
		<div class="col-sm-6">
		<?php
			echo $form->labelEx($changePassword, 'verifyPassword');
			echo $form->textField($changePassword, 'verifyPassword');
		?>
		</div>
	</li>
	<li class="row">
		<div class="col-sm-6">
		<?php
			echo $form->labelEx($profile, 'email');
			echo $form->textField($profile, 'email');
		?>
		</div>
	</li>
	<li class="row">
		<div class="col-sm-6">
		<?php
			echo $form->labelEx($profile, 'firstname');
			echo $form->textField($profile, 'firstname');
		?>
		</div>
	</li>
	<li class="row">
		<div class="col-sm-6">
		<?php
			echo $form->labelEx($profile, 'lastname');
			echo $form->textField($profile, 'lastname');
		?>
		</div>
	</li>
	<li class="row">
		<div class="col-sm-6">
		<?php 
			echo $form->labelEx($profile, 'gender');
			//echo $form->dropDownList($profile, 'gender', array('M'=>'Male', 'F'=>'Female',), array('prompt' => 'Please select'));
			echo $form->dropDownList($profile, 'gender', array('M'=>Yii::t('shop','Male'), 'F'=>Yii::t('shop','Female'),));
		?>
		</div>
	</li>
	
	<li>
		<?php echo $form->labelEx($profile,'country'); ?>
		<?php 
	 
		echo CHtml::hiddenField('hidden_cou',$profile->country_id);
		if (Yii::app()->language=='zh'){
			$opts = CHtml::listData(Country::model()->findAll('parent_id = 0'),'country_id','title_zh');
		}else{
			$opts = CHtml::listData(Country::model()->findAll('parent_id = 0'),'country_id','title');
		}
		echo $form->dropDownList($profile,'country_id',$opts,array('empty'=>Yii::t('shop','-- Please Select --'),
		'ajax' => array(
                        'type'=>'POST',
         				'url'=>Yii::app()->createUrl('shop/country/dynamicCou'),
                        'update'=>'#YumProfile_sub_country_id',
                        'data'=>'js:$(this).serialize()+"&hidden_state='.$profile->country_id.'"',
 
        )));     

		?>
		</li>
		<li>
		<?php echo $form->labelEx($profile,'sub_country_id'); 
		 
		$opts = array();
		if(isset($profile->sub_country_id) && $profile->country_id !=""){
			if (Yii::app()->language=='zh'){
				$opts = CHtml::listData(Country::model()->findAll('parent_id = '.$profile->country_id),'country_id','title_zh');
			}else{
				$opts = CHtml::listData(Country::model()->findAll('parent_id = '.$profile->country_id),'country_id','title');	
			}
		}
			
		echo $form->dropDownList($profile,'sub_country_id',$opts,array('empty'=>Yii::t('shop','-- Please Select --')));
		
		?>
		</li>
		
	</ul>
	</div>
</section>
<section class="section_offset">
	<input class="button_blue middle_btn" type="submit" value="<?php echo Yii::t('shop','Save');?>" />
</section>
<?php $this->endWidget(); ?>
</main><!--/ [col]-->
