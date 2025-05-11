<?php get_header(); ?>

	<div id="primary" class="content-area">

		<section class="default-page">
			<div class="container">
				<div class="error-404 not-found text-center">
					<?php
						$error_404 = get_field( 'error_404', 'options' );
					
						echo '<header class="error-header">';

							if ( $error_404['404'] ) 
							{
								printf(
									'<h1 class="hero">%s</h1>', 
									$error_404['404']
								);
							} 
							else 
							{
								printf(
									'<h1 class="hero">%s</h1>', 
									esc_html__( '404', 'aisk' )
								);
							}

							if ( $error_404['title'] ) 
							{
								printf(
									'<h2 class="page-title">%s</h2>', 
									$error_404['title']
								);
							} 
							else 
							{
								printf(
									'<h2 class="page-title">%s</h2>', 
									esc_html__( 'Oops! That page can&rsquo;t be found.', 'aisk' )
								);
							}

						echo '</header>';

						echo '<div class="error-content">';

							if ( $error_404['description'] ) 
							{
								printf(
									'%s', 
									$error_404['description']
								);
							} 
							else 
							{
								printf(
									'<p>%s</p>', 
									esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'aisk' )
								);
							}

							if ( $error_404['button'] ) 
							{
								printf(
									'<a href="%s" class="btn" target="%s">
										<span>%s</span>
									</a>', 
									esc_url( $error_404['button']['url'] ), 
									$error_404['button']['target'], 
									$error_404['button']['title'] 
								);
							} 
							else 
							{
								printf(
									'<a href="%s" class="btn">
										<span>%s</span>
									</a>', 
									esc_url( home_url( '/' ) ), 
									esc_html__( 'Go Back To Home', 'aisk' )
								);
							}

						echo '</div>';
					?>
				</div>
			</div>
		</section>

	</div><!-- /content-area -->

<?php get_footer();