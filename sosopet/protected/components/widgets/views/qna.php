<?php		
	$href='#';
	//echo Yii::app()->sourceLanguage;
	//echo Yii::app()->language;
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
		 
			<div class="description_section v_centered">
				 
			</div>
			<div class="description_section">
				<table class="product_info">
					<tbody>
						<?php
							if (isset($item['Title'])) {
								echo '<tr>';
								echo '<td>WHOSPETS Name : </td>';
								echo '<td>'.$item['title'].'</td>';
								echo '</tr>';
							}
						?>
						 <?php
							if (isset($item['Email'])) {
								echo '<tr>';
								echo '<td>Email : </td>';
								echo '<td>'.$item['email'].'</td>';
								echo '</tr>';
							}
						?>
						  <?php
							if (isset($item['Description'])) {
								echo '<tr>';
								echo '<td>Description : </td>';
								echo '<td>'.$item['description'].'</td>';
								echo '</tr>';
							}
						?>
						 
						 
					 
					 
					</tbody>
				</table>
			</div>
			<hr>
			 
			 
			 
			<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->
		 
			<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->
		</div>
		<!-- - - - - - - - - - - - - - End of product description column - - - - - - - - - - - - - - - - -->
	</div>
</section><!--/ .section_offset -->
 
