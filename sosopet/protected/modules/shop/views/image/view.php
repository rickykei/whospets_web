<?php 
$folder = Shop::module()->productThumbImagesFolder;

if($model->filename) 
	$path = Yii::app()->baseUrl. '/' . $folder . '/' . $model->filename;
	else
	$path = Shop::register('no-pic.jpg');

echo CHtml::image($path,
		$model->title,
		array(
			'title' => $model->title,
			'style' => 'margin: 10px;',
			'width' => isset($thumb) && $thumb
			? Shop::module()->imageWidthThumb 
			: Shop::module()->imageWidth)
		); 
//if(Shop::module()->useWithYum && Yii::app()->user->isAdmin() || Yii::app()->user->id == 'admin') 
	echo CHtml::link(Shop::t('Delete Image'),
			array('/shop/image/delete', 'id' => $model->id)); 
	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	if($model->is_default!=='Y')
		echo CHtml::link(Shop::t('Default Image'),
			array('/shop/image/setDefault', 'id' => $model->id)); 
?>
