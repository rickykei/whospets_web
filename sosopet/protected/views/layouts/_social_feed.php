		<ul class="social_feeds">

			<!-- - - - - - - - - - - - - - Facebook - - - - - - - - - - - - - - - - -->

			<li>

				<button class="icon_btn middle_btn social_facebook open_"><i class="icon-facebook-1"></i></button>

				
				<section class="dropdown">

					<div class="animated_item">

						<h3 class="title">Join Us on Facebook</h3>

					</div><!--/ .animated_item-->

					<div class="animated_item">

<iframe src="http://www.facebook.com/plugins/likebox.php?href=https://www.facebook.com/whospets/?fref=ts&width=235&amp;height=345&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=438889712801266" style="border:none; overflow:hidden; width:235px; height:345px;"></iframe>
					</div><!--/ .animated_item-->

				</section><!--/ .dropdown-->

			</li>

			<!-- - - - - - - - - - - - - - End of Facebook - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - Twitter - - - - - - - - - - - - - - - - -->

			<li>

				<button class="icon_btn middle_btn social_twitter open_"><i class="icon-twitter"></i></button>

				<section class="dropdown">
					<div class="animated_item">

						<h3 class="title">Latest Tweets</h3>

					</div>

					 
					<footer class="animated_item bottom_box">
<a class="twitter-timeline"  data-widget-id="711279542652960768" data-chrome="nofooter noheader noborders noscrollbar"></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</footer> 

				</section><!--/ .dropdown-->

			</li>

			<!-- - - - - - - - - - - - - - End of Twitter - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - Contact us - - - - - - - - - - - - - - - - -->

			<li>

				<button class="icon_btn middle_btn social_contact open_"><i class="icon-mail-8"></i></button>

<?php  //echo $this->model2; 
$this->renderPartial('//layouts/_contactajaxform', array('model'=>$this->model2));?>
			</li>

			<!-- - - - - - - - - - - - - - End contact us - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - Google map - - - - - - - - - - - - - - - - -->

			<li>

				<button class="icon_btn middle_btn social_gmap open_"><i class="icon-location-4"></i></button>

				<!--Location-->

				<section class="dropdown">

					<div class="animated_item">

						<h3 class="title">Our Location</h3>

					</div><!--/ .animated_item-->
					 
					<div class="animated_item">
						
						<p class="c_info_location">Room 11-13, 9/F, Block A,<br>Wah Tat Industrial Centre, No 8-10 Wah Sing Street, <br>Kwai Chung, N.T., Hong Kong</p>

						<div class="proportional_frame">

							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.7574373921325!2d114.13330684979634!3d22.362785946204458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3403f8990e96a6bd%3A0xb9d84f6ac2beadfe!2z6JG15raM6I-v5pif6KGXOOiZn-iPr-mBlOW3pealreS4reW_g0Hluqc!5e0!3m2!1szh-TW!2shk!4v1457003281662" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

						</div>

						<ul class="c_info_list">

							<li class="c_info_phone">(852) 2187 3128</li>
												<li class="c_info_mail"><a href="mailto:enquiry@nfctouch.com.hk ">admin@whospets.com </a></li>
												<li class="c_info_schedule">

								<ul>

									<li>Monday-Friday: 8.00-20.00</li>
									<li>Saturday: 9.00-15.00</li>
									<li>Sunday: closed</li>

								</ul>

							</li>

						</ul>

					</div><!--/ .animated_item-->

				</section><!--/ .dropdown-->
			
			</li>

			<!-- - - - - - - - - - - - - - End google map - - - - - - - - - - - - - - - - -->

		</ul>
