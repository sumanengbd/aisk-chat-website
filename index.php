<?php get_header(); ?>
	
	<div id="primary" class="content-area">

		<section class="blog-page">
            <div class="container">
            	<div class="row lr-10 justify-content-center">
					<div class="col-lg-8 col-md-10">
						<main class="main-content">
							<?php
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
								}
								else
								{
									printf( 
										'<div class="noposts text-center">
											<p>%s</p>
										</div>', 
										esc_html__('No posts found!', 'aisk') 
									);
								}
							?>
						</main>
					</div>
				</div>
            </div>
        </section>

	</div><!-- /content-area -->

<?php get_footer(); ?>