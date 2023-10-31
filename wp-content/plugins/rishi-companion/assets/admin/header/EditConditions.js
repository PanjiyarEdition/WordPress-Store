import {
	createElement,
	Fragment,
	Component,
	useContext,
	useRef,
	useState,
} from '@wordpress/element'
import {
	Overlay,
	OptionsPanel,
	getValueFromInput,
	PlacementsDragDropContext,
} from 'rishi-customizer-options'
import { __ } from '@wordpress/i18n'
import useFetch from 'react-fetch-hook'

import createTrigger from 'react-use-trigger'
import useTrigger from 'react-use-trigger/useTrigger'

const requestTrigger = createTrigger()
const EditConditions = ({ forcedEdit = false, headerId }) => {
	const [isEditing, setIsEditing] = useState(false)
	const [localConditions, setConditions] = useState(null)
	const { builderValueCollection, builderValueDispatch } = useContext(
		PlacementsDragDropContext
	)

	const containerRef = useRef()

	const requestTriggerValue = useTrigger(requestTrigger)

	const saveSettings = () => {
		fetch(
			`${wp.ajax.settings.url}?action=rishi_header_update_all_conditions`,
			{
				headers: {
					Accept: 'application/json',
					'Content-Type': 'application/json',
				},
				method: 'POST',
				body: JSON.stringify(localConditions),
			}
		)
			.then((r) => r.json())
			.then(() => {
				requestTrigger()
				setIsEditing(false)
			})
	}

	const { data: conditions, isLoading, error } = useFetch(
		`${RishiCompanionAdmin.ajax_url}?action=rishi_header_get_all_conditions`,
		{
			method: 'POST',
			formatter: async (r) => {
				const { success, data } = await r.json()

				if (!success || !data.conditions) {
					throw new Error()
				}

				return data.conditions
			},
			depends: [requestTriggerValue],
		}
	)

	return (
		<Fragment>
			<button
				className="button-primary"
				style={{ width: '100%' }}
				onClick={(e) => {
					if (isLoading) {
						return
					}
					e.preventDefault()
					e.stopPropagation()

					setIsEditing(true)
				}}>
				{__('Add/Edit Conditions', 'rishi-companion')}
			</button>

			<Overlay
				items={isEditing}
				initialFocusRef={containerRef}
				className="rt-admin-modal rt-builder-conditions-modal"
				onDismiss={() => {
					setIsEditing(false)
					setConditions(null)
				}}
				render={() => (
					<div className="rt-modal-content" ref={containerRef}>
						<h2>{sprintf(__('Display Conditions', 'rishi-companion'))}</h2>
						<p>
							{__(
								'Add one or more conditions in order to display your header.',
								'rishi-companion'
							)}
						</p>

						<div className="rt-modal-scroll">
							<OptionsPanel
								onChange={(optionId, cond) => {
									setConditions((localConditions) => [
										...(
											localConditions || conditions
										).filter(({ id }) => id !== headerId),
										{
											id: headerId,
											conditions: cond,
										},
									])
								}}
								options={{
									conditions: {
										type: 'rishi-display-condition',
										design: 'none',
										value: [],
										design: 'none',
										label: false,
									},
								}}
								value={{
									conditions: (
										(localConditions || conditions).find(
											({ id }) => id === headerId
										) || { conditions: [] }
									).conditions,
								}}
								hasRevertButton={false}
							/>
						</div>

						<div className="rt-modal-actions has-divider">
							<button
								className="button-primary"
								disabled={!localConditions}
								onClick={() => saveSettings()}>
								{__('Save Conditions', 'rishi-companion')}
							</button>
						</div>
					</div>
				)}
			/>
		</Fragment>
	)
}

export default EditConditions
