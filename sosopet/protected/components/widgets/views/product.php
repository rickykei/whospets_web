<?php		
	$href='#';
	echo Yii::app()->sourceLanguage;
	echo Yii::app()->language;
?>
<section class="section_offset">
	<div class="clearfix">
		<!-- - - - - - - - - - - - - - Product image column - - - - - - - - - - - - - - - - -->
		<div class="single_product">
			<!-- - - - - - - - - - - - - - Image preview container - - - - - - - - - - - - - - - - -->
			<div class="image_preview_container">
				<img id="img_zoom" data-zoom-image="<?php echo (isset($item['defaultImage'])?$item['defaultImage']:$href); ?>" src="<?php echo (isset($item['defaultImage'])?$item['defaultImage']:$href); ?>" alt="">
				<button class="button_grey_2 icon_btn middle_btn open_qv"><i class="icon-resize-full-6"></i></button>
			</div><!--/ .image_preview_container-->
			<!-- - - - - - - - - - - - - - End of image preview container - - - - - - - - - - - - - - - - -->
			<!-- - - - - - - - - - - - - - Prodcut thumbs carousel - - - - - - - - - - - - - - - - -->	
			<?php
				if (isset($item['images'])) {
					echo '<div class="product_preview">';
					echo '<div class="owl_carousel" id="thumbnails">';
					foreach($item['images'] as $imageItem) {
						echo '<a href="#" data-image="'.(isset($imageItem['image'])?$imageItem['image']:$href).'" data-zoom-image="'.(isset($imageItem['image'])?$imageItem['image']:$href).'">';
						echo '<img src="'.(isset($imageItem['thumbImage'])?$imageItem['thumbImage']:$href).'" data-large-image="'.(isset($imageItem['image'])?$imageItem['image']:$href).'" alt="">';
						echo '</a>';
					}
					echo '</div><!--/ .owl-carousel-->';
					echo '</div><!--/ .product_preview-->';
				}
			?>
			<!-- - - - - - - - - - - - - - End of prodcut thumbs carousel - - - - - - - - - - - - - - - - -->
			<!-- - - - - - - - - - - - - - Share - - - - - - - - - - - - - - - - -->
			<div class="v_centered">
				<span class="title">Share this:</span>
				<div class="addthis_widget_container">
					<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
					<a class="addthis_button_preferred_1"></a>
					<a class="addthis_button_preferred_2"></a>
					<!--<a class="addthis_button_preferred_3"></a>-->
					<!--<a class="addthis_button_preferred_4"></a>-->
					<!--<a class="addthis_button_compact"></a>-->
					<a class="addthis_counter addthis_bubble_style"></a>
					</div>
					<!-- AddThis Button END -->
				</div>
			</div>
			<!-- - - - - - - - - - - - - - End of share - - - - - - - - - - - - - - - - -->
		</div>
		<!-- - - - - - - - - - - - - - End of product image column - - - - - - - - - - - - - - - - -->
		<!-- - - - - - - - - - - - - - Product description column - - - - - - - - - - - - - - - - -->
		<div class="single_product_description">
			<h3 class="offset_title"><a href="#"><?php echo (isset($item['title'])?$item['title']:''); ?></a></h3>
			<!-- - - - - - - - - - - - - - Page navigation - - - - - - - - - - - - - - - - -->
			<!--<div class="page-nav">
				<a href="#" class="page-prev"></a>
				<a href="#" class="page-next"></a>
			</div>-->
			<!-- - - - - - - - - - - - - - End of page navigation - - - - - - - - - - - - - - - - -->
			<div class="description_section v_centered">
				<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->
				<!--<ul class="rating">
					<li class="active"></li>
					<li class="active"></li>
					<li class="active"></li>
					<li></li>
					<li></li>
				</ul>-->
				<!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->
				<!-- - - - - - - - - - - - - - Reviews menu - - - - - - - - - - - - - - - - -->
				<!--<ul class="topbar">
					<li><a href="#">3 Review(s)</a></li>
					<li><a href="#">Message to Owner</a></li>
				</ul>-->
				<!-- - - - - - - - - - - - - - End of reviews menu - - - - - - - - - - - - - - - - -->
			</div>
			<div class="description_section">
				<table class="product_info">
					<tbody>
						<?php
							if (isset($item['dateLost'])) {
								echo '<tr>';
								echo '<td>'.Yii::t('shop','Date Lost').': </td>';
								echo '<td>'.$item['dateLost'].'</td>';
								echo '</tr>';
							}
						?>
						<?php
							if (isset($item['dateBorn'])) {
								echo '<tr>';
								echo '<td>'.Yii::t('shop','Date Born').': </td>';
								echo '<td>'.$item['dateBorn'].'</td>';
								echo '</tr>';
								
								# object oriented
								$from = new DateTime($item['dateBorn']);
								$to   = new DateTime('today');
								
								echo '<tr>';
								echo '<td>'.Yii::t('shop','Age').': </td>';
								echo '<td>'.$from->diff($to)->y.'</td>';
								//echo '<td>'.floor(($to - $from) / 86400).'</td>';
								echo '</tr>';
							}
						?>
						<?php
							if (isset($item['brand'])&& isset($item['subCatID'])) {
								echo '<tr>';
								echo '<td>'.Yii::t('shop','Pet Breed').': </td>';
								echo '<td>'.$item['brand'].' > <a href="http://www.whospets.com/en/shop/category/'.$item['subCatID'].'">'.$item['subCatTitle'].'</td>';
								echo '</tr>';
							}
						?>
						<?php
						//	if (isset($item['subCat'])) {
						//		echo '<tr>';
						//		echo '<td>Sub-Category: </td>';
						//	echo '<td>'.$item['subCat'].'</td>';
						//		echo '</tr>';
							//}
						?>
						<?php
							if (isset($item['Title'])) {
								echo '<tr>';
								echo '<td>WHOSPETS Name : </td>';
								echo '<td>'.$item['title'].'</td>';
								echo '</tr>';
							}
						?>
						<?php
							if (isset($item['petId'])) {
								echo '<tr>';
								echo '<td>'.Yii::t('shop','Pet Id').': </td>';
								echo '<td>'.$item['petId'].'</td>';
								echo '</tr>';
							}
						?>
						<?php
							if (isset($item['gender'])) {
								echo '<tr>';
								echo '<td>'.Yii::t('shop','Gender').': </td>';
								echo '<td>'.$item['gender'].'</td>';
								echo '</tr>';
							}
						?>
						<?php
							if (isset($item['color'])) {
								echo '<tr>';
								echo '<td>'.Yii::t('shop','Pet Color').': </td>';
								echo '<td>'.$item['color'].'</td>';
								echo '</tr>';
							}
						?>
						<?php
							if (isset($item['size'])) {
								echo '<tr>';
								echo '<td>'.Yii::t('shop','Size').': </td>';
								echo '<td>'.$item['size'].'</td>';
								echo '</tr>';
							}
						?>
						<?php
							if (isset($item['weight'])) {
								echo '<tr>';
								echo '<td>'.Yii::t('shop','Weight').': </td>';
								echo '<td>'.$item['weight'].'</td>';
								echo '</tr>';
							}
						?>
						<?php
							if (isset($item['height'])) {
								echo '<tr>';
								echo '<td>'.Yii::t('shop','Height').': </td>';
								echo '<td>'.$item['height'].'</td>';
								echo '</tr>';
							}
						?>
						<?php
							if (isset($item['nameOfPet'])) {
								echo '<tr>';
								echo '<td>'.Yii::t('shop',"Pet Name").':</td>';
								echo '<td>'.$item['nameOfPet'].'</td>';
								echo '</tr>';
							}
						?>
						<?php
							 
							if (isset($item['country'])) {
								echo '<tr>';
								echo '<td>'.Yii::t('shop','Country').': </td>';
								echo '<td>'.$item['country'].' > '.$item['subCountryTitle'].'</td>';
								echo '</tr>';
							}
						?>
						<?php/*
							if (isset($item['country'])) {
								echo '<tr>';
								echo '<td>'.Yii::t('shop','Country').': </td>';
								echo '<td>'.$item['country'].'</td>';
								echo '</tr>';
							}*/
						?>
						<?php
							if (isset($item['contact'])) {
								echo '<tr>';
								echo '<td>'.Yii::t('shop','Owner Contact Number').': </td>';
								echo '<td>'.$item['contact'].'</td>';
								echo '</tr>';
							}
						?>
						<?php
							if (isset($item['price'])) {
								echo '<tr>';
								echo '<td>'.Yii::t('shop','Reward').': </td>';
								echo '<td>'.$item['price'].'</td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
			</div>
			<hr>
			<div class="description_section">
				<p><?php echo (isset($item['description'])?$item['description']:''); ?></p>
			</div>
			<hr>
			<?php
				if (isset($item['discountPrice'])){
					echo '<p class="product_price"><s>'.(isset($item['price'])?'$'.$item['price']:'').'</s> <b class="theme_color">'.(isset($item['discountPrice'])?'$'.$item['discountPrice']:'').'</b></p>';
				}else{
					echo '<p class="product_price"><b class="theme_color">'.Yii::t('shop','Pet Status').':'.$item['petStatus'].'</b></p>';
				}
			?>
			<div class="offer"></div>
			<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->
			<div class="buttons_row">
				<!--<button class="button_blue middle_btn">Add to Cart</button>-->
				<!--<input class="button_blue middle_btn" type="submit" value="Add to Cart"></input>-->
				<!--<button class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container" onclick="javascript:location.href='<?php echo (isset($item['messageLink'])?$item['messageLink']:$href); ?>'"><span class="tooltip right">Message to Owner</span></button>-->
				<button class="button_blue middle_btn middle_btn email tooltip_container" onclick="javascript:resetMessageDialog();location.href='<?php echo (isset($item['mailLink'])?$item['mailLink']:$href); ?>'"><span class="tooltip right"><?php echo Yii::t('shop','Message to Owner');?></span><?php echo Yii::t('shop','Contact my owner!');?></button>
				<!--<button class="button_dark_grey def_icon_btn middle_btn add_to_compare tooltip_container"><span class="tooltip top">Add to Compare</span></button>-->
			</div>
			<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->
		</div>
		<!-- - - - - - - - - - - - - - End of product description column - - - - - - - - - - - - - - - - -->
	</div>
</section><!--/ .section_offset -->
<?php
 
if ($item['pet_status']==1 and Yii::app()->language=='zh') {
	Yii::app()->clientScript->registerScript('countdown', "
	$('.offer').countdown({
			since: new Date(parseInt('".$item['dateLost']."'.substring(0,4)),parseInt('".$item['dateLost']."'.substring(5,7))-1,parseInt('".$item['dateLost']."'.substring(8,10))),
			layout: '{desc}<i>{dn}</i> {dl} <i>{hn}</i> {hl} <i>{mn}</i> {ml} <i>{sn}</i> {sl}',
			description: '<span>".Yii::t('shop','Time lost').":</span>&nbsp;'
			},$.countdown.regionalOptions['zh-TW']);
	");
}else if ($item['pet_status']==1){
	Yii::app()->clientScript->registerScript('countdown', "
	$.countdown.setDefaults($.countdown.regionalOptions['']);
	$('.offer').countdown({
			since: new Date(parseInt('".$item['dateLost']."'.substring(0,4)),parseInt('".$item['dateLost']."'.substring(5,7))-1,parseInt('".$item['dateLost']."'.substring(8,10))),
			layout: '{desc}<i>{dn}</i> {dl} <i>{hn}</i> {hl} <i>{mn}</i> {ml} <i>{sn}</i> {sl}',
			description: '<span>".Yii::t('shop','Time lost').":</span>&nbsp;'
			});
	");
}
//$(selector).countdown({since: new Date(2014, 12-1, 25)});
?>
