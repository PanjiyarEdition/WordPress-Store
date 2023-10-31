<?php
/**
 * Helper Functions.
 *
 * @package Rishi_Companion
 */


function rishi_companion_call_fn($args = [], ...$params) {
	$args = wp_parse_args(
		$args,
		[
			'fn' => null,

			// string | null | array
			'default' => ''
		]
	);

	if (! $args['fn']) {
		throw new Error('$fn must be specified!');
	}

	if (! function_exists($args['fn'])) {
		return $args['default'];
	}

	return call_user_func($args['fn'], ...$params);
}

/**
 * check if the current request is rest or ajax
 */
function rishi_companion_is_dynamic_request () {
    if((defined('REST_REQUEST') && REST_REQUEST) || (function_exists('wp_is_json_request') && wp_is_json_request()) || wp_doing_ajax() || wp_doing_cron()) {
        return true;
    }

    return false;
}

/**
 * check for page builder query args
 *
 * @return void
 */
function rishi_companion_is_page_builder() {
	$page_builders = array(
		'elementor-preview', //elementor
		'fl_builder', //beaver builder
		'et_fb', //divi
		'ct_builder', //oxygen
		'tve' //thrive
	);

	foreach($page_builders as $page_builder) {
		if(isset($_GET[$page_builder])) {
			return true;
		}
	}

	return false;
}

/**
 * check for lazy load
 *
 * @return void
 */
function rishi_lazyload_get_atts_array($atts_string) {

	if(!empty($atts_string)) {
		$atts_array = array_map(
			function(array $attribute) {
				return $attribute['value'];
			},
			wp_kses_hair($atts_string, wp_allowed_protocols())
		);

		return $atts_array;
	}

	return false;
}

/**
 * check for lazy load
 *
 * @return void
 */
function rishi_lazyload_get_atts_string($atts_array) {

	if(!empty($atts_array)) {
		$assigned_atts_array = array_map(
		function($name, $value) {
				if($value === '') {
					return $name;
				}
				return sprintf('%s="%s"', $name, esc_attr($value));
			},
			array_keys($atts_array),
			$atts_array
		);
		$atts_string = implode(' ', $assigned_atts_array);

		return $atts_string;
	}

	return false;
}

/**
 * check for comment counts
 *
 * @return void
 */
function rishi_companion_get_comments_count() {

	global $post;

	return get_comments_number($post);
}

/**
 * List function.
 *
 * @since 1.1.6
 */
function rishi_companion_list( $list_array, $data ) {
	if ( is_array( $list_array ) ) {
		return array_map( function( $key ) use ($data) {
			if ( isset( $data[ $key ] ) ) {
				return $data[ $key ];
			}
			return NULL;
		}, $list_array );
	}
	return $data;
}


