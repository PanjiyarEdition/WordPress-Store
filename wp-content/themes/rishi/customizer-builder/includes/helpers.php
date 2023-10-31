<?php
/**
 * General purpose helpers
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package Rishi
 */

add_filter(
	'body_class',
	function ( $classes ) {

		$classes[] = 'rt-loading';

		if ( function_exists( 'is_product_category' ) ) {
			if ( is_product_category() || is_product_tag() ) {
				$classes[] = 'woocommerce-archive';
			}

			if ( is_product() || is_woocommerce() || is_cart() ) {
				if ( get_theme_mod( 'has_ajax_add_to_cart', 'no' ) === 'yes' ) {
					$classes[] = 'rt-ajax-add-to-cart';
				}
			}
		}

		return $classes;
	}
);

add_filter(
	'llms_get_theme_default_sidebar',
	function ( $id ) {
		return 'sidebar-1';
	}
);

add_action(
	'dynamic_sidebar_before',
	function () {
		ob_start();
	}
);

add_action(
	'dynamic_sidebar_after',
	function () {
		$text = str_replace(
			'textwidget',
			'textwidget entry-content',
			ob_get_clean()
		);

		echo $text;
	}
);

if ( ! function_exists( 'rishi__cb_customizer_body_attr' ) ) {
	function rishi__cb_customizer_body_attr( $attrs = array(), $raw = false ) {

		if ( get_theme_mod( 'has_passepartout', 'no' ) === 'yes' ) {
			$attrs['data-frame'] = 'default';
		};

		$attrs['data-forms'] = str_replace(
			'-forms',
			'',
			get_theme_mod( 'forms_type', 'classic-forms' )
		);

		$attrs['data-prefix'] = rishi__cb_customizer_manager()->screen->get_prefix();
		$attrs['data-header'] = apply_filters(
			'rishi:general:body-header-attr', substr(
			str_replace(
				'rt-custom-',
				'',
				rishi__cb_customizer_manager()->header_builder->get_current_section_id()
			),
			0,
			6
		) );

		$attrs['data-footer'] = substr(
			str_replace(
				'rt-custom-',
				'',
				rishi__cb_customizer_manager()->footer_builder->get_current_section_id()
			),
			0,
			6
		);

		$footer_render = new \Rishi_Footer_Builder_Render();
		$footer_atts   = $footer_render->get_current_section()['settings'];

		$reveal_result = array();

		if ( rishi__cb_customizer_default_akg(
			'has_reveal_effect/desktop',
			$footer_atts,
			false
		) ) {
			$reveal_result[] = 'desktop';
		}

		if ( rishi__cb_customizer_default_akg(
			'has_reveal_effect/tablet',
			$footer_atts,
			false
		) ) {
			$reveal_result[] = 'tablet';
		}

		if ( rishi__cb_customizer_default_akg(
			'has_reveal_effect/mobile',
			$footer_atts,
			false
		) ) {
			$reveal_result[] = 'mobile';
		}

		if ( count( $reveal_result ) > 0 ) {
			$attrs['data-footer'] .= ':reveal';
		}

		$_attrs = array_merge(
			array(
				'data-link' => get_theme_mod( 'content_link_type', 'type-2' ),
			),
			$attrs,
			rishi__cb_customizer_schema_org_definitions( 'single', array( 'array' => true ) )
		);
		if ( $raw ) {
			return $_attrs;
		}

		return rishi__cb_customizer_attr_to_html( $_attrs );
	}
}
add_filter( 'rishi__cb_body_attributes', 'rishi__cb_customizer_body_attr', 10, 2 );

/**
 * Get the requested media query.
 *
 * @param string $name Name of the media query.
 */
function rishi__cb_get_media_query( $name ) {
	// If the theme function doesn't exist, build our own queries.
	$desktop = apply_filters( 'rt_desktop_media_query', '(min-width:1025px)' );
	$tablet  = apply_filters( 'rt_tablet_media_query', '(min-width: 703px) and (max-width: 1024px)' );
	$mobile  = apply_filters( 'rt_mobile_media_query', '(max-width:702px)' );

	$queries = apply_filters(
		'rt_media_queries',
		array(
			'desktop' => $desktop,
			'tablet'  => $tablet,
			'mobile'  => $mobile,
		)
	);

	return $queries[ $name ];
}

if ( ! function_exists( 'rishi__cb_customizer_assert_args' ) ) {
	function rishi__cb_customizer_assert_args( $args, $fields = array() ) {
		foreach ( $fields as $single_field ) {
			if (
				! isset( $args[ $single_field ] )
				||
				! $args[ $single_field ]
			) {
				throw new Error( $single_field . ' missing in args!' );
			}
		}
	}
}

add_filter(
	'widget_nav_menu_args',
	function ( $nav_menu_args, $nav_menu, $args, $instance ) {
		$nav_menu_args['menu_class'] = 'widget-menu';
		return $nav_menu_args;
	},
	10,
	4
);

class Rishi_Walker_Page extends Walker_Page {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if (
			isset( $args['item_spacing'] )
			&&
			'preserve' === $args['item_spacing']
		) {
			$t = "\t";
			$n = "\n";
		} else {
			$t = '';
			$n = '';
		}

		$indent  = str_repeat( $t, $depth );
		$output .= "{$n}{$indent}<ul class='sub-menu'>{$n}";
	}

	public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		parent::start_el(
			$output,
			$page,
			$depth,
			$args,
			$current_page
		);

		$output = str_replace(
			"</a><ul class='sub-menu'>",
			"~</a><ul class='sub-menu'>",
			$output
		);

		$output = preg_replace( '/~~+/', '~', $output );
	}
}

if ( ! function_exists( 'rishi__cb_customizer_get_with_percentage' ) ) {
	function rishi__cb_customizer_get_with_percentage( $id, $value ) {
		 $val = get_theme_mod( $id, $value );

		if ( strpos( $value, '%' ) !== false && is_numeric( $val ) ) {
			$val .= '%';
		}

		return str_replace( '%%', '%', $val );
	}
}

if ( ! function_exists( 'rishi__cb_customizer_main_menu_fallback' ) ) {
	function rishi__cb_customizer_main_menu_fallback( $args ) {
		extract( $args );

		$list_pages_args = array(
			'sort_column'  => 'menu_order, post_title',
			'menu_id'      => 'primary-menu',
			'menu_class'   => 'primary-menu menu',
			'container'    => 'ul',
			'echo'         => false,
			'link_before'  => '',
			'link_after'   => '',
			'before'       => '<ul>',
			'after'        => '</ul>',
			'item_spacing' => 'discard',
			'walker'       => new \Rishi_Walker_Page(),
			'title_li'     => '',
			'number'       => 6,
		);

		if ( isset( $args['rishi__cb_customizer_mega_menu'] ) ) {
			$list_pages_args['rishi__cb_customizer_mega_menu'] = $args['rishi__cb_customizer_mega_menu'];
		}

		$menu = wp_list_pages( $list_pages_args );

		$svg = '<button class="child-indicator submenu-toggle"><svg width="8" height="8" viewBox="0 0 15 15"><path d="M2.1,3.2l5.4,5.4l5.4-5.4L15,4.3l-7.5,7.5L0,4.3L2.1,3.2z"/></svg></button>';

		$menu = str_replace(
			'~',
			$svg,
			$menu
		);

		if ( empty( trim( $menu ) ) ) {
			$args['echo'] = false;
			$menu         = rishi__cb_customizer_link_to_menu_editor( $args );
		} else {
			$attrs = '';

			if ( ! empty( $args['menu_id'] ) ) {
				$attrs .= ' id="' . esc_attr( $args['menu_id'] ) . '"';
			}

			if ( ! empty( $args['menu_class'] ) ) {
				$attrs .= ' class="' . esc_attr( $args['menu_class'] ) . '"';
			}

			$menu = "<ul{$attrs}>" . $menu . '</ul>';
		}

		if ( $echo ) {
			echo $menu;
		}

		return $menu;
	}
}

/**
 * Link to menus editor for every empty menu.
 *
 * @param array  $args Menu args.
 */
if ( ! function_exists( 'rishi__cb_customizer_link_to_menu_editor' ) ) {
	function rishi__cb_customizer_link_to_menu_editor( $args ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// see wp-includes/nav-menu-template.php for available arguments
        // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
		extract( $args );

		$output = '<a class="rt-create-menu" href="' . admin_url( 'nav-menus.php' ) . '" target="_blank">' . $before . __( 'Click here to add a menu &rarr;', 'rishi' ) . $after . '</a>';

		if ( ! empty( $container ) ) {
			$output = "<$container class='emptymenu'>$output</$container..>";
		}

		if ( $echo ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo wp_kses_post( $output );
		}

		return $output;
	}
}

