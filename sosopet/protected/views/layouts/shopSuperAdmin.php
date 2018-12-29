<?php $this->beginContent('//layouts/_common'); ?>

	<div id="mainmenu">
		<?php
		$items = array();
		$items[] = array('label'=>Shop::t('Home'), 'url'=>array('/site/index'));
		$items[] = array('label'=>Shop::t('All'), 'url'=>array('/shop/products/index'));
		foreach(Category::model()->findAll() as $category)
		$items[] = array(
			'label' => $category->title,
			'url' => array(
				'//shop/category/view', 'id' => $category->category_id));
		$items[] = array('label'=>Shop::t('Admin'), 'url'=>array('/shop/shop/admin'));
		$items[] = array('label'=>Shop::t('About'), 'url'=>array('/site/page', 'view'=>'about'));
		$items[] = array('label'=>Shop::t('Login'), 'url'=>array('/user/auth'), 'visible'=>Yii::app()->user->isGuest);
		$items[] = array('label'=>Shop::t('Logout').' ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest);
		$this->widget('zii.widgets.CMenu',array(
			'items'=>$items,
		)); ?>
	</div><!-- mainmenu -->

	<div class="span-19">
		<div id="content">
   		<?php echo $content; ?>
	        </div><!-- content -->
	</div><!-- span-19 -->

	<div class="span-5 last">
		<div id="sidebar">
		<?php
		$this->widget('ShoppingCartWidget'); 
		$this->widget('ProductCategoriesWidget'); 
		if(!Yii::app()->user->isGuest) 
			$this->widget('AdminWidget');
		?>	
		</div><!-- sidebar -->
	</div><!-- span-5 -->

<?php $this->endContent(); ?>
