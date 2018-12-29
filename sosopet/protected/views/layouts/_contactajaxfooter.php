
								<!-- - - - - - - - - - - - - - Contact Us widget - - - - - - - - - - - - - - - - -->

								<section class="widget">

									<h4><?php echo Yii::t('shop','Contact Us');?></h4>

									<p class="form_caption"><?php echo Yii::t('shop','If you have any queries please feel free to contact our friendly team');?></p>

  <?php $form=$this->beginWidget('CActiveForm',array(
                                                                'id'=>'contact-ajax-form',
                                                                'enableAjaxValidation'=>false,
                                                        //      'action'=>'/site/contactajax',
                                                        ));
?>
										<ul>

											<li class="row">

												<div class="col-xs-12">

<?php echo $form->textField($model,'name',array('title'=>'Name','placeholder'=>Yii::t('shop','Your Name')));?>
        <?php echo $form->error($model,'name');?>
												</div>

											</li>

											<li class="row">

												<div class="col-xs-12">

<?php echo $form->textField($model,'email',array('title'=>'Email','placeholder'=>Yii::t('shop','Your email')));?>
        <?php echo $form->error($model,'email');?>
												</div>

											</li>

											<li class="row">

												<div class="col-xs-12">

<?php echo $form->textArea($model,'body',array('title'=>'Message','placeholder'=>Yii::t('shop','Your Message'),'rows'=>'6'));?>
        <?php echo $form->error($model,'body');?>
												</div>

											</li>
										<li class="row">
                <div class="col-xs-12" id="errorMsgFooter"></div>
        </li>	
											<li class="row">

												<div class="col-xs-12">

            <?php echo CHtml::ajaxSubmitButton(Yii::t('shop','Send'),
                                                                                '/site/contactajax',
                                                                                array('update'=>'#errorMsgFooter'),
                                                                                array('class'=>'button_grey middle_btn'),
array('data'=>'js:jQuery(this).parents("form").serialize()',
'success'=>'js:function(data){
        $("#errorMsg").html("'.Yii::t('shop','Send!').'");
}',
'error'=>'js:function(data){
        $("#errorMsg").html("'.Yii::t('shop','Fail to Send!').'");}',
));
?>
<?php $this->endWidget(); ?>
												</div>

											</li>

										</ul>


								</section><!--/ .widget-->

								<!-- - - - - - - - - - - - - - End of contact us widget - - - - - - - - - - - - - - - - -->
