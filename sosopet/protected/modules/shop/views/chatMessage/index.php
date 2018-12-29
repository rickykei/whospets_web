<?php
/* @var $this ChatMessageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Chat Messages',
);

$this->menu=array(
	array('label'=>'Create ChatMessage', 'url'=>array('create')),
	array('label'=>'Manage ChatMessage', 'url'=>array('admin')),
);
?>

<h1>Chat Messages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