if ( ! is_admin() ) {
	add_filter(
		'pre_get_posts',
		function ( $query ) {
			if ( $query->is_search && ( is_search()
			||
			wp_doing_ajax() ) ) {
				if ( ! empty( $_GET['rt_post_type'] ) ) {
					$custom_post_types = rishi__cb_customizer_manager()->post_types->get_supported_post_types();

					$allowed_post_types = array();

					$post_types = explode(
						':',
						sanitize_text_field( $_GET['rt_post_type'] )
					);

					$known_cpts = array( 'post', 'page' );

					if ( get_post_type_object( 'product' ) ) {
						$known_cpts[] = 'product';
					}

					foreach ( $post_types as $single_post_type ) {
						if (
						in_array( $single_post_type, $custom_post_types )
						||
						in_array( $single_post_type, $known_cpts )
						) {
							$allowed_post_types[] = $single_post_type;
						}
					}

					$query->set( 'post_type', $allowed_post_types );
				}
			}

			return $query;
		}
	);
}

/**
 * This is a print_r() alternative
 *
 * @param mixed $value Value to debug.
 */
function rishi__cb_customizer_print( $value ) {
	static $first_time = true;

	if ( $first_time ) {
		ob_start();
		echo '<style>
		div.ct_print_r {
			max-height: 500px;
			overflow-y: scroll;
			background: #23282d;
			margin: 10px 30px;
			padding: 0;
			border: 1px solid #F5F5F5;
			border-radius: 3px;
			position: relative;
			z-index: 11111;
		}

		div.ct_print_r pre {
			color: #78FF5B;
			background: #23282d;
			text-shadow: 1px 1px 0 #000;
			font-family: Consolas, monospace;
			font-size: 12px;
			margin: 0;
			padding: 5px;
			display: block;
			line-height: 16px;
			text-align: left;
		}

		div.ct_print_r_group {
			background: #f1f1f1;
			margin: 10px 30px;
			padding: 1px;
			border-radius: 5px;
			position: relative;
			z-index: 11110;
		}
		div.ct_print_r_group div.ct_print_r {
			margin: 9px;
			border-width: 0;
		}
		</style>';

		/**
		 * Note to code reviewers: This line doesn't need to be escaped.
		 * The variable used here has the value escaped properly.
		 */
		echo str_replace( array( '  ', "\n" ), '', ob_get_clean() );

		$first_time = false;
	}

	/**
	 * Note to code reviewers: This line doesn't need to be escaped.
	 * The variable used here has the value escaped properly.
	 */
	if ( func_num_args() === 1 ) {
		echo '<div class="ct_print_r"><pre>';
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo htmlspecialchars( \Rishi_FW_Dumper::dump( $value ) );
		echo '</pre></div>';
	} else {
		echo '<div class="ct_print_r_group">';

		foreach ( func_get_args() as $param ) {
			rishi__cb_customizer_print( $param );
		}

		echo '</div>';
	}
}

/**
 * TVar_dumper class.
 * original source: https://code.google.com/p/prado3/source/browse/trunk/framework/Util/TVar_dumper.php
 *
 * TVar_dumper is intended to replace the buggy PHP function var_dump and print_r.
 * It can correctly identify the recursively referenced objects in a complex
 * object structure. It also has a recursive depth control to avoid indefinite
 * recursive display of some peculiar variables.
 *
 * TVar_dumper can be used as follows,
 * <code>
 *   echo \TVar_dumper::dump($var);
 * </code>
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id$
 * @package System.Util
 * @since 3.0
 */
class Rishi_FW_Dumper {

	/**
	 * Object
	 *
	 * @var object objects boj
	 */
	private static $_objects;
	/**
	 * Output
	 *
	 * @var string Output output of the dumper.
	 */
	private static $_output;
	/**
	 * Depth
	 *
	 * @var int Depth depth
	 */
	private static $_depth;

	/**
	 * Converts a variable into a string representation.
	 * This method achieves the similar functionality as var_dump and print_r
	 * but is more robust when handling complex objects such as PRADO controls.
	 *
	 * @param mixed   $var     Variable to be dumped.
	 * @param integer $depth Maximum depth that the dumper should go into the variable. Defaults to 10.
	 * @return string the string representation of the variable
	 */
	public static function dump( $var, $depth = 10 ) {
		self::reset_internals();

		self::$_depth = $depth;
		self::dump_internal( $var, 0 );

		$output = self::$_output;

		self::reset_internals();

		return $output;
	}

	/**
	 * Reset internals.
	 */
	private static function reset_internals() {
		 self::$_output = '';
		self::$_objects = array();
		self::$_depth   = 10;
	}

	/**
	 * Dump
	 *
	 * @param object $var var.
	 * @param int    $level level.
	 */
	private static function dump_internal( $var, $level ) {
		switch ( gettype( $var ) ) {
			case 'boolean':
				self::$_output .= $var ? 'true' : 'false';
				break;
			case 'integer':
				self::$_output .= "$var";
				break;
			case 'double':
				self::$_output .= "$var";
				break;
			case 'string':
				self::$_output .= "'$var'";
				break;
			case 'resource':
				self::$_output .= '{resource}';
				break;
			case 'NULL':
				self::$_output .= 'null';
				break;
			case 'unknown type':
				self::$_output .= '{unknown}';
				break;
			case 'array':
				if ( self::$_depth <= $level ) {
					self::$_output .= 'array(...)';
				} elseif ( empty( $var ) ) {
					self::$_output .= 'array()';
				} else {
					$keys           = array_keys( $var );
					$spaces         = str_repeat( ' ', $level * 4 );
					self::$_output .= "array\n" . $spaces . '(';
					foreach ( $keys as $key ) {
						self::$_output .= "\n" . $spaces . "    [$key] => ";
						self::$_output .= self::dump_internal( $var[ $key ], $level + 1 );
					}
					self::$_output .= "\n" . $spaces . ')';
				}
				break;
			case 'object':
				$id = array_search( $var, self::$_objects, true );

				if ( false !== $id ) {
					self::$_output .= get_class( $var ) . '(...)';
				} elseif ( self::$_depth <= $level ) {
					self::$_output .= get_class( $var ) . '(...)';
				} else {
					$id             = array_push( self::$_objects, $var );
					$class_name     = get_class( $var );
					$members        = (array) $var;
					$keys           = array_keys( $members );
					$spaces         = str_repeat( ' ', $level * 4 );
					self::$_output .= "$class_name\n" . $spaces . '(';
					foreach ( $keys as $key ) {
						$key_display    = strtr(
							trim( $key ),
							array( "\0" => ':' )
						);
						self::$_output .= "\n" . $spaces . "    [$key_display] => ";
						self::$_output .= self::dump_internal(
							$members[ $key ],
							$level + 1
						);
					}
					self::$_output .= "\n" . $spaces . ')';
				}
				break;
		}
	}
}

/**
 * Extract variable from a file.
 *
 * @param string $file_path path to file.
 * @param array  $_extract_variables variables to return.
 * @param array  $_set_variables variables to pass into the file.
 */
if ( ! function_exists( 'rishi__cb_customizer_get_variables_from_file' ) ) {
	function rishi__cb_customizer_get_variables_from_file(
		$file_path,
		array $_extract_variables,
		array $_set_variables = array()
	) {
        // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
		extract( $_set_variables, EXTR_REFS );
		unset( $_set_variables );
		require $file_path;

		foreach ( $_extract_variables as $variable_name => $default_value ) {
			if ( isset( $$variable_name ) ) {
				$_extract_variables[ $variable_name ] = $$variable_name;
			}
		}

		return $_extract_variables;
	}
}

/**
 * Transform ID to title.
 *
 * @param string $id initial ID.
 */
if ( ! function_exists( 'rishi__cb_customizer_id_to_title' ) ) {
	function rishi__cb_customizer_id_to_title( $id ) {
		if (
			function_exists( 'mb_strtoupper' )
			&&
			function_exists( 'mb_substr' )
			&&
			function_exists( 'mb_strlen' )
		) {
			$id = mb_strtoupper( mb_substr( $id, 0, 1, 'UTF-8' ), 'UTF-8' ) . mb_substr(
				$id,
				1,
				mb_strlen( $id, 'UTF-8' ),
				'UTF-8'
			);
		} else {
			$id = strtoupper( substr( $id, 0, 1 ) ) . substr( $id, 1, strlen( $id ) );
		}

		return str_replace( array( '_', '-' ), ' ', $id );
	}
}

/**
 * Extract a key from an array with defaults.
 *
 * @param string       $keys 'a/b/c' path.
 * @param array|object $array_or_object array to extract from.
 * @param null|mixed   $default_value defualt value.
 */
