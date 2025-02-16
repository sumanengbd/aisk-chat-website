<?php
/**
 * This is a PHP file containing the code for the acf_field_gravity_forms class.
 *
 * @package Advanced_Custom_Fields_Pro
 */
if ( !class_exists('acf_field_gravity_forms') ) {
	
	class acf_field_gravity_forms extends acf_field {

		function __construct() {
			$this->name = 'gravity_forms_field';
			$this->label = __('Gravity Forms');
			$this->category = __("Relational", 'capitalcarpet');
			$this->defaults = array(
				'allow_multiple' => 0,
				'allow_null' => 0
			);

			parent::__construct();
		}
	  
		function render_field_settings( $field ) {
			acf_render_field_setting( $field, 
				array(
					'label' => 'Allow Null?',
					'type'  =>  'radio',
					'name'  =>  'allow_null',
					'choices' =>  array(
						1 =>  __("Yes", 'capitalcarpet'),
						0 =>  __("No", 'capitalcarpet'),
					),
					'layout'  =>  'horizontal'
				)
			);

			acf_render_field_setting( $field, 
				array(
					'label' => 'Allow Multiple?',
					'type'  =>  'radio',
					'name'  =>  'allow_multiple',
					'choices' =>  array(
						1 =>  __("Yes", 'capitalcarpet'),
						0 =>  __("No", 'capitalcarpet'),
					),
					'layout'  =>  'horizontal'
				)
			);
		}
		  
		function render_field( $field ) {

			$field = array_merge($this->defaults, $field);
			$choices = array();

			if ( class_exists('RGFormsModel')) {
				$forms = RGFormsModel::get_forms(1);
			} else {
				echo "<font style='color:red;font-weight:bold;'>Warning: Gravity Forms is not installed or activated. This field does not function without Gravity Forms!</font>";
			}
			
			if ( isset($forms) ) {

			  	foreach( $forms as $form ) {
					$choices[ intval($form->id) ] = ucfirst($form->title);
			  	}
			}

			$field['choices'] = $choices;
			$field['type'] = 'select';

			if ( $field['allow_multiple'] ) {
				$multiple = 'multiple="multiple" data-multiple="1"';
				echo "<input type=\"hidden\" name=\"{$field['name']}\">";
			}
			else $multiple = ''; ?>
			<select id="<?php echo str_replace(array('[',']'), array('-',''), $field['name']);?>" name="<?php echo $field['name']; if( $field['allow_multiple'] ) echo "[]"; ?>"<?php echo $multiple; ?>>
				<?php
				if ( $field['allow_null'] ) 
					echo '<option value="">- Select -</option>';
					
				foreach ($field['choices'] as $key => $value){
					$selected = '';
					if ( (is_array($field['value']) && in_array($key, $field['value'])) || $field['value'] == $key )
						$selected = ' selected="selected"';
				?>
					<option value="<?php echo $key; ?>"<?php echo $selected;?>><?php echo $value; ?></option>
				<?php } ?>
			</select>
			<?php
		}

		function format_value( $value, $post_id, $field ) {
				
			if ( !$value || empty($value) ) {
				return false;
			}
				
			if ( is_array($value) && !empty($value) ) {
				$form_objects = array();

				foreach($value as $k => $v) {
					$form = GFAPI::get_form( $v );

					if ( !is_wp_error($form) ) {
						$form_objects[$k] = $form;
					}
				}

				if ( !empty($form_objects) ) {
					return $form_objects;   
				} else {
					return false;
				}
			} else {
				$form = GFAPI::get_form(intval($value));

				if ( !is_wp_error($form) ) {
					return $form;   
				} else {
					return false;
				}
			}
		}
	}

	// create field
	new acf_field_gravity_forms();
}

/**
 * This is a PHP file containing the code for the acf_field_post_type class.
 *
 * @package Advanced_Custom_Fields_Pro
 */
