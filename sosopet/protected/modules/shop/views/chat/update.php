<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">
	<div class="container">
		<?php
			$this->widget('application.components.widgets.BreadcrumbsWidget',array(
								'items'=>array(
												array('description'=>Yii::t('shop','Home'), 'href'=>Yii::app()->createUrl('/site/index'),),
												array('description'=>Yii::t('shop','Sent Mail'), 'href'=>Yii::app()->createUrl('/shop/chat/sent'),),
												array('description'=>$model->title),
											)
							)
						);
			$this->renderPartial('profile.views.profile._left_menu');
		?>
		<main class="col-md-9 col-sm-8">
		<?php
			$this->renderPartial('_update', array('model'=>$model,'chatMessages'=>$chatMessages,'messageForm'=>$messageForm,'upload'=>$upload));
		?>
		</main><!--/ [col]-->
	</div><!--/ .container-->
</div><!--/ .page_wrapper-->			
<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->