<?php
/**
 * Footer
 *
 */
$action = get_field( 'call_action', 'options' );
$footer_logo = get_field( 'footer_logo', 'options' );
$social_media = get_field( 'social_media', 'options' ); ?>
	
	<?php if ( !empty( $action ) && array_filter( $action ) ): ?>
	<section class="footer_top">
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
			<div class="footer__content mx-auto text-center">
				<?php
					echo '<div class="footer__logo">';
						echo '<a href="'.esc_url( home_url( '/' ) ).'">';

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
							        esc_url( get_theme_file_uri('images/footer-logo.svg') ), 
							        get_bloginfo('name')
							    );
							}

						echo '</a>';
					echo '</div>';

					wp_nav_menu( array(
					    'depth'              => 1,
					    'container'          => false,
					    'theme_location'     => 'menu-3',
					    'menu'               => 'Footer Menu',
					    'menu_id'            => 'footer-menu',
					    'menu_class'         => 'footer__menu list-inline',
					    'fallback_cb'        => 'wp_bootstrap_navwalker::fallback',
					    'walker'             => new wp_bootstrap_navwalker(),
					));

					if ( $social_media ) 
					{
						echo '<ul class="social-media list-inline">';

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

					echo do_shortcode('[copyright]');
				?>
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