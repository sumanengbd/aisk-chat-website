<?php 
/*
Template Name: Contact Page
*/
get_header(); ?>
	
	<div id="primary" class="content-area">

		<section class="contact-us">
			<div class="container">
				<div class="row lr-10 align-items-center">
					<div class="col-lg-6">
						<div class="contact-us__content-area">
							<div class="entry-title">
								<h6 class="sub-title text-uppercase font-abel">Contact Us</h6>
								<h1 class="title">Contact AISK, today</h1>
								<div class="description h6 font-weight-normal">
									<p>Recruiting caregivers for your home care agency can be challenging enough, but it's even more frustrating when those same</p>
								</div>
							</div>

							<ul class="quick-contact list-unstyled">
								<li><a href="#" class="icon-phone">+8801734415341</a></li>
								<li><a href="#" class="icon-mail">support@aisk.com</a></li>
							</ul>

							<ul class="social-media list-inline">
								<li>Follow us on social</li>
								<li><a href="#" class="icon-facebook"></a></li>
								<li><a href="#" class="icon-twitter"></a></li>
								<li><a href="#" class="icon-linkedin"></a></li>
							</ul>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="contact-us__form">
							<h4 class="form-title">Send us a message, anytime.</h4>

							<div class="form bgblack">
								<?php echo do_shortcode('[gravityform id="1" title="false" description="false" tabindex="10" ajax="true"]'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	</div><!-- /content-area -->

<?php get_footer();