<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">
	<div class="container">
		<?php
			$this->widget('application.components.widgets.BreadcrumbsWidget',array(
								'items'=>array(
												array('description'=>'Home', 'href'=>Yii::app()->createUrl('/site/index'),),
												array('description'=>'My Orders'),
											)
							)
						);
			$this->renderPartial('profile.views.profile._left_menu');
			$this->renderPartial('_list', array('model'=>$model));	
		?>
	</div><!--/ .container-->
</div><!--/ .page_wrapper-->			
<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->