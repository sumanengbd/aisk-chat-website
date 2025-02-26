<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php 
        echo '<title>';

            if ( is_front_page() ) { 
                echo 'Home'; 
                echo ' | '; 
                echo bloginfo('name'); 
            } else { 
                wp_title(''); 
                echo ' | '; 
                bloginfo('name');  
            } 

        echo '</title>';

        if ( has_site_icon() ) 
        {
            wp_site_icon(); 
        }

        if ( is_single() ) 
        {
            echo '<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=67b2e0323c04610012ab7070&product=inline-share-buttons" async="async"></script>';
        }

        wp_head(); 
    ?>
</head>
<body <?php body_class( ( isset( $args['bodyclass'] ) && $args['bodyclass'] ? $args['bodyclass'] : '' ) ); ?>>
    <div class="overflow-hidden">

        <div id="sidr">
            <div class="mobile-header d-none">
                <div class="navbar-header d-flex align-items-center justify-content-between">
                    <div class="logo">
                        <a class="navbar-brand" href="index.html">
                            <img src="<?php echo get_theme_file_uri(); ?>/images/logo-white.png" class="img-fluid" alt="">
                        </a>
                    </div>

                    <button class="navbar-toggle in">
                        <i class="icon-close"></i>
                    </button>
                </div>

                <div class="navigation">
                    <div class="aisk-chat-mobile-nav">
                        <ul class="nav navbar-nav navbar-mobile">
                            <li><a href="#">Home</a></li>
                            <li class="dropdown megamenu">
                                <a href="#">Features <span class="dropdown-toggle" data-toggle="dropdown"></span></a>

                                <ul class="dropdown-menu">
                                    <div class="row">
                                        <li class="col-md-4 title has-button has-button has-description">
                                            <a href="#">
                                                <span class="btn">Learn more about us</span>
                                                <span class="description">Learn more about our awesome company and why we’re so great</span>
                                                Features
                                            </a>
                                        </li>

                                        <li class="col-md-4 has-icon-box dropdown empty">
                                            <ul class="dropdown-menu">
                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-document"></span>

                                                        <div class="text">
                                                            <h6 class="title">System status</h6>
                                                            <div class="description">
                                                                <p>Check the status of our services to see if all systems are operational.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-integrations"></span>

                                                        <div class="text">
                                                            <h6 class="title">Help center</h6>
                                                            <div class="description">
                                                                <p>Explore our help center for quick and reliable answers.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-blog"></span>

                                                        <div class="text">
                                                            <h6 class="title">Blog</h6>
                                                            <div class="description">
                                                                <p>News and writings, press releases, and press resources.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-roadmap"></span>

                                                        <div class="text">
                                                            <h6 class="title">Roadmap</h6>
                                                            <div class="description">
                                                                <p>Find out what’s next and vote on features you’d love to see.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="col-md-4 dropdown has-action-box empty">
                                            <ul class="dropdown-menu">
                                                <div class="action-box">
                                                    <div class="action-box__text">
                                                        <h5 class="title">Aisk: The AI Chatbot for WordPress & WooCommerce</h5>
                                                        <div class="description">
                                                            <p>Automate customer support, boost product discovery, and increase sales with just a few clicks.</p>
                                                        </div>
                                                        <a href="#" class="btn">14-day free trial</a>
                                                    </div>

                                                    <div class="action-box__overlay">
                                                        <img src="<?php echo get_theme_file_uri(); ?>/images/header-action-box.png">
                                                    </div>
                                                </div>
                                            </ul>
                                        </li>
                                    </div>
                                </ul>
                            </li>

                            <li class="dropdown megamenu">
                                <a href="#">Blog <span class="dropdown-toggle" data-toggle="dropdown"></span></a>

                                <ul class="dropdown-menu">
                                    <div class="row">
                                        <li class="col-md-4 has-icon-box dropdown empty">
                                            <ul class="dropdown-menu">
                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-document"></span>

                                                        <div class="text">
                                                            <h6 class="title">System status</h6>
                                                            <div class="description">
                                                                <p>Check the status of our services to see if all systems are operational.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-integrations"></span>

                                                        <div class="text">
                                                            <h6 class="title">Help center</h6>
                                                            <div class="description">
                                                                <p>Explore our help center for quick and reliable answers.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-blog"></span>

                                                        <div class="text">
                                                            <h6 class="title">Blog</h6>
                                                            <div class="description">
                                                                <p>News and writings, press releases, and press resources.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-roadmap"></span>

                                                        <div class="text">
                                                            <h6 class="title">Roadmap</h6>
                                                            <div class="description">
                                                                <p>Find out what’s next and vote on features you’d love to see.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="col-md-4 has-icon-box dropdown empty">
                                            <ul class="dropdown-menu">
                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-document"></span>

                                                        <div class="text">
                                                            <h6 class="title">System status</h6>
                                                            <div class="description">
                                                                <p>Check the status of our services to see if all systems are operational.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-integrations"></span>

                                                        <div class="text">
                                                            <h6 class="title">Help center</h6>
                                                            <div class="description">
                                                                <p>Explore our help center for quick and reliable answers.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-blog"></span>

                                                        <div class="text">
                                                            <h6 class="title">Blog</h6>
                                                            <div class="description">
                                                                <p>News and writings, press releases, and press resources.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-roadmap"></span>

                                                        <div class="text">
                                                            <h6 class="title">Roadmap</h6>
                                                            <div class="description">
                                                                <p>Find out what’s next and vote on features you’d love to see.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="col-md-4 dropdown has-action-box empty">
                                            <ul class="dropdown-menu">
                                                <div class="action-box">
                                                    <div class="action-box__text">
                                                        <h5 class="title">Aisk: The AI Chatbot for WordPress & WooCommerce</h5>
                                                        <div class="description">
                                                            <p>Automate customer support, boost product discovery, and increase sales with just a few clicks.</p>
                                                        </div>
                                                        <a href="#" class="btn">14-day free trial</a>
                                                    </div>

                                                    <div class="action-box__overlay">
                                                        <img src="<?php echo get_theme_file_uri(); ?>/images/header-action-box.png">
                                                    </div>
                                                </div>
                                            </ul>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>

                    <ul class="nav navbar-nav">
                        <li class="menu-btn"><a href="#">Request a Demo</a></li>
                    </ul>
                </div>
            </div>
        </div><!-- /mobile-header -->

        <header class="header">
            <div class="container">
                <div class="navbar navbar-expand d-flex align-items-center justify-content-between">
                    <div class="navbar-header d-lg-none d-flex align-items-center">
                        <div class="logo">
                            <a class="navbar-brand" href="index.html">
                                <img src="<?php echo get_theme_file_uri(); ?>/images/logo-white.png" class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
            
                    <div class="collapse navbar-collapse justify-content-lg-between">
                        <div class="logo d-lg-block d-none">
                            <a class="navbar-brand" href="index.html">
                                <img src="<?php echo get_theme_file_uri(); ?>/images/logo-white.png" class="img-fluid" alt="">
                            </a>
                        </div>

                        <ul class="nav navbar-nav">
                            <li><a href="#">Home</a></li>
                            <li class="dropdown megamenu">
                                <a href="#">Features <span class="dropdown-toggle" data-toggle="dropdown"></span></a>

                                <ul class="dropdown-menu">
                                    <div class="row">
                                        <li class="col-md-4 title has-button has-button has-description">
                                            <a href="#">
                                                <span class="btn">Learn more about us</span>
                                                <span class="description">Learn more about our awesome company and why we’re so great</span>
                                                Features
                                            </a>
                                        </li>

                                        <li class="col-md-4 dropdown has-icon-box empty">
                                            <ul class="dropdown-menu">
                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-document"></span>

                                                        <div class="text">
                                                            <h6 class="title">System status</h6>
                                                            <div class="description">
                                                                <p>Check the status of our services to see if all systems are operational.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-integrations"></span>

                                                        <div class="text">
                                                            <h6 class="title">Help center</h6>
                                                            <div class="description">
                                                                <p>Explore our help center for quick and reliable answers.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-blog"></span>

                                                        <div class="text">
                                                            <h6 class="title">Blog</h6>
                                                            <div class="description">
                                                                <p>News and writings, press releases, and press resources.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-roadmap"></span>

                                                        <div class="text">
                                                            <h6 class="title">Roadmap</h6>
                                                            <div class="description">
                                                                <p>Find out what’s next and vote on features you’d love to see.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="col-md-4 dropdown has-action-box empty">
                                            <div class="action-box">
                                                <div class="action-box__text">
                                                    <h5 class="title">Aisk: The AI Chatbot for WordPress & WooCommerce</h5>
                                                    <div class="description">
                                                        <p>Automate customer support, boost product discovery, and increase sales with just a few clicks.</p>
                                                    </div>
                                                    <a href="#" class="btn">14-day free trial</a>
                                                </div>

                                                <div class="action-box__overlay">
                                                    <img src="<?php echo get_theme_file_uri(); ?>/images/header-action-box.png">
                                                </div>
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                            <li class="dropdown megamenu">
                                <a href="#">Blog <span class="dropdown-toggle" data-toggle="dropdown"></span></a>

                                <ul class="dropdown-menu">
                                    <div class="row">
                                        <li class="col-md-4 dropdown has-icon-box empty">
                                            <ul class="dropdown-menu">
                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-document"></span>

                                                        <div class="text">
                                                            <h6 class="title">System status</h6>
                                                            <div class="description">
                                                                <p>Check the status of our services to see if all systems are operational.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-integrations"></span>

                                                        <div class="text">
                                                            <h6 class="title">Help center</h6>
                                                            <div class="description">
                                                                <p>Explore our help center for quick and reliable answers.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-blog"></span>

                                                        <div class="text">
                                                            <h6 class="title">Blog</h6>
                                                            <div class="description">
                                                                <p>News and writings, press releases, and press resources.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-roadmap"></span>

                                                        <div class="text">
                                                            <h6 class="title">Roadmap</h6>
                                                            <div class="description">
                                                                <p>Find out what’s next and vote on features you’d love to see.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="col-md-4 dropdown has-icon-box empty">
                                            <ul class="dropdown-menu">
                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-document"></span>

                                                        <div class="text">
                                                            <h6 class="title">System status</h6>
                                                            <div class="description">
                                                                <p>Check the status of our services to see if all systems are operational.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-integrations"></span>

                                                        <div class="text">
                                                            <h6 class="title">Help center</h6>
                                                            <div class="description">
                                                                <p>Explore our help center for quick and reliable answers.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-blog"></span>

                                                        <div class="text">
                                                            <h6 class="title">Blog</h6>
                                                            <div class="description">
                                                                <p>News and writings, press releases, and press resources.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="icon-box">
                                                    <a href="#" class="icon-box__item">
                                                        <span class="icon-roadmap"></span>

                                                        <div class="text">
                                                            <h6 class="title">Roadmap</h6>
                                                            <div class="description">
                                                                <p>Find out what’s next and vote on features you’d love to see.</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="col-md-4 dropdown has-action-box empty">
                                            <div class="action-box">
                                                <div class="action-box__text">
                                                    <h5 class="title">Aisk: The AI Chatbot for WordPress & WooCommerce</h5>
                                                    <div class="description">
                                                        <p>Automate customer support, boost product discovery, and increase sales with just a few clicks.</p>
                                                    </div>
                                                    <a href="#" class="btn">14-day free trial</a>
                                                </div>

                                                <div class="action-box__overlay">
                                                    <img src="<?php echo get_theme_file_uri(); ?>/images/header-action-box.png">
                                                </div>
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                            <li><a href="#">Contact</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-nav-right">
                            <li class="menu-btn"><a href="#">Get Started</a></li>

                            <li class="mobile-navbar-toggler d-lg-none">
                                <button class="navbar-toggle" type="button">
                                    <span class="icon-bar"><span class="inner"></span></span>
                                    <span class="icon-bar"><span class="inner"></span></span>
                                    <span class="icon-bar"><span class="inner"></span></span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <?php
            if ( !isset( $args['gutter_disable'] ) && !$args['gutter_disable'] ) 
            {
                echo '<div class="header-gutter"></div>';
            }
        ?>