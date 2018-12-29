<?php echo Shop::t('Your Shopping Cart'); ?> 

<?php 

if(!isset($carts))
	$carts = ShoppingCart::getCartsofOwner();

if(isset($carts)) 
{  
	echo '<ul>';
	foreach($carts as $cart) {
		printf('<li> <b>%s</b> %s %s <b>%s</b> | (%s)</li>', 
			$cart->amount, 
			$cart->Product->unit, 
			Shop::t('of'), 
			CHtml::link($cart->Product->title, 
				array('products/view', 'id' => $cart->Product->product_id)
			),
			CHtml::link(Shop::t('Remove from Cart'),
	  		array('shoppingCart/delete', 'id' => $cart->cart_id)
	  	)
		) ;
	}
?>
	</ul>
	<hr />

<?php	echo CHtml::link(Shop::t('Configure Cart'), array('shoppingCart/admin')); ?>
&nbsp;
<?php	echo CHtml::link(Shop::t('Buy this items'), array('order/create')); 

} else
		echo Shop::t('Your shopping Cart is empty.');

?>
