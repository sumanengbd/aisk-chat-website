<?php
/**
 * Footer
 *
 */
$tagline = get_field( 'tagline', 'options' );
$contacts = get_field( 'contacts', 'options' );
$footer_logo = get_field( 'footer_logo', 'options' );
$social_media = get_field( 'social_media', 'options' ); ?>

	<footer class="footer">
		<div class="container">
			<div class="row lr-10">
				<div class="col-lg-5">
					<div class="footer__text-area d-lg-flex flex-column-reverse justify-content-between">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__logo">
						    <?php
						        if ( $footer_logo ) 
						        {
						            printf(
						                '<img src="%s" class="img-fluid" alt="%s">', 
						                esc_url( $footer_logo['url'] ), 
						                $footer_logo['alt']
						            );
						        }
						        else
						        {
						            printf(
						                '<img src="%s" class="img-fluid" alt="%s">', 
						                esc_url( get_theme_file_uri('images/logo.png') ), 
						                get_bloginfo('name')
						            );
						        }
						    ?>
						</a>

						<div class="text">
							<?php
								if ( $tagline ) 
								{
									printf( 
										'<h2 class="tagline text-white">%s</h2>',
										$tagline  
									);
								}
								else
								{
									printf( 
										'<h2 class="tagline text-white">%s</h2>',
										get_bloginfo('description')  
									);
								}
							?>
							<div class="description desc-big text-white">
								<p>After connecting, your conversations will not be viewable and answerable on the mobile WhatsApp Business App but are easily</p>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-7">
					<div class="row lr-10 masonry row-cols-sm-3 row-cols-2">
						<div class="col">
							<div class="footer__widget">
								<?php
									wp_nav_menu( array(
									    'depth'              => 1,
									    'container'          => false,
									    'theme_location'     => 'menu-3',
									    'menu'               => 'Footer Menu 1',
									    'menu_id'            => 'footer-menu-1',
									    'menu_class'         => 'footer__widget--menu list-unstyled',
									    'fallback_cb'        => 'wp_bootstrap_navwalker::fallback',
									    'walker'             => new wp_bootstrap_navwalker(),
									));
								?>
							</div>
						</div>

						<div class="col">
							<div class="footer__widget">
								<?php
									wp_nav_menu( array(
									    'depth'              => 1,
									    'container'          => false,
									    'theme_location'     => 'menu-4',
									    'menu'               => 'Footer Menu 2',
									    'menu_id'            => 'footer-menu-2',
									    'menu_class'         => 'footer__widget--menu list-unstyled',
									    'fallback_cb'        => 'wp_bootstrap_navwalker::fallback',
									    'walker'             => new wp_bootstrap_navwalker(),
									));
								?>
							</div>
						</div>

						<div class="col">
							<div class="footer__widget">
								<ul class="social-media list-inline">
									<li class="title"><a>Resources</a></li>
									<li><a href="#" class="icon-facebook" target="_blank"></a></li>
									<li><a href="#" class="icon-twitter" target="_blank"></a></li>
									<li><a href="#" class="icon-linkedin" target="_blank"></a></li>
								</ul>
							</div>
						</div>
					</div>

					<div class="policies-copyright d-flex flex-wrap align-items-center flex-row-reverse justify-content-between">
						<?php
							wp_nav_menu( array(
							    'depth'              => 1,
							    'container'          => false,
							    'theme_location'     => 'menu-5',
							    'menu'               => 'Privacy Menu',
							    'menu_id'            => 'privacy-menu',
							    'menu_class'         => 'privacy-menu list-inline last_no_bullet',
							    'fallback_cb'        => 'wp_bootstrap_navwalker::fallback',
							    'walker'             => new wp_bootstrap_navwalker(),
							));

							echo do_shortcode('[copyright]');
						?>
					</div>
				</div>
			</div>
		</div>
	</footer>
		
	</div><?php
 
	if ( get_field( 'mouse_pointer', 'options' ) ) 
	{
		echo '<div id="cursor">
			<div class="cursor__circle"></div>
		</div>';
	}
		
	wp_footer(); ?>
</body>
</html>