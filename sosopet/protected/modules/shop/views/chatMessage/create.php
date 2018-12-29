<?php
/* @var $this ChatMessageController */
/* @var $model ChatMessage */

$this->breadcrumbs=array(
	'Chat Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ChatMessage', 'url'=>array('index')),
	array('label'=>'Manage ChatMessage', 'url'=>array('admin')),
);
?>

<h1>Create ChatMessage</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>