if ( ! function_exists( 'rishi__cb_customizer_default_akg' ) ) {
	function rishi__cb_customizer_default_akg( $keys, $array_or_object, $default_value = null ) {
		return rishi__cb_get_akv( $keys, $array_or_object, $default_value );
	}
}

/**
 * Recursively find a key's value in array
 *
 * @param string       $keys 'a/b/c' path.
 * @param array|object $array_or_object array to extract from.
 * @param null|mixed   $default_value defualt value.
 *
 * @return null|mixed
 */
function rishi__cb_get_akv( $keys, $array_or_object, $default_value = null ) {
	if ( ! is_array( $keys ) ) {
		$keys = explode( '/', (string) $keys );
	}

	$array_or_object = $array_or_object;
	$key_or_property = array_shift( $keys );

	if ( is_null( $key_or_property ) ) {
		return $default_value;
	}

	$is_object = is_object( $array_or_object );

	if ( $is_object ) {
		if ( ! property_exists( $array_or_object, $key_or_property ) ) {
			return $default_value;
		}
	} else {
		if ( ! is_array( $array_or_object ) || ! array_key_exists( $key_or_property, $array_or_object ) ) {
			return $default_value;
		}
	}

	if ( isset( $keys[0] ) ) { // not used count() for performance reasons.
		if ( $is_object ) {
			return rishi__cb_get_akv( $keys, $array_or_object->{$key_or_property}, $default_value );
		} else {
			return rishi__cb_get_akv( $keys, $array_or_object[ $key_or_property ], $default_value );
		}
	} else {
		if ( $is_object ) {
			return $array_or_object->{$key_or_property};
		} else {
			return $array_or_object[ $key_or_property ];
		}
	}
}

if ( ! function_exists( 'rishi__cb_get_akv_or_customizer' ) ) {
	function rishi__cb_get_akv_or_customizer( $key, $source, $default = null ) {
		$source = wp_parse_args(
			$source,
			array(
				'prefix'   => '',

				// customizer | array
				'strategy' => 'customizer',
			)
		);

		if ( $source['strategy'] !== 'customizer' && ! is_array( $source['strategy'] ) ) {
			throw new Error(
				'strategy wrong value provided. Array or customizer is required.'
			);
		}

		if ( ! empty( $source['prefix'] ) ) {
			$source['prefix'] .= '_';
		}
		if ( $source['strategy'] === 'customizer' ) {
			return get_theme_mod( $source['prefix'] . $key, $default );
		}

		return rishi__cb_get_akv( $source['prefix'] . $key, $source['strategy'], $default );
	}
}

if ( ! function_exists( 'rishi__cb_customizer_collect_and_return' ) ) {
	function rishi__cb_customizer_collect_and_return( $cb ) {
		ob_start();

		if ( $cb ) {
			call_user_func( $cb );
		}

		return ob_get_clean();
	}
}

/**
 * Generate a random ID.
 */
if ( ! function_exists( 'rishi__cb_customizer_rand_md5' ) ) {
	function rishi__cb_customizer_rand_md5( $slug = null ) {
		if ( $slug ) {
			return md5( $slug );
		}
		return md5( time() . '-' . uniqid( wp_rand(), true ) . '-' . wp_rand() );
	}
}

/**
 * Generate attributes string for html tag
 *
 * @param array $attr_array array('href' => '/', 'title' => 'Test').
 *
 * @return string 'href="/" title="Test"'
 */
if ( ! function_exists( 'rishi__cb_customizer_attr_to_html' ) ) {
	function rishi__cb_customizer_attr_to_html( array $attr_array ) {
		$html_attr = '';

		foreach ( $attr_array as $attr_name => $attr_val ) {
			if ( false === $attr_val ) {
				continue;
			}

			$html_attr .= $attr_name . '="' . htmlspecialchars( $attr_val ) . '" ';
		}

		return $html_attr;
	}
}

/**
 * Generate html tag
 *
 * @param string      $tag Tag name.
 * @param array       $attr Tag attributes.
 * @param bool|string $end Append closing tag. Also accepts body content.
 *
 * @return string The tag's html
 */
if ( ! function_exists( 'rishi__cb_html_tag' ) ) {
	function rishi__cb_html_tag( $tag, $attr = array(), $end = false ) {
		$html = '<' . $tag . ' ' . rishi__cb_customizer_attr_to_html( $attr );

		if ( true === $end ) {
			// <script></script>
			$html .= '></' . $tag . '>';
		} elseif ( false === $end ) {
			// <br/>
			$html .= '/>';
		} else {
			// <div>content</div>
			$html .= '>' . $end . '</' . $tag . '>';
		}

		return $html;
	}
}

/**
 * Safe render a view and return html
 * In view will be accessible only passed variables
 * Use this function to not include files directly and to not give access to current context variables (like $this)
 *
 * @param string $file_path File path.
 * @param array  $view_variables Variables to pass into the view.
 *
 * @return string HTML.
 */
if ( ! function_exists( 'rishi__cb_customizer_render_view' ) ) {
	function rishi__cb_customizer_render_view(
		$file_path,
		$view_variables = array(),
		$default_value = ''
	) {
		if ( ! is_file( $file_path ) ) {
			return $default_value;
		}

        // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
		extract( $view_variables, EXTR_REFS );
		unset( $view_variables );

		ob_start();
		require $file_path;

		return ob_get_clean();
	}
}

if ( ! function_exists( 'rishi__cb_customizer_get_wp_theme' ) ) {
	function rishi__cb_customizer_get_wp_theme() {
		 return apply_filters( 'rishi__cb_customizer_get_wp_theme', wp_get_theme() );
	}
}

if ( ! function_exists( 'rishi__cb_customizer_get_wp_parent_theme' ) ) {
	function rishi__cb_customizer_get_wp_parent_theme() {
		return apply_filters( 'rishi__cb_customizer_get_wp_theme', wp_get_theme( get_template() ) );
	}
}


function rishi__cb_customizer_current_url() {
	static $url = null;

	if ( $url === null ) {
		if ( is_multisite() && ! ( defined( 'SUBDOMAIN_INSTALL' ) && SUBDOMAIN_INSTALL ) ) {
			switch_to_blog( 1 );
			$url = home_url();
			restore_current_blog();
		} else {
			$url = home_url();
		}

		// Remove the "//" before the domain name
		$url = ltrim( preg_replace( '/^[^:]+:\/\//', '//', $url ), '/' );

		// Remove the ulr subdirectory in case it has one
		$split = explode( '/', $url );

		// Remove end slash
		$url = rtrim( $split[0], '/' );

		$url .= '/' . ltrim( rishi__cb_get_akv( 'REQUEST_URI', $_SERVER, '' ), '/' );
		$url  = set_url_scheme( '//' . $url ); // https fix
	}

	return $url;
}

/**
 * Treat non-posts home page as a simple page.
 */
if ( ! function_exists( 'rishi__cb_customizer_is_page' ) ) {
	function rishi__cb_customizer_is_page( $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'shop_is_page' => true,
				'blog_is_page' => true,
			)
		);

		static $static_result = null;

		if ( $static_result !== null ) {
		}

		$result = (
			( $args['blog_is_page']
				&&
				is_home()
				&&
				! is_front_page() ) || is_page() || ( $args['shop_is_page'] && function_exists( 'is_shop' ) && is_shop() ) || is_attachment() );

		if ( $result ) {
			$post_id = get_the_ID();

			if ( is_home() && ! is_front_page() ) {
				$post_id = get_option( 'page_for_posts' );
			}

			if ( function_exists( 'is_shop' ) && is_shop() ) {
				$post_id = get_option( 'woocommerce_shop_page_id' );
			}

			$static_result = $post_id;

			return $post_id;
		}

		$static_result = false;
		return false;
	}
}

function rishi__cb_customizer_sync_whole_page( $args = array() ) {
	return array_merge(
		array(
			'selector'            => 'main#main',
			'container_inclusive' => true,
			'render'              => function () {
				echo rishi__cb_customizer_replace_current_template();
			},
		),
		$args
	);
}


function rishi__cb_customizer_values_are_similar( $actual, $expected ) {
	if ( ! is_array( $expected ) || ! is_array( $actual ) ) {
		return $actual === $expected;
	}

	foreach ( $expected as $key => $value ) {
		if ( ! rishi__cb_customizer_values_are_similar( $actual[ $key ], $expected[ $key ] ) ) {
			return false;
		}
	}

	foreach ( $actual as $key => $value ) {
		if ( ! rishi__cb_customizer_values_are_similar( $actual[ $key ], $expected[ $key ] ) ) {
			return false;
		}
	}

	return true;
}


