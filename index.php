<?php 
/**
 * Blog Page
 *
 */
$args = array(
    'post_type' => 'post',
    'meta_value' => 'yes',
    'posts_per_page' => 4,
    'post_status' => 'publish',
    'meta_key' => '_is_ns_featured_post',
);

$fposts_query = new WP_Query( $args );

$page_id = get_option('page_for_posts');
$blog_page = get_post( $page_id );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

get_header(); ?>
	
	<div id="primary" class="content-area">

		<section class="feature">
			<div class="container">
				<?php
					echo '<div class="entry-title'.( !$bcontent['disable'] && $paged == 1 && $fposts_query->have_posts() ? ' text-center' : ' mb-0').'">';

						printf( 
							'<h1 class="title">%s</h1>',  
							get_the_title( $page_id )
						);

						if( '' !== $blog_page->post_content )
				        {
				        	echo '<div class="description font-weight-normal mt-2 h6">';

				        		echo apply_filters('the_content', $blog_page->post_content);

				        	echo '</div>';
				        }

					echo '</div>';

					if ( !$bcontent['disable'] && $paged == 1 && $fposts_query->have_posts() ) 
					{
						echo '<div class="row lr-10 mbm-20">';
							echo '<div class="col-lg-6">';

								while ( $fposts_query->have_posts() ) 
								{
									$fposts_query->the_post();

									get_template_part( 
										'template-parts/content', 
										'post',
										array(
											'image' => 'post_large',
											'class' => 'feature__item',
										)
									);

									break;
								}

							echo '</div>';

							if ( $fposts_query->found_posts > 1 ) 
							{
								echo '<div class="col-lg-6">';

									while ( $fposts_query->have_posts() ) 
									{
										$fposts_query->the_post();

										get_template_part( 
											'template-parts/content', 
											'post',
											array(
												'class' => 'feature__item has--small d-sm-flex align-items-center justify-content-between flex-row-reverse'
											)
										);
									}

								echo '</div>';
							}

						echo '</div>';
					}
					wp_reset_query();
				?>
			</div>
		</section>

		<div class="container">
			<hr class="blue">
		</div>

		<section class="blog-page">
            <div class="container">
                <div class="row lr-10" data-sticky_parent>
                    <div class="col-lg-8" data-sticky_column>
                        <main class="main-content">
                        	<?php
                        		global $wp_query;

                        		$total_pages = $wp_query->max_num_pages;
                        		$current_page = max( 1, get_query_var( 'paged' ) );

                        		printf( 
                        			'<h6 class="blog-page__title">%s</h6>',  
                        			esc_html__( 'All Blog Posts', 'aisk' )
                        		);

                        		if ( have_posts() ) 
                        		{
                        			while ( have_posts() ) 
                        			{
                        				the_post();

                        				get_template_part( 
                        					'template-parts/content', 
                        					'post' 
                        				);
                        			}

                        			if ( $wp_query->max_num_pages > 1 ) 
                        			{
                        				the_posts_pagination( array(
                        				    'class' => '',
                        				    'mid_size' => 2,
                        				    'prev_text' => __( '<span class="icon-arrow-left"></span> Newer Posts', 'aisk' ),
                        				    'next_text' => __( 'Older Posts <span class="icon-arrow-right"></span>', 'aisk' ),
                        				) );
                        			}
                        		}
                        		else
                        		{
                        			printf( 
                        				'<div class="noposts mt-3">
                        					<p>%s</p>
                        				</div>', 
                        				esc_html__('No posts found!', 'aisk') 
                        			);
                        		}
                        		wp_reset_query();				        		    	
                        	?>
                        </main>
                    </div>

                    <?php get_sidebar(); ?>
                </div>
            </div>
        </section>

	</div><!-- /content-area -->

<?php get_footer(); ?>