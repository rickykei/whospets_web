<section class="content-wrapper">
	<div class="content-container container">
		<?php 
			$this->widget('application.components.widgets.ProfileBreadcrumbsWidget',array(
					'items'=>array(
						'My Account'=>Yii::app()->createUrl('/profile/profile/update/'),
						'Feedbacks'=>'',
					),
				)
			);
			$this->renderPartial('profile.views.profile._left_menu');
			$this->renderPartial('_form', array('model'=>$model));			
		?>
	</div>
</section>