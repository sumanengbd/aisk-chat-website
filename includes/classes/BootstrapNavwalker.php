<?php

/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class wp_bootstrap_navwalker extends Walker_Nav_Menu {

	/**
	 * Check if the current URL exactly matches the given URL.
	 *
	 * @param string $url The URL to check.
	 * @return bool Whether the current URL exactly matches the given URL.
	 */
	private function is_current_url_exact_match( $url ) {
	   $current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	   return ( $url && $current_url === $url );
	}

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) 
		{
			$t = '';
			$n = '';
		} 
		else 
		{
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		// Default class.
		$classes = array( 'dropdown-menu' );

		/**
		 * Filters the CSS class(es) applied to a menu list element.
		 *
		 * @since 4.8.0
		 *
		 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
		 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= "{$n}{$indent}<ul$class_names>{$n}";
		$output .= "{$n}{$indent}<div class=\"row\">{$n}";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) 
		{
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent  = str_repeat( $t, $depth );
		$output .= "$indent</div>{$n}";
		$output .= "$indent</ul>{$n}";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$mm_icon = '';
		$description = '';

		$enable_mega_menu = get_field( 'enable_mega_menu', $item );
		$mm_options = get_field( 'mm_options', $item );
		$mm_image = get_field( 'mm_image', $item );
		$mm_button = get_field( 'mm_button', $item );

		if ( $mm_options !== null && $mm_options == 'icon' ) 
		{
			$mm_icon = get_field( 'mm_icon', $item );
		}

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) 
		{
			$output .= $indent . '<li role="presentation" class="divider">';
		} 
		else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) 
		{
			$output .= $indent . '<li role="presentation" class="divider">';
		} 
		else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) 
		{
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} 
		else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) 
		{
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} 
		else 
		{
			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children ) 
			{
				$class_names .= ' dropdown';
			}

			if ( $enable_mega_menu ) 
			{
				$class_names .= ' megamenu';
			}

			if ( $mm_options == 'icon' ) 
			{
				$class_names .= ' has-icon-box'; 
			}

			if ( $mm_options == 'action' ) 
			{
				$class_names .= ' has-action-box'; 
			}

			if ( $item->description ) 
			{
				$class_names .= ' has-description'; 
			}

			if ( in_array( 'current-menu-item', $classes ) ) 
			{
				$class_names .= ' active';
			}

			if ( strcasecmp( $item->attr_title, 'empty' ) == 0 )
			{
				$class_names .= ' empty';
			}

			if ( $mm_icon ) 
			{
				$mm_icon = '<span class="'.$mm_icon.'"></span>';
			}

			if ( $mm_image ) 
			{
				$mm_image = '<div class="media">
					<img src="'.esc_url( $mm_image['url'] ).'" alt="'.$mm_image['alt'].'">
				</div>';
			}

			if ( $mm_button ) 
			{
				$mm_button = '<span class="btn">'.$mm_button.'</span>';
			}

			if ( $item->description ) 
			{
				$description = '<span class="description">' . esc_attr( $item->description ) . '</span>';
			}

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) 
			{
				$atts['href']   		= $item->url;
				$atts['aria-haspopup']	= 'true';
			} 
			else 
			{
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) 
			{
				if ( ! empty( $value ) ) 
				{
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
			if ( $item->attr_title == 'empty' ) 
			{
				$item_output .= '';
			}
			elseif ( $mm_options == 'action' ) 
			{
				$item_output .= '<a'. $attributes .' class="action-box">';
			}
			elseif ( $mm_options == 'icon' ) 
			{
				$item_output .= '<a'. $attributes .' class="icon-box__item">';
			}
			elseif ( ! empty( $item->attr_title ) ) 
			{
				$item_output .= '<a'. $attributes .'><span class="' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
			}
			else
			{
				$item_output .= '<a'. $attributes .'>';
			}

			if ( $mm_options == 'icon' && $mm_icon ) 
			{
				$item_output .= $args->link_before . $mm_icon . '<div class="text">' . '<span class="title">' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>'. $description . '</div>' . $args->link_after;
			}
			elseif ( $mm_options == 'action' && $mm_image || $description || $mm_button ) 
			{
				$item_output .= $args->link_before . $mm_image . '<div class="text">' . '<span class="title">' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>'. $description . $mm_button  . '</span>' . '</div>' . $args->link_after;
			}
			elseif ( $item->attr_title !== 'empty' ) 
			{
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			}

			$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="dropdown-toggle" data-toggle="dropdown"></span></a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo $fb_output;
		}
	}
}