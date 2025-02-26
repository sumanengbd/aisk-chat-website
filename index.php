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

		<section class="blog-page">
            <div class="container">
            	<div class="row lr-10 justify-content-center">
					<div class="col-lg-8 col-md-10">
						<main class="main-content">
							<article class="blog-posts">
								<div class="blog-posts__header text-center">
									<a href="#">
										<h2 class="title">WPPOOL Year in Review – 2025</h2>
									</a>

									<ul class="post-meta list-inline">
										<li><a href="#" class="icon-user">Nazmul</a></li>
										<li><a href="#" class="icon-calendar">January 23, 2025</a></li>
										<li><a href="#" class="icon-comment-empty">0 Comments</a></li>
									</ul>
								</div>

								<div class="featured-img">
									<a href="#">
										<img src="<?php echo get_theme_file_uri(); ?>/images/Year-in-review-wppool.jpg" class="img-fluid" alt="">
									</a>
								</div>

								<div class="content__editor">
									<p>The year 2024 was nothing short of amazing for WPPOOL—a year filled with growth, innovation, and plenty of lessons along the way. They say, "Success is no accident; it’s hard work, perseverance, and a love for what you do," and we couldn’t agree more. At WPPOOL, we made it our mission to deliver innovative solutions while keeping our products rock-solid and reliable. Of course, no innovation happens without a few cups of coffee (or maybe a few hundred), and this...</p>

									<p>We focused on creating user-friendly tools while keeping everything reliable and stable. From updating old products to launching new plugins, we worked hard to meet the needs of the WordPress community. Our goal was simple: keep our users happy and make their work easier. And we’re proud to say we built stronger products and an even closer connection with our users this year</p>
								</div>

								<div class="text-right">
									<a href="#" class="btn btn-transparent">Read More <i class="icon-arrow-right"></i></a>
								</div>
							</article>

							<article class="blog-posts">
								<div class="blog-posts__header text-center">
									<a href="#">
										<h2 class="title">WPPOOL Year in Review – 2025</h2>
									</a>

									<ul class="post-meta list-inline">
										<li><a href="#" class="icon-user">Nazmul</a></li>
										<li><a href="#" class="icon-calendar">January 23, 2025</a></li>
										<li><a href="#" class="icon-comment-empty">0 Comments</a></li>
									</ul>
								</div>

								<div class="featured-img">
									<a href="#">
										<img src="<?php echo get_theme_file_uri(); ?>/images/Year-in-review-wppool.jpg" class="img-fluid" alt="">
									</a>
								</div>

								<div class="content__editor">
									<p>The year 2024 was nothing short of amazing for WPPOOL—a year filled with growth, innovation, and plenty of lessons along the way. They say, "Success is no accident; it’s hard work, perseverance, and a love for what you do," and we couldn’t agree more. At WPPOOL, we made it our mission to deliver innovative solutions while keeping our products rock-solid and reliable. Of course, no innovation happens without a few cups of coffee (or maybe a few hundred), and this...</p>

									<p>We focused on creating user-friendly tools while keeping everything reliable and stable. From updating old products to launching new plugins, we worked hard to meet the needs of the WordPress community. Our goal was simple: keep our users happy and make their work easier. And we’re proud to say we built stronger products and an even closer connection with our users this year</p>
								</div>

								<div class="text-right">
									<a href="#" class="btn btn-transparent">Read More <i class="icon-arrow-right"></i></a>
								</div>
							</article>
						</main>
					</div>
				</div>
            </div>
        </section>

	</div><!-- /content-area -->

<?php get_footer(); ?>