if ( ! function_exists( 'rishi__cb_customizer_get_all_image_sizes' ) ) {
	function rishi__cb_customizer_get_all_image_sizes() {
		$titles = array(
			'thumbnail'    => __( 'Thumbnail', 'rishi' ),
			'medium'       => __( 'Medium', 'rishi' ),
			'medium_large' => __( 'Medium Large', 'rishi' ),
			'large'        => __( 'Large', 'rishi' ),
			'full'         => __( 'Full Size', 'rishi' ),
		);

		$all_sizes = get_intermediate_image_sizes();

		$result = array(
			'full' => __( 'Full Size', 'rishi' ),
		);

		foreach ( $all_sizes as $single_size ) {
			if ( isset( $titles[ $single_size ] ) ) {
				$result[ $single_size ] = $titles[ $single_size ];
			} else {
				$result[ $single_size ] = $single_size;
			}
		}

		return $result;
	}
}

function rishi__cb_customizer_main_attr() {
	$attrs = array(
		'id'    => 'main',
		'class' => 'site-main',
	);

	if ( rishi__cb_customizer_has_schema_org_markup() ) {
		$attrs['class'] .= ' hfeed';
	}

	if (
		( is_singular() || rishi__cb_customizer_is_page() )
		&&
	 rishi__cb_customizer_sidebar_position() === 'none'
	) {

		$attrs['class'] .= ' content-wide';
	}

	return rishi__cb_customizer_attr_to_html(
		array_merge(
			apply_filters( 'rishi:main:attr', $attrs ),
			rishi__cb_customizer_schema_org_definitions(
				'creative_work',
				array(
					'array' => true,
				)
			)
		)
	);
}

/**
 * Implement meta boxes
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

if ( ! function_exists( 'rishi__cb_customizer_get_post_options' ) ) {
	function rishi__cb_customizer_get_post_options( $post_id = null, $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'meta_id' => 'rishi__cb_customizer_post_meta_options',
			)
		);

		static $post_opts = array();

		if ( ! $post_id ) {
			global $post;

			if ( $post && is_singular() ) {
				$post_id = $post->ID;
			}

			if ( is_home() && ! is_front_page() ) {
				$post_id = get_option( 'page_for_posts' );
			}

			if ( function_exists( 'is_shop' ) && is_shop() ) {
				$post_id = get_option( 'woocommerce_shop_page_id' );
			}
		}

		$cache_key = $post_id . ':' . $args['meta_id'];

		if ( isset( $post_opts[ $cache_key ] ) ) {
			return $post_opts[ $cache_key ];
		}

		$values = get_post_meta( $post_id, $args['meta_id'] );

		if ( empty( $values ) ) {
			$values = array( array() );
		}

		$post_opts[ $cache_key ] = $values[0];

		return $values[0];
	}
}

if ( ! function_exists( 'rishi__cb_customizer_get_taxonomy_options' ) ) {
	function rishi__cb_customizer_get_taxonomy_options( $term_id = null ) {
		static $taxonomy_opts = array();

		if ( ! $term_id ) {
			$term_id = get_queried_object_id();
		}

		if ( isset( $taxonomy_opts[ $term_id ] ) ) {
			return $taxonomy_opts[ $term_id ];
		}

		$values = get_term_meta(
			$term_id,
			'rishi__cb_customizer_taxonomy_meta_options'
		);

		if ( empty( $values ) ) {
			$values = array( array() );
		}

		$taxonomy_opts[ $term_id ] = $values[0];

		return $values[0];
	}
}

if ( ! function_exists( 'rishi__cb_customizer_sanitize_rgba' ) ) :
	/**
	 * Sanitize RGBA colors
	 */
	function rishi__cb_customizer_sanitize_rgba( $color ) {
		if ( '' === $color ) {
			return '';
		}

		// If string does not start with 'rgba', then treat as hex
		// sanitize the hex color and finally convert hex to rgba
		if ( false === strpos( $color, 'rgba' ) ) {
			return rishi__cb_customizer_sanitize_hex_color( $color );
		}

		// By now we know the string is formatted as an rgba color so we need to further sanitize it.
		$color = str_replace( ' ', '', $color );
		sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
		return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';

		return '';
	}
endif;

function rishi__cb_customizer_add_customizer_preview_cache( $maybe_content ) {
	add_action(
		'rishi__cb_customizer_customizer_preview_cache',
		function () use ( $maybe_content ) {
			if ( is_callable( $maybe_content ) ) {
				/**
				 * Note to code reviewers: This line doesn't need to be escaped.
				 * Function call_user_func($maybe_content) used here escapes the value properly.
				 */
				echo call_user_func( $maybe_content );
				return;
			}

			/**
			 * Note to code reviewers: This line doesn't need to be escaped.
			 * Variable $maybe_content used here has the value escaped properly.
			 */
			echo $maybe_content;
		}
	);
}

if ( ! function_exists( 'rishi__cb_customizer_akg_or_customizer' ) ) {
	function rishi__cb_customizer_akg_or_customizer( $key, $source, $default = null ) {
		$source = wp_parse_args(
			$source,
			array(
				'prefix'   => '',

				// customizer | array
				'strategy' => 'customizer',
			)
		);

		if ( $source['strategy'] !== 'customizer' && ! is_array( $source['strategy'] ) ) {
			throw new Error(
				'strategy wrong value provided. Array or customizer is required.'
			);
		}

		if ( ! empty( $source['prefix'] ) ) {
			$source['prefix'] .= '_';
		}

		if ( $source['strategy'] === 'customizer' ) {
			return get_theme_mod( $source['prefix'] . $key, $default );
		}

		return rishi__cb_get_akv( $source['prefix'] . $key, $source['strategy'], $default );
	}
}

/**
 * Generate html tag
 *
 * @param string      $tag Tag name.
 * @param array       $attr Tag attributes.
 * @param bool|string $end Append closing tag. Also accepts body content.
 *
 * @return string The tag's html
 */
if (!function_exists('rishi__cb_customizer_html_tag')) {
    function rishi__cb_customizer_html_tag($tag, $attr = [], $end = false)
    {
        $html = '<' . $tag . ' ' . rishi__cb_customizer_attr_to_html($attr);

        if (true === $end) {
            $html .= '></' . $tag . '>';
        } elseif (false === $end) {
            $html .= '/>';
        } else {
            $html .= '>' . $end . '</' . $tag . '>';
        }

        return $html;
    }
}

function rishi__cb_customizer_get_v_spacing() {

	$v_spacing_output = '';

	$post_options = rishi__cb_customizer_get_post_options();

	$page_vertical_spacing_source = rishi__cb_customizer_default_akg(
		'vertical_spacing_source',
		$post_options,
		'inherit'
	);

	$post_content_area_spacing = get_theme_mod(
		'single_content_area_spacing',
		'both'
	);

	if ( $page_vertical_spacing_source === 'custom' ) {
		$post_content_area_spacing = rishi__cb_customizer_default_akg(
			'content_area_spacing',
			$post_options,
			'both'
		);
	}

	if ( $post_content_area_spacing === 'both' ) {
		$post_content_area_spacing = 'top:bottom';
	}

	$v_spacing_output = 'data-v-spacing="' . esc_attr( $post_content_area_spacing ) . '"';

	return $v_spacing_output;

	return '';

}

function rishi__cb_customizer_get_page_spacing() {
	$v_spacing_output = '';

	$post_options = rishi__cb_customizer_get_post_options();

	$page_vertical_spacing_source = rishi__cb_customizer_default_akg(
		'vertical_spacing_source',
		$post_options,
		'inherit'
	);

	$post_content_area_spacing = get_theme_mod(
		'page_content_area_spacing',
		'both'
	);

	if ( $page_vertical_spacing_source === 'custom' ) {
		$post_content_area_spacing = rishi__cb_customizer_default_akg(
			'content_area_spacing',
			$post_options,
			'both'
		);
	}

	if ( $post_content_area_spacing === 'both' ) {
		$post_content_area_spacing = 'top:bottom';
	}

	$v_spacing_output = 'data-page-spacing="' . esc_attr(
		$post_content_area_spacing
	) . '"';

	return $v_spacing_output;
}

/**
 * Matching taxonomy.
 */
