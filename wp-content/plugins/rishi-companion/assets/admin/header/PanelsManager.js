import {
	createElement,
	Component,
	useState,
	useContext,
	Fragment,
} from '@wordpress/element'
import cls from 'classnames'
import {
	Panel,
	PanelMetaWrapper,
	PlacementsDragDropContext,
	getValueFromInput,
} from 'rishi-customizer-options'
import { applyFilters } from '@wordpress/hooks'

import { Slot } from '@wordpress/components'

import { __ } from '@wordpress/i18n'
import EditConditions from './EditConditions'

const PanelsManager = () => {
	const secondaryItems =
		rishi__cb_customizer_localizations.header_builder_data.secondary_items.header
	const allItems = rishi__cb_customizer_localizations.header_builder_data.header

	const {
		builderValueDispatch,
		builderValue,
		option,
		builderValueCollection,
		panelsActions,
	} = useContext(PlacementsDragDropContext)

	const allSections =
		applyFilters(
			'rishi.header.available-sections',
			null,
			builderValueCollection.sections
		) ||
		builderValueCollection.sections.filter(
			({ id }) =>
				id !== 'type-2' &&
				id !== 'type-3' &&
				id.indexOf('rt-custom') === -1
		)

	return (
		<Fragment>
			<ul className={cls('rt-panels-manager')}>
				{allSections.map(({ name, id }) => {
					let panelLabel =
						name ||
						{
							'type-1': __('Global Header', 'rishi-companion'),
						}[id] ||
						id

					const panelId = `builder_header_panel_${id}`

					const headerOptions =
						rishi__cb_customizer_localizations.header_builder_data
							.header_data.header_options

					const option = {
						label: panelLabel,
						'inner-options': {
							...(id.indexOf('rt-custom') > -1
								? {
									conditions_button: {
										label: __('Edit Conditions', 'rishi-companion'),
										type: 'jsx',
										design: 'block',
										render: () => (
											<EditConditions headerId={id} />
										),
									},

									divider: { type: 'rt-divider' }
								}
								: {}),

							...headerOptions,
						},
					}

					return (
						<PanelMetaWrapper
							id={panelId}
							key={id}
							option={option}
							{...panelsActions}
							getActualOption={({ open }) => (
								<Fragment>
									{id === builderValue.id && (
										<Panel
											id={panelId}
											getValues={() => ({
												id,
												...(builderValue.settings ||
													{}),
											})}
											option={option}
											onChangeFor={(
												optionId,
												optionValue
											) => {
												builderValueDispatch({
													type:
														'BUILDER_GLOBAL_SETTING_ON_CHANGE',
													payload: {
														optionId,
														optionValue,
														values: getValueFromInput(
															headerOptions,
															Array.isArray(
																builderValue.settings
															)
																? {}
																: builderValue.settings ||
																{}
														),
													},
												})
											}}
											view="simple"
										/>
									)}

									<li
										className={cls({
											active: id === builderValue.id,
											'rt-global': id === 'type-1',
										})}
										onClick={() => {
											if (id === builderValue.id) {
												open()
											} else {
												builderValueDispatch({
													type:
														'PICK_BUILDER_SECTION',
													payload: {
														id,
													},
												})
											}
										}}>
										<span className="rt-panel-name">
											{panelLabel}
										</span>

										{id.indexOf('rt-custom') > -1 &&
											id !== builderValue.id && (
												<span
													className="rt-remove-instance"
													onClick={(e) => {
														e.preventDefault()
														e.stopPropagation()

														builderValueDispatch({
															type:
																'REMOVE_BUILDER_SECTION',
															payload: {
																id,
															},
														})
													}}>
													<i className="rt-tooltip-top">
														{__(
															'Remove header',
															'rishi-companion'
														)}
													</i>
													<svg
														width="11px"
														height="11px"
														viewBox="0 0 24 24">
														<path d="M9.6,0l0,1.2H1.2v2.4h21.6V1.2h-8.4l0-1.2H9.6z M2.8,6l1.8,15.9C4.8,23.1,5.9,24,7.1,24h9.9c1.2,0,2.2-0.9,2.4-2.1L21.2,6H2.8z"></path>
													</svg>
												</span>
											)}
									</li>
								</Fragment>
							)}></PanelMetaWrapper>
					)
				})}
			</ul>
			<Slot name="PlacementsBuilderPanelsManagerAfter">
				{(fills) => (fills.length === 0 ? null : fills)}
			</Slot>
		</Fragment>
	)
}

export default PanelsManager
