<?php
/**
 * Blog Post Template
 *
 */
$video_post = get_field( 'video_post' );
$categories = get_the_terms( get_the_ID(), 'category' ); ?>

<article class="<?php echo implode(' ', get_post_class(array( isset( $args['class'] ) && $args['class'] ? $args['class'] : 'blog-posts'))); if ( !empty( $video_post ) ) echo ' video'; ?>">
	<?php
		echo '<div class="blog-posts__header text-center">';
			echo '<a href="'.esc_url( get_the_permalink() ).'">';

				the_title('<h2 class="title h1">', '</h2>');

			echo '</a>';

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

		echo '</div>';

		echo '<div class="featured-img">';
			echo '<a href="'.esc_url( get_the_permalink() ).'">';

				if ( has_post_thumbnail() ) 
				{
					the_post_thumbnail( 
						'post_large', 
						array( 'class' => 'img-fluid' ) 
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

		if ( has_excerpt() ) 
		{
			echo '<div class="content__editor">';

				the_excerpt();

			echo '</div>';
		}

		printf( 
			'<div class="text-right">
				<a href="%s" class="btn btn-transparent">%s <span class="icon-arrow-right"></span></a>
			</div>',  
			esc_url( get_the_permalink() ),
			esc_html__( 'Read More', 'aisk' )
		);
	?>
	
</article>