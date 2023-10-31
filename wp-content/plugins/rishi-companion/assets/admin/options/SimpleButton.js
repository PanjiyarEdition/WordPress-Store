import { Fragment, useState } from '@wordpress/element'
import { __ } from '@wordpress/i18n'

const SimpleButton = () => {
    const [isLoading, setIsLoading] = useState(false)
    const [buttonLabel, setbuttonLabel] = useState(__('Confirm', 'rishi-companion'))
	return (
		<Fragment>
			<button
                className="button button-primary rc-simple-button"
                disabled={isLoading}
                onClick={(e) => {
                    e.preventDefault()

                    setIsLoading(true);
                    jQuery.post(
                        ajaxurl,
                        {
                            wp_customize: 'on',
                            action: 'rc_local_font_flush',
                            nonce:
                                rishi__cb_customizer_localizations.customizer_flush_font,
                        },
                        (response) => {
                            if ( response && response.success ) {
                                setbuttonLabel( __('Successfully Flushed', 'rishi-companion' ) );
                            } else {
                                setbuttonLabel( __( 'Failed, Reload Page and Try Again', 'rishi-companion' ) );
                            }
                            
                        }
                    )
                }}>
                {buttonLabel}
            </button>
		</Fragment>
	)
}

export default SimpleButton