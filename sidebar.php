<div class="col-lg-4">
    <aside class="sidebar" data-sticky_column>
    	<?php
			printf( 
				'<div class="widget">
					<h6 class="widget__title">%s</h6>

		            <form action="%s" class="search-form" method="get">
						<div class="form-group">
							<input type="search" name="s" value="%s" placeholder="%s">
							<button type="submit"><i class="icon-search"></i></button>
						</div>
					</form>
				</div>', 
				esc_html__('Search', 'aisk'),
				esc_url( home_url( '/' ) ),
				get_search_query(),
				esc_html__('Search the Blog', 'aisk'),
			);

			$queried_object = get_queried_object();

			$categories = get_categories( array(
			    'orderby' => 'name', 
			    'order'   => 'ASC' 
			));

			if ( $categories ) 
			{
				echo '<div class="widget">';

					printf( 
						'<h6 class="widget__title">%s</h6>',  
						esc_html__('Categories', 'aisk')
					);

					echo '<ul class="category list-unstyled">';

						foreach ( $categories as $category ) 
						{
						    printf( 
						    	'<li%s><a href="%s">%s</a></li>', 
						    	(get_queried_object()->term_id == $category->term_id ? ' class="active"' : ''),
						    	esc_url( get_category_link( $category->term_id ) ), 
						    	$category->name 
						    );
						}

					echo '</ul>';
				echo '</div>';
			}

			$helpful_links = get_field( 'helpful_links', get_option('page_for_posts') );

			if ( $helpful_links ) 
			{
				echo '<div class="widget">';

					printf( 
						'<h6 class="widget__title">%s</h6>',  
						esc_html__('Helpful Links', 'aisk')
					);

					echo '<div class="helpful_link">';

						foreach ( $helpful_links as $hlink ) 
						{
							printf( 
								'<a href="%s" class="helpful_link__item d-flex flex-column align-items-start justify-content-between" target="%s">
				            		<span class="%s"></span>
				            		<h6 class="title text-uppercase">%s</h6>
				            	</a>', 
				            	esc_url( $hlink['link']['url'] ),
				            	esc_html( $hlink['link']['target'] ),
				            	esc_html( $hlink['icon'] ),
				            	htmlspecialchars_decode( $hlink['link']['title'] )
							);
						}

					echo '</div>';

				echo '</div>';
			}
    	?>
    </aside>
</div>