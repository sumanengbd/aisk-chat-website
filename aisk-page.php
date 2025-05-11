<?php 
/*
Template Name: AISK Page
*/
get_header(); 
	
	if ( have_rows('content') ) 
	{
		$sec = 1;
		echo '<div class="content-area">';

			while ( have_rows('content') ) 
			{
				the_row();

				if ( get_row_layout() == 'banner' ) 
				{
					$image = get_sub_field( 'image' );
					$title = get_sub_field( 'title' );
					$description = get_sub_field( 'description' );
					$button = get_sub_field( 'button' );
					$class = get_sub_field( 'class' );

					if ( $image || $title || $description || $button ) 
					{
						echo '<section class="banner '.( $class ).'">';
							echo '<div class="container">';
								echo '<div class="row align-items-center">';
									echo '<div class="'.( $image ? 'col-lg-6 col-md-7' : 'col-md-12 fluid').'">';
										echo '<div class="banner__text">';

											if ( $title ) 
											{
												printf( 
													'<h1 class="title fz-big">%s</h1>', 
													$title
												);
											}
											else
											{
												printf( 
													'<h1 class="title">%s</h1>', 
													get_bloginfo( 'name' )
												);
											}

											if ( $description ) 
											{
												printf( 
													'<div class="description font-weight-normal h4">%s</div>', 
													$description
												);
											}
											else
											{
												printf( 
													'<div class="description font-weight-normal h4">%s</div>', 
													get_bloginfo( 'description' )
												);
											}

											if ( $button ) 
											{
												printf( 
													'<a href="%s" class="btn" target="%s">%s</a>', 
													esc_url( $button['url'] ), 
													$button['target'], 
													$button['title'] 
												);
											}

										echo '</div>';
									echo '</div>';

									if ( $image ) 
									{
										printf( 
											'<div class="col-lg-6 col-md-5">
												<div class="banner__media">
													<img src="%s" class="img-fluid" alt="%s">
												</div>
											</div>', 
											esc_url( $image['url'] ), 
											$image['alt'] 
										);
									}
									
								echo '</div>';
							echo '</div>';
						echo '</section>';
					}
				}

				if ( get_row_layout() == 'all_chats' ) 
				{
					$title = get_sub_field( 'title' );
					$description = get_sub_field( 'description' );
					$chats = get_sub_field( 'chats' );
					$class = get_sub_field( 'class' );

					if ( $title || $description || $all_chats ) 
					{
						echo '<section class="communication '.( $class ).'">';
							echo '<a id="'.esc_attr( sanitize_title( $title ) ).'" class="blankSpace"></a>';

							if ( $title || $description ) 
							{
								echo '<div class="container">';
									echo '<div class="entry-title text-center mx-auto">';

										if ( $title ) 
										{
											printf( 
												'<h2 class="title">%s</h2>',  
												$title
											);
										}

										if ( $description ) 
										{
											printf( 
												'<div class="description h6 font-weight-normal mt-2">%s</div>',  
												$description
											);
										}

									echo '</div>';
								echo '</div>';
							}

							if ( $chats ) 
							{
								echo '<div class="container-fluid px-0">';
									echo '<div class="row lr-0 minus justify-content-center">';

										foreach ( $chats as $chat ) 
										{
											echo '<div class="col-lg-4 col-md-6">';
												echo '<div class="communication__item d-flex flex-column justify-content-between" style="--backgroundColor: '.$chat['background'].';">';

													if ( $chat['title'] || $chat['description'] ) 
													{
														echo '<div class="text text-center">';

															if ( $chat['title'] ) 
															{
																printf( 
																	'<h5 class="title">%s</h5>', 
																	$chat['title']
																);
															}

															if ( $chat['description'] ) 
															{
																printf( 
																	'<div class="description desc-big">%s</div>',  
																	$chat['description']
																);
															}

														echo '</div>';
													}

													if ( $chat['image'] ) 
													{
														printf( 
															'<div class="media">
																<img src="%s" class="img-fluid" alt="%s">
															</div>', 
															esc_url( $chat['image']['url'] ), 
															$chat['image']['alt'] 
														);
													}
													
												echo '</div>';
											echo '</div>';
										}

									echo '</div>';
								echo '</div>';
							}
								
						echo '</section>';
					}
				}

				if ( get_row_layout() == 'features' ) 
				{
					$title = get_sub_field( 'title' );
					$description = get_sub_field( 'description' );
					$features = get_sub_field( 'features' );
					$class = get_sub_field( 'class' );

					if ( $title || $description || $features ) 
					{
						echo '<section class="qualification '.( $class ).'">';
							echo '<div class="container">';

								if ( $title || $description ) 
								{
									echo '<div class="entry-title">';

										if ( $title ) 
										{
											printf( 
												'<h2 class="title">%s</h2>',  
												$title
											);
										}

										if ( $description ) 
										{
											printf( 
												'<div class="description h6 font-weight-normal">%s</div>',  
												$description
											);
										}

									echo '</div>';
								}

								if ( $features ) 
								{
									echo '<div class="qualification--wrapper">';

										foreach ($features as $feature ) 
										{
											echo '<div class="qualification__item">';
												echo '<a id="'.esc_attr( sanitize_title( $feature['title'] ) ).'" class="blankSpace"></a>';
												echo '<div class="row align-items-center">';

													if ( $feature['video'] ) 
													{
														printf( 
															'<div class="col-lg-6">
																<div class="media has-video">
																	<video class="video" poster="%s" autoplay muted loop preload="auto">
													                    <source src="%s" type="%s">
													                </video>
																</div>
															</div>', 
															esc_url( $feature['image']['url'] ), 
															esc_url( $feature['video']['url'] ),
															esc_html( $feature['video']['mime_type'] )
														);
													}
													elseif ( $feature['image'] ) 
													{
														printf( 
															'<div class="col-lg-6">
																<div class="media">
																	<img src="%s" class="img-fluid" alt="%s">
																</div>
															</div>', 
															esc_url( $feature['image']['url'] ), 
															$feature['image']['alt'] 
														);
													}

													if ( $feature['title'] || $feature['description'] || $feature['button'] ) 
													{
														echo '<div class="'.( $feature['image'] || $feature['video'] ? 'col-lg-6' : 'col-lg-12 fluid').'">';
															echo '<div class="text">';

																if ( $feature['title'] ) 
																{
																	printf( 
																		'<h3 class="title">%s</h3>',  
																		$feature['title']
																	);
																}

																if ( $feature['description'] ) 
																{
																	printf( 
																		'<div class="description desc-big font-weight-normal">%s</div>',  
																		$feature['description']
																	);
																}
																
																if ( $feature['button'] ) 
																{
																	printf( 
																		'<a href="%s" class="btn" target="%s">%s</a>', 
																		esc_url( $feature['button']['url'] ), 
																		$feature['button']['target'], 
																		$feature['button']['title'] 
																	);
																}

															echo '</div>';
														echo '</div>';
													}

												echo '</div>';
											echo '</div>';
										}

									echo '</div>';
								}
								
							echo '</div>';
						echo '</section>';
					}
				}

				if ( get_row_layout() == 'brands' ) 
				{
					$title = get_sub_field( 'title' );
					$description = get_sub_field( 'description' );
					$brands = get_sub_field( 'brands' );
					$button = get_sub_field( 'button' );
					$class = get_sub_field( 'class' );

					if ( $title || $description || $brands || $button ) 
					{
						echo '<section class="trusted '.( $class ).'">';
							echo '<div class="container">';

								if ( $title || $description ) 
								{
									echo '<div class="entry-title text-center">';

										if ( $title ) 
										{
											printf( 
												'<h2 class="title">%s</h2>',  
												$title
											);
										}

										if ( $description ) 
										{
											printf( 
												'<div class="description h6 font-weight-normal">%s</div>',  
												$description
											);
										}

									echo '</div>';
								}

								if ( $brands || $button ) 
								{
									echo '<div class="contner-fluid px-0">';

										if ( $brands ) 
										{	
											echo '<div class="carouselTicker" data-speed="1" data-direction="prev">';
												echo '<ul class="carouselTicker__list">';

													foreach ( $brands as $brand ) 
													{
														echo '<li>';
															echo '<a'.( $brand['link'] ? ' href="'.( $brand['link']['url'] ).'" target="'.( $brand['link']['target'] ).'"' : '').' class="trusted__item d-flex align-items-center justify-content-center">';
															
																if ( $brand['logo'] ) 
																{
																	printf( 
																		'<img src="%s" class="img-fluid" alt="%s">', 
																		esc_url( $brand['logo']['url'] ), 
																		$brand['logo']['alt'] 
																	);
																}

															echo '</a>';
														echo '</li>';
													}

												echo '</ul>';
											echo '</div>';
										}

										if ( $button ) 
										{
											printf( 
												'<div class="text-center">
													<a href="%s" class="btn" target="%s">%s</a>
												</div>', 
												esc_url( $button['url'] ), 
												$button['target'], 
												$button['title'] 
											);
										}

									echo '</div>';
								}
								
							echo '</div>';
						echo '</section>';
					}
				}

				if ( get_row_layout() == 'testimonial' ) 
				{
					$image = get_sub_field( 'image' );
					$quote = get_sub_field( 'quote' );
					$name = get_sub_field( 'name' );
					$position = get_sub_field( 'position' );
					$class = get_sub_field( 'class' );

					if ( $image || $quote || $name || $position ) 
					{
						echo '<section class="testimonial '.( $class ).'">';
							echo '<div class="container">';
								echo '<div class="background">';

									if ( $image ) 
									{
										printf( 
											'<div class="media">
												<img src="%s" class="img-fluid" alt="%s">
											</div>', 
											esc_url( $image['url'] ), 
											$image['alt'] 
										);
									}

									if ( $quote || $name || $position ) 
									{
										echo '<div class="text">';
											echo '<span class="icon-quote-left"></span>';

											if ( $quote ) 
											{
												printf( 
													'<div class="quote">%s</div>',  
													$quote
												);
											}

											if ( $name || $position ) 
											{
												echo '<span class="name">';

													if ( $name ) 
													{
														printf( 
															'%s',  
															$name
														);
													}

													if ( $name && $position ) 
													{
														echo '<br>';														
													}

													if ( $position ) 
													{
														printf( 
															'%s',  
															$position
														);														
													}

												echo '</span>';
											}

										echo '</div>';
									}

								echo '</div>';
							echo '</div>';
						echo '</section>';
					}
				}

				if ( get_row_layout() == 'reviews' ) 
				{
					$title = get_sub_field( 'title' );
					$reviews = get_sub_field( 'reviews' );
					$class = get_sub_field( 'class' );

					if ( $title || $reviews ) 
					{
						echo '<section class="testimonials '.( $class ).'">';
							echo '<div class="container">';

								if ( $title ) 
								{
									printf( 
										'<div class="entry-title text-center mx-auto">
											<h2 class="title">%s</h2>
										</div>',  
										$title
									);
								}

								if ( $reviews ) 
								{
									echo '<div class="row lr-10 minus">';

										foreach ( $reviews as $review ) 
										{
											echo '<div class="'.( count( $reviews ) > 1 ? 'col-sm-6' : 'col-sm-12').'">';
												echo '<div class="testimonials__item">';

													if ( isset($review['star']) ) 
													{
													    echo '<div class="ratings">';
													    
													    $fullStars = floor( $review['star'] );
													    $halfStar = ( $review['star'] - $fullStars ) >= 0.5 ? 1 : 0;
													    $emptyStars = 5 - ( $fullStars + $halfStar );

													    for ( $i = 0; $i < $fullStars; ++$i) 
													    {
													        echo '<span class="icon-star"></span>';
													    }

													    if ( $halfStar ) 
													    {
													        echo '<span class="icon-star-half-alt"></span>';
													    }

													    for ( $i = 0; $i < $emptyStars; ++$i ) 
													    {
													        echo '<span class="icon-star-empty"></span>';
													    }

													    echo '</div>';
													}

													if ( $review['title'] || $review['message'] ) 
													{
														echo '<div class="text">';

															if ( $review['title'] ) 
															{
																printf( 
																	'<h6 class="title">%s</h6>',  
																	$review['title']
																);
															}

															if ( $review['message'] ) 
															{
																printf( 
																	'<div class="description">%s</div>',  
																	$review['message']
																);
															}

														echo '</div>';
													}

													if ( $review['name'] || $review['image'] ) 
													{
														echo '<div class="meta d-flex align-items-center">';

															if ( $review['image'] ) 
															{
																printf( 
																	'<img src="%s" class="img-fluid" alt="%s">', 
																	esc_url( $review['image']['url'] ), 
																	$review['image']['alt'] 
																);
															}

															if ( $review['name'] ) 
															{
																printf( 
																	'<span class="name">/ %s</span>',  
																	$review['name']
																);
															}
														echo '</div>';
													}

												echo '</div>';
											echo '</div>';
										}

									echo '</div>';
								}

							echo '</div>';
						echo '</section>';
					}
				}

				if ( get_row_layout() == 'stories' ) 
				{
					$title = get_sub_field( 'title' );
					$description = get_sub_field( 'description' );
					$stories = get_sub_field( 'stories' );
					$class = get_sub_field( 'class' );

					if ( $title || $description || $stories ) 
					{
						echo '<section class="success-stories '.( $class ).'">';
							echo '<div class="container">';

								if ( $title || $description ) 
								{
									echo '<div class="entry-title">';

										if ( $title ) 
										{
											printf( 
												'<h2 class="title">%s</h2>',  
												$title
											);
										}

										if ( $description ) 
										{
											printf( 
												'<div class="description h6 font-weight-normal">%s</div>',  
												$description
											);
										}

									echo '</div>';
								}

								if ( $stories ) 
								{
									echo '<div class="row lr-10 minus">';

										foreach ( $stories as $key => $story ) 
										{
											echo '<div class="col-lg-4 col-sm-6">';
												echo '<a'.( $story['button'] ? ' href="'.( $story['button']['url'] ).'" target="'.( $story['button']['target'] ).'"' : '').' class="success-stories__item d-flex flex-wrap justify-content-between">';

													if ( $story['image'] ) 
													{
														printf( 
															'<div class="media">
																<img src="%s" class="img-fluid" alt="%s">
															</div>', 
															esc_url( $story['image']['url'] ), 
															$story['image']['alt'] 
														);
													}

													if ( $story['title'] || $story['button'] ) 
													{
														echo '<div class="text">';

															if ( $story['title'] ) 
															{
																printf( 
																	'<h6 class="title">%s</h6>',  
																	$story['title']
																);
															}

															if ( $story['button'] ) 
															{
																printf( 
																	'<button class="btn">%s</button>',  
																	$story['button']['title']
																);
															}

														echo '</div>';
													}

												echo '</a>';
											echo '</div>';
										}

									echo '</div>';
								}
								
							echo '</div>';
						echo '</section>';
					}
				}

				if ( get_row_layout() == 'steps' ) 
				{
					$title = get_sub_field( 'title' );
					$description = get_sub_field( 'description' );
					$steps = get_sub_field( 'steps' );
					$class = get_sub_field( 'class' );

					if ( $title || $description || $steps ) 
					{
						echo '<section class="step-started '.( $class ).'">';
							echo '<div class="container">';

								if ( $title || $description ) 
								{
									echo '<div class="entry-title">';

										if ( $title ) 
										{
											printf( 
												'<h2 class="title">%s</h2>',  
												$title
											);
										}

										if ( $description ) 
										{
											printf( 
												'<div class="description h6 font-weight-normal">%s</div>',  
												$description
											);
										}

									echo '</div>';
								}

								if ( $steps ) 
								{
									echo '<div class="row lr-10 minus">';

										foreach ( $steps as $key => $step ) 
										{
											echo '<div class="col-lg-4 col-sm-6">';
												echo '<div class="step-started__item text-center">';

													if ( $step['title'] ) 
													{
														printf( 
															'<span class="step">%s</span>',  
															$step['title']
														);

													}
													else
													{
														printf( 
															'<span class="step">Step %s.</span>',  
															( $key + 1 )
														);
													}

													if ( $step['icon'] ) 
													{
														printf( 
															'<div class="media justify-content-center">
																<img src="%s" class="img-fluid" alt="%s">
															</div>', 
															esc_url( $step['icon']['url'] ), 
															$step['icon']['alt'] 
														);
													}

													if ( $step['description'] ) 
													{
														printf( 
															'<div class="description">%s</div>',  
															$step['description']
														);
													}

												echo '</div>';
											echo '</div>';
										}

									echo '</div>';
								}
								
							echo '</div>';
						echo '</section>';
					}
				}

				if ( get_row_layout() == 'faqs' ) 
				{
					$title = get_sub_field( 'title' );
					$description = get_sub_field( 'description' );
					$faqs = get_sub_field( 'faqs' );
					$class = get_sub_field( 'class' );

					if ( $title || $description || $faqs ) 
					{
						echo '<section class="faqs '.( $class ).'">';
							echo '<div class="container">';

								if ( $title || $description ) 
								{
									echo '<div class="entry-title">';

										if ( $title ) 
										{
											printf( 
												'<h2 class="title">%s</h2>',  
												$title
											);
										}

										if ( $description ) 
										{
											printf( 
												'<div class="description h6 font-weight-normal">%s</div>',  
												$description
											);
										}

									echo '</div>';
								}

								if ( $faqs ) 
								{
									echo '<div id="faqs-accordion-'.$sec.'" class="faqs__accordion">';

										foreach ( $faqs as $key => $faq ) 
										{
											echo '<div class="card'.( $key == 0 ? ' show' : '').'" data-toggle="collapse" data-target="#faqs-accordion-'.$sec.'-faq-'.( $key + 1).'" aria-expanded="'.( $key == 0 ? 'true' : 'false').'" aria-controls="faqs-accordion-'.$sec.'-faq-'.( $key + 1 ).'">';

												if ( $faq['question'] ) 
												{
													printf( 
														'<div class="card-header">%s</div>',  
														$faq['question']
													);
												}

												if ( $faq['answer'] ) 
												{
													printf( 
														'<div id="faqs-accordion-%s-faq-%s" class="collapse%s" data-parent="#faqs-accordion-%s">
															<div class="card-body">
																<div class="content__editor">%s</div>
															</div>
														</div>', 
														$sec,
														( $key + 1 ),
														( $key == 0 ? ' show' : ''),
														$sec, 
														$faq['answer']
													);
												}

											echo '</div>';
										}

									echo '</div>';
								}
								
							echo '</div>';
						echo '</section>';
					}
				}

				if ( get_row_layout() == 'call_action' ) 
				{
					$image = get_sub_field( 'image' );
					$title = get_sub_field( 'title' );
					$description = get_sub_field( 'description' );
					$button = get_sub_field( 'button' );
					$class = get_sub_field( 'class' );

					if ( $image || $title || $description || $button ) 
					{
						echo '<section class="call-action '.( $class ).'">';
							echo '<div class="container">';
								echo '<div class="background d-md-flex align-items-center">';

									if ( $image ) 
									{
										printf( 
											'<div class="media">
												<img src="%s" class="img-fluid" alt="%s">
											</div>', 
											esc_url( $image['url'] ), 
											$image['alt'] 
										);
									}

									if ( $title || $description || $button ) 
									{
										echo '<div class="text">';

											if ( $title ) 
											{
												printf( 
													'<h2 class="title text-white">%s</h2>',  
													$title
												);
											}

											if ( $description ) 
											{
												printf( 
													'<div class="description h6 font-weight-normal">%s</div>',  
													$description
												);
											}

											if ( $button ) 
											{
												printf( 
													'<a href="%s" class="btn" target="%s">%s</a>', 
													esc_url( $button['url'] ), 
													$button['target'], 
													$button['title'] 
												);
											}

										echo '</div>';
									}
									
								echo '</div>';
							echo '</div>';
						echo '</section>';
					}
				}

				$sec++;
			}

		echo '</div>';
	}

get_footer();