if ( !class_exists('acf_field_post_type') ) {

	class acf_field_post_type extends acf_field {

		function __construct() {
			$this->name = 'post_type_field';
			$this->label = __('Post Type');
			$this->category = __("Relational", 'capitalcarpet');
			$this->defaults = array(
				'allow_null' => 0
			);

			parent::__construct();
		}
	  
		function render_field_settings( $field ) {
			acf_render_field_setting( $field, 
				array(
					'label' => 'Allow Null?',
					'type'  =>  'radio',
					'name'  =>  'allow_null',
					'choices' =>  array(
						1 =>  __("Yes", 'capitalcarpet'),
						0 =>  __("No", 'capitalcarpet'),
					),
					'layout'  =>  'horizontal'
				)
			);
		}

		function render_field( $field ) {

			$field = array_merge($this->defaults, $field);

			$args=array(
				'public' => true,
				'_builtin' => false
			); 

			$output = 'objects';
			$operator = 'and';
			$post_types = get_post_types($args, $output, $operator);
			$posttypes_array = wp_list_pluck( $post_types, 'label', 'name');

			$field['choices'] = $posttypes_array; ?>
			<select id="<?php echo str_replace(array('[',']'), array('-',''), $field['name']);?>" name="<?php echo $field['name']; ?>">
				<?php
				if ( $field['allow_null'] ) 
					echo '<option value="">- Select Post Type -</option>';
					
				foreach ($field['choices'] as $key => $value){
					$selected = '';
					if ( (is_array($field['value']) && in_array($key, $field['value'])) || $field['value'] == $key )
						$selected = ' selected="selected"';
				?>
					<option value="<?php echo $key; ?>"<?php echo $selected;?>><?php echo $value; ?></option>
				<?php } ?>
			</select>
			<?php
		}
	}

	// create field
	new acf_field_post_type();
}

/**
 * This is a PHP file containing the code for the acf_field_menu class.
 *
 * @package Advanced_Custom_Fields_Pro
 */
if ( !class_exists('acf_field_menu') ) {

	class acf_field_menu extends acf_field {

		function __construct() {
			$this->name     = 'nav_menu';
			$this->label    = esc_html__( 'Select Menu', 'capitalcarpet' );
			$this->category = 'choice';
			$this->defaults = array(
				'save_format' => 'menu',
				'allow_null'  => 0,
				'container'   => 'div',
			);
			parent::__construct();
		}

		function render_field_settings( $field ) {
			acf_render_field_setting( $field, array(
				'label'        => esc_html__( 'Return Value', 'capitalcarpet' ),
				'instructions' => esc_html__( 'Specify the returned value on front end', 'capitalcarpet' ),
				'type'         => 'radio',
				'name'         => 'save_format',
				'layout'       => 'horizontal',
				'choices'      => array(
					'menu'   => esc_html__( 'Nav Menu HTML', 'capitalcarpet' ),
					'object' => esc_html__( 'Nav Menu Object', 'capitalcarpet' ),
					'id'     => esc_html__( 'Nav Menu ID', 'capitalcarpet' ),
				),
			) );

			acf_render_field_setting( $field, array(
				'label'        => esc_html__( 'Menu Container', 'capitalcarpet' ),
				'instructions' => esc_html__( "What to wrap the Menu's ul with (when returning HTML only)", 'capitalcarpet' ),
				'type'         => 'select',
				'name'         => 'container',
				'choices'      => $this->get_allowed_nav_container_tags(),
			) );

			acf_render_field_setting( $field, array(
				'label'        => esc_html__( 'Allow Null?', 'capitalcarpet' ),
				'type'         => 'radio',
				'name'         => 'allow_null',
				'layout'       => 'horizontal',
				'choices'      => array(
					1 => esc_html__( 'Yes', 'capitalcarpet' ),
					0 => esc_html__( 'No', 'capitalcarpet' ),
				),
			) );
		}

		function get_allowed_nav_container_tags() {
			$formatted_tags = array('0' => 'None');
			$tags = apply_filters( 'wp_nav_menu_container_allowedtags', array( 'div', 'nav' ) );

			foreach ( $tags as $tag ) {
				$formatted_tags[$tag] = ucfirst( $tag );
			}

			return $formatted_tags;
		}

		function render_field( $field ) {
			$allow_null = $field['allow_null'];
			$nav_menus  = $this->get_nav_menus( $allow_null );

			if ( empty( $nav_menus ) ) {
				return;
			} ?>
			<div class="custom-acf-nav-menu">
				<select id="<?php esc_attr( $field['id'] ); ?>" class="<?php echo esc_attr( $field['class'] ); ?>" name="<?php echo esc_attr( $field['name'] ); ?>">
				<?php foreach( $nav_menus as $nav_menu_id => $nav_menu_name ) : ?>
					<option value="<?php echo esc_attr( $nav_menu_id ); ?>" <?php selected( $field['value'], $nav_menu_id ); ?>>
						<?php echo esc_html( $nav_menu_name ); ?>
					</option>
				<?php endforeach; ?>
				</select>
			</div>
			<?php
		}

		function get_nav_menus( $allow_null = false ) {
			$navs = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
			$nav_menus = array();

			if ( $allow_null ) {
				$nav_menus[''] = esc_html__( '- Select -', 'capitalcarpet' );
			}

			foreach ( $navs as $nav ) {
				$nav_menus[ $nav->term_id ] = $nav->name;
			}

			return $nav_menus;
		}

		function format_value( $value, $post_id, $field ) {
			if ( empty( $value ) ) {
				return false;
			}

			if ( 'object' == $field['save_format'] ) {
				$wp_menu_object = wp_get_nav_menu_object( $value );

				if( empty( $wp_menu_object ) ) {
					return false;
				}

				$menu_object = new stdClass;
				$menu_object->ID = $wp_menu_object->term_id;
				$menu_object->name = $wp_menu_object->name;
				$menu_object->slug = $wp_menu_object->slug;
				$menu_object->count = $wp_menu_object->count;

				return $menu_object;
			} elseif ( 'menu' == $field['save_format'] ) {
				ob_start();
				wp_nav_menu( array(
					'menu' => $value,
					'container' => 'div',
	       			'container_class' => 'acf-nav-menu',
					'container' => $field['container'],
					'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				));

				return ob_get_clean();
			}

			return $value;
		}

		function load_value( $value, $post_id, $field ) {
			return $value;
		}
	}

	new acf_field_menu();
}

/**
 * This is a PHP file containing the code for the acf_field_icon_picker class.
 *
 * @package Advanced_Custom_Fields_Pro
 */
if ( !class_exists('acf_field_custom_icon_picker') ) {
	
	function get_theme_icons($dashicons) {

		$scss_content = file_get_contents(get_template_directory() . '/sass/_icon.scss');

		$lines = explode("\n", $scss_content);

		foreach ($lines as $line) {
		    if (preg_match('/\.icon-(.*):before\s*{\s*content:\s*\'\\\\([^\']*)\';\s*}/', $line, $icon_match)) {
		        $icon_name = 'icon-' . $icon_match[1];
		        $icon_label = ucwords(str_replace('-', ' ', $icon_match[1]));

		        $dashicons[$icon_name] = $icon_label;
		    }
		}

		return $dashicons;
	}

	// add_filter( 'acf/fields/icon_picker/dashicons', 'get_theme_icons' );
}

/**
 * This is a PHP file containing the code for the acf_field_cicon_picker class.
 *
 * @package Advanced_Custom_Fields_Pro
 */
if ( !class_exists('acf_field_cicon_picker') ) {

    class acf_field_cicon_picker extends acf_field {
    	private $env;
        private $icon_choices = [];
        private $icon_categories = [];

        public function __construct() {
            $this->name = 'cicon_picker';
            $this->label = __('Custom Icon Picker', 'capitalcarpet');
            $this->type = 'select';
            $this->category = 'advanced';
            $this->description = __('Custom Icon Picker Easily select icons from a custom set to enhance visual representation on your WordPress site.', 'capitalcarpet');
            $this->preview_image = '//i.ibb.co/YX7TNFr/icon-picker.png';

            $this->populate_icon_choices();
            $this->populate_icon_categories();

            $this->defaults = [
                'ui' => 1,
                'allow_null' => 0,
                'placeholder' => '',
                'choices' => $this->icon_choices,
                'default_value' => '',
                'return_format' => 'value',
            ];

            $this->env = array(
    			'url' => site_url( str_replace( ABSPATH, '', __DIR__ ) ),
    			'version' => '1.0',
    		);

            parent::__construct();
        }

        public function input_admin_enqueue_scripts() {
    		wp_register_style(
    			'cacf',
    			get_theme_file_uri('includes/assets/css/cacf.min.css'),
    			array( 'acf-input' ),
    			$this->env['version']
    		);

    		wp_register_script(
    			'cacf',
    			get_theme_file_uri('includes/assets/js/cacf.min.js'),
    			array( 'acf-input' ),
    			$this->env['version']
    		);

    		// Default
            wp_enqueue_style('select2');
            wp_enqueue_script('select2');

            // Cutom
    		wp_enqueue_style('cacf');
    		wp_enqueue_script('cacf');
        }

        private function populate_icon_choices() {
            $current_category = '';
            $icon_choices = array();
            $scss_content = file_get_contents(get_template_directory() . '/sass/_icon.scss');

            $lines = explode("\n", $scss_content);

            foreach ($lines as $line) {
                if (preg_match('/\/\/\s*(.+)\s*$/', $line, $category_match)) {
                    $current_category = trim($category_match[1]);
                    continue;
                }

                if (empty($current_category)) {
                    $current_category = 'Basic';
                }

                if (preg_match('/\.icon-(.*):before\s*{\s*content:\s*\'\\\\([^\']*)\';\s*}/', $line, $icon_match)) {
                    $icon_name = 'icon-' . $icon_match[1];
                    $icon_label = ucwords(str_replace('-', ' ', $icon_match[1]));

                    $icon_choices[$current_category][$icon_name] = $icon_label;
                }
            }

            $this->icon_choices = $icon_choices;
        }

        private function populate_icon_categories() {
            $this->icon_categories = array_keys($this->icon_choices);
        }

        public function render_field($field) {
            $choices = $this->icon_choices;
            $value = acf_get_array($field['value']);

            if (!empty($field['icon_categories']) && is_array($field['icon_categories'])) {
                foreach ($choices as $category => $icons) {
                    if (!in_array($category, $field['icon_categories'])) {
                        unset($choices[$category]);
                    }
                }
            }

            $field['placeholder'] = empty($field['placeholder']) ? _x('Select an icon', 'verb', 'capitalcarpet') : $field['placeholder'];

            $value = empty($value) ? [''] : $value;

            if ($field['allow_null']) {
                $choices = ['' => "- {$field['placeholder']} -"] + $choices;
            }

            $select = [
                'id' => $field['id'],
                'class' => $field['class'] . ' acf-cicon-picker',
                'name' => $field['name'],
                'data-ui' => $field['ui'],
                'data-placeholder' => $field['placeholder'],
                'data-allow_null' => $field['allow_null'],
                'value' => $value,
                'choices' => $choices,
            ];

            acf_select_input($select);
        }

        public function render_field_settings($field) {
            $field['choices'] = acf_encode_choices($field['choices']);

            $this->render_field_icon_categories_setting($field);

            acf_render_field_setting(
                $field,
                [
                    'label' => __('Return Format', 'capitalcarpet'),
                    'instructions' => __('Specify the value returned', 'capitalcarpet'),
                    'type' => 'radio',
                    'name' => 'return_format',
                    'layout' => 'horizontal',
                    'choices' => [
                        'value' => __('Value', 'capitalcarpet'),
                        'label' => __('Label', 'capitalcarpet'),
                        'array' => __('Both (Array)', 'capitalcarpet'),
                    ],
                ]
            );
        }

        public function render_field_icon_categories_setting($field) {
            acf_render_field_setting(
                $field,
                [
                    'label' => __('Icon Categories', 'capitalcarpet'),
                    'instructions' => __('Select the icon categories to display.', 'capitalcarpet'),
                    'type' => 'checkbox',
                    'layout' => 'horizontal',
                    'name' => 'icon_categories',
                    'choices' => array_combine($this->icon_categories, $this->icon_categories),
                ]
            );
        }

        public function render_field_validation_settings($field) {
            acf_render_field_setting(
                $field,
                [
                    'label' => __('Allow Null', 'capitalcarpet'),
                    'instructions' => '',
                    'name' => 'allow_null',
                    'type' => 'true_false',
                    'ui' => 1,
                ]
            );
        }

        public function load_value($value, $post_id, $field) {
            return acf_unarray($value);
        }

        public function update_field($field) {
            $field['choices'] = acf_decode_choices($field['choices']);

            return $field;
        }

        public function update_value($value, $post_id, $field) {
            if (empty($value)) {
                return $value;
            }

            if (is_array($value)) {
                $value = array_map('strval', $value);
            }

            return $value;
        }

        public function format_value($value, $post_id, $field) {
            if (is_array($value)) {
                foreach ($value as $i => $val) {
                    $value[$i] = $this->format_value_single($val, $post_id, $field);
                }
            } else {
                $value = $this->format_value_single($value, $post_id, $field);
            }
            return $value;
        }

        public function format_value_single($value, $post_id, $field) {
            if (acf_is_empty($value)) {
                return $value;
            }

            $choices = array();

            foreach ($field['choices'] as $category => $icons) {
                $choices = array_merge($choices, $icons);
            }

            $label = acf_maybe_get($choices, $value, $value);

            switch ($field['return_format']) {
                case 'value':
                    break;
                case 'label':
                    $value = $label;
                    break;
                case 'array':
                    $value = [
                        'value' => $value,
                        'label' => $label,
                    ];
                    break;
            }

            return $value;
        }
    }
    
    acf_register_field_type('acf_field_cicon_picker');
}