<aside class="col-md-3 col-sm-4">
	<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->
	<?php
		$this->widget('application.components.widgets.LeftMenuWidget',array(
							'title'=>Yii::t('shop','My Account'),
							'items'=>array(
											array('description'=>Yii::t('shop','Account Information'), 'href'=>Yii::app()->createUrl('/profile/profile/update'),),
											//array('description'=>'My Orders', 'href'=>Yii::app()->createUrl('/shop/order/list'),),
											//array('description'=>'My Feedbacks', 'href'=>Yii::app()->createUrl('/shop/feedback/admin'),),
											//array('description'=>'My Wishlist', 'href'=>Yii::app()->createUrl('/shop/wishlist/admin'),),
											array('description'=>Yii::t('shop','Inbox'), 'href'=>Yii::app()->createUrl('/shop/chat/inbox'),),
											array('description'=>Yii::t('shop','Sent Mail'), 'href'=>Yii::app()->createUrl('/shop/chat/sent'),),
										)
						)
					);
	?>
	<!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->
	<!-- - - - - - - - - - - - - - Banner - - - - - - - - - - - - - - - - -->
	
	<!-- - - - - - - - - - - - - - End of banner - - - - - - - - - - - - - - - - -->
</aside><!--/ [col]-->