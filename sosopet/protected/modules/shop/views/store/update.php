<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">
	<div class="container">
		<?php 
			$this->widget('application.components.widgets.BreadcrumbsWidget',array(
								'items'=>array(
												array('description'=>Yii::t('shop','Home'), 'href'=>Yii::app()->createUrl('/site/index'),),
												array('description'=>Yii::t('shop','My Pet\'s Home')),
											)
							)
						);
			$this->renderPartial('shop.views.layouts._left_menu');
			//$this->renderPartial('profile.views.profile._left_menu');
		?>	
		<main class="col-md-9 col-sm-8">
		<?php 
			$this->renderPartial('_form', array('model'=>$model));
		?>
		</main><!--/ [col]-->
	</div><!--/ .container-->
</div><!--/ .page_wrapper-->			
<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->