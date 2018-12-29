<?php
/* @var $this ChatMessageController */
/* @var $model ChatMessage */

$this->breadcrumbs=array(
	'Chat Messages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ChatMessage', 'url'=>array('index')),
	array('label'=>'Create ChatMessage', 'url'=>array('create')),
	array('label'=>'View ChatMessage', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ChatMessage', 'url'=>array('admin')),
);
?>

<h1>Update ChatMessage <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>