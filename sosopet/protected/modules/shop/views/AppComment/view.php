<?php
/* @var $this FeedbackController */
/* @var $model Feedback */

$this->breadcrumbs=array(
	'AppComments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AppComments', 'url'=>array('index')),
	array('label'=>'Create AppComments', 'url'=>array('create')),
	array('label'=>'Update AppComments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AppComments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AppComments', 'url'=>array('admin')),
);
?>

<h1>View AppComments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		 
		'content_id',
		'created_date',
		 
		'comment',
	),
)); ?>
