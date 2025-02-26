<?php
/**
 * Footer
 *
 */
$action = get_field( 'call_action', 'options' );
$footer_logo = get_field( 'footer_logo', 'options' );
$social_media = get_field( 'social_media', 'options' ); ?>
	
	<?php if ( !empty( $action ) && array_filter( $action ) ): ?>
	<section class="footer_top pb-3">
		<div class="container">
			<div class="entry-title text-center mx-auto">
				<?php
					if ( $action['title'] ) 
					{
						printf( 
							'<h2 class="title h1">%s</h2>',  
							$action['title']
						);
					}

					if ( $action['description'] ) 
					{
						printf( 
							'<div class="description h4 font-weight-normal">%s</div>',  
							$action['description']
						);
					}

					if ( $action['button'] ) 
					{
						printf( 
							'<a href="%s" class="btn" target="%s">%s</a>', 
							esc_url( $action['button']['url'] ), 
							$action['button']['target'], 
							$action['button']['title'] 
						);
					}
				?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<footer class="footer">
		<div class="container">
			<div class="row lr-10">
				<div class="col-lg-3">
					<div class="footer__text-area">
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
						                esc_url( get_theme_file_uri('images/footer-logo.png') ), 
						                get_bloginfo('name')
						            );
						        }
						    ?>
						</a>
					</div>
				</div>

				<div class="col-lg-9">
					<div class="row lr-10 row-cols-lg-4 row-cols-sm-3 row-cols-2">
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
								<?php
									wp_nav_menu( array(
									    'depth'              => 1,
									    'container'          => false,
									    'theme_location'     => 'menu-5',
									    'menu'               => 'Footer Menu 3',
									    'menu_id'            => 'footer-menu-3',
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
									if ( $social_media ) 
									{
										echo '<ul class="social-media list-inline">';

											printf( 
												'<li class="title"><a>%s</a></li>',
												esc_html__( 'Social', 'aisk' )  
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
								?>
							</div>
						</div>
					</div>

					<div class="policies-copyright d-flex flex-wrap align-items-center flex-row-reverse justify-content-between">
						<?php
							wp_nav_menu( array(
							    'depth'              => 1,
							    'container'          => false,
							    'theme_location'     => 'menu-6',
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