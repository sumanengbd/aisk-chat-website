<?php 
/*
Template Name: Contact Page
*/
get_header();
	
	$content = get_field( 'content' );
	$social_media = get_field( 'social_media', 'options' ); ?>
	
	<div id="primary" class="content-area">

		<section class="contact-us">
			<div class="container">
				<div class="row lr-10 justify-content-center">
					<div class="col-lg-8 col-md-10">
						<?php
							echo '<div class="entry-title text-center">';

								if ( $content['sub_title'] ) 
								{
									printf( 
										'<h6 class="sub-title font-abel">%s</h6>',  
										$content['sub_title']
									);
								}

								if ( $content['title'] ) 
								{
									printf( 
										'<h1 class="title">%s</h1>',  
										$content['title']
									);
								}
								else
								{
									printf( 
										'<h1 class="title">%s</h1>',  
										get_the_title()
									);
								}

								if ( $content['description'] ) 
								{
									printf( 
										'<div class="description h6 font-weight-normal">%s</div>',  
										$content['description']
									);
								}

								if ( $social_media ) 
								{
									echo '<ul class="social-media list-inline">';

										printf( 
											'<li>%s</li>',
											esc_html__( 'Follow us on social', 'aisk' )  
										);

										foreach ( $social_media as $social ) 
										{
											printf( 
												'<li><a href="%s" class="%s" target="_blank"></a></li>',  
												esc_url( $social['url'] ),
												esc_html( $social['icon'] )
											);
										}

									echo '</ul>';
								}

							echo '</div>';

							if ( $content['form_title'] || $content['form_type'] ) 
							{
								echo '<div class="contact-us__form">';

									if ( $content['form_title'] ) 
									{
										printf( 
											'<h4 class="form-title text-center">%s</h4>',  
											$content['form_title']
										);
									}

		                    		if ( $content['form_type'] ) 
		                    		{
										echo '<div class="form">';

			                    		if ( $content['form_type'] == 'embed' && $content['embed_code'] ) 
			                    		{
			                    			echo '<div class="embed_code">';

			                    			echo do_shortcode( $content['embed_code'] );

			                    			echo '</div>';
			                    		}
			                    		elseif( $content['form_type'] == 'form' && $content['select_form'] )
			                    		{
			                    			echo do_shortcode('[gravityform id="'. $content['select_form']['id'] .'" title="false" description="false" tabindex="10" ajax="true"]');
			                    		} 

		                    			echo '</div>';
		                    		}

								echo '</div>';
							}
						?>
					</div>
				</div>
			</div>
		</section>

	</div><!-- /content-area -->

<?php get_footer();