function rishi__cb_get_matching_taxonomy( $post_type, $is_category = true ) {
	$category = $is_category ? 'category' : 'post_tag';

	if ( $post_type === 'product' ) {
		$category = $is_category ? 'product_cat' : 'product_tag';
	}

	if ( $post_type !== 'product' && $post_type !== 'post' ) {
		$taxonomies = array_values(
			array_diff(
				get_object_taxonomies( $post_type ),
				array( 'post_format' )
			)
		);

		if ( count( $taxonomies ) > 0 ) {
			$category = null;

			foreach ( $taxonomies as $single_taxonomy ) {
				$taxonomy_object = get_taxonomy( $single_taxonomy );

				if ( ! $taxonomy_object->public ) {
					continue;
				}

				if (
					$is_category && $taxonomy_object->hierarchical
					||
					! $is_category && ! $taxonomy_object->hierarchical
				) {
					$category = $single_taxonomy;
					break;
				}
			}
		} else {
			return null;
		}
	}

	if ( ! get_taxonomy( $category ) ) {
		return null;
	}

	return $category;
}

/**
 * Gets RISHI__\Customizer_Manager instance.
 */
function rishi__cb_customizer_manager() {
	return RISHI__\Customizer_Manager::instance();
}

/**
 * Calculates sidebar class.
 */
function rishi__cb_body_class( $classes ) {
	global $post;

	$use_cb_class = apply_filters( 'rishi__cb_use_cb_body_classes', true );

	if( !$use_cb_class ) return $classes;

	$classes_flip = array_flip( $classes );

	$layouts_defaults = rishi__cb__get_layout_defaults();

	$global_sidebar_layout = get_theme_mod( 'layout_style', $layouts_defaults['layout_style'] );
	$global_page_layout    = get_theme_mod( 'layout', $layouts_defaults['layout'] );

	$context = '';
	if ( isset( $classes_flip['home'] ) ) {
		$context = 'home';
	} elseif ( isset( $classes_flip['blog'] ) ) {
		$context = 'blog';
	} elseif ( isset( $classes_flip['single-post'] ) ) { // is_singular( 'post' )
		$context = 'single-post';
	} elseif ( isset( $classes_flip['page'] ) ) { // is_singular( 'page' )
		$context = 'page';
	} elseif ( isset( $classes_flip['archive'] ) ) { // is_archive()
		$context = 'archive';
	} elseif ( isset( $classes_flip['search'] ) ) { // is_search()
		$context = 'search';
	}

	$mods_name_by_context = array(
		'home'        => array( 'blog_sidebar_layout', 'blog_container', 'blog_container_streched_ed' ),
		'blog'        => array( 'blog_sidebar_layout', 'blog_container', 'blog_container_streched_ed' ),
		'archive'     => array( 'archive_sidebar_layout', 'archive_layout', 'archive_layout_streched_ed' ),
		'author'      => array( 'author_sidebar_layout', 'author_layout', 'author_layout_streched_ed' ),
		'search'      => array( 'search_sidebar_layout', 'search_layout', 'search_layout_streched_ed' ),
		'single-post' => array( 'post_sidebar_layout', 'blog_post_layout', 'blog_post_streched_ed' ),
		'page'        => array( 'page_sidebar_layout', 'page_layout', 'page_layout_streched_ed' ),
	);

	$classes_by_mod_value = array(
		'no-sidebar'           => 'no-sidebar',
		'right-sidebar'        => 'right-sidebar',
		'left-sidebar'         => 'left-sidebar',
		'default-sidebar'      => $global_sidebar_layout === 'no-sidebar' ? 'no-sidebar' : $global_sidebar_layout,
		'centered'             => 'no-sidebar centered',
		'default'              => $global_page_layout,
		'content_boxed'        => 'layout__content-box',
		'full_width_contained' => 'layout__default',
		'boxed'                => 'layout__box',
	);

	if ( isset( $mods_name_by_context[ $context ] ) ) {
		foreach ( $mods_name_by_context[ $context ] as $mod_name ) {
			$mod_value = get_theme_mod( $mod_name, $layouts_defaults[ $mod_name ] );
			$mod_value = apply_filters( 'rishi__cb_mod_value', $mod_value, $mod_name, $context );
			if ( 'yes' === $mod_value && strpos( $mod_name, 'streched_ed' ) > -1 ) {
				$classes[] = 'full-width';
			} elseif ( isset( $classes_by_mod_value[ $mod_value ] ) ) {
				$classes[] = $classes_by_mod_value[ $mod_value ];
			}
		}
	}

	// TODO: add woocommerce support later.

	return $classes;

}
add_filter( 'body_class', 'rishi__cb_body_class' );

/**
 * Returns for option on post meta to override global
 * customizer_settings.
 */
function rishi__cb_filter_mod_value_by_post_meta( $mod_value, $mod_name, $context ) {
	$post_meta_value = rishi__cb_customizer_get_post_options();

	$customizer_mapping_to_post_meta = array(
		'blog_sidebar_layout'        => 'page_structure_type',
		'post_sidebar_layout'        => 'page_structure_type',
		'page_sidebar_layout'        => 'page_structure_type',
		'page_layout'                => 'content_style',
		'page_layout_streched_ed'    => 'blog_page_streched_ed',
		'blog_container_streched_ed' => 'blog_page_streched_ed',
	);

	if ( isset( $customizer_mapping_to_post_meta[ $mod_name ] ) ) {
		$meta_key = $customizer_mapping_to_post_meta[ $mod_name ];
		if ( isset( $post_meta_value[ $meta_key ] ) ) {
			if ( 'blog_page_streched_ed' === $meta_key ) {
				$mod_value = 'yes' === $post_meta_value[ $meta_key ] ? 'no' : $mod_value;
			} else {
				$mod_value = 'default-sidebar' === $post_meta_value[ $meta_key ] ? $mod_value : $post_meta_value[ $meta_key ];
			}
		}
	}
	return $mod_value;
}
add_filter( 'rishi__cb_mod_value', 'rishi__cb_filter_mod_value_by_post_meta', 10, 3 );

