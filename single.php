<?php get_header(); ?>
	
	<div id="primary" class="content-area">

		<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>
		<section class="blog-details">
			<div class="container">
				<div class="blog-details__banner">
					<div class="row align-items-center">
						<div class="<?php echo has_post_thumbnail() ? 'col-lg-6' : 'col-lg-12 fluid'; ?>">
							<div class="content<?php if ( has_post_thumbnail() ) echo ' has-media'; ?>">
								<?php
									$categories = get_the_terms( get_the_ID(), 'category' );

									if ( $categories ) 
									{
										echo '<ul class="categories list-unstyled">';

											foreach ( $categories as $key => $category ) 
											{
												printf( '<li%s><a href="%s">%s</a></li>', ( $key == 0 ? ' class="active"' : ''), esc_url( get_term_link( $category->term_id ) ), $category->name );

												break;
											}

										echo '</ul>';
									}

									the_title( '<h1 class="title">', '</h1>' );
								?>
							</div>
						</div>

						<?php $video = get_field( 'video_post' ); if ( has_post_thumbnail() ): ?>
						<div class="col-lg-6">
							<?php 
								echo $video ? '<a href="'.esc_url( $video ).'" class="media popup-video" data-effect="mfp-move-from-top">' : '<div class="media">';
									
									the_post_thumbnail( 'post_large', array( 'class' => 'img-fluid' ) ); 

								echo $video ? '</a>' : '</div>';
							?>
						</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="blog-details__content" data-sticky_parent>
					<main class="main-content position-relative" data-sticky_column>
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

	                        			if ( $call_action['image'] ) 
	                        			{
	                        				printf( 
	                        					'<div class="media">
	                        						<img src="%s" class="img-fluid" alt="%s">
	                        					</div>', 
	                        					esc_url( $call_action['image']['url'] ), 
	                        					$call_action['image']['alt'] 
	                        				);
	                        			}

	                        			if ( $call_action['title'] || $call_action['description'] || $call_action['button'] ) 
	                            		{
	                            			echo '<div class="text">';

		                                		if ( $call_action['title'] ) 
		                                		{
		                                			printf( 
		                                				'<h2 class="title text-white">%s</h2>', 
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
						?>
					</main>
				</div>
			</div>
		</section><!-- blog-details -->
		<?php endwhile; endif; wp_reset_query(); ?>

	</div><!-- /content-area -->

<?php get_footer(); ?>