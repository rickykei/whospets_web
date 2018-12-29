<div class="container">
    <br>
<?php 
$this->pageTitle = Yii::t('shop','Password recovery');

$this->breadcrumbs=array(
	Yum::t('Login') => Yum::module()->loginUrl,
	Yum::t('Restore'));

?>
<?php if(Yum::hasFlash()) {
echo '<div class="alert alert-success">';
echo Yum::getFlash(); 
echo '</div>';
} else {
echo '<h2>'.Yii::t('shop','Password recovery').'</h2>';
?>


<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::errorSummary($form); ?>
	

	

	

		<?php echo CHtml::activeLabel($form,'login_or_email'); ?>
		<?php echo CHtml::activeTextField($form,'login_or_email') ?>
		<?php echo CHtml::error($form,'login_or_email'); ?>
		<p class="hint"><?php echo Yum::t(Yii::t('shop','Password recovery')).'</p>'; ?>
	
 
		<?php echo CHtml::submitButton(Yii::t('shop','Restore'), array('class'=>'button_blue middle_btn')); ?>
	


<?php echo CHtml::endForm(); ?>

<?php } ?>
</div>