<section class="dropdown">

                                        <div class="animated_item">

                                                <h3 class="title">Contact Us</h3>

                                        </div><!--/ .animated_item-->

                                        <div class="animated_item">

                                                <p class="form_caption">If you have any queries please feel free to contact our friendly team</p>

                                                <?php $form=$this->beginWidget('CActiveForm',array(
                                                                'id'=>'contact-ajax-form',
                                                                'enableAjaxValidation'=>false,
							//	'action'=>'/site/contactajax',
                                                        ));

?>
<ul>
                                                        

                                                                <li class="row">

                                                                        <div class="col-xs-12">
	<?php echo $form->textField($model,'name',array('title'=>'Name','placeholder'=>'Your Name'));?>
	<?php echo $form->error($model,'name');?>
                                                                        </div>

                                                                </li>

                                                                <li class="row">

                                                                        <div class="col-xs-12">
       <?php echo $form->textField($model,'email',array('title'=>'Email','placeholder'=>'Your email'));?>
        <?php echo $form->error($model,'email');?>

                                                                        </div>

                                                                </li>

                                                                <li class="row">

                                                                        <div class="col-xs-12">
       <?php echo $form->textArea($model,'body',array('title'=>'Message','placeholder'=>'Your Message','rows'=>'6'));?>
        <?php echo $form->error($model,'body');?>

                                                                        </div>

                                                                </li>
 <li class="row">
                <div class="col-xs-12" id="errorMsg"></div>
        </li>
                                                                <li class="row">

                                                                        <div class="col-xs-12">

                                                                        <?php echo CHtml::ajaxSubmitButton("Send",
										'/site/contactajax',
										array('update'=>'#errorMsg'),
										array('class'=>'button_grey middle_btn'),
array('data'=>'js:jQuery(this).parents("form").serialize()',
'success'=>'js:function(data){
	$("#errorMsg").html("Send!");
}',
'error'=>'js:function(data){
	$("#errorMsg").html("Fail to send!");}',
));
?>

                                                                        </div>

                                                                </li>

                                                        </ul>
<?php $this->endWidget(); ?>

                                        </div><!--/ .animated_item-->

                                </section><!--/ .dropdown-->
