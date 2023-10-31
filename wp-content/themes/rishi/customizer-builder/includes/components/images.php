<?php

/**
 * Images generators
 *
 * @copyright 2019-present Rara Themes
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package Rishi
 */

if (!function_exists('rishi__cb_customizer_has_lazyload')) {
	function rishi__cb_customizer_has_lazyload(  )
	{
		if (
			wp_doing_ajax()
			&&
			isset($_REQUEST['action'])
			&&
			$_REQUEST['action'] = 'brizy_shortcode_content'
		) {
			return false;
		}

		if (class_exists('WP_Smush_Lazy_Load')) {
			if (\WP_Smush_Settings::get_instance()->get('lazy_load')) {
				return false;
			}
		}

		if (
			class_exists('Jetpack')
			&&
			\Jetpack::is_module_active('lazy-images')
		) {
			return false;
		}

		if (
			function_exists('get_rocket_option')
			&&
			!!get_rocket_option('lazyload')
		) {
			return false;
		}

		if( ! apply_filters('rishi_lazy_load_on_single_post', true ) ) return false;

		return class_exists( 'Rishi\Rishi_Companion\RishiCompanionExtensionPerformance' ) && get_theme_mod('has_lazy_load', 'yes') === 'yes';
	}
}

/**
 * Output image container for an attachment.
 *
 * @param array $args various params that the function accepts.
 */
if (!function_exists('rishi__cb_customizer_image')) {
	function rishi__cb_customizer_image( $args = [] )
	{
		$args = wp_parse_args(
			$args,
			[
				'attachment_id' => null,
				'other_images' => [],
				'ratio' => '1/1',
				'class' => '',
				'ratio_blocks' => true,
				'tag_name' => 'div',
				'html_atts' => [],
				'img_atts' => [],
				'inner_content' => '',
				'lazyload' => rishi__cb_customizer_has_lazyload(),
				'lazyload_type' => get_theme_mod('lazy_load_type', 'fade'),
				'size' => 'medium',

				// default | woo
				'no_image_type' => 'default',

				'suffix' => ''
			]
		);

		$classes = $args['class'];

		$attachment_exists = !!wp_get_attachment_image_src($args['attachment_id']);

		$other_html_atts = apply_filters( 'rishi__cb_customizer_image_other_attributes', '', $args['attachment_id'] );

		$original_class = 'rt-image-container';

		if (!empty($args['suffix'])) {
			$original_class .= '-' . $args['suffix'];
		}

		$args['html_atts']['class'] = $original_class . (empty($classes) ? '' : ' ' . $classes);

		if (!$attachment_exists) {
			if ($args['no_image_type'] === 'woo') {
				$placeholder_image = get_option('woocommerce_placeholder_image', 0);

				if ($placeholder_image) {
					if (is_numeric($placeholder_image)) {
						$args['attachment_id'] = $placeholder_image;
						$attachment_exists = !!wp_get_attachment_image_src($args['attachment_id']);
					} else {
						return rishi__cb_customizer_simple_image($placeholder_image, $args);
					}
				}
			}
		}

		if (!$attachment_exists) {
			$no_image_class = 'rt-no-image';
			$args['html_atts']['class'] .= ' ' . $no_image_class;
		}

		if ($args['lazyload'] && $attachment_exists) {
			$args['html_atts']['class'] .= ' rt-lazy';

			if ($args['lazyload_type'] === 'none') {
				$args['html_atts']['class'] .= ' rt-lazy-static';
			}

			if ($args['lazyload_type'] === 'circle') {
				$args['inner_content'] .= '<span data-loader="circles"><span></span><span></span><span></span></span>';
			}
		}

		if( rishi_is_woocommerce_activated() && is_product() && is_single() ){
			$gallery_ratio     = get_theme_mod( 'gallery_image_options', '1/1' );

			$args['inner_content'] .= rishi__cb_customizer_generate_ratio(
				$gallery_ratio,
				$args['attachment_id'],
				$args['size']
			);
		}elseif ($args['ratio_blocks']) {
			$args['inner_content'] .= rishi__cb_customizer_generate_ratio(
				$args['ratio'],
				$args['attachment_id'],
				$args['size']
			);
		}

		if (isset($args['html_atts']['class'])) {
			$other_html_atts .= 'class="' . $args['html_atts']['class'] . '" ';
			unset($args['html_atts']['class']);
		}

		if ($args['attachment_id']) {
			if (wp_get_attachment_image_src($args['attachment_id'])) {
				$info = wp_get_attachment_metadata($args['attachment_id']);

				if (
					$info
					&&
					isset($info['width'])
					&&
					intval($info['width']) !== 0
					&&
					is_customize_preview()
				) {
					$args['html_atts']['data-w'] = $info['width'];
					$args['html_atts']['data-h'] = $info['height'];
				}
			}
		}

		foreach ($args['html_atts'] as $attr => $value) {
			$other_html_atts .= $attr . '="' . $value . '" ';
		}

		$other_html_atts = trim($other_html_atts);

		$a_tag_start = ( is_archive() || is_home() || is_search() ) ? '<a href="' . esc_url( get_the_permalink() ) . '">' : '';
		$a_tag_end   = ( is_archive() || is_home() || is_search() ) ? '</a>' : '';
		return $a_tag_start . '<' . $args['tag_name'] . ' ' . $other_html_atts . '>' .
		 rishi__cb_customizer_get_image_element($args) .
			$args['inner_content'] .
			'</' . $args['tag_name'] . '>' . $a_tag_end;
	}
}


