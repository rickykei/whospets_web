<section class="content-wrapper">
	<div class="content-container container">
		<?php 
			$this->widget('application.components.widgets.ProfileBreadcrumbsWidget',array(
					'items'=>array(
						'My Account'=>Yii::app()->createUrl('/profile/profile/update/'),
						'Sent'=>'',
					),
				)
			);
			$this->renderPartial('profile.views.profile._left_menu');
			$this->renderPartial('_sent', array('model'=>$model));			
		?>
	</div>
</section>


