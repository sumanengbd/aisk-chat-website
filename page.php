<?php get_header(); ?>

	<section class="breadcrumb-wrapper">
		<div class="container">
			<?php echo aisk_breadcrumb(); ?>
		</div>
	</section><!-- breadcrumb -->

	<div id="primary" class="content-area">
		
		<?php if ( have_posts() ): while( have_posts() ): the_post(); ?>
		<section class="default-page">
			<div class="container">
				<?php
					echo '<div class="content__editor">';
				
						the_content(); 

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aisk' ),
							'after'  => '</div>',
						) );

					echo '</div>';
				?>
			</div>
		</section><!-- /default-page -->
		<?php endwhile; endif; ?>

	</div><!-- /primary -->

<?php get_footer(); ?>