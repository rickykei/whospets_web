<?php
	$deliveryAddress=$model->deliveryAddress;
	$billingAddress=$model->billingAddress;
?>
<div class="col-2-layout">
	<div class="block address-block">
	<div class="block-title">Shipping address</div>
	<ul>
	<li><?php echo $deliveryAddress->firstname.' '.$deliveryAddress->lastname; ?></li>
	<li><?php echo $deliveryAddress->street; ?></li>
	<li><?php echo $deliveryAddress->city; ?></li>
	<li><?php echo Shop::module()->validCountries[$deliveryAddress->country]; ?></li>
	<li><?php echo Shop::module()->validStates[$deliveryAddress->state]; ?></li>
	<li><?php echo $deliveryAddress->zipcode; ?></li>
	<li><?php echo $deliveryAddress->phone; ?></li>
	</ul>
	</div>
	<div class="block address-block">
	<div class="block-title">Billing address</div>
	<ul>
	<li><?php echo $billingAddress->firstname.' '.$billingAddress->lastname; ?></li>
	<li><?php echo $billingAddress->street; ?></li>
	<li><?php echo $billingAddress->city; ?></li>
	<li><?php echo Shop::module()->validCountries[$billingAddress->country]; ?></li>
	<li><?php echo Shop::module()->validStates[$billingAddress->state]; ?></li>
	<li><?php echo $billingAddress->zipcode; ?></li>
	<li><?php echo $billingAddress->phone; ?></li>
	</ul>
	</div>
</div>	
