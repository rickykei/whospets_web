<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">
	<div class="container">
		<?php
			$this->widget('application.components.widgets.BreadcrumbsWidget',array(
								'items'=>array(
												array('description'=>Yii::t('shop','Home'), 'href'=>Yii::app()->createUrl('/site/index'),),
												array('description'=>Yii::t('shop','My Account')),
											)
							)
						);
			include('_left_menu.php');
			$this->renderPartial('/profile/_form', array('profile' => $profile, 'user'=>$user, 'changePassword'=>$changePassword)); 
		?>
	</div><!--/ .container-->
</div><!--/ .page_wrapper-->			
<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
