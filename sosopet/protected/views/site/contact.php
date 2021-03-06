<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<?php 
						$this->widget('application.components.widgets.BreadcrumbsWidget',array(
											'items'=>array(
															array('description'=>'Home', 'href'=>Yii::app()->createUrl('/site/index'),),
															array('description'=>'Contact Us'),
														)
										)
									);
					?>

					<div class="row">

						<aside class="col-md-3 col-sm-4">

							<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

							<?php
								$this->renderPartial('//layouts/_left_menu');
							?>

							<!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Banner - - - - - - - - - - - - - - - - -->
							<!--
							<div class="section_offset">

								<a href="#" class="banner">
									
									<img src="images/banner_img_11.png" alt="">

								</a>

							</div>
							-->
							<!-- - - - - - - - - - - - - - End of banner - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Testimonials - - - - - - - - - - - - - - - - -->

							<section class="section_offset">

								<h3 class="offset_title"><?php echo Yii::t('shop','Testimonial');?></h3>

								<!-- - - - - - - - - - - - - - Carousel of testimonials - - - - - - - - - - - - - - - - -->

								<div class="owl_carousel widgets_carousel">

									<!-- - - - - - - - - - - - - - Testimonial - - - - - - - - - - - - - - - - -->

									<blockquote>

										<div class="author_info"><b>Jenny P - 香港</b></div>

										<p>非常感謝您幫助我找回那天我失去的小狗（2015年12月19日）。若不是您的網絡平台，好心人是沒可能在這麼短的時間內找回我的小狗呢。另外，我要感謝那位好心的先生！您們對動物世界無盡的激情和關愛，使我真正相信香港仍然有愛。</p>

									</blockquote>
									
									<!-- - - - - - - - - - - - - - End testimonial - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Testimonial - - - - - - - - - - - - - - - - -->

									<blockquote>

										<div class="author_info"><b>Anna Cheung, Hong Kong</b></div>

										<p>Thanks you so much for helping us to find our 豬豬. I never thought we would need the tag at all, but the tag has presented the concern on the real situation of animals in the world, and together with the lovely lady who found out cat, thank you Mrs. Tang! I am really glad that we find our baby finally!</p>

									</blockquote>

									<!-- - - - - - - - - - - - - - End testimonial - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Testimonial - - - - - - - - - - - - - - - - -->

									<blockquote>

										<div class="author_info"><b>陳生 - 九龍塘</b></div>

										<p>我要感謝寵物標籤和那位找到我們小狗的人,在公園匆忙之間丟失腸腸,有位超好心人幫我們找回腸腸並送還給我們……</p>

									</blockquote>
									
									<!-- - - - - - - - - - - - - - End testimonial - - - - - - - - - - - - - - - - -->

								</div><!--/ .widgets_carousel-->

								<!-- - - - - - - - - - - - - - End of carousel of testimonials - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - View all testimonials - - - - - - - - - - - - - - - - -->

								<footer class="bottom_box">

									<a href="#" class="button_grey middle_btn"><?php echo Yii::t('shop','View All Testimonials');?></a>

								</footer>

								<!-- - - - - - - - - - - - - - End of view all testimonials - - - - - - - - - - - - - - - - -->

							</section><!--/ .section_offset.animated.transparent-->

							<!-- - - - - - - - - - - - - - End of testimonials - - - - - - - - - - - - - - - - -->

						</aside><!--/ [col]-->

						<main class="col-md-9 col-sm-8">

							<h1 class="page_title"><?php echo Yii::t('shop','Join WHOSPETS');?></h1>

                            <div class="video_wrap">

									<iframe src="https://www.youtube.com/embed/_T0mskoj-xs" frameborder="0" allowfullscreen></iframe>

								</div><!--/ .video_wrap -->
                            <br><br>
							<section class="section_offset">
                                <h3><?php echo Yii::t('shop','Step 1 - Register with Us');?></h3>
                                	<div class="theme_box">
                                       
                                        
                                        <p><?php echo Yii::t('shop','Firstly, you will need to register an account with us.');?><a href="http://whospets.com/en/registration/registration/registration"><?php echo Yii::t('shop','Simplily click');?></a><?php echo Yii::t('shop','on the register button and you will see a form to fill in.');?></p>

											<p><?php echo Yii::t('shop','You will receive an email from us and please follow the instruction in order to complete the registeration process.');?></p>
                                        </div><!--/ .theme_box -->
                                <br><br>
                                <h3><?php echo Yii::t('shop','Step 2 - Create pet\'s profile');?></h3>
                                <div class="theme_box">
                                    
                                        
                                        <p><a href="http://whospets.com/en/shop/products/create"><?php echo Yii::t('shop','Add your pet');?></a><?php echo Yii::t('shop','onto our platform to join our community. If your pet is lost one day, chances are the finder will be able to find you on this platform.');?></p>

											<p><?php echo Yii::t('shop','None of your personal detail will be disclose to anyone therefore your personal privacy is protected at all time.');?></p>
                                        </div><!--/ .theme_box -->
								<br><br>
								<h3><?php echo Yii::t('shop','Step 3 - Fill in the form below and request for your tag');?></h3>

								<div class="theme_box">

									<!-- - - - - - - - - - - - - - Contact form - - - - - - - - - - - - - - - - -->

									<?php $form=$this->beginWidget('CActiveForm', array(
										'id'=>'contact-form',
										'enableClientValidation'=>true,
										'clientOptions'=>array(
											'validateOnSubmit'=>true,
										),
									)); ?>

									<?php
										Shop::renderFlash();
										echo $form->errorSummary($model); 
									?>

										<ul>
										
											<li class="row">
												<div class="col-sm-6">
													<?php echo $form->labelEx($model,'name'); ?>
													<?php echo $form->textField($model,'name'); ?>
													<?php //echo $form->error($model,'name'); ?>
												</div><!--/ [col]-->

												<div class="col-sm-6">
													<?php echo $form->labelEx($model,'email'); ?>
													<?php echo $form->textField($model,'email'); ?>
													<?php //echo $form->error($model,'email'); ?>
												</div><!--/ [col]-->

											</li><!--/ .row -->
              <li class="row">
                                                                                                <div class="col-sm-6">
                                                                                                        <?php echo $form->labelEx($model,'petName'); ?>
                                                                                                        <?php echo $form->textField($model,'petName'); ?>
                                                                                                        <?php //echo $form->error($model,'petName'); ?>
                                                                                                </div><!--/ [col]-->

                                                                                                <div class="col-sm-6">
                                                                                                        <?php echo $form->labelEx($model,'contactNo'); ?>
                                                                                                        <?php echo $form->textField($model,'contactNo'); ?>
                                                                                                        <?php //echo $form->error($model,'contactNo'); ?>
                                                                                                </div><!--/ [col]-->

                                                                                        </li><!--/ .row -->
											<li class="row">
												<div class="col-xs-12">
													<?php echo $form->hiddenField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
													<?php //echo $form->labelEx($model,'subject'); ?>
													<?php //echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
													<?php //echo $form->error($model,'subject'); ?>
												</div><!--/ [col]-->
											</li><!--/ .row -->

											<li class="row">
												<div class="col-xs-12">
													<?php echo $form->labelEx($model,'body'); ?>
													<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
													<?php //echo $form->error($model,'body'); ?>
												</div><!--/ [col]-->
											</li><!--/ .row -->

											<li class="row">
												<div class="col-xs-12">
													<?php if(CCaptcha::checkRequirements()): ?>
													<div class="row">
														<?php echo $form->labelEx($model,'verifyCode'); ?>
														<div>
														<?php $this->widget('CCaptcha', array('captchaAction' => '/site/captcha/')); ?>
														<?php echo $form->textField($model,'verifyCode'); ?>
														</div>
														<div class="hint"><?php echo Yii::t('shop','Please enter the letters as they are shown in the image above.');?><br/><?php echo Yii::t('shop','Letters are not case-sensitive.');?></div>
														<?php echo $form->error($model,'verifyCode'); ?>
													</div>
													<?php endif; ?>
												</div><!--/ [col]-->
											</li><!--/ .row -->
										</ul>

									<!--/ .contactform -->

									<!-- - - - - - - - - - - - - - End of contact form - - - - - - - - - - - - - - - - -->

								</div><!--/ .theme_box -->

								<footer class="bottom_box on_the_sides">

									<div class="left_side">
									
										<input class="button_dark_grey middle_btn" type="submit" value="<?php echo Yii::t('shop','Submit');?>" />

									</div>

									<div class="right_side">

										<p class="prompt"><?php echo Yii::t('shop','Required Fields');?></p>

									</div>

								</footer>
								<?php $this->endWidget(); ?>
							</section>

							<section class="section_offset">

								<h3><?php echo Yii::t('shop','Contact Information');?></h3>

								<div class="theme_box">

									<div class="row">

										<div class="col-sm-5">

											<div class="proportional_frame">

												<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.7574373921325!2d114.13330684979634!3d22.362785946204458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3403f8990e96a6bd%3A0xb9d84f6ac2beadfe!2z6JG15raM6I-v5pif6KGXOOiZn-iPr-mBlOW3pealreS4reW_g0Hluqc!5e0!3m2!1szh-TW!2shk!4v1457003281662" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

											</div>

										</div><!--/ [col]-->

										<div class="col-sm-7">

											<p class="form_caption"><?php echo Yii::t('shop','Your feedback can help improve our product and service. Feel free to give us suggestions.');?></p>

											<ul class="c_info_list">

												<li class="c_info_location"><?php echo Yii::t('shop','Room 11-13, 9/F, Block A, Wah Tat Industrial Centre, No 8-10 Wah Sing Street, Kwai Chung, N.T., Hong Kong');?></li>
												<li class="c_info_phone">(852) 2187 3128</li>
												<li class="c_info_mail"><a href="mailto:enquiry@nfctouch.com.hk ">admin@whospets.com</a></li>
												<li class="c_info_schedule">

													<ul>

														<li><?php echo Yii::t('shop','Monday-Friday: 8.00-20.00');?></li>
														<li><?php echo Yii::t('shop','Saturday: 9.00-15.00');?></li>
														<li><?php echo Yii::t('shop','Sunday: closed');?></li>

													</ul>

												</li>

											</ul>

										</div><!--/ [col]-->

									</div><!--/ .row -->

								</div><!--/ .theme_box -->

							</section>

						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