function rishi__cb_get_contacts_output( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'data'        => array(),
			'link_target' => 'no',
			'type'        => 'rounded',
			'fill'        => 'outline',
			'size'        => '',
		)
	);

	$has_enabled_layer = false;

	foreach ( $args['data'] as $single_layer ) {
		if ( $single_layer['enabled'] ) {
			$has_enabled_layer = true;
			break;
		}
	}

	if ( ! $has_enabled_layer ) {
		return '';
	}

	$data_target = '';

	if ( $args['link_target'] !== 'no' ) {
		$data_target = 'target="_blank"';
	}

	$svgs = array(
		'address' => '<svg id="address" xmlns="http://www.w3.org/2000/svg" width="13.788" height="20.937" viewBox="0 0 13.788 20.937"><path id="Path_26497" data-name="Path 26497" d="M29.894,961.362A6.894,6.894,0,0,0,23,968.256a10.93,10.93,0,0,0,1.277,4.6l5.617,9.447,5.617-9.447a10.929,10.929,0,0,0,1.277-4.6A6.894,6.894,0,0,0,29.894,961.362Zm0,3.83a3.064,3.064,0,1,1-3.064,3.064A3.064,3.064,0,0,1,29.894,965.192Z" transform="translate(-23 -961.362)"/></svg>',
		'phone'   => '<svg xmlns="http://www.w3.org/2000/svg" width="18.823" height="19.788" viewBox="0 0 18.823 19.788"><path id="Phone" d="M15.925,19.741a8.537,8.537,0,0,1-3.747-1.51,20.942,20.942,0,0,1-3.524-3.094,51.918,51.918,0,0,1-3.759-4.28A13.13,13.13,0,0,1,2.75,6.867a6.3,6.3,0,0,1-.233-2.914,5.144,5.144,0,0,1,1.66-2.906A7.085,7.085,0,0,1,5.306.221,1.454,1.454,0,0,1,6.9.246a5.738,5.738,0,0,1,2.443,2.93,1.06,1.06,0,0,1-.117,1.072c-.283.382-.578.754-.863,1.136-.251.338-.512.671-.736,1.027a.946.946,0,0,0,.01,1.108c.564.791,1.11,1.607,1.723,2.36a30.024,30.024,0,0,0,3.672,3.8c.3.255.615.481.932.712a.892.892,0,0,0,.96.087,10.79,10.79,0,0,0,.989-.554c.443-.283.878-.574,1.314-.853a1.155,1.155,0,0,1,1.207-.024,5.876,5.876,0,0,1,2.612,2.572,1.583,1.583,0,0,1-.142,1.795,5.431,5.431,0,0,1-4.353,2.362A6.181,6.181,0,0,1,15.925,19.741Z" transform="translate(-2.441 0.006)"/></svg>',
		'mobile'  => '<svg xmlns="http://www.w3.org/2000/svg" width="12.542" height="21" viewBox="0 0 12.542 21"><path id="mobile" d="M159.292,76H150.25a1.748,1.748,0,0,0-1.75,1.75v17.5A1.748,1.748,0,0,0,150.25,97h9.042a1.748,1.748,0,0,0,1.75-1.75V77.75A1.748,1.748,0,0,0,159.292,76Zm.525,16.158h-10.15V79.967h10.15Z" transform="translate(-148.5 -76)"/></svg>',
		'hours'   => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path id="clock" d="M35,977.362a10,10,0,1,0,10,10A10,10,0,0,0,35,977.362Zm0,3.6a.8.8,0,0,1,.8.8V986.9l3.763,2.175a.8.8,0,0,1-.8,1.375l-4.075-2.35a.813.813,0,0,1-.087-.05.792.792,0,0,1-.4-.687v-5.6A.8.8,0,0,1,35,980.962Z" transform="translate(-25 -977.362)"/></svg>',
		'fax'     => '<svg id="fax" xmlns="http://www.w3.org/2000/svg" width="19" height="17.417" viewBox="0 0 19 17.417"><g id="Group_5861" data-name="Group 5861"><path id="Path_26501" data-name="Path 26501" d="M18.208,16H.792A.794.794,0,0,0,0,16.792v5.526a.794.794,0,0,0,.792.792H3.167V20.746H15.833v2.363h2.375A.794.794,0,0,0,19,22.317V16.792A.794.794,0,0,0,18.208,16Zm-5.542,2.771a.792.792,0,1,1,.792-.792A.792.792,0,0,1,12.667,18.771Zm2.375,0a.792.792,0,1,1,.792-.792.792.792,0,0,1-.792.792Z" transform="translate(0 -9.667)" /><path id="Path_26502" data-name="Path 26502" d="M11,32.166v3.182a.794.794,0,0,0,.792.792H20.5a.794.794,0,0,0,.792-.792V30.99H11Z" transform="translate(-6.646 -18.723)" /><path id="Path_26503" data-name="Path 26503" d="M21.292,2.771H19.708a1.191,1.191,0,0,1-1.187-1.188V0H11.792A.794.794,0,0,0,11,.792v4.75H21.292Z" transform="translate(-6.646)" /><path id="Path_26504" data-name="Path 26504" d="M32.4,1.979h1.583L32,0V1.583A.4.4,0,0,0,32.4,1.979Z" transform="translate(-19.333)" /></g></svg>',
		'email'   => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="12.683" viewBox="0 0 20 12.683"><path id="Path_26505" data-name="Path 26505" d="M10.463,976.362a1.465,1.465,0,0,0-.541.107l8.491,7.226a.825.825,0,0,0,1.159,0l8.5-7.233a1.469,1.469,0,0,0-.534-.1H10.463Zm-1.448,1.25a1.511,1.511,0,0,0-.015.213v9.756a1.46,1.46,0,0,0,1.463,1.463H27.537A1.46,1.46,0,0,0,29,987.581v-9.756a1.51,1.51,0,0,0-.015-.213l-8.46,7.2a2.376,2.376,0,0,1-3.064,0Z" transform="translate(-9 -976.362)"/></svg>',
		'website' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path id="Path_26506" data-name="Path 26506" d="M12,50A10,10,0,1,1,2,60,10,10,0,0,1,12,50Zm2.537,14H9.463A9.263,9.263,0,0,0,10.7,66.943c.393.576.776,1.057,1.3,1.057s.907-.481,1.3-1.057A9.263,9.263,0,0,0,14.537,64Zm-7.12,0H5.072a8.038,8.038,0,0,0,3.466,3.213A13.037,13.037,0,0,1,7.417,64Zm11.511,0H16.583a13.037,13.037,0,0,1-1.121,3.213A8.038,8.038,0,0,0,18.928,64ZM7.1,58H4.252a8.062,8.062,0,0,0,0,4H7.1a20.05,20.05,0,0,1,0-4Zm7.791,0H9.109a18.4,18.4,0,0,0,0,4h5.782A17.985,17.985,0,0,0,15,60,17.984,17.984,0,0,0,14.891,58Zm4.857,0H16.9a20,20,0,0,1,.1,2,20,20,0,0,1-.1,2h2.848a8.063,8.063,0,0,0,0-4ZM8.538,52.787A8.038,8.038,0,0,0,5.072,56H7.417A13.037,13.037,0,0,1,8.538,52.787ZM12,52c-.524,0-.907.481-1.3,1.057A9.263,9.263,0,0,0,9.463,56h5.074A9.263,9.263,0,0,0,13.3,53.057C12.907,52.481,12.524,52,12,52Zm3.462.787A13.037,13.037,0,0,1,16.583,56h2.345A8.038,8.038,0,0,0,15.462,52.787Z" transform="translate(-2 -50)" fill-rule="evenodd"/></svg>',
	);

	$attr = array();

	// if ($args['type'] !== 'simple') {
		$attr['data-icons-type'] = $args['type'];
	// }

	if ( $args['type'] !== 'simple' && ! empty( $args['fill'] ) ) {
		$attr['data-icons-type'] .= ':' . $args['fill'];
	}

	if ( ! empty( $args['size'] ) ) {
		$attr['data-icon-size'] = $args['size'];
	}

	ob_start(); ?>

	<ul <?php echo rishi__cb_customizer_attr_to_html( $attr ); ?>>
		<?php foreach ( $args['data'] as $single_layer ) { ?>
			<?php
			if ( ! $single_layer['enabled'] ) {
				continue; }
			?>
			<li>
				<span class="cb__icon-container">
					<?php echo $svgs[ $single_layer['id'] ]; ?>
				</span>

				<div class="contact-info">
					<?php if ( ! empty( rishi__cb_get_akv( 'title', $single_layer, '' ) ) ) { ?>
						<span class="contact-title">
							<?php echo esc_html( rishi__cb_get_akv( 'title', $single_layer, '' ) ); ?>
						</span>
					<?php } ?>

					<?php if ( ! empty( rishi__cb_get_akv( 'content', $single_layer, '' ) ) ) { ?>
						<span class="contact-text">
							<?php if ( ! empty( rishi__cb_get_akv( 'link', $single_layer, '' ) ) ) { ?>
								<a href="<?php echo rishi__cb_get_akv( 'link', $single_layer, '' ); ?>" <?php echo $data_target; ?>>
							<?php } ?>

							<?php echo rishi__cb_get_akv( 'content', $single_layer, '' ); ?>

							<?php if ( ! empty( rishi__cb_get_akv( 'link', $single_layer, '' ) ) ) { ?>
								</a>
							<?php } ?>
						</span>
					<?php } ?>
				</div>
			</li>
		<?php } ?>
	</ul>

	<?php
	return ob_get_clean();
}


function rishi__cb_customizer_fonts_manager() {
	return new \rishi__cb_customizer_Fonts_Manager();
}

/**
 * Gets Context.
 */
function rishi__cb_get_context() {
	if ( is_home() ) {
		return 'is_home';
	} elseif ( is_search() ) {
		return 'is_search';
	} elseif ( is_archive() ) {
		return 'is_archive';
	} elseif ( is_page() ) {
		return 'is_page';
	} elseif ( is_single() ) {
		return 'is_single';
	} elseif ( is_front_page() ) {
		return 'is_front_page';
	}
	return 'none';
}

function rishi__cb_get_page_layout_value() {
	$defaults = rishi__cb__get_layout_defaults();

	$context = '';

	if ( is_home() ) {
		$context = 'home';
	} elseif ( is_archive() ) {
		$context = 'archive';
	} elseif ( is_search() ) {
		$context = 'search';
	}

	$mods = array(
		'home' => 'blog_page_layout',
		'archive' => 'archive_page_layout',
		'search' => 'search_page_layout',
	);

	if ( isset( $mods[ $context ] ) ) {
		return get_theme_mod( $mods[ $context ], $defaults[ $mods[ $context ] ] ? $defaults[ $mods[ $context ] ] : $default_class );
	}
	return '';
}

add_filter(
	'rishi__cb_sidebar_layout',
	function( $layout ) {
		$context = rishi__cb_get_context();

		$defaults = rishi__cb__get_layout_defaults();

		$mods_by_context = array(
			'is_home' => 'blog_sidebar_layout',
			'is_page' => 'page_sidebar_layout',
		);

		if ( isset( $mods_by_context[ $context ] ) ) {
			$layout = get_theme_mod( $mods_by_context[ $context ], $defaults[ $mods_by_context[ $context ] ] ? $defaults[ $mods_by_context[ $context ] ] : $default_class );

			if ( 'default-sidebar' === $layout ) {
				$layout = get_theme_mod( 'layout_style', $defaults['layout_style'] );
			}
			$layout = apply_filters( 'rishi__cb_mod_value', $layout, $mods_by_context[ $context ], $context );
		}

		return $layout;

	}
);


