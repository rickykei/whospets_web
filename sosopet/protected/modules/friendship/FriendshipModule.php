<?php
Yii::setPathOfAlias('friendship' , dirname(__FILE__));

class FriendshipModule extends CWebModule {
	public $friendshipTable = '{{friendship}}';

	public $controllerMap=array(
			'friendship'=>array(
				'class'=>'friendship.controllers.YumFriendshipController'),
			);

}
