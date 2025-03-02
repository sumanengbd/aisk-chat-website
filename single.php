<?php get_header(); ?>
	
	<div id="primary" class="content-area">

		<?php if ( have_posts() ): while ( have_posts() ): the_post(); $video = get_field( 'video_post' ); ?>
		<section class="blog-details">
			<div class="container">
				<div class="blog-details__header text-center">
					<div class="row lr-10 justify-content-center">
						<div class="col-lg-8 col-md-8 col-sm-10">
							<?php 
								the_title( '<h1 class="title h2">', '</h1>' ); 

								printf(
								    '<ul class="post-meta list-inline">
								        <li><a href="%s" class="icon-user">%s</a></li>
								        <li><a href="%s" class="icon-calendar">%s</a></li>
								        <li><a href="%s" class="icon-comment-empty">%s</a></li>
								    </ul>',
								    get_author_posts_url(get_the_author_meta('ID')),
								    get_the_author(),
								    esc_url( get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) ),
								    get_the_date('F j, Y'),
								    esc_url( get_comments_link() ), 
								    get_comments_number_text('0 Comments', '1 Comment', '% Comments')
								);
							?>
						</div>
					</div>
				</div>

				<?php if ( has_post_thumbnail() ): ?>
				<div class="blog-details__banner">
					<div class="row lr-10 justify-content-center">
						<div class="col-lg-8 col-md-10 col-sm-12">
							<?php 
								echo $video ? '<a href="'.esc_url( $video ).'" class="media popup-video" data-effect="mfp-move-from-top">' : '<div class="media">';
									
									the_post_thumbnail( 'post_large', array( 'class' => 'img-fluid' ) ); 

								echo $video ? '</a>' : '</div>';
							?>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<div class="blog-details__content" data-sticky_parent>
					<div class="row lr-10 justify-content-center" data-sticky_column>
						<div class="col-lg-8 col-md-8 col-sm-10">
							<?php
								if( '' !== get_post()->post_content )
						        {
						        	echo '<div class="content__editor">';

						        		the_content();

						        	echo '</div>';
						        }

						        $action_type = get_field( 'action_type' );
	                        	$embed_code = get_field('embed_code');
	                        	$call_action = $action_type == 'default' ? get_field( 'blog_call_action', 'options' ) : get_field('call_action');

						        if ( $action_type == 'custom' || $action_type == 'default' && !empty( $call_action ) && array_filter( $call_action ) ) 
	                        	{
	                        		echo '<div class="call-action">';
		                        		echo '<div class="background d-md-flex align-items-center">';

		                        			if ( $call_action['title'] || $call_action['description'] || $call_action['button'] ) 
		                            		{
		                            			echo '<div class="text">';

			                                		if ( $call_action['title'] ) 
			                                		{
			                                			printf( 
			                                				'<h3 class="title text-white">%s</h3>', 
			                                				$call_action['title'] 
			                                			);
			                                		}

			                                		if ( $call_action['description'] ) 
			                                		{
			                                			printf( 
			                                				'<div class="description h6 font-weight-normal">%s</div>', 
			                                				$call_action['description'] 
			                                			);
			                                		}

			                                		if ( $call_action['button'] ) 
			                                		{
			                                			printf( 
			                                				'<a href="%s" class="btn" target="%s">%s</a>', 
			                                				esc_url( $call_action['button']['url'] ), 
			                                				$call_action['button']['target'], 
			                                				htmlspecialchars_decode( $call_action['button']['title'] ) 
			                                			);
			                                		}

		                                		echo '</div>';
		                            		}

		                        		echo '</div>';
	                        		echo '</div>';
	                        	}
	                        	elseif ( $action_type == 'embed' )
	                        	{
	                        		echo '<div class="call-action embed">';

	                        			printf(
	                        				'<div class="content__editor">%s</div>', 
	                        				$embed_code
	                        			);

	                        		echo '</div>';
	                        	}

	                        	echo '<div class="socialshare">
									<div class="sharethis-inline-share-buttons" data-sticky_column></div>
								</div>';

		                        if ( comments_open() || get_comments_number() ) 
		                        {
	    	                    	echo '<div class="entry-comments">';
		                            	
		                            	comments_template();

		                        	echo '</div>';
		                        }
							?>
						</div>
					</div>
				</div>
			</div>
		</section><!-- blog-details -->
		<?php endwhile; endif; wp_reset_query(); ?>

	</div><!-- /content-area -->

<?php get_footer(); ?>