<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<?php 
						$this->widget('application.components.widgets.BreadcrumbsWidget',array(
											'items'=>array(
															array('description'=>'Home', 'href'=>Yii::app()->createUrl('/site/index'),),
															array('description'=>'FAQ'),
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

								<h3 class="offset_title">Testimonials</h3>

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

										<div class="author_info"><b>Johanna Fung, Hong Kong</b></div>

										<p>A lot has happened this year & the best thing was the return of Cha Cha after disappearing for 3 MONTHS! I would like to take this opportunity to thank you for introducing me to this wonderful tag which has enabled AMC to contacting us after finding our dog. I never thought I would be able to see Cha Cha again but we did it finally! Thanks!!</p>

									</blockquote>
									
									<!-- - - - - - - - - - - - - - End testimonial - - - - - - - - - - - - - - - - -->

								</div><!--/ .widgets_carousel-->

								<!-- - - - - - - - - - - - - - End of carousel of testimonials - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - View all testimonials - - - - - - - - - - - - - - - - -->

								<footer class="bottom_box">

									<a href="http://pet.sosowedding.com/en/site/testimonial" class="button_grey middle_btn">View All Testimonials</a>

								</footer>

								<!-- - - - - - - - - - - - - - End of view all testimonials - - - - - - - - - - - - - - - - -->

							</section><!--/ .section_offset.animated.transparent-->

							<!-- - - - - - - - - - - - - - End of testimonials - - - - - - - - - - - - - - - - -->

						</aside><!--/ [col]-->

						<main class="col-md-9 col-sm-8">

							<h1>FAQ</h1>

							<!-- - - - - - - - - - - - - - Accordion - - - - - - - - - - - - - - - - -->

							<dl class="accordion">

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>How does data protection work?</dt>
								<dd>Create your pet’s free online profile with us. The profile contains information about your pet including their name, breed, age, medications, allergies, owner’s contact info, and much more. Your data is protected by us and it is your option to disclose your personal information or not. </dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Do you have to have a smartphone to use our tag?</dt>
								<dd>No! Our tag offers multiple ways for people to get in touch with the owner. If the user does not have NFC reading device, they can manually enter in the web address with the unique code that links directly to the pet’s profile.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Can I add my pet’s name and my phone number to its profile?</dt>
								<dd>Yes! We offer some of the profile with a personalization option that allows you to put your pet’s name and contact information. Is totally up to you what information you want to present for your pet. </dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>What comes with our membership?</dt>
								<dd>Our membership is free and comes with every tag or collar. It includes:
                                <ul class="list_type_6">

										<li>Storage of Your Pet’s Information – put all of your pet’s contact information online, in one place, and then put it to use to help protect them by linking it to one of our NFC Tags.</li>
										<li>Basic (Free) Tag</li>

									</ul>
                                </dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Is there a monthly fee once I have paid for the tag?</dt>
								<dd>There is no monthly fee.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Are there any hidden fees?</dt>
								<dd>No, we pride ourselves on being as straightforward as possible to the consumer. The Basic (Free) Tag offers a suite of features while the Premium products offers better looks!</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Can I wait until my pet is missing then register?</dt>
								<dd>No. Your pet needs to have the tag on them before they got lost therefore the finder can communicate with you once your pet has been found. The purpose of the tag is to get your pet home faster.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Is there a discount for multiple pets?</dt>
								<dd>Yes! Please keep an eye on our discount products.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Do I have to replace my pet’s tag each year?</dt>
								<dd>No, our tags are durable and meant to last. If you have a problem with a tag, we will replace it!</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>What happens if my tag is lost or damaged?</dt>
								<dd>If your tag is lost, you may purchase a new tag and link it to your pet's profile just like you did before. If it becomes damaged, contact us so we can help you get a new tag, usually at no additional cost.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Can I change my pets’ and my information whenever I want free of charge?</dt>
								<dd>Yes, you may change your pets’ information as often as you like free of charge.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Do we have a specific mobile app?</dt>
								<dd>No, we do not have our own app for any brand of phone. You may use any NFC device you choose. This is helpful so if a rescuer finds your pet they can just use what they have and not need to download anything else.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->
                                <!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>What if someone doesn’t know what NFC is?</dt>
								<dd>That is the great thing about our tags; the rescuer can use NFC or just type in the URL in any browser or call to speak to a live person who can give them any information and link a phone call to you directly.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->
                                <!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Can the tag be used outside the HK?</dt>
								<dd>YES! It is available to everyone, everywhere.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

							</dl>

							<!-- - - - - - - - - - - - - - End of accordion - - - - - - - - - - - - - - - - -->

						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
