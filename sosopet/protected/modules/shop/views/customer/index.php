<?php
$this->breadcrumbs=array(
	Shop::t('Customers'),
);

?>
	<h1> <?php echo Shop::t('Customers'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
