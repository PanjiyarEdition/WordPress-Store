import {
	Fragment,
	useState
} from '@wordpress/element'
import { __ } from '@wordpress/i18n'
import Overlay from '../helpers/Overlay'
import ConditionsManager from './ConditionsManager'

const DisplayCondition = ({
	option: {
		// inline | modal
		display = 'inline',

		modalTitle = __('Transparent Header Display Conditions', 'rishi-companion'),
		modalDescription = __(
			'Add one or more conditions to display the transparent header.',
			'rishi-companion'
		),
	},
	value,
	onChange,
}) => {
	const [isEditing, setIsEditing] = useState(false)
	const [localValue, setLocalValue] = useState(null)

	if (display === 'inline') {
		return <ConditionsManager value={value} onChange={onChange} />
	}

	return (
		<Fragment>
			<button
				className="button-primary"
				style={{ width: '100%' }}
				onClick={(e) => {
					e.preventDefault()
					// console.log('clicked here')
					setIsEditing(true)
					setLocalValue(null)
				}}>
				{__('Add/Edit Conditions', 'rishi-companion')}
			</button>

			<Overlay
				items={isEditing}
				className="rt-admin-modal rt-builder-conditions-modal"
				onDismiss={() => {
					setIsEditing(false)
					setLocalValue(null)
				}}
				render={() => (
					<div className="rt-modal-content">
						<h2>{modalTitle}</h2>
						<p>{modalDescription}</p>

						<div className="rt-modal-scroll">
							<ConditionsManager
								value={localValue || value}
								onChange={(value) => {
									setLocalValue(value)
								}}
							/>
						</div>

						<div className="rt-modal-actions has-divider">
							<button
								className="button-primary"
								disabled={!localValue}
								onClick={() => {
									onChange(localValue)
									setIsEditing(false)
								}}>
								{__('Save Conditions', 'rishi-companion')}
							</button>
						</div>
					</div>
				)}
			/>
		</Fragment>
	)
}

export default DisplayCondition
