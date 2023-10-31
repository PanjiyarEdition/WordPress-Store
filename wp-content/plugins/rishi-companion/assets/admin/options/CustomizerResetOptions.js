import { Fragment, useState } from '@wordpress/element'
import { __ } from '@wordpress/i18n'
import Overlay from '../helpers/Overlay'

const CustomizerResetOptions = ({ value, option, onChange }) => {
	const [isShowing, setIsShowing] = useState(false)

	return (
		<Fragment>
			<button
				className="button"
				style={{ width: '100%' }}
				onClick={(e) => {
					e.preventDefault()

					setIsShowing(true)
				}}>
				{__('Reset Customizer', 'rishi-companion')}
			</button>

			<Overlay
				items={isShowing}
				className="rara-admin-modal rara-reset-options"
				onDismiss={() => setIsShowing(false)}
				render={() => (
					<div className="rara-modal-content">
						<h2 className="rara-modal-title">{__("Reset Settings", "rishi-companion")}</h2>
						<p>
							{__("You are about to reset all settings to their default values, are you sure you want to continue?", "rishi-companion")}
						</p>

						<div
							className="rara-modal-actions has-divider"
							data-buttons="2">
							<button
								onClick={(e) => {
									e.preventDefault()
									e.stopPropagation()
									setIsShowing(false)
								}}
								className="button">
								Cancel
							</button>

							<button
								className="button button-primary"
								onClick={(e) => {
									e.preventDefault()

									jQuery.post(
										ajaxurl,
										{
											wp_customize: 'on',
											action: 'rc_customizer_reset',
											nonce:
												rishi__cb_customizer_localizations.customizer_reset_none,
										},
										() => {
											wp.customize
												.state('saved')
												.set(true)
											location.reload()
										}
									)
								}}>
								Confirm
							</button>
						</div>
					</div>
				)}
			/>
		</Fragment>
	)
}

export default CustomizerResetOptions
