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
                        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php
                                $logo = get_field( 'logo', 'options' );
                                $logo_mobile = get_field( 'logo_mobile', 'options' );

                                if ( $logo_mobile ) 
                                {
                                    printf(
                                        '<img src="%s" class="img-fluid" alt="%s">', 
                                        esc_url( $logo_mobile['url'] ), 
                                        $logo_mobile['alt']
                                    );
                                }
                                else
                                {
                                    printf(
                                        '<img src="%s" class="img-fluid" alt="%s">', 
                                        esc_url( get_theme_file_uri('images/logo-mobile.svg') ), 
                                        get_bloginfo('name')
                                    );
                                }
                            ?>
                        </a>
                    </div>

                    <button class="navbar-toggle in">
                        <i class="icon-close"></i>
                    </button>
                </div>

                <div class="navigation">
                    <?php
                        echo '<div class="aisk-chat-mobile-nav">';

                            wp_nav_menu( array(
                                'depth'              => 3,
                                'container'          => false,
                                'theme_location'     => 'menu-1',
                                'menu'               => 'Primary Menu Mobile',
                                'menu_id'            => 'primary-menu-mobile',
                                'menu_class'         => 'nav navbar-nav navbar-mobile sscroll',
                                'fallback_cb'        => 'wp_bootstrap_navwalker::fallback',
                                'walker'             => new wp_bootstrap_navwalker(),
                            ));

                        echo '</div>';

                        wp_nav_menu( array(
                            'depth'              => 1,
                            'container'          => false,
                            'theme_location'     => 'menu-2',
                            'menu_class'         => 'nav navbar-nav',
                            'menu'               => 'Secondary Menu Mobile',
                            'menu_id'            => 'secondary-menu-mobile',
                            'fallback_cb'        => 'wp_bootstrap_navwalker::fallback',
                            'walker'             => new wp_bootstrap_navwalker(),
                        ));
                    ?>
                </div>
            </div>
        </div><!-- /mobile-header -->

        <header class="header">
            <div class="container">
                <div class="navbar navbar-expand d-flex align-items-center justify-content-between">
                    <div class="navbar-header d-lg-none d-flex align-items-center">
                        <div class="logo">
                            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <?php
                                    if ( $logo ) 
                                    {
                                        printf(
                                            '<img src="%s" class="img-fluid" alt="%s">', 
                                            esc_url( $logo['url'] ), 
                                            $logo['alt']
                                        );
                                    }
                                    else
                                    {
                                        printf(
                                            '<img src="%s" class="img-fluid" alt="%s">', 
                                            esc_url( get_theme_file_uri('images/logo.svg') ), 
                                            get_bloginfo('name')
                                        );
                                    }
                                ?>
                            </a>
                        </div>
                    </div>
            
                    <div class="collapse navbar-collapse justify-content-lg-between">
                        <?php
                            echo '<div class="logo d-lg-block d-none">';
                                echo '<a class="navbar-brand" href="'.esc_url( home_url( '/' ) ).'">';

                                    if ( $logo ) 
                                    {
                                        printf(
                                            '<img src="%s" class="img-fluid" alt="%s">', 
                                            esc_url( $logo['url'] ), 
                                            $logo['alt']
                                        );
                                    }
                                    else
                                    {
                                        printf(
                                            '<img src="%s" class="img-fluid" alt="%s">', 
                                            esc_url( get_theme_file_uri('images/logo.svg') ), 
                                            get_bloginfo('name')
                                        );
                                    }

                                echo '</a>';
                            echo '</div>';

                            wp_nav_menu( array(
                                'depth'              => 3,
                                'container'          => false,
                                'theme_location'     => 'menu-1',
                                'menu'               => 'Primary Menu',
                                'menu_id'            => 'primary-menu',
                                'menu_class'         => 'nav navbar-nav sscroll',
                                'fallback_cb'        => 'wp_bootstrap_navwalker::fallback',
                                'walker'             => new wp_bootstrap_navwalker(),
                            ));

                            wp_nav_menu( array(
                                'depth'              => 1,
                                'container'          => false,
                                'theme_location'     => 'menu-2',
                                'menu'               => 'Secondary Menu',
                                'menu_id'            => 'secondary-menu',
                                'menu_class'         => 'nav navbar-nav navbar-nav-right',
                                'fallback_cb'        => 'wp_bootstrap_navwalker::fallback',
                                'walker'             => new wp_bootstrap_navwalker(),
                            ));
                        ?>
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