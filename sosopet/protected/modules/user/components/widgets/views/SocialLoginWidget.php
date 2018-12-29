<div class="sns-account-login">
<div class="col-1">
<div class="content">
			<h2>EXPRESS LOGIN / SIGN UP</h2>
			 <div>
			 <?php 
				foreach(Yum::module()->hybridAuthProviders as $provider) {
					echo CHtml::link('Login with '.$provider, 
						array('//user/auth/login', array('hybridauth' => $provider)), array(
							'class'=>'colors-btn',
							'title'=>'Login',
						)
					);
					echo ' ';
				}
				?>
			 </div>
</div>	 
</div>
</div>