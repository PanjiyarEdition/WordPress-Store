<?php
/**
* version 3.7 (custom)
* work with bootstrap there are some extra customization
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if(!class_exists('pisol_class_form_sn_v3_7')):
class pisol_class_form_sn_v3_7{

    private $setting;
    private $saved_value; 
    private $pro;
    function __construct($setting){

        $this->setting = $setting;

        if(isset( $this->setting['default'] )){
            $this->saved_value = get_option($this->setting['field'], $this->setting['default']);
        }else{
            $this->saved_value = get_option($this->setting['field']);
        }

        if(isset( $this->setting['pro'] )){
            if($this->setting['pro']){
                $this->pro = ' free-version ';
                //$this->setting['desc'] = '<span style="color:#f00; font-weight:bold;">Workes in Pro version only / Without PRO version this setting will have no effect</span>';
            }else{
                $this->pro = ' paid-version ';
            }
        }else{
            $this->pro = "";
        }

        $allowed_atts = array(
            'align'      => array(),
            'class'      => array(),
            'selected'   => array(),
            'multiple'   => array(),
            'checked'    => array(),
            'type'       => array(),
            'id'         => array(),
            'dir'        => array(),
            'lang'       => array(),
            'style'      => array(),
            'xml:lang'   => array(),
            'src'        => array(),
            'alt'        => array(),
            'href'       => array(),
            'rel'        => array(),
            'rev'        => array(),
            'target'     => array(),
            'novalidate' => array(),
            'type'       => array(),
            'value'      => array(),
            'name'       => array(),
            'tabindex'   => array(),
            'action'     => array(),
            'method'     => array(),
            'for'        => array(),
            'width'      => array(),
            'height'     => array(),
            'data'       => array(),
            'title'      => array(),
            'min'        => array(),
            'max'        => array(),
            'step'        => array(),
            'required'   => array(),
            'readonly'   => array(),
        );
        $this->allowed_tags['form']     = $allowed_atts;
        $this->allowed_tags['label']    = $allowed_atts;
        $this->allowed_tags['input']    = $allowed_atts;
        $this->allowed_tags['select']    = $allowed_atts;
        $this->allowed_tags['option']    = $allowed_atts;
        $this->allowed_tags['textarea'] = $allowed_atts;
        $this->allowed_tags['iframe']   = $allowed_atts;
        $this->allowed_tags['script']   = $allowed_atts;
        $this->allowed_tags['style']    = $allowed_atts;
        $this->allowed_tags['strong']   = $allowed_atts;
        $this->allowed_tags['small']    = $allowed_atts;
        $this->allowed_tags['table']    = $allowed_atts;
        $this->allowed_tags['span']     = $allowed_atts;
        $this->allowed_tags['abbr']     = $allowed_atts;
        $this->allowed_tags['code']     = $allowed_atts;
        $this->allowed_tags['pre']      = $allowed_atts;
        $this->allowed_tags['div']      = $allowed_atts;
        $this->allowed_tags['img']      = $allowed_atts;
        $this->allowed_tags['h1']       = $allowed_atts;
        $this->allowed_tags['h2']       = $allowed_atts;
        $this->allowed_tags['h3']       = $allowed_atts;
        $this->allowed_tags['h4']       = $allowed_atts;
        $this->allowed_tags['h5']       = $allowed_atts;
        $this->allowed_tags['h6']       = $allowed_atts;
        $this->allowed_tags['ol']       = $allowed_atts;
        $this->allowed_tags['ul']       = $allowed_atts;
        $this->allowed_tags['li']       = $allowed_atts;
        $this->allowed_tags['em']       = $allowed_atts;
        $this->allowed_tags['hr']       = $allowed_atts;
        $this->allowed_tags['br']       = $allowed_atts;
        $this->allowed_tags['tr']       = $allowed_atts;
        $this->allowed_tags['td']       = $allowed_atts;
        $this->allowed_tags['p']        = $allowed_atts;
        $this->allowed_tags['a']        = $allowed_atts;
        $this->allowed_tags['b']        = $allowed_atts;
        $this->allowed_tags['i']        = $allowed_atts;
        
        
        $this->check_field_type();
    }

    function check_field_type(){
        if(isset($this->setting['type'])):
            switch ($this->setting['type']){
                case 'select':
                    $this->select_box();
                break;

                case 'number':
                    $this->number_box();
                break;

                case 'text':
                    $this->text_box();
                break;
                    
                case 'textarea':
                    $this->textarea_box();
                break;

                case 'multiselect':
                    $this->multiselect_box();
                break;

                case 'color':
                    $this->color_box();
                break;

                case 'hidden':
                    $this->hidden_box();
                break;

                case 'switch':
                    $this->switch_display();
                break;

                case 'switch_category':
                    $this->switch_category_display();
                break;

                case 'setting_category':
                    $this->setting_category();
                break;

                case 'image':
                    $this->image();
                break;
            }
        endif;
    }

    function bootstrap($label, $field, $desc = "", $links = "", $title_col = 5){
        $setting_col = 12 - $title_col;
        if($this->setting['type'] != 'hidden'){
        ?>
        <div id="row_<?php echo esc_attr($this->setting['field']); ?>"  class="row py-4 border-bottom align-items-center <?php echo esc_attr($this->pro); ?> <?php echo !empty($this->setting['class']) ? esc_attr($this->setting['class']) : ''; ?>">
            <div class="col-12 col-md-<?php echo esc_attr($title_col); ?>">
            <?php echo wp_kses($label, $this->allowed_tags); ?>
            <?php echo wp_kses($desc != "" ? $desc.'<br>': "", $this->allowed_tags); ?>
            <?php echo wp_kses($links != "" ? $links: "", $this->allowed_tags); ?>
            </div>
            <div class="col-12 col-md-<?php echo esc_attr($setting_col); ?>">
            <?php echo wp_kses($field, $this->allowed_tags); ?>
            </div>
        </div>
        <?php
        }else{
            ?>
            <div id="row_<?php echo esc_attr($this->setting['field']); ?>" class="row align-items-center <?php echo esc_attr($this->pro); ?>">
            <div class="col-12 col-md-12">
            <?php echo wp_kses($field, $this->allowed_tags); ?>
            </div>
            </div>
            <?php
        }
    }


    function bootstrap_switch_category($label, $field, $desc = "", $links = ""){
        ?>
        <div id="row_<?php echo esc_attr($this->setting['field']); ?>" class="row py-4 border-bottom align-items-center <?php echo ( isset($this->setting['class']) ? esc_attr($this->setting['class']) : "" ); ?>">
            <div class="col-9">
            <?php echo wp_kses($label, $this->allowed_tags) ; ?>
            <?php echo wp_kses($desc != "" ? $desc.'<br>': "", $this->allowed_tags); ?>
            <?php echo wp_kses($links != "" ? $links: "", $this->allowed_tags); ?>
            </div>
            <div class="col-3">
            <?php echo wp_kses($field, $this->allowed_tags); ?>
            </div>
        </div>
        <?php
    }

    /*
        Field type: select box
    */
    function select_box(){

        $label = '<label class="h6 mb-0" for="'.esc_attr($this->setting['field']).'">'.esc_html($this->setting['label']).'</label>';
        $desc = (isset($this->setting['desc'])) ? '<br><small>'.wp_kses($this->setting['desc'], $this->allowed_tags).'</small>' : "";
        
        $field = '<select class="form-control '.esc_attr($this->pro).'" name="'.esc_attr($this->setting['field']).'" id="'.esc_attr($this->setting['field']).'"'
         .(isset($this->setting['multiple']) ? ' multiple="'.esc_attr($this->setting['multiple']).'"': '')
        .'>';
            foreach($this->setting['value'] as $key => $val){
               $field .= '<option value="'.esc_attr($key).'" '.( ( $this->saved_value == $key) ? " selected=\"selected\" " : "" ).'>'.esc_html($val).'</option>';
            }
        $field .= '</select>';

        $links = $this->generateLinks($this->setting);

        $this->bootstrap($label, $field, $desc, $links, 7);

    }

    function generateLinks($setting){
        /*
        'links'=>array(array('name'=>"Video", 'url'=>"https://www.youtube.com/watch?v=KNC5lkoE2Fs", 'type'=>'iframe'))
        'links'=>array(array('name'=>"Video", 'url'=>"image url", 'type'=>'image'))
        */

        if(!isset($setting['links']) || !is_array($setting['links']) || empty($setting['links'])) return;

        $html = '';
        $links = $setting['links'];
        foreach($links as $link){
            $class = 'pi-'.$link['type'];
            $html .= '<a href="'.esc_url($link['url']).'" class="'.esc_attr($class).' pi-info-links" target="_blank">'.esc_html($link['name']).'</a> ';
        }
        return $html;
    }

    /*
        Field type: select box
    */
    function multiselect_box(){
        $label = '<label class="h6 mb-0" for="'.esc_attr($this->setting['field']).'">'.esc_html($this->setting['label']).'</label>';
        $desc = ((isset($this->setting['desc'])) ? '<br><small>'.wp_kses($this->setting['desc'], $this->allowed_tags).'</small>' : "");
        $field = '<select style="min-height:100px;" class="form-control multiselect '.esc_attr($this->pro).'" name="'.esc_attr($this->setting['field']).'[]" id="'.esc_attr($this->setting['field']).'" multiple'. '>';
            foreach($this->setting['value'] as $key => $val){
                if(isset($this->saved_value) && $this->saved_value != false){
                    $field .='<option value="'.esc_attr($key).'" '.( ( in_array($key, $this->saved_value) ) ? " selected=\"selected\" " : "" ).'>'.esc_html($val).'</option>';
                }else{
                    $field .= '<option value="'.esc_attr($key).'">'.esc_html($val).'</option>';
                }
            }
            $field .= '</select>';

            $links = $this->generateLinks($this->setting);

            $this->bootstrap($label, $field, $desc, $links);

    }

    /*
        Field type: Number box
    */
    function number_box(){

        $label = '<label class="h6 mb-0" for="'.esc_attr($this->setting['field']).'">'.esc_html($this->setting['label']).'</label>';
        $desc =  (isset($this->setting['desc'])) ? '<br><small>'.wp_kses($this->setting['desc'], $this->allowed_tags).'</small>' : "";
        $field = '<input type="number" class="form-control '.esc_attr($this->pro).'" name="'.esc_attr($this->setting['field']).'" id="'.esc_attr($this->setting['field']).'" value="'.esc_attr($this->saved_value).'"'
        .(isset($this->setting['min']) ? ' min="'.esc_attr($this->setting['min']).'"': '')
        .(isset($this->setting['max']) ? ' max="'.esc_attr($this->setting['max']).'"': '')
        .(isset($this->setting['step']) ? ' step="'.esc_attr($this->setting['step']).'"': '')
        .(isset($this->setting['required']) ? ' required="'.esc_attr($this->setting['required']).'"': '')
        .(isset($this->setting['readonly']) ? ' readonly="'.esc_attr($this->setting['readonly']).'"': '')
        .'>';

        $links = $this->generateLinks($this->setting);

        $this->bootstrap($label, $field, $desc, $links, 7);
    }

    /*
        Field type: Number box
    */
    function text_box(){

        $label = '<label class="h6 mb-0" for="'.esc_attr($this->setting['field']).'">'.esc_html($this->setting['label']).'</label>';
        $desc =  (isset($this->setting['desc'])) ? '<br><small>'.wp_kses($this->setting['desc'], $this->allowed_tags).'</small>' : "";
        $field = '<input type="text" class="form-control '.esc_attr($this->pro).'" name="'.esc_attr($this->setting['field']).'" id="'.esc_attr($this->setting['field']).'" value="'.esc_attr($this->saved_value).'"'
        .(isset($this->setting['required']) ? ' required="'.esc_attr($this->setting['required']).'"': '')
        .(isset($this->setting['readonly']) ? ' readonly="'.esc_attr($this->setting['readonly']).'"': '')
        .'>';

        $links = $this->generateLinks($this->setting);

        $this->bootstrap($label, $field, $desc, $links, 7);
    }
    
    /*
    Textarea field
    */
    function textarea_box(){
        $label = '<label class="h6 mb-0" for="'.esc_attr($this->setting['field']).'">'.esc_html($this->setting['label']).'</label>';
        $desc =  (isset($this->setting['desc'])) ? '<br><small>'.wp_kses($this->setting['desc'], $this->allowed_tags).'</small>' : "";
        $field = '<textarea style="height:auto !important; min-height:200px;" type="text" class="form-control '.esc_attr($this->pro).'" name="'.esc_attr($this->setting['field']).'" id="'.esc_attr($this->setting['field']).'"'
        .(isset($this->setting['required']) ? ' required="'.esc_attr($this->setting['required']).'"': '')
        .(isset($this->setting['readonly']) ? ' readonly="'.esc_attr($this->setting['readonly']).'"': '')
        .'>';
        $field .= esc_textarea($this->saved_value); 
        $field .= '</textarea>';

        $links = $this->generateLinks($this->setting);

        $this->bootstrap($label, $field, $desc, $links, 12);
    }

     /*
        Field type: color
    */
    function color_box(){
        wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');
        wp_add_inline_script('wp-color-picker','
        jQuery(document).ready(function($) {
            $(".color-picker").wpColorPicker();
          });
        ');
        $label = '<label class="h6 mb-0" for="'.esc_attr($this->setting['field']).'">'.esc_html($this->setting['label']).'</label>';
        $desc =  (isset($this->setting['desc'])) ? '<br><small>'.wp_kses($this->setting['desc'], $this->allowed_tags).'</small>' : "";
        $field = '<input type="text" class="color-picker pisol_select '.esc_attr($this->pro).'" name="'.esc_attr($this->setting['field']).'" id="'.esc_attr($this->setting['field']).'" value="'.esc_attr($this->saved_value).'"'
        .(isset($this->setting['required']) ? ' required="'.esc_attr($this->setting['required']).'"': '')
        .(isset($this->setting['readonly']) ? ' readonly="'.esc_attr($this->setting['readonly']).'"': '')
        .'>';

        $links = $this->generateLinks($this->setting);

        $this->bootstrap($label, $field, $desc, $links, 6);
    }

    function hidden_box(){
        $label =  '<label class="h6 mb-0" for="'.esc_attr($this->setting['field']).'">'.esc_html($this->setting['label']).'</label>';
        $desc =   (isset($this->setting['desc'])) ? '<br><small>'.wp_kses($this->setting['desc'], $this->allowed_tags).'</small>' : "";
        $field ='<input type="hidden" class="pisol_select '.esc_attr($this->pro).'" name="'.esc_attr($this->setting['field']).'" id="'.esc_attr($this->setting['field']).'" value="'.esc_attr($this->saved_value).'"'
        .(isset($this->setting['required']) ? ' required="'.esc_attr($this->setting['required']).'"': '')
        .(isset($this->setting['readonly']) ? ' readonly="'.esc_attr($this->setting['readonly']).'"': '')
        .'>';

        $links = $this->generateLinks($this->setting);

        $this->bootstrap($label, $field, $desc, $links);
    }

    /*
        Field type: switch
    */
    function switch_display(){

        $label = '<label class="h6 mb-0" for="'.esc_attr($this->setting['field']).'">'.esc_html($this->setting['label']).'</label>';
        $desc = (isset($this->setting['desc'])) ? '<br><small>'.wp_kses($this->setting['desc'], $this->allowed_tags).'</small>' : "";
        
        $field = '<div class="custom-control custom-switch">
        <input type="checkbox" value="1" class="custom-control-input" name="'.esc_attr($this->setting['field']).'" id="'.esc_attr($this->setting['field']).'" '.(($this->saved_value == true) ? "checked='checked'": "").' >
        <label class="custom-control-label" for="'.esc_attr($this->setting['field']).'"></label>
        </div>';

        $links = $this->generateLinks($this->setting);

        $this->bootstrap($label, $field, $desc, $links, 9);
    }

    function switch_category_display(){

        $label = '<label class="h6 mb-0" for="'.esc_attr($this->setting['field']).'">'.esc_html($this->setting['label']).'</label>';
        $desc = (isset($this->setting['desc'])) ? '<br><small>'.wp_kses($this->setting['desc'], $this->allowed_tags).'</small>' : "";
        
        $field = '<div class="custom-control custom-switch">
        <input type="checkbox" value="1" class="custom-control-input" name="'.esc_attr($this->setting['field']).'" id="'.esc_attr($this->setting['field']).'"'.(($this->saved_value == true) ? "checked='checked'": "").' >
        <label class="custom-control-label" for="'.esc_attr($this->setting['field']).'"></label>
        </div>';

        $links = $this->generateLinks($this->setting);

        $this->bootstrap_switch_category($label, $field, $desc, $links);
    }

    /**
     * Category: is to devide setting in different part 
     */
    function setting_category(){
        if(isset($this->setting['label']) && $this->setting['label'] != ""):
        ?>
        <div id="row_<?php echo esc_attr($this->setting['field']); ?>" class="row py-4 border-bottom align-items-center <?php echo ( isset($this->setting['class']) ? esc_attr($this->setting['class']) : "" ); ?>">
            <div class="col-12">
            <h2 class="mt-0 mb-0 <?php echo ( isset($this->setting['class_title']) ? esc_attr($this->setting['class_title']) : "" ); ?>"><?php echo $this->setting['label']; ?></h2>
            </div>
        </div>
        <?php
        endif;
    }

    function image(){
        wp_enqueue_media();
        add_action( 'admin_footer', array($this,'media_selector_scripts') );
        $label = '<label class="h6 mb-0" for="'.esc_attr($this->setting['field']).'">'.esc_html($this->setting['label']).'</label>';
        $desc = (isset($this->setting['desc'])) ? '<br><small>'.wp_kses($this->setting['desc'], $this->allowed_tags).'</small>' : "";
        $field = '
        <div class="row align-items-center">
        <div class="col-6">
        <input id="'.esc_attr($this->setting['field']).'_button" type="button" class="button" value="'.esc_attr(__('Upload image','add-coupon-by-link-woocommerce')).'" />
        <input type="hidden" name="'.esc_attr($this->setting['field']).'" id="'.esc_attr($this->setting['field']).'" value="'.esc_attr($this->saved_value).'">
        </div>
        <div class="col-6">
        <div class="image-preview-wrapper">
        <img id="'.esc_attr($this->setting['field']).'_preview" '.($this->saved_value > 0 ? 'src="'.wp_get_attachment_url( get_option( $this->setting['field'] ) ).'"': '').' width="100" height="100" style="max-height: 100px; width: 100px;">
        <a href="javascript:void(0)" class="clear-image-'.esc_attr($this->setting['field']).'">Clear</a>
        </div>
        </div>
        </div>
        ';
        $links = $this->generateLinks($this->setting);

        $this->bootstrap($label, $field, $desc, $links);
    }

    function media_selector_scripts(){
        $my_saved_attachment_post_id = get_option($this->setting['field'], 0 );
	    ?><script type='text/javascript'>
		jQuery( document ).ready( function( $ ) {
			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo esc_attr($my_saved_attachment_post_id == 0 || $my_saved_attachment_post_id =="" ? "0" : $my_saved_attachment_post_id) ; ?>; // Set this
			jQuery('#<?php echo esc_attr($this->setting['field']); ?>_button').on('click', function( event ){
				event.preventDefault();
				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}
				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});
				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();
					// Do something with attachment.id and/or attachment.url here
					$( '#<?php echo esc_attr($this->setting['field']); ?>_preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#<?php echo esc_attr($this->setting['field']); ?>' ).val( attachment.id );
					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});
					// Finally, open the modal
					file_frame.open();
			});
			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
            jQuery( 'a.clear-image-<?php echo esc_attr($this->setting['field']); ?>' ).on( 'click', function() {
                $( '#<?php echo esc_attr($this->setting['field']); ?>_preview' ).attr("src","");
                $( '#<?php echo esc_attr($this->setting['field']); ?>' ).val("");
            });
		});
	</script>
    <?php
    }
}
endif;