<?php
/**
 * Public area settings and hooks.
 *
 * @package Rishi_Companion
 */

namespace Rishi;

defined( 'ABSPATH' ) || exit;

/**
 * Global Settings.
 */
class Rishi_Companion_Public {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Initialization.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function init() {

		// Initialize hooks.
		$this->init_hooks();

		// Allow 3rd party to remove hooks.
		do_action( 'rishi_companion_public_unhook', $this );

        add_filter('rt:frontend:dynamic-js-chunks', function ($chunks) {

			$chunks[] = [
				'id'       => 'rishi_sticky_header',
				'selector' => 'header [data-sticky]',
				'url'      => plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/sticky.js',
			];

			return $chunks;
		});
		if( ! is_customize_preview() ) add_action('wp', array( $this, 'rishi_companion_set_views' ) );

		add_filter( 'rishi__cb_author_social_links', [ $this, 'rishi_companion_author_social_links' ], 10, 2 );
    }

	/**
     * Init Hooks
     *
     * @return void
     */
    public function init_hooks(){
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
		add_action( 'wp_head', [ $this, 'rishi_single_post_schema' ] );
    }

    public function enqueue_assets() {
        wp_enqueue_style( 'rishi-companion-frontend', plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/public.css' );
        $public_deps = include_once plugin_dir_path( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/public.asset.php';

        // add rt-custom-events as dependency.
        array_push( $public_deps['dependencies'], 'rt-custom-events' );

        wp_enqueue_script( 'rishi-companion-frontend', plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/public.js', $public_deps['dependencies'], $public_deps['version'], true );

		$localize_data = [
			'public_url' => plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . '/assets/build/',
		];

		wp_localize_script( 'rishi-companion-frontend', 'rishi_companion_data', $localize_data );

		wp_enqueue_script( 'rishi-companion-custom', plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/postsTab.js', $public_deps['dependencies'], $public_deps['version'], true );
		wp_enqueue_style(
			'rishi-companion-blocks-public', // Handle.
			plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/blocks.css'
		);

	}

	/**
	 * Single Post Schema
	 *
	 * @return string
	 */
	public function rishi_single_post_schema() {
		$enable_schema_org_markup = get_theme_mod('enable_schema_org_markup', 'yes');
		if ( $enable_schema_org_markup === 'yes' && is_singular( 'post' ) ) {
			global $post;
			$custom_logo_id = get_theme_mod( 'custom_logo' );

			$site_logo   = wp_get_attachment_image_src( $custom_logo_id , [600, 60] );
			$images      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			$excerpt     = $this->rishi_escape_text_tags( $post->post_excerpt );
			$content     = $excerpt === "" ? mb_substr( $this->rishi_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;
			$schema_type = ! empty( $custom_logo_id ) && has_post_thumbnail( $post->ID ) ? "BlogPosting" : "Blog";

			$args = array(
				"@context"  => "http://schema.org",
				"@type"     => $schema_type,
				"mainEntityOfPage" => array(
					"@type" => "WebPage",
					"@id"   => esc_url( get_permalink( $post->ID ) )
				),
				"headline"  => esc_html( get_the_title( $post->ID ) ),
				"datePublished" => esc_html( get_the_time( DATE_ISO8601, $post->ID ) ),
				"dateModified"  => esc_html( get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ) ),
				"author"        => array(
					"@type"     => "Person",
					"name"      => $this->rishi_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) ),
					"url"       => esc_url( get_the_author_meta( 'user_url', $post->post_author ) ),
				),
				"description" => ( class_exists('WPSEO_Meta') ? \WPSEO_Meta::get_value( 'metadesc' ) : $content )
			);

			$args = apply_filters( 'rishi__cb_single_post_schema', $args );

			if ( has_post_thumbnail( $post->ID ) && is_array( $images ) ) :
				$args['image'] = array(
					"@type"  => "ImageObject",
					"url"    => $images[0],
					"width"  => $images[1],
					"height" => $images[2]
				);
			endif;

			if ( ! empty( $custom_logo_id ) && is_array( $site_logo ) ) :
				$args['publisher'] = array(
					"@type"       => "Organization",
					"name"        => esc_html( get_bloginfo( 'name' ) ),
					"description" => wp_kses_post( get_bloginfo( 'description' ) ),
					"logo"        => array(
						"@type"   => "ImageObject",
						"url"     => $site_logo[0],
						"width"   => $site_logo[1],
						"height"  => $site_logo[2]
					)
				);
			endif;

			echo '<script type="application/ld+json">';
			if ( version_compare( PHP_VERSION, '5.4.0' , '>=' ) ) {
				echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
			} else {
				echo wp_json_encode( $args );
			}
			echo '</script>';
		}
	}

	/**
	 * Remove new line tags from string
	 *
	 * @param $text
	 * @return string
	 */
	public function rishi_escape_text_tags( $text ) {
		return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
	}

	/**
	 * Function to add the post view count
	 */
	public function rishi_companion_set_views( $post_id ) {
		if ( in_the_loop() ) {
			$post_id = get_the_ID();
			}
		else {
			global $wp_query;
			$post_id = $wp_query->get_queried_object_id();
		}
		if( is_singular( 'post' ) )
		{
			$countKey = '_rishi_post_view_count';
			$count = get_post_meta( $post_id, $countKey, true );

			$count++;
			update_post_meta( $post_id, $countKey, $count );
		}
	}

	/**
	 * Function to add author social links
	 */
	public function rishi_companion_author_social_links($value, $author_id) {

		$socials = get_user_meta( $author_id, 'rishi_author_social_links', true );

		if( $socials ){
			echo rishi__cb_customizer_social_icons($socials, [
				'type' => 'simple',
				'icons-color' => 'official',
				'fill' => 'solid',
				'hide_labels' =>
				[
					'desktop' => false,
					'tablet' => false,
					'mobile' => false,
				],
			]);
		}
	}

}
