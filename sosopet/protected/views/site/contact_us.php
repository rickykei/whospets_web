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

										<div class="author_info"><b>Alan, Los Angeles</b></div>

										<p>Ut tellus dolor, dapibus eget, elementum vel, cursus elefiend, elit. Aenean wisi et urna. Aliquam erat volutpat. Duis ac turpis.</p>

									</blockquote>
									
									<!-- - - - - - - - - - - - - - End testimonial - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Testimonial - - - - - - - - - - - - - - - - -->

									<blockquote>

										<div class="author_info"><b>Tracy, New York</b></div>

										<p>Donec sit amet eros. Lorem ipsum dolor sit amet elit. Mauris amet fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget.</p>

									</blockquote>

									<!-- - - - - - - - - - - - - - End testimonial - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Testimonial - - - - - - - - - - - - - - - - -->

									<blockquote>

										<div class="author_info"><b>Nikki, Boston</b></div>

										<p>Ut tellus dolor, dapibus eget, elementum vel, cursus elefiend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat.</p>

									</blockquote>
									
									<!-- - - - - - - - - - - - - - End testimonial - - - - - - - - - - - - - - - - -->

								</div><!--/ .widgets_carousel-->

								<!-- - - - - - - - - - - - - - End of carousel of testimonials - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - View all testimonials - - - - - - - - - - - - - - - - -->

								<footer class="bottom_box">

									<a href="#" class="button_grey middle_btn">View All Testimonials</a>

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

								<dt>Vestibulum ante ipsum primis in faucibus?</dt>
								<dd>Nam elit agna, endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl. </dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Fusce euismod consequat ante?</dt>
								<dd>Nam elit agna, endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Ut tellus dolor dapibus eget?</dt>
								<dd>Nam elit agna, endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl. </dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Lorem ipsum dolor sit amet consectetuer?</dt>
								<dd>Nam elit agna, endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Neque porro quisquam est qui dolorem ipsum quia dolor sit?</dt>
								<dd>Nam elit agna, endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl. </dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Aliquam dapibus tincidunt metus?</dt>
								<dd>Nam elit agna, endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Proin dictum elementum velit?</dt>
								<dd>Nam elit agna, endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl. </dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Vestibulum libero nisl, porta vel, scelerisque?</dt>
								<dd>Nam elit agna, endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Donec eget tellus non erat?</dt>
								<dd>Nam elit agna, endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl. </dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Integer rutrum ante eu lacus?</dt>
								<dd>Nam elit agna, endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Quis autem vel eum iure reing elit?</dt>
								<dd>Nam elit agna, endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque sed dolor. Aliquam congue fermentum nisl. </dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Accordion item - - - - - - - - - - - - - - - - -->

								<dt>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet nsectetur?</dt>
								<dd>Nam elit agna, endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est.</dd>

								<!-- - - - - - - - - - - - - -  End of accordion item - - - - - - - - - - - - - - - - -->

							</dl>

							<!-- - - - - - - - - - - - - - End of accordion - - - - - - - - - - - - - - - - -->

						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->