<?php
class RishiCompanionFontSources {
    public function __construct()
    {
        $this->init_hooks();    
    }

    public function init_hooks(){
        add_filter( 'rishi__cb_customizer_static_font_ids', [ $this, 'get_companion_fonts' ] );
    }

    public function get_companion_fonts(){
        $companion_font_sources = apply_filters( 'rishi__cb_customizer_companion_static_font_ids', [] );
        
        return array_merge(
            array(
                get_theme_mod(
                    'cookieContenttypo',
                    rishi__cb_customizer_typography_default_values(
                        array(
                            'family'         => 'System Default',
                            'size' => [
                                'desktop' => '16px',
                                'tablet'  => '16px',
                                'mobile'  => '16px'
                            ],
                            'variation'   => 'n4',
                            'line-height' => '1.5'
                        )
                    )
                ),
            ),
            $companion_font_sources        
        );
    }
}