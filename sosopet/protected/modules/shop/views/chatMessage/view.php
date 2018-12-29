<?php
/* @var $this ChatMessageController */
/* @var $model ChatMessage */

$this->breadcrumbs=array(
	'Chat Messages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ChatMessage', 'url'=>array('index')),
	array('label'=>'Create ChatMessage', 'url'=>array('create')),
	array('label'=>'Update ChatMessage', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ChatMessage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ChatMessage', 'url'=>array('admin')),
);
?>

<h1>View ChatMessage #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'chat_id',
		'user_id',
		'message',
		'created',
		'modified',
	),
)); ?>
