<section class="content-wrapper">
	<div class="content-container container">
		<?php 
			//$user=YumUser::model()->find('id=?',array(Yii::app()->user->id));
			$this->widget('application.components.widgets.ProfileBreadcrumbsWidget',array(
					'items'=>array(
						'My Account'=>Yii::app()->createUrl('/profile/profile/update/'),
						'Favorite'=>'',
						//$user->username=>Yii::app()->request->baseUrl.'/profile/profile/update/'.Yii::app()->user->id,
					),
				)
			);
			$this->renderPartial('profile.views.profile._left_menu');
			//$this->renderPartial('/profile/_form', array('profile' => $profile, 'user'=>$user, 'changePassword'=>$changePassword)); 
			//$this->renderPartial('_form', array('model'=>$model));
		?>	
		<div class="col-main">

		<?php 
			$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'wishlist-grid',
			//'dataProvider'=>$products->search(),
			'dataProvider'=>$model->search(),
			'columns'=>array(
				array(            // display 'author.username' using an expression
					'name'=>'id',
					'type'=>'raw',
					'value'=>array($this, '_admin_grid'),
				),
				array(
					'class'=>'CButtonColumn',
					'template' => '{view} {delete}',
					'viewButtonUrl' => 'Yii::app()->createUrl("/shop/store/view",array("id" => $data->id))',
				),
			),
		)); ?>
		</div>
		
		
	</div>
</section>
<!-- form -->