if (!function_exists('rishi_companion_multiple_authors_social_profile')) :
	/**
	 * Rishi Multiple Author Social Profile
	 */
	function rishi_companion_multiple_authors_social_profile( $user_id ){
		/**
		 * Array of lists for social profile 
		 */
		$metadata = [
			'facebook' => [
				'name' => __('Facebook', 'rishi'),
				'icon' => '
				<svg
				class="rt-icon"
				width="20"
				height="20"
				viewBox="0 0 24 24">
					<path d="m15.997 3.985h2.191v-3.816c-.378-.052-1.678-.169-3.192-.169-3.159 0-5.323 1.987-5.323 5.639v3.361h-3.486v4.266h3.486v10.734h4.274v-10.733h3.345l.531-4.266h-3.877v-2.939c.001-1.233.333-2.077 2.051-2.077z"/>
				</svg>',
			],
			'twitter' => [
				'name' => __('Twitter', 'rishi'),
				'icon' => '
				<svg
				class="rt-icon"
				width="20"
				height="20"
				viewBox="0 0 20 20">
					<path d="M20,3.8c-0.7,0.3-1.5,0.5-2.4,0.6c0.8-0.5,1.5-1.3,1.8-2.3c-0.8,0.5-1.7,0.8-2.6,1c-0.7-0.8-1.8-1.3-3-1.3c-2.3,0-4.1,1.8-4.1,4.1c0,0.3,0,0.6,0.1,0.9C6.4,6.7,3.4,5.1,1.4,2.6C1,3.2,0.8,3.9,0.8,4.7c0,1.4,0.7,2.7,1.8,3.4C2,8.1,1.4,7.9,0.8,7.6c0,0,0,0,0,0.1c0,2,1.4,3.6,3.3,4c-0.3,0.1-0.7,0.1-1.1,0.1c-0.3,0-0.5,0-0.8-0.1c0.5,1.6,2,2.8,3.8,2.8c-1.4,1.1-3.2,1.8-5.1,1.8c-0.3,0-0.7,0-1-0.1c1.8,1.2,4,1.8,6.3,1.8c7.5,0,11.7-6.3,11.7-11.7c0-0.2,0-0.4,0-0.5C18.8,5.3,19.4,4.6,20,3.8z"/>
				</svg>',
			],
			'instagram' => [
				'name' => 'Instagram',
				'icon' => '
				<svg
				class="rt-icon"
				width="20"
				height="20"
				viewBox="0 0 511 511.9">
					<path d="m510.949219 150.5c-1.199219-27.199219-5.597657-45.898438-11.898438-62.101562-6.5-17.199219-16.5-32.597657-29.601562-45.398438-12.800781-13-28.300781-23.101562-45.300781-29.5-16.296876-6.300781-34.898438-10.699219-62.097657-11.898438-27.402343-1.300781-36.101562-1.601562-105.601562-1.601562s-78.199219.300781-105.5 1.5c-27.199219 1.199219-45.898438 5.601562-62.097657 11.898438-17.203124 6.5-32.601562 16.5-45.402343 29.601562-13 12.800781-23.097657 28.300781-29.5 45.300781-6.300781 16.300781-10.699219 34.898438-11.898438 62.097657-1.300781 27.402343-1.601562 36.101562-1.601562 105.601562s.300781 78.199219 1.5 105.5c1.199219 27.199219 5.601562 45.898438 11.902343 62.101562 6.5 17.199219 16.597657 32.597657 29.597657 45.398438 12.800781 13 28.300781 23.101562 45.300781 29.5 16.300781 6.300781 34.898438 10.699219 62.101562 11.898438 27.296876 1.203124 36 1.5 105.5 1.5s78.199219-.296876 105.5-1.5c27.199219-1.199219 45.898438-5.597657 62.097657-11.898438 34.402343-13.300781 61.601562-40.5 74.902343-74.898438 6.296876-16.300781 10.699219-34.902343 11.898438-62.101562 1.199219-27.300781 1.5-36 1.5-105.5s-.101562-78.199219-1.300781-105.5zm-46.097657 209c-1.101562 25-5.300781 38.5-8.800781 47.5-8.601562 22.300781-26.300781 40-48.601562 48.601562-9 3.5-22.597657 7.699219-47.5 8.796876-27 1.203124-35.097657 1.5-103.398438 1.5s-76.5-.296876-103.402343-1.5c-25-1.097657-38.5-5.296876-47.5-8.796876-11.097657-4.101562-21.199219-10.601562-29.398438-19.101562-8.5-8.300781-15-18.300781-19.101562-29.398438-3.5-9-7.699219-22.601562-8.796876-47.5-1.203124-27-1.5-35.101562-1.5-103.402343s.296876-76.5 1.5-103.398438c1.097657-25 5.296876-38.5 8.796876-47.5 4.101562-11.101562 10.601562-21.199219 19.203124-29.402343 8.296876-8.5 18.296876-15 29.398438-19.097657 9-3.5 22.601562-7.699219 47.5-8.800781 27-1.199219 35.101562-1.5 103.398438-1.5 68.402343 0 76.5.300781 103.402343 1.5 25 1.101562 38.5 5.300781 47.5 8.800781 11.097657 4.097657 21.199219 10.597657 29.398438 19.097657 8.5 8.300781 15 18.300781 19.101562 29.402343 3.5 9 7.699219 22.597657 8.800781 47.5 1.199219 27 1.5 35.097657 1.5 103.398438s-.300781 76.300781-1.5 103.300781zm0 0"/><path d="m256.449219 124.5c-72.597657 0-131.5 58.898438-131.5 131.5s58.902343 131.5 131.5 131.5c72.601562 0 131.5-58.898438 131.5-131.5s-58.898438-131.5-131.5-131.5zm0 216.800781c-47.097657 0-85.300781-38.199219-85.300781-85.300781s38.203124-85.300781 85.300781-85.300781c47.101562 0 85.300781 38.199219 85.300781 85.300781s-38.199219 85.300781-85.300781 85.300781zm0 0"/><path d="m423.851562 119.300781c0 16.953125-13.746093 30.699219-30.703124 30.699219-16.953126 0-30.699219-13.746094-30.699219-30.699219 0-16.957031 13.746093-30.699219 30.699219-30.699219 16.957031 0 30.703124 13.742188 30.703124 30.699219zm0 0"/>
				</svg>'
			],
			'pinterest' => [
				'name' => __('Pinterest', 'rishi'),
				'icon' => '
				<svg
				class="rt-icon"
				width="20"
				height="20"
				viewBox="0 0 20 20">
					<path d="M10,0C4.5,0,0,4.5,0,10c0,4.1,2.5,7.6,6,9.2c0-0.7,0-1.5,0.2-2.3c0.2-0.8,1.3-5.4,1.3-5.4s-0.3-0.6-0.3-1.6c0-1.5,0.9-2.6,1.9-2.6c0.9,0,1.3,0.7,1.3,1.5c0,0.9-0.6,2.3-0.9,3.5c-0.3,1.1,0.5,1.9,1.6,1.9c1.9,0,3.2-2.4,3.2-5.3c0-2.2-1.5-3.8-4.2-3.8c-3,0-4.9,2.3-4.9,4.8c0,0.9,0.3,1.5,0.7,2C6,12,6.1,12.1,6,12.4c0,0.2-0.2,0.6-0.2,0.8c-0.1,0.3-0.3,0.3-0.5,0.3c-1.4-0.6-2-2.1-2-3.8c0-2.8,2.4-6.2,7.1-6.2c3.8,0,6.3,2.8,6.3,5.7c0,3.9-2.2,6.9-5.4,6.9c-1.1,0-2.1-0.6-2.4-1.2c0,0-0.6,2.3-0.7,2.7c-0.2,0.8-0.6,1.5-1,2.1C8.1,19.9,9,20,10,20c5.5,0,10-4.5,10-10C20,4.5,15.5,0,10,0z"/>
				</svg>',
			],
			'linkedin' => [
				'name' => __('LinkedIn', 'rishi'),
				'icon' => '
				<svg
				class="rt-icon"
				width="20"
				height="20"
				viewBox="0 0 24 24">
					<path d="m23.994 24v-.001h.006v-8.802c0-4.306-.927-7.623-5.961-7.623-2.42 0-4.044 1.328-4.707 2.587h-.07v-2.185h-4.773v16.023h4.97v-7.934c0-2.089.396-4.109 2.983-4.109 2.549 0 2.587 2.384 2.587 4.243v7.801z"/><path d="m.396 7.977h4.976v16.023h-4.976z"/><path d="m2.882 0c-1.591 0-2.882 1.291-2.882 2.882s1.291 2.909 2.882 2.909 2.882-1.318 2.882-2.909c-.001-1.591-1.292-2.882-2.882-2.882z"/>
				</svg>',
			],
			'medium' => [
				'name' => 'Medium',
				'icon' => '
				<svg
				class="rt-icon"
				width="20"
				height="20"
				viewBox="0 0 20 20">
					<path d="M2.4,5.3c0-0.2-0.1-0.5-0.3-0.7L0.3,2.4V2.1H6l4.5,9.8l3.9-9.8H20v0.3l-1.6,1.5c-0.1,0.1-0.2,0.3-0.2,0.4v11.2c0,0.2,0,0.3,0.2,0.4l1.6,1.5v0.3h-7.8v-0.3l1.6-1.6c0.2-0.2,0.2-0.2,0.2-0.4V6.5L9.4,17.9H8.8L3.6,6.5v7.6c0,0.3,0.1,0.6,0.3,0.9L6,17.6v0.3H0v-0.3L2.1,15c0.2-0.2,0.3-0.6,0.3-0.9V5.3z"/>
				</svg>'
			],
			'tiktok' => [
				'name' => 'TikTok',
				'icon' => '
				<svg
				class="rt-icon"
				width="20"
				height="20"
				viewBox="0 0 20 20">
					<path d="M18.2 4.5c-2.3-.2-4.1-1.9-4.4-4.2V0h-3.4v13.8c0 1.4-1.2 2.6-2.8 2.6-1.4 0-2.6-1.1-2.6-2.6s1.1-2.6 2.6-2.6h.2l.5.1V7.5h-.7c-3.4 0-6.2 2.8-6.2 6.2S4.2 20 7.7 20s6.2-2.8 6.2-6.2v-7c1.1 1.1 2.4 1.6 3.9 1.6h.8V4.6l-.4-.1z"/>
				</svg>
			',
			],
		];

		$multisocials = get_user_meta( $user_id, 'rishi_author_social_links', true );
		if( $multisocials ){ ?>
			<div class="cb__social-box" data-icon-size="custom" data-color="official" data-icons-type="simple">
				<?php foreach ( $multisocials as $single_social ) { 
					if ( ! $single_social['enabled'] ) {
						continue;
					}
					$social_url = isset( $single_social['url'] ) ? esc_url( $single_social['url'] ) : '';
					?>
					<a href="<?php echo $social_url; ?>" target="_blank" rel="nofollow" data-network="<?php echo esc_attr( $single_social['id'] ); ?>" aria-label="<?php echo esc_attr( ucwords( $single_social['id'] ) ); ?>">
						<span class="cb__icon-container">
							<?php if( $metadata[$single_social['id']] ) echo $metadata[$single_social['id']]['icon']; ?>
						</span>
						<span class="cb__label" hidden=""><?php echo esc_attr( $single_social['id'] ); ?></span>
					</a>
				<?php } ?>
			</div>
			<?php 
		}
	}
endif;