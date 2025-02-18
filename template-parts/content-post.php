<?php
/**
 * Blog Post Template
 *
 */
$video_post = get_field( 'video_post' );
$categories = get_the_terms( get_the_ID(), 'category' ); ?>

<article class="<?php echo implode(' ', get_post_class(array( isset( $args['class'] ) && $args['class'] ? $args['class'] : 'blog-posts d-sm-flex align-items-center'))); if ( !empty( $video_post ) ) echo ' video'; ?>">
	<?php
		echo '<div class="'.( isset($args['class']) && str_contains($args['class'], 'feature__item') ? '' : 'blog-posts__' ).'media">';

			echo '<a href="'.esc_url( get_the_permalink() ).'">';

				if ( has_post_thumbnail() ) 
				{
					the_post_thumbnail( 
						( 
							isset( $args['image'] ) ? 
							$args['image'] : 
							'post_thumb'
						), 
						array( 
							'class' => 'img-fluid' 
						) 
					);
				}
				else
				{
					printf( 
						'<img src="%s" class="img-fluid" alt="%s">', 
						esc_url( get_theme_file_uri( 'images/placeholder-post.jpg' ) ), 
						get_the_title() 
					);
				}

			echo '</a>';

		echo '</div>';

		echo '<div class="blog-posts__text">';

			if ( $categories ) 
			{
				echo '<ul class="categories list-unstyled">';

					foreach ( $categories as $key => $category ) 
					{
						printf( 
							'<li%s><a href="%s">%s</a></li>', 
							( $key == 0 ? ' class="active"' : ''), 
							esc_url( get_term_link( $category->term_id ) ), 
							$category->name 
						);

						break;
					}

				echo '</ul>';
			}

			echo '<a href="'.esc_url( get_the_permalink() ).'">';

				if ( isset( $args['image'] ) && $args['image'] == 'post_large' ) 
				{
					the_title(
						'<h3 class="title">', 
						'</h3>'
					);
				}
				else
				{	
					the_title(
						'<h5 class="title">', 
						'</h5>'
					);
				}

			echo '</a>';

			if ( has_excerpt() ) 
			{
				echo '<div class="description desc-big">';

					the_excerpt();

				echo '</div>';
			}

		echo '</div>';
	?>
</article>