add_filter(
	'rishi__cb_layout_class',
	function( $classes ) {

		$page_layout = rishi__cb_get_page_layout_value();

		$layout_classes = array(
			'listing'      => 'view__listing',
			'grid'         => 'view__grid',
			'classic'      => 'view__classic',
			'masonry_grid' => 'view__masonry-grid',
		);

		if ( isset( $layout_classes[ $page_layout ] ) ) {
			$classes[] = $layout_classes[ $page_layout ];
		}

		return $classes;
	}
);


add_filter(
	'rishi__cb_layout_attributes',
	function( $attr = array() ) {
		$defaults       = rishi__cb__get_layout_defaults();
		$current_layout = rishi__cb_get_page_layout_value();

		if ( in_array( $current_layout, array( 'grid', 'masonry_grid' ), true ) ) {
			if ( is_home() ) {
				$attr['data-cols-per-row'] = get_theme_mod( 'blog_posts_per_row', $defaults['blog_posts_per_row'] );
			} elseif ( is_archive( ) ) {
				$attr['data-cols-per-row'] = get_theme_mod( 'archive_posts_per_row', $defaults['archive_posts_per_row'] );
			} elseif( is_search() ) {
				$attr['data-cols-per-row'] = get_theme_mod( 'search_posts_per_row', $defaults['search_posts_per_row'] );
			}
		}

		return $attr;

	}
);


add_action(
	'rishi__cb_the_posts_navigation',
	function( $callable ) {
		$context = rishi__cb_get_context();

		$mods_by_contexts = array(
			'is_home'    => 'post_navigation',
			'is_archive' => 'archive_post_navigation',
			'is_author'  => 'author_post_navigation',
			'is_shop'    => 'woo_post_navigation',
			'is_search'  => 'search_post_navigation',
		);

		$pagination_types = array(
			'numbered'        => function() {
				echo rishi__cb_customizer_display_posts_pagination( ['pagination_type' => 'simple'] ); // phpcs:ignore

			},
			'infinite_scroll' => function() {
				echo rishi__cb_customizer_display_posts_pagination( ['pagination_type' => 'infinite_scroll'] ); // phpcs:ignore
			},
		);

		$defaults = rishi__cb__get_layout_defaults();

		if ( isset( $mods_by_contexts[ $context ] ) ) {
			$pagination_type = get_theme_mod( $mods_by_contexts[ $context ], $defaults[ $mods_by_contexts[ $context ] ] );
			if ( isset( $pagination_types[ $pagination_type ] ) ) {
				$callable = $pagination_types[ $pagination_type ];
			}
		}
		is_callable( $callable ) && $callable();
	}
);

add_filter( 'rishi__cb_breadcrumb_settings', 'rishi__cb_get_breadcrumb_settings' );
function rishi__cb_get_breadcrumb_settings() {
	$defaults = rishi__cb__get_breadcrumbs_defaults();

	$current = array();

	foreach ( $defaults as $mod_name => $default_value ) {
		$current[ $mod_name ] = get_theme_mod( $mod_name, $default_value );
	}

	$separator_svg_names = array(
		'type-1' => 'breadcrumb-sep-1',
		'type-2' => 'breadcrumb-sep-2',
		'type-3' => 'breadcrumb-sep-3',
	);

	$current['breadcrumbs_separator_svg'] = '';

	if ( in_array( $current['breadcrumbs_separator'], array( 'type-1', 'type-2', 'type-3' ) ) ) {
		$current['breadcrumbs_separator_svg'] = rishi__cb_customizer_image_picker_file( $separator_svg_names[ $current['breadcrumbs_separator'] ] );
	}

	$current['is_breadcrumb_enabled'] = true;
	if ( is_archive() ) {
		$current['is_breadcrumb_enabled'] = get_theme_mod( 'breadcrumbs_ed_archive', 'yes' ) === 'yes';
	} elseif ( is_search() ) {
		$current['is_breadcrumb_enabled'] = get_theme_mod( 'breadcrumbs_ed_search', 'yes' ) === 'yes';
	} elseif ( is_page() ) {
		$current['is_breadcrumb_enabled'] = get_theme_mod( 'breadcrumbs_ed_single_page', 'yes' ) === 'yes';
	} elseif( !is_front_page() && is_home() ) {
		$current['is_breadcrumb_enabled'] = get_theme_mod( 'blog_ed_breadcrumbs', 'yes' ) === 'yes';
	}

	return $current;
}