/**
 * Output image element for all the cases.
 *
 * @param array $args various params that the function accepts.
 */
if (!function_exists('rishi__cb_customizer_get_image_element')) {
	function rishi__cb_customizer_get_image_element( $args )
	{
		if (!wp_get_attachment_image_src($args['attachment_id'])) {
			return '';
		}

		$parser = new \Rishi_Attributes_Parser();

		$image = wp_get_attachment_image(
			$args['attachment_id'],
			$args['size']
		);

		$has_srcset = strpos($image, 'srcset') !== false;

		$output = '';

		if ($args['lazyload']) {
			$output = '<noscript>' . $image . '</noscript>';

			$image = $parser->rename_attribute_from_images(
				$image,
				'src',
				'data-rt-lazy'
			);

			if ($has_srcset) {
				$image = $parser->rename_attribute_from_images(
					$image,
					'srcset',
					'data-rt-lazy-set'
				);
			}
		}

		$image = $parser->add_attribute_to_images($image, 'data-object-fit', '~');

		if ( rishi__cb_customizer_has_schema_org_markup()) {
			$image = $parser->add_attribute_to_images($image, 'itemprop', 'image');
		}

		foreach ($args['img_atts'] as $attr => $attr_value) {
			$image = $parser->add_attribute_to_images($image, $attr, $attr_value);
		}

		if (!empty($args['other_images'])) {
			foreach ($args['other_images'] as $other_image) {
				$other_image = wp_get_attachment_image(
					$other_image,
					$args['size']
				);

				$other_image = $parser->add_attribute_to_images($other_image, 'class', 'rt-swap');

				if ($args['lazyload']) {
					$other_image = $parser->rename_attribute_from_images(
						$other_image,
						'src',
						'data-rt-lazy'
					);

					if ($has_srcset) {
						$other_image = $parser->rename_attribute_from_images(
							$other_image,
							'srcset',
							'data-rt-lazy-set'
						);
					}
				}

				$output = $other_image . $output;
			}
		}

		$output = $image . $output;

		return $output;
	}
}

/**
 * Generate ratio div based on ratio.
 *
 * @param string $ratio 1/1 | 1/2 | 4/3 | 3/4 ...
 */
if (!function_exists('rishi__cb_customizer_generate_ratio')) {
	function rishi__cb_customizer_generate_ratio( $ratio, $attachment_id = null, $size = null )
	{
		$result = 0;

		if ('original' === $ratio) {
			if (!$attachment_id) {
				$result = 1;
			} else {
				$all_sizes = rishi__cb_customizer_get_all_wp_image_sizes();

				if (
					$size
					&&
					$size !== 'full'
					&&
					isset($all_sizes[$size])
					&&
					$all_sizes[$size]['width']
					&&
					$all_sizes[$size]['height']
				) {
					$info = $all_sizes[$size];
				} else {
					$info = wp_get_attachment_metadata($attachment_id);
				}

				if (
					$info
					&&
					isset($info['width'])
					&&
					intval($info['width']) !== 0
				) {
					$result = (int) $info['height'] / (int) $info['width'];
				} else {
					$result = 1;
				}
			}
		} else {
			$computed_ratio = explode(
				strpos($ratio, '/') !== false ? '/' : ':',
				$ratio
			);
			
			$result = (float) (isset($computed_ratio[1]) ? $computed_ratio[1] : 1 ) / (float) (isset($computed_ratio[0]) ? $computed_ratio[0] : 1);
		}

		$style = 'padding-bottom: ' . round($result * 100, 1) . '%';
		return '<span class="rt-ratio" style="' . $style . '"></span>';
	}
}


