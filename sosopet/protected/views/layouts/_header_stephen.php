<header id="header" class="type_4">
	<!-- - - - - - - - - - - - - - Bottom part - - - - - - - - - - - - - - - - -->
	<div class="bottom_part">
		<div class="container">
			<div class="row">
				<div class="main_header_row">
					<div class="col-sm-3">
						<!-- - - - - - - - - - - - - - Logo - - - - - - - - - - - - - - - - -->
						<a href="<?php echo Yii::app()->createUrl('/site/index');?>" class="logo">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="">
						</a>
						<!-- - - - - - - - - - - - - - End of logo - - - - - - - - - - - - - - - - -->
					</div><!--/ [col]-->
					<div class="col-lg-3 col-md-4 col-sm-5">
						<!-- - - - - - - - - - - - - - Call to action - - - - - - - - - - - - - - - - -->
						<div class="call_us">
						</div><!--/ .call_us-->
						<!-- - - - - - - - - - - - - - End call to action - - - - - - - - - - - - - - - - -->
					</div><!--/ [col]-->
					<div class="col-lg-6 col-sm-5 special_handle_stephen">
						<div class="clearfix">
							<!-- - - - - - - - - - - - - - Language change - - - - - - - - - - - - - - - - -->
							<div class="alignright site_settings">
							</div><!--/ .alignright.site_settings-->
							<!-- - - - - - - - - - - - - - End of language change - - - - - - - - - - - - - - - - -->
							<!-- - - - - - - - - - - - - - Currency change - - - - - - - - - - - - - - - - -->
							<div class="alignright site_settings currency">
							</div><!--/ .alignright.site_settings.currency-->
							<!-- - - - - - - - - - - - - - End of currency change - - - - - - - - - - - - - - - - -->
						</div><!--/ .clearfix-->
						<!-- - - - - - - - - - - - - - Navigation of shop - - - - - - - - - - - - - - - - -->
						<nav class="align_right">
							<ul class="topbar">
								<li><a href="<?php echo Yii::app()->createUrl('/shop/products/index');?>"><?php echo Yii::t('shop','Home');?></a></li>
								<li><a href="<?php echo Yii::app()->createUrl('/profile/profile/update');?>"><?php echo Yii::t('shop','My Account');?></a></li>
								<li><a href="<?php echo Yii::app()->createUrl('/shop/products/create');?>"><?php echo Yii::t('shop','My Pet\'s Home');?></a></li>
								<li><a href="<?php echo Yii::app()->createUrl('/site/howitworks');?>"><?php echo Yii::t('shop','How it works');?></a></li>
								<li><a href="<?php echo Yii::app()->createUrl('/site/aboutus');?>"><?php echo Yii::t('shop','About us');?></a></li>
								<li><a href="<?php echo Yii::app()->createUrl('/site/faq');?>"><?php echo Yii::t('shop','FAQ');?></a></li>
								<li><a href="<?php echo Yii::app()->createUrl('/site/testimonial');?>"><?php echo Yii::t('shop','Testimonial');?></a></li>
								<li><?php echo CHtml:: link ( '中文' , '/zh' ) ;?></li>
								<li><?php echo CHtml:: link ( 'Eng' , '/en' );?> </li>
								<?php
									if (Yii::app()->user->isAdmin()){
										//echo '<li><a href="'.Yii::app()->createUrl('/site/index').'">Admin</a></li>';
										echo '<li class="has_submenu">';
										echo '<a href="'.Yii::app()->createUrl('/site/index').'">Admin</a>';
										//level 2
										echo '<ul class="theme_menu submenu">';
										
										echo '<li class="has_submenu">';
										//echo '<a href="'.Yii::app()->createUrl('/shop/store/update').'">Products</a>';
										echo '<a href="'.Yii::app()->createUrl('/shop/products/active').'">Products</a>';
										echo '<ul class="theme_menu submenu">';
										echo '<li><a href="'.Yii::app()->createUrl('/shop/products/active').'">Active</a></li>';
										echo '<li><a href="'.Yii::app()->createUrl('/shop/products/inactive').'">Inactive</a></li>';
										echo '<li><a href="'.Yii::app()->createUrl('/shop/products/create').'">Add Product</a></li>';
										echo '<li><a href="'.Yii::app()->createUrl('/shop/products/updateDiscount').'">Update Discount</a></li>';
										echo '</ul>';
										echo '</li>';
										
										echo '<li>';
										echo '<a href="'.Yii::app()->createUrl('/shop/order/admin').'">Orders</a>';
										echo '</li>';
										
										echo '</ul>';
										echo '</li>';
									}
								?>
							</ul>
						</nav>
						<!-- - - - - - - - - - - - - - End navigation of shop - - - - - - - - - - - - - - - - -->
					</div><!--/ [col]-->
				</div><!--/ .main_header_row-->
			</div><!--/ .row-->
		</div><!--/ .container-->
	</div><!--/ .bottom_part -->
	<!-- - - - - - - - - - - - - - End of bottom part - - - - - - - - - - - - - - - - -->
	<!-- - - - - - - - - - - - - - Main navigation wrapper - - - - - - - - - - - - - - - - -->
	<div id="main_navigation_wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="sticky_inner special_handle_stephen">
					    
						<?php
							$items = array();
							$items[] = array('description'=>Yii::t('shop','All Pets'), 'href'=>Yii::app()->createUrl('/shop/category/view'));
							foreach(Category::model()->findAllByAttributes(array('parent_id'=>0)) as $category){
								$subitems = array();
								foreach(Category::model()->findAllByAttributes(array('parent_id'=>$category->category_id)) as $subcat){
									if (Yii::app()->language=='zh'){
										$subitems[] = array(
										'description' => $subcat->title_zh,
										'href' => Yii::app()->createUrl('/shop/category/view', array('id' => $subcat->category_id))
										);
									}else{
									$subitems[] = array(
										'description' => $subcat->title,
										'href' => Yii::app()->createUrl('/shop/category/view', array('id' => $subcat->category_id))
										);
									}
								}
								if($subitems){
										if (Yii::app()->language=='zh'){
												$items[] = array(
												'description' => $category->title_zh,
												'href' => Yii::app()->createUrl('/shop/category/view', array('id' => $category->category_id)),
												'items' => $subitems,
												);
										}else{
											$items[] = array(
												'description' => $category->title,
												'href' => Yii::app()->createUrl('/shop/category/view', array('id' => $category->category_id)),
												'items' => $subitems,
												);
										}
								}else{
									$items[] = array(
										'description' => $category->title,
										'href' => Yii::app()->createUrl('/shop/category/view', array('id' => $category->category_id)),
										);
								}
							}
							$this->widget('application.components.widgets.NavigationMenuWidget_stephen',array('items'=>$items));
							/*
							$this->widget('application.components.widgets.NavigationMenuWidget',array(
									'items'=>array(
													array('description'=>'Test1','href'=>'#',
														'items'=>array(array('description'=>'Test1','href'=>'#',),
																	array('description'=>'Test1','href'=>'#',),
															)
													),
													array('description'=>'Test2','href'=>'#',
														'items'=>array(array('description'=>'Test2','href'=>'#',),
																	array('description'=>'Test2','href'=>'#',),
															)
													),
													array('description'=>'Test3','href'=>'#',
														'items'=>array(array('description'=>'Test3','href'=>'#',),
																	array('description'=>'Test3','href'=>'#',),
															)
													),
												),
								)
							);
							*/
						?>
						 
						<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->
						<div class="nav_item inner_offset special_handle_stephen">
							<!-- - - - - - - - - - - - - - Search form - - - - - - - - - - - - - - - - -->
							<form class="clearfix search" action="<?php echo Yii::app()->createUrl('/shop/products/list');?>" method="get">
								<input type="text" name="keywords" id="keywords" tabindex="1" placeholder="<?php echo Yii::t('shop','Search...');?>" class="alignleft">
                                
                            
								<!-- - - - - - - - - - - - - - Categories - - - - - - - - - - - - - - - - -->
								<!--
								<div class="search_category alignleft">
									<div class="open_categories">All Categories</div>
									<ul class="categories_list dropdown">
										<li class="animated_item"><a href="#">Medicine &amp; Health</a></li>
										<li class="animated_item"><a href="#">Beauty</a></li>
										<li class="animated_item"><a href="#">Personal Care</a></li>
										<li class="animated_item"><a href="#">Vitamins &amp; Supplements</a></li>
										<li class="animated_item"><a href="#">Baby Needs</a></li>
										<li class="animated_item"><a href="#">Diet &amp; Fitness</a></li>
										<li class="animated_item"><a href="#">Sexual Well-being</a></li>
									</ul>
								</div>--><!--/ .search_category.alignleft-->
								<!-- - - - - - - - - - - - - - End of categories - - - - - - - - - - - - - - - - -->
								<button type="submit" class="button_blue def_icon_btn alignleft"></button>
							</form><!--/ #search-->
							<!-- - - - - - - - - - - - - - End search form - - - - - - - - - - - - - - - - -->
						</div><!--/ .nav_item-->
						<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->
						<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->
						<!--<div class="nav_item size_1">
							<a href="#" class="wishlist_button" data-amount="7"></a>
							<a href="<?php echo Yii::app()->createUrl('shop/wishlist/admin'); ?>" class="wishlist_button"></a>
						</div>--><!--/ .nav_item-->
						<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->
						<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->
						<!--<div class="nav_item size_1">
							<a href="#" class="compare_button" data-amount="3"></a>
						</div>--><!--/ .nav_item-->
						<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->
						<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->
						<div class="nav_item size_2 special_handle_stephen">		
							<?php
								if (Yii::app()->user->isGuest){
									echo '<div class="login_box"><div class="login_box_inner">'.Yii::t('shop','Welcome visitor').'<a href="'.Yii::app()->createUrl('/user/auth');
									echo '">'.Yii::t('shop','Login').'</a> '.Yii::t('shop','or').' <a href="'.Yii::app()->createUrl('registration/registration/registration').'">'.Yii::t('shop','Register').'</a></div></div>';
								}else{
									echo '<div class="login_box"><div class="login_box_inner">'.Yii::t('shop','Welcome visitor').' '.Yii::app()->user->name.' <a href="'.Yii::app()->createUrl('/site/logout').'">'.Yii::t('shop','Logout').'</a></div></div>';
								}
							?>		
						</div><!--/ .nav_item-->
                        <div class="nav_item size_2 special_handle_stephen">	
<a href="http://whospets.com/en/site/contact" class="button_blue huge_btn "><?php echo Yii::t('shop','Join us');?></a></div>
						<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->
						<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->
						<!--<div class="nav_item size_2">
							<button id="open_shopping_cart" class="open_button" data-amount="3">
								<b class="title">My Cart</b>
								<b class="total_price">$999.00</b>
							</button>
							<button id="open_shopping_cart" class="open_button" onclick="location.href='<?php echo Yii::app()->createUrl('shop/shoppingCart/view'); ?>'">
								<b class="title">My Cart</b>
								<b class="total_price"></b>
							</button>
						</div>--><!--/ .nav_item-->
						<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->
					</div><!--/ .main_navigation-->
				</div><!--/ [col]-->
			</div><!--/ .row-->
		</div><!--/ .container-->
	</div><!--/ .main_navigation_wrap-->
	<!-- - - - - - - - - - - - - - End of main navigation wrapper - - - - - - - - - - - - - - - - -->
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-77904747-1', 'auto');
  ga('send', 'pageview');

</script>
</header>
