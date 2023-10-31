<?php
/**
 * Admin area settings and hooks.
 *
 * @package Rishi_Companion
 */

namespace Rishi;

defined( 'ABSPATH' ) || exit;

/**
 * Global Settings.
 */
class Rishi_Companion_Admin {

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
		do_action( 'rishi_companion_admin_unhook', $this );
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function init_hooks() {
		// Admin Scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
		add_action( 'admin_footer', array ( $this, 'add_script' ) );
		add_action( 'init', array( $this, 'rishi_register_category_image_id' ) );

		add_action( 'category_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
		add_action( 'created_category', array ( $this, 'save_category_image' ), 10, 2 );
		add_action( 'category_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
		add_action( 'edited_category', array ( $this, 'updated_category_image' ), 10, 2 );
		add_action( 'category_add_form_fields', array( $this, 'rishi_companion_add_color_uploader' ) );
		add_action( 'created_category', array( $this, 'rishi_companion_save_category_color' ) , 10, 2 );
		add_action( 'category_edit_form_fields', array( $this, 'rishi_companion_update_category_color' ) , 10, 2 );
		add_action( 'edited_category', array( $this, 'rishi_companion_updated_category_color' ) , 10, 2 );
		add_action( 'wp_ajax_rc_local_font_flush', array( $this, 'ajax_delete_fonts_folder' ) );

		if( get_theme_mod( 'ed_favicon', 'yes' ) === 'yes' ){
			add_action( 'admin_head', array( $this, 'rishi_remove_favicon_request' ), 10 );
			add_action( 'wp_head', [ $this, 'rishi_remove_favicon_request' ], 10 );
		}

		add_filter( 'block_categories_all', array( $this, 'add_block_category' ) );

		add_action( 'init', array( $this, 'register_post_meta' ), 9999999 );

		add_action( 'rest_api_init', array( $this, 'register_rest_post_comment_count' ) );

		add_filter( 'rest_prepare_category', array ( $this, 'rishi_add_category_image_rest' ), 10, 3);
	}

	public function rishi_add_category_image_rest($response, $item, $request) {
		$image_id  	 = get_term_meta( $item->term_id, 'category-image-id', true );
		$image_url 	 = wp_get_attachment_url( $image_id );
		$response->data['image_url']  = $image_url ?: '';
		return $response;
	}

	/**
     * Disable Automatic Favicon Request
    */
    public function rishi_remove_favicon_request() {
        echo '<link rel="icon" href="data:,">';
    }

	/**
	 * Enqueue Admin Scripts
	 *
	 * @return void
	 */
	public function enqueue_scripts() {

		$manager = new Rishi_Companion_Plugin_Manager();
		$free_plugins = $manager->get_config();

		$screen = get_current_screen();
        $global_deps = include_once plugin_dir_path( RISHI_COMPANION_PLUGIN_FILE ) . '/assets/build/dashboard.asset.php';

        if ( 'appearance_page_rishi-dashboard' === $screen->id ) {

            // Recipe global screen assets.
            wp_register_script( 'rishi-companion-dashboard', plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/dashboard.js', $global_deps['dependencies'], $global_deps['version'], true );

            // Add localization vars.
            wp_localize_script(
                'rishi-companion-dashboard',
                'RishiCompanionDashboard',
                array(
					'ajaxURL'   	   => esc_url( admin_url('admin-ajax.php') ),
					'adminURL'  	   => esc_url( admin_url() ),
                    'siteURL'          => esc_url( home_url( '/' ) ),
                    'pluginUrl'        => esc_url( plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) ),
                    'pluginPRO'        => class_exists( 'Rishi\Rishi_Pro' ),
                    'pluginName'       => $free_plugins,
                    'customizeURL'     => admin_url('/customize.php?autofocus'),
                    'plugin_data' 	   => apply_filters( 'rishi_companion_dashboard_localizations', [] ),
                )
            );
            wp_enqueue_script( 'rishi-companion-dashboard' );
        }

		//color picker option in category page
		if ( 'edit-category' === $screen->id ) {
			wp_enqueue_style( 'wp-color-picker' );

			wp_enqueue_script( 'rishi-companion-color-uploader', plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/admin/other/colorUploader.js', array( 'wp-color-picker' ), false, true );

		}

		if ( $screen->id === 'user-edit' ||  $screen->id === 'profile' ) {

			$blocks_deps = include_once plugin_dir_path( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/userSocial.asset.php';
			wp_enqueue_style( 'rishi-companion-userSocial', plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/userSocial.css' );

			wp_register_script(
				'rishi-companion-userSocial',
				plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/userSocial.js', $blocks_deps['dependencies'], $blocks_deps['version'], true
			);

			// Add localization vars.
            wp_localize_script(
                'rishi-companion-userSocial',
                'RishiCompanionUserSocial',
                array(
                    'user_id' 	   => ( $screen->id === 'profile' ) ? 1 : absint($_GET['user_id']),
                )
            );
            wp_enqueue_script( 'rishi-companion-userSocial' );
		}

	}

	/**
	 * Adding category color
	*/
	public function rishi_companion_add_color_uploader ( $taxonomy ) { ?>

		<tr class="form-field term-group-wrap">
			<th scope="row">
				<label for="rc-uploader"><?php esc_html_e( 'Background Color', 'rishi-companion' ); ?></label>
			</th>
			<td>
			<p>
				<input type="text" value="#307ac9" name="rc-uploader" class="rc-uploader" data-default-color="#307ac9" />
			</p>
			</td>
		</tr>
		<tr class="form-field term-group-wrap">
			<th scope="row">
				<label for="rc-uploader"><?php esc_html_e( 'Text Color', 'rishi-companion' ); ?></label>
			</th>
			<td>
			<p>
				<input type="text" value="#ffffff" name="rc-text-uploader" class="rc-uploader" data-default-color="#ffffff" />
			</p>
			</td>
		</tr>
	<?php
	}

	/*
	* Save the form field
	* @since 1.0.0
	*/
	public function rishi_companion_save_category_color( $term_id, $tt_id ) {
		if ( isset( $_POST['rc-uploader'] ) && '' !== $_POST['rc-uploader'] ) {
			$image = $_POST['rc-uploader'];
			add_term_meta( $term_id, 'rc-uploader', $image, true );
		}
		if ( isset( $_POST['rc-text-uploader'] ) && '' !== $_POST['rc-text-uploader'] ) {
			$image = $_POST['rc-text-uploader'];
			add_term_meta( $term_id, 'rc-text-uploader', $image, true );
		}
	}

	/*
	* Edit the form field
	* @since 1.0.0
	*/
	public function rishi_companion_update_category_color( $term, $taxonomy ) { ?>
		<tr class="form-field term-group-wrap">
			<th scope="row">
				<label for="rc-uploader"><?php esc_html_e( 'Background Color', 'rishi-companion' ); ?></label>
			</th>
			<?php $color_id = get_term_meta ( $term -> term_id, 'rc-uploader', true ); ?>
			<td>
				<p>
					<input type="text" value="<?php if( $color_id ) echo $color_id; ?>" name="rc-uploader" class="rc-uploader" data-default-color="#307ac9" />
				</p>
			</td>
			</tr>
			<br />
		<tr class="form-field term-group-wrap">
			<th scope="row">
				<label for="rc-uploader"><?php esc_html_e( 'Text Color', 'rishi-companion' ); ?></label>
			</th>
			<?php $textcolor_id = get_term_meta ( $term -> term_id, 'rc-text-uploader', true ); ?>
			<td>
				<p>
					<input type="text" value="<?php if( $textcolor_id ) echo $textcolor_id; ?>" name="rc-text-uploader" class="rc-uploader" data-default-color="#ffffff" />
				</p>
			</td>
		</tr>
		<?php
	}

	public function rishi_companion_updated_category_color( $term_id, $tt_id ) {
		if ( isset( $_POST['rc-uploader'] ) && '' !== $_POST['rc-uploader'] ) {
			$bgcolor = $_POST['rc-uploader'];
			update_term_meta( $term_id, 'rc-uploader', $bgcolor );
		} else {
			update_term_meta( $term_id, 'rc-uploader', '' );
		}

		if ( isset( $_POST['rc-text-uploader'] ) && '' !== $_POST['rc-text-uploader'] ) {
			$text_color = $_POST['rc-text-uploader'];
			update_term_meta( $term_id, 'rc-text-uploader', $text_color );
		} else {
			update_term_meta( $term_id, 'rc-text-uploader', '' );
		}
	}

	/**
	 * Reset font folder
	 *
	 * @access public
	 * @return void
	 */
	public function ajax_delete_fonts_folder() {
		// Check request.
		if ( ! check_ajax_referer( 'rt-flush-fonts', 'nonce', false ) ) {
			wp_send_json_error( 'invalid_nonce' );
		}
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			wp_send_json_error( 'invalid_permissions' );
		}
		if ( class_exists( '\RishiCompanionWebFontLoader' ) ) {
			$font_loader = new \RishiCompanionWebFontLoader( '' );
			$removed = $font_loader->delete_fonts_folder();
			if ( ! $removed ) {
				wp_send_json_error( 'failed_to_flush' );
			}
			wp_send_json_success();
		}
		wp_send_json_error( 'no_font_loader' );
	}

	/**
	 * Add Block Category
	 *
	 * @param [type] $categories
	 * @return void
	 */
	public function add_block_category( $categories ) {
		// setup category array
		$rishi_blocks_category = array(
			'slug'  => 'rishi-blocks',
			'title' => __( 'Rishi Blocks', 'rishi-pro' ),
		);

		// make a new category array and insert ours at position 1
		$new_categories    = array();
		$new_categories[0] = $rishi_blocks_category;

		// rebuild cats array
		foreach ( $categories as $category ) {
			$new_categories[] = $category;
		}

		return $new_categories;
	}

	/**
	 * Register Block meta
	 *
	 * @return void
	 */
	public function register_post_meta() {
		register_post_meta(
			'post',
			'_rishi_post_view_count',
			array(
				'single'       => true,
				'type'         => 'number',
				'show_in_rest' => true,
				'default'	   => 0,
				'sanitize_callback' => 'absint',
				'auth_callback' => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_meta(
			'user',
			'rishi_author_social_links',
			array(
				'single'       => true,
				'type'         => 'array',
				'show_in_rest' => array(
					'schema' => array(
						'items' => array(
							'type'       => 'object',
							'properties' => array(
								'id'    => array(
									'type' => 'string',
								),
								'enabled' => array(
									'type'       => 'boolean',
								),
								'url' => array(
									'type'       => 'string',
								),
								'__id' => array(
									'type'       => 'string',
								),
							),
						),
					),
				),
			)
		);
	}

	/**
	 * Add Category image id in rest api
	 */
	public function rishi_register_category_image_id(){
		register_term_meta('category', 'category-image-id', ['show_in_rest' => true]);
	}

	/**
	 * Add Comments Count of Posts to API response
	 *
	 */
	public function register_rest_post_comment_count() {
		register_rest_field( 'post',
			'comments_count',
			array(
				'get_callback' => 'rishi_companion_get_comments_count'
			)
		);
	}

	public function load_media() {
		wp_enqueue_media();
	}

	/*
	* Add a form field in the new category page
	* @since 1.0.0
	*/
	public function add_category_image ( $taxonomy ) { ?>
		<div class="form-field term-group">
		<label for="category-image-id"><?php _e('Image', 'hero-theme'); ?></label>
		<input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
		<div id="category-image-wrapper"></div>
		<p>
			<input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
			<input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
		</p>
		</div>
	<?php
	}

	 /*
	* Save the form field
	* @since 1.0.0
	*/
	public function save_category_image ( $term_id, $tt_id ) {
		if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
		$image = $_POST['category-image-id'];
		add_term_meta( $term_id, 'category-image-id', $image, true );
		}
	}

	/*
	* Edit the form field
	* @since 1.0.0
	*/
	public function update_category_image ( $term, $taxonomy ) { ?>
		<tr class="form-field term-group-wrap">
		<th scope="row">
			<label for="category-image-id"><?php _e( 'Image', 'hero-theme' ); ?></label>
		</th>
		<td>
			<?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
			<input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
			<div id="category-image-wrapper">
			<?php if ( $image_id ) { ?>
				<?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
			<?php } ?>
			</div>
			<p>
			<input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
			<input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
			</p>
		</td>
		</tr>
	<?php
	}

	/*
	* Update the form field value
	* @since 1.0.0
	*/
	public function updated_category_image ( $term_id, $tt_id ) {
		if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
		$image = $_POST['category-image-id'];
		update_term_meta ( $term_id, 'category-image-id', $image );
		} else {
		update_term_meta ( $term_id, 'category-image-id', '' );
		}
	}

	/*
	* Add script
	* @since 1.0.0
	*/
	public function add_script() { ?>
		<script>
		jQuery(document).ready( function($) {
			function ct_media_upload(button_class) {
			var _custom_media = true,
			_orig_send_attachment = wp.media.editor.send.attachment;
			$('body').on('click', button_class, function(e) {
				var button_id = '#'+$(this).attr('id');
				var send_attachment_bkp = wp.media.editor.send.attachment;
				var button = $(button_id);
				_custom_media = true;
				wp.media.editor.send.attachment = function(props, attachment){
				if ( _custom_media ) {
					$('#category-image-id').val(attachment.id);
					$('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
					$('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
				} else {
					return _orig_send_attachment.apply( button_id, [props, attachment] );
				}
				}
			wp.media.editor.open(button);
			return false;
			});
		}
			ct_media_upload('.ct_tax_media_button.button');
			$('body').on('click','.ct_tax_media_remove',function(){
				$('#category-image-id').val('');
				$('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
			});
			// Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
			$(document).ajaxComplete(function(event, xhr, settings) {
				var queryStringArr = settings.data.split('&');
				if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
				var xml = xhr.responseXML;
				$response = $(xml).find('term_id').text();
				if($response!=""){
					// Clear the thumb image
					$('#category-image-wrapper').html('');
				}
				}
			});
		});
		</script>
	<?php }
}
