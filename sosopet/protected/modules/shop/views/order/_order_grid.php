<div class="grid_wrapper">
	<div class="leftcolumn">
		<p>
		<?php
			echo '<strong>Order: #'.$order->order_id.'</strong>';
			echo '<br><br>';
			echo '<strong>Shipping Address:</strong><br>';
			$shippingAddr=$order->deliveryAddress;
			if($shippingAddr){
				echo $shippingAddr->firstname.' '.$shippingAddr->lastname.'<br>';
				echo $shippingAddr->street.'<br>';
				echo $shippingAddr->city.'<br>';
				echo $shippingAddr->country.'<br>';
			}
			echo '<br>';
			echo '<strong>Status: </strong>'.$order->status;
		?>
		</p>
	</div>
	<div class="content">
		<p>
		<?php
			$positions=$order->positions;
			if($positions){
				foreach ($positions as $position){
					if($position->product_id=='0'){
						echo 'Shipping<br>';
						//echo $position->amount.'<br>';
						echo '$ '.$position->unit_price.'<br>'; 
						echo '<br>';
					}else{
						echo '<div style="display:table-row;"><div width="120px" style="display:table-cell;">';
						$folder = Shop::module()->productThumbImagesFolder;
						$images = $position->product->images;
						if($images){
							$image=$position->product->getDefaultImage();
							if(!$image)
								$image=current($images);
							$path = Yii::app()->baseUrl. '/' . $folder . '/' . $image->filename;
							echo CHtml::image($path,
							$image->title,
							array(
								'title' => $image->title,
								'style' => 'margin: 10px;',
								'width' => 100));
						}
						echo '</div>';
						echo '<div style="display:table-cell; float:left">';
						echo $position->product->title.'<br>';
						echo 'Qty: '.$position->amount.'<br>';
						echo '$ '.$position->unit_price.' @<br>'; 
						echo '<br>';
						echo '</div></div>';
					}
				}
			}
		?>
		</p>
   </div>
	<div class="rightcolumn">
		<p>
		<?php
			echo '<strong>'.date(Shop::module()->dateFormat, $order->ordering_date).'</strong>';
			echo '<br><br><br><br><br><br>';
			echo '<strong>Total: $'.$order->getTotalPrice().'</strong>';
			echo '<br><br>';
			if($order->customer->user_id==Yii::app()->user->id)
			//if($order->store->user->id==Yii::app()->user->id)
				echo CHtml::link('Feedback',array('/shop/feedback/update','order_id'=>$order->order_id));
		?>
		</p>
	</div>
</div>