<?php
$this->breadcrumbs=array(
		Shop::t('Categories')=>array('index'),
		Shop::t('Create'),
		);

?>
<div id="shopcontent">

<h1> <?php echo Shop::t('Create Category'); ?> </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