if (!function_exists('rishi__cb_customizer_get_all_wp_image_sizes')) {
	function rishi__cb_customizer_get_all_wp_image_sizes(  )
	{
		global $_wp_additional_image_sizes;

		$default_image_sizes = get_intermediate_image_sizes();

		$image_sizes = [];

		foreach ($default_image_sizes as $size) {
			$image_sizes[$size] = [];
			$image_sizes[$size]['width'] = intval(get_option("{$size}_size_w"));
			$image_sizes[$size]['height'] = intval(get_option("{$size}_size_h"));
			$image_sizes[$size]['crop'] = get_option("{$size}_crop") ? get_option("{$size}_crop") : false;
		}

		if (isset($_wp_additional_image_sizes) && count($_wp_additional_image_sizes)) {
			$image_sizes = array_merge($image_sizes, $_wp_additional_image_sizes);
		}


		return $image_sizes;
	}
}

/**
 * Generate an image container based on image URL.
 *
 * @param string $image_src URL to the image.
 * @param array $args various params that the function accepts.
 */
if (!function_exists('rishi__cb_customizer_simple_image')) {
	function rishi__cb_customizer_simple_image( $image_src, $args = [] )
	{
		$args = wp_parse_args(
			$args,
			[
				'ratio' => '1/1',
				'class' => '',
				'ratio_blocks' => true,
				'tag_name' => 'div',
				'html_atts' => [],
				'img_atts' => [],
				'inner_content' => '',
				'lazyload' => rishi__cb_customizer_has_lazyload(),
				'lazyload_type' => get_theme_mod('lazy_load_type', 'fade'),
				'size' => 'medium',
				'has_image' => true,
				'suffix' => ''
			]
		);

		$original = 'rt-image-container';

		if (!empty($args['suffix'])) {
			$original .= '-' . $args['suffix'];
		}

		$image_attr = 'src';

		$other_img_atts = '';

		if (!isset($args['img_atts']['alt'])) {
			$args['img_atts']['alt'] = __('Default image', 'rishi');
		}

		foreach ($args['img_atts'] as $attr => $value) {
			$other_img_atts .= $attr . '="' . $value . '" ';
		}

		if ($args['lazyload']) {
			$original .= ' rt-lazy';

			if ($args['lazyload_type'] === 'none') {
				$original .= ' rt-lazy-static';
			}

			if ($args['has_image']) {
				$args['inner_content'] .= '<noscript>';
				$args['inner_content'] .= '<img ' . $image_attr . '="' . $image_src . '" data-object-fit="~" ' . $other_img_atts . '>';
				$args['inner_content'] .= '</noscript>';
			}

			$image_attr = 'data-rt-lazy';

			if ($args['lazyload_type'] === 'circle') {
				$args['inner_content'] .= '<span data-loader="circles"><span></span><span></span><span></span></span>';
			}
		}

		if (!isset($args['html_atts']['class'])) {
			$args['html_atts']['class'] = $original;
		} else {
			$args['html_atts']['class'] = $original . ' ' . $args['html_atts']['class'];
		}

		$other_html_atts = '';

		foreach ($args['html_atts'] as $attr => $value) {
			$other_html_atts .= $attr . '="' . $value . '" ';
		}

		$other_html_atts = trim($other_html_atts);

		if ($args['ratio_blocks']) {
			$args['inner_content'] .= rishi__cb_customizer_generate_ratio($args['ratio']);
		}

		$image_content = '';

		if ($args['has_image']) {
			$image_content = '<img ' . $image_attr . '="' . $image_src . '" data-object-fit="~" ' . $other_img_atts . '>';
		}

		return '<' . $args['tag_name'] . ' ' . $other_html_atts . '>' .
			$image_content .  $args['inner_content'] .
			'</' . $args['tag_name'] . '>';
	}
}
