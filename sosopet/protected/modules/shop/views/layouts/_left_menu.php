<aside class="col-md-3 col-sm-4">
	<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->
	<?php
		$this->widget('application.components.widgets.LeftMenuWidget',array(
							'title'=>Yii::t('shop','Administration'),
							'items'=>array(
											//array('description'=>Yii::t('shop','Pet\'s Home'), 'href'=>Yii::app()->createUrl('/shop/store/update'),),
											array('description'=>Yii::t('shop','Active Pet'), 'href'=>Yii::app()->createUrl('/shop/products/active'),),
											array('description'=>Yii::t('shop','Inactive Pet'), 'href'=>Yii::app()->createUrl('/shop/products/inactive'),),
											array('description'=>Yii::t('shop','Add Pet'), 'href'=>Yii::app()->createUrl('/shop/products/create'),),
											//array('description'=>'Update Discount', 'href'=>Yii::app()->createUrl('/shop/products/updateDiscount'),),
											//array('description'=>'Orders', 'href'=>Yii::app()->createUrl('/shop/order/admin'),),
											array('description'=>Yii::t('shop','Message'), 'href'=>Yii::app()->createUrl('/shop/feedback/storeview'),),
										)
						)
					);
	?>
	<!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->
	<!-- - - - - - - - - - - - - - Banner - - - - - - - - - - - - - - - - -->
	
	<!-- - - - - - - - - - - - - - End of banner - - - - - - - - - - - - - - - - -->
</aside><!--/ [col]-->
