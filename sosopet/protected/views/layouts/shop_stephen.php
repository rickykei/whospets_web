<?php $this->beginContent('//layouts/_common_stephen'); ?>

	<div class="span-19">
		<div id="content">
   		<?php echo $content; ?>
	        </div><!-- content -->
	</div><!-- span-19 -->

	<div class="span-5 last">
		<div id="sidebar">
		<?php
		//$this->widget('ShoppingCartWidget'); 
		//$this->widget('ProductCategoriesWidget'); 
		?>	
		</div><!-- sidebar -->
	</div><!-- span-5 -->
	
<?php $this->endContent(); ?>

