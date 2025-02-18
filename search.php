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
					echo '<div class="entry-title mb-0">';

						printf(
						    '<h1 class="title">%s <span style="color: #3b42c4">%s</span></h1>',
						    __('Search Results for:', 'aisk'),
						    esc_html(get_search_query())
						);

					echo '</div>';
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