add_filter( 'rishi__cb_page_title_settings', 'rishi__cb_get_page_title_settings' );
function rishi__cb_get_page_title_settings( $settings ) {
	$defaults = rishi__cb__get_breadcrumbs_defaults();

	$settings = array(); // Reset.

	$settings = array(
		'title_prefix'          => '',
		'show_page_title'       => get_theme_mod( 'archive_page_title_ed', 'yes' ) === 'yes',
		'show_page_description' => get_theme_mod( 'archive_page_desc_ed', 'yes' ) === 'yes',
		'show_breadcrumbs'      => true,
		'show_title_prefix'     => get_theme_mod( 'archive_page_prefix_ed', 'no' ) === 'yes',
		'page_title'            => __( 'Archive', 'rishi' ),
		'title_alignment'       => 'left',
		'vertical_spacing'      => 48,
		'show_counts'           => true,
		'counts_bottom_margin'  => 48,
		'is_title_enabled'      => true,
		'breadcrumbs_position'  => get_theme_mod( 'breadcrumbs_position', 'before' ),
		'show_comments'         => false,
	);

	if ( is_archive() ) {

		if ( is_category() ) {
			$settings['title_prefix'] = __( 'Browsing Category:', 'rishi' );
			$settings['page_title']   = single_cat_title( '', false );
			$post_type              = get_post_type();
			$post_type_options        = array(
				'post' => array(
				'show_breadcrumbs' => get_theme_mod( 'breadcrumbs_ed_archive', $defaults['breadcrumbs_ed_archive'] ) === 'yes',

				),
			);
			if ( isset( $post_type_options[ $post_type ] ) ) {
				$settings = wp_parse_args( $post_type_options[ $post_type ], $settings );
			}
		} elseif ( is_tag() ) {
			$settings['title_prefix'] = __( 'Browsing Tag:', 'rishi' );
			$settings['page_title']   = single_tag_title( '', false );
		} elseif ( is_year() ) {
			$settings['title_prefix'] = __( 'Browsing Year:', 'rishi' );
			$settings['page_title']   = get_the_date( _x( 'Y', 'yearly archives date format', 'rishi' ) );
		} elseif ( is_month() ) {
			$settings['title_prefix'] = __( 'Browsing Month:', 'rishi' );
			$settings['page_title']   = get_the_date( _x( 'F Y', 'monthly archives date format', 'rishi' ) );
		} elseif ( is_day() ) {
			$settings['title_prefix'] = __( 'Browsing Day:', 'rishi' );
			$settings['page_title']   = get_the_date( _x( 'F j, Y', 'daily archives date format', 'rishi' ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );

			$settings['title_prefix'] = sprintf( __('Browsing %s', 'rishi'), $tax->label );
			$settings['page_title']   = single_term_title( '', false );
		}

		$settings['show_counts']      = get_theme_mod( 'archive_page_search_ed', 'no' ) === 'yes';
		$settings['is_title_enabled'] = get_theme_mod( 'archive_title_panel', 'yes' ) === 'yes';
	} elseif ( is_singular() ) {
		$settings['page_title'] = get_the_title();
		$post_type              = get_post_type();
		$post_type_options      = array(
			'page' => array(
				'is_title_enabled'       => get_theme_mod( 'page_title_panel', 'yes' ) === 'yes',
				'page_title'             => get_the_title(),
				'show_breadcrumbs'       => get_theme_mod( 'breadcrumbs_ed_single_page', $defaults['breadcrumbs_ed_single_page'] ) === 'yes',
				'show_comments'          => get_theme_mod( 'single_page_ed_comment', 'no' ) === 'yes',
				'enabled_featured_image' => get_theme_mod( 'single_page_has_featured_image', 'yes' ) === 'yes',
				'featured_image_ratio'   => get_theme_mod( 'single_page_featured_image_ratio', 'original' ),
				'featured_image_size'    => get_theme_mod( 'single_page_featured_image_size', 'full' ),
			),
			'post' => array(
				'is_title_enabled' => true,
				'page_title'       => get_the_title(),
				'show_breadcrumbs' => get_theme_mod( 'breadcrumbs_ed_single_post', $defaults['breadcrumbs_ed_single_post'] ) === 'yes',
			),
		);
		if ( isset( $post_type_options[ $post_type ] ) ) {
			$settings = wp_parse_args( $post_type_options[ $post_type ], $settings );
		}
	} elseif( is_search() ) {
		$settings['show_breadcrumbs'] = get_theme_mod( 'breadcrumbs_ed_search', $defaults['breadcrumbs_ed_search'] ) === 'yes';
		$settings['show_counts']      = get_theme_mod( 'search_page_search_ed', 'no' ) === 'yes';
	}

	return $settings;
}

function rishi__cb_get_header_cart_icons(){
	return apply_filters(
		'rt:header:cart:icons',
		array(
			'type-1' => '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M6.41665 6.16665C6.41665 3.17513 8.8418 0.75 11.8333 0.75C14.8249 0.75 17.25 3.17513 17.25 6.16665V7.75H20C20.39 7.75 20.715 8.049 20.7474 8.4377L21.9141 22.4377C21.9315 22.6468 21.8606 22.8535 21.7186 23.0079C21.5765 23.1622 21.3764 23.25 21.1666 23.25H2.5C2.29026 23.25 2.0901 23.1622 1.94809 23.0079C1.80607 22.8535 1.73517 22.6468 1.75259 22.4377L2.91926 8.4377C2.95165 8.049 3.2766 7.75 3.66667 7.75H6.41665V6.16665ZM15.75 7.75H7.91665V6.16665C7.91665 4.00355 9.6702 2.25 11.8333 2.25C13.9964 2.25 15.75 4.00355 15.75 6.16665V7.75Z" stroke="none"/></svg>',
	
			'type-2' => '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 18C16.9038 18 16 18.8846 16 20C16 21.0962 16.8846 22 18 22C19.0962 22 20 21.1154 20 20C19.9808 18.9038 19.0962 18 18 18Z" stroke="none"/><path d="M21.2662 5.36093C21.2212 5.36093 21.1539 5.33775 21.0865 5.33775H6.94004L6.71549 3.78477C6.58076 2.7649 5.72748 2 4.71702 2H3C2.5 2 2 2.5 2 3C2 3.5 2.5 4 3 4C3 4 4.60475 4 4.71702 4C4.8293 4 4.91911 4.09272 4.94157 4.20861C4.96402 4.3245 6.33376 13.8444 6.33376 13.8444C6.5134 15.0728 7.54632 16 8.75887 16H18.1C19.2677 16 20.2781 15.1424 20.5252 13.9603L21.9847 6.42715C22.0745 5.9404 21.7602 5.45364 21.2662 5.36093Z" stroke="none"/><path d="M8.96972 18C7.82803 18.058 6.96192 18.9855 7.00129 20.087C7.04066 21.1498 7.92645 22 9.00909 22H9.04846C10.1705 21.942 11.0563 21.0145 10.9972 19.913C10.9578 18.8502 10.0524 18 8.96972 18Z" stroke="none"/></svg>',
	
			'type-3' => '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.46398 9.50757C1.16228 9.50757 0.9409 9.79112 1.01408 10.0838L3.94062 21.79C4.04385 22.2029 4.41483 22.4926 4.84044 22.4926H19.1595C19.5851 22.4926 19.9561 22.2029 20.0593 21.79L22.9859 10.0838C23.0591 9.79112 22.8377 9.50757 22.536 9.50757H1.46398ZM12 13.6813C10.7194 13.6813 9.68125 14.7195 9.68125 16.0001C9.68125 17.2807 10.7194 18.3188 12 18.3188C13.2806 18.3188 14.3187 17.2807 14.3187 16.0001C14.3187 14.7195 13.2806 13.6813 12 13.6813Z" stroke="none"/><path d="M18.5 10.5L13.5887 4.07758C12.7882 3.03078 11.2118 3.03078 10.4113 4.07758L5.5 10.5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>',
	
			'type-4' => '<svg class="cb__icon" width="15" height="15" viewBox="0 0 10 10"><path d="M7.2 2.1V1c0-.6-.5-1-1.1-1H3.9c-.6 0-1.1.4-1.1 1v1H0v7c0 .6.5 1 1.1 1h7.8c.6 0 1.1-.5 1.1-1V2.1H7.2zM3.8.9h2.5v1.2H3.8V.9zM9 9.1H1v-6h8v6zM2.9 4.7c0-.3.2-.5.5-.5s.6.2.6.5-.3.5-.6.5-.5-.2-.5-.5zm3.1 0c0-.3.2-.5.5-.5s.5.2.5.5-.2.5-.5.5c-.2 0-.5-.2-.5-.5z"/></svg>',
	
			'type-5' => '<svg class="cb__icon" width="15" height="15" viewBox="0 0 10 10"><path d="M9.5 2.1V2L8.1.2C8 .1 7.9 0 7.7 0H2.3c-.2 0-.3.1-.4.2L.5 2v6.7c0 .8.6 1.4 1.4 1.4h6.4c.8 0 1.4-.6 1.4-1.4V2.3c-.2-.1-.2-.1-.2-.2zM2.5.9h5l.7.9H1.8l.7-.9zm5.7 8.2H1.8c-.3 0-.5-.2-.5-.5V2.7h7.3v5.9c0 .3-.2.5-.4.5zm-.9-5c0 1.3-1 2.3-2.3 2.3s-2.3-1-2.3-2.3c0-.3.2-.5.5-.5s.5.2.5.5c0 .8.6 1.4 1.4 1.4s1.4-.6 1.4-1.4c0-.3.2-.5.5-.5.1 0 .3.2.3.5z"/></svg>',
	
			'type-6' => '<svg class="cb__icon" width="15" height="15" viewBox="0 0 10 10"><path d="M10 4.2c0-.1-.1-.2-.2-.3-.1-.3-.4-.4-.6-.4h-.9L5.8.9C5.6.6 5.3.5 5 .5c-.3 0-.6.1-.8.4L1.7 3.5H.8c-.2 0-.5.1-.6.3-.1.1-.2.3-.2.5V4.9l.6 3.4c.1.8.8 1.3 1.5 1.3H7.8c.7 0 1.4-.6 1.5-1.3l.6-3.4v-.3-.2c.1-.1.1-.2.1-.2zM4.7 1.4c.1-.1.2-.2.3-.2s.2 0 .3.1l2 2.1H2.7l2-2zM2.9 7.8c-.2 0-.4-.1-.4-.4l-.1-1.7c0-.2.2-.4.4-.4s.3.2.4.4l.1 1.8c0 .1-.2.2-.4.3zm2.5-.4c0 .2-.2.4-.4.4s-.4-.2-.4-.4V5.6c0-.2.2-.4.4-.4s.4.2.4.4v1.8zm2.2-1.7l-.2 1.7c0 .2-.2.4-.4.4s-.3-.2-.3-.4l.1-1.8c0-.2.2-.4.4-.4s.4.2.4.5c0-.1 0-.1 0 0z"/></svg>',
		)
	);
}

if( ! function_exists( 'rishi_404_show_blog_page_button_label' ) ) :
	function rishi_404_show_blog_page_button_label(){
		$show_blog_page_button_label = get_theme_mod( '404_show_blog_page_button_label',__('Go To Blog', 'rishi') ); 
		$blog                        = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : get_home_url();
		echo '<div class="go-to-blog-wrap">';
			if( $show_blog_page_button_label ){ ?>				
				<a href="<?php echo esc_url( $blog ); ?>" class="go-to-blog"><?php echo esc_html( $show_blog_page_button_label ); ?></a>
			<?php }
		echo '</div>';
	} 
endif;

/**
 * Check if Rishi Companion Plugin is installed and active
 * @return boolean
 * @since 1.0.0
 * @package Rishi
 * @category Functions
 */
function rishi_is_companion_plugin_active(){
	return class_exists( 'Rishi\Rishi_Companion' ) ? true : false;
}

if( ! function_exists( 'rishi_search_page_label_activecallback' ) ) :
	/**
	 * Search label partial refresh
	*/
	function rishi_search_page_label_activecallback(){
		$search_page_label = get_theme_mod( 'search_page_label',__( 'Search Result for','rishi' ) );
		echo "<span class='search-res'>";
		if( $search_page_label ) echo esc_html( $search_page_label ); 
		echo "</span>";
	}
endif;

if( ! function_exists( 'rishi_single_product_upsell_activecallback' ) ) :
	/**
	 * Single Product upsell tab section partial refresh
	*/
	function rishi_single_product_upsell_activecallback(){
		$upsell_tab_label = get_theme_mod( 'woo_upsell_tab_label',__( 'Upsell Products','rishi' ) );
		
		echo '<li class="rishi_upsell_products_tab" id="tab-title-rishi_upsell_products" role="tab" aria-controls="tab-rishi_upsell_products">';
		echo '<a href="#tab-rishi_upsell_products">';
		if( $upsell_tab_label ) echo esc_html( $upsell_tab_label );
		echo '</a>';
		echo '</li>';
	}
endif;