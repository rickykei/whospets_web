<div class="secondary_page_wrapper">
<div class="container">
<?php 
	$this->widget('application.components.widgets.BreadcrumbsWidget',array(
								'items'=>array(
												array('description'=>'Home', 'href'=>Yii::app()->createUrl('/site/index'),),
												array('description'=>'Order Review'),
											)
							)
						);
	Shop::renderFlash();
	$form=$this->beginWidget('CActiveForm', array(
			'id'=>'customer-form',
			'action' => Yii::app()->createUrl('//shop/order/confirm'),
			'enableAjaxValidation'=>false,
		)); 

	if(Shop::getCartContent() == array())
		return false;

	$this->renderPartial('application.modules.shop.views.shoppingCart._cart_view', array(
					'customer' => $customer,
					'hideAddress' => true,
					'hideEmail' => true,
					'skipAddress' => $skipAddress));

	$this->endWidget();
?>
</div>
</div>