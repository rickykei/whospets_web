<?php
$user=YumUser::model()->find('id=?',array(Yii::app()->user->id));
$this->widget('application.components.widgets.ProfileBreadcrumbsWidget',array(
		'items'=>array(
			'My Account'=>'',
			$user->username=>'',
		),
	)
);
?>