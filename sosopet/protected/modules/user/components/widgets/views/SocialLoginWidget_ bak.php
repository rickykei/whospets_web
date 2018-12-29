<div>
<?php 
foreach(Yum::module()->hybridAuthProviders as $provider) 
  echo CHtml::link(
			CHtml::image(
				Yii::app()->getAssetManager()->publish(
					Yii::getPathOfAlias('user.assets.images').'/'.strtolower($provider).'.png'
				),
				$provider
			) . $provider,
			array('//user/auth/login', 'hybridauth' => $provider), array('class' => 'social')
		) . '<br />'; 
?>
</div>
