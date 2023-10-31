import { typographyOption } from '../../../src/js/customizer/sync/variables/typography'
import rtEvents from '../../../src/js/events';
import { updateAndSaveEl } from '../../../src/js/frontend/header/render-loop'
import {
	getRootSelectorFor,
	assembleSelector,
	mutateSelector,
} from '../../../src/js/customizer/sync/helpers'

rtEvents.on(
	'rt:header:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['trigger'] = ({ itemId }) => ({
			triggerMargin: {
				selector: assembleSelector(getRootSelectorFor({ itemId })),

				type: 'spacing',
				variable: 'margin',
				responsive: true,
				important: true,
			},

			// default state
			triggerIconColor: [
				{
					selector: assembleSelector(getRootSelectorFor({ itemId })),
					variable: 'linkInitialColor',
					type: 'color:default',
				},

				{
					selector: assembleSelector(getRootSelectorFor({ itemId })),
					variable: 'linkHoverColor',
					type: 'color:hover',
				},
			],

			triggerSecondColor: [
				{
					selector: assembleSelector(getRootSelectorFor({ itemId })),
					variable: 'secondColor',
					type: 'color:default',
				},

				{
					selector: assembleSelector(getRootSelectorFor({ itemId })),
					variable: 'secondColorHover',
					type: 'color:hover',
				},
			],

			// transparent state
			transparentTriggerIconColor: [
				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'between',
							to_add: '[data-transparent-row="yes"]',
						})
					),

					variable: 'linkInitialColor',
					type: 'color:default',
				},

				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'between',
							to_add: '[data-transparent-row="yes"]',
						})
					),

					variable: 'linkHoverColor',
					type: 'color:hover',
				},
			],

			transparentTriggerSecondColor: [
				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'between',
							to_add: '[data-transparent-row="yes"]',
						})
					),

					variable: 'secondColor',
					type: 'color:default',
				},

				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'between',
							to_add: '[data-transparent-row="yes"]',
						})
					),

					variable: 'secondColorHover',
					type: 'color:hover',
				},
			],

			// sticky state
			stickyTriggerIconColor: [
				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'between',
							to_add: '[data-sticky*="yes"]',
						})
					),
					variable: 'linkInitialColor',
					type: 'color:default',
				},

				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'between',
							to_add: '[data-sticky*="yes"]',
						})
					),
					variable: 'linkHoverColor',
					type: 'color:hover',
				},
			],

			stickyTriggerSecondColor: [
				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'between',
							to_add: '[data-sticky*="yes"]',
						})
					),
					variable: 'secondColor',
					type: 'color:default',
				},

				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'between',
							to_add: '[data-sticky*="yes"]',
						})
					),
					variable: 'secondColorHover',
					type: 'color:hover',
				},
			],

			...typographyOption({
				id: "trigger_typo",
				selector: assembleSelector(getRootSelectorFor({ itemId })),
			}),
		})
	}
)

rtEvents.on(
	'ct:header:sync:item:trigger',
	({ optionId, optionValue, values }) => {
		const selector = '[data-id="trigger"]'

		if (optionId === 'mobile_menu_trigger_type') {
			updateAndSaveEl(
				selector,
				(el) =>
					(el.querySelector('.cb__menu-trigger').dataset.type = optionValue)
			)
		}

		updateAndSaveEl(selector, (el) => {
			let label = el.querySelector('.cb__label')

			label.innerHTML = values.trigger_label

			label.removeAttribute('hidden')

			if (values.has_trigger_label !== 'yes') {
				label.hidden = true
			}

			el.dataset.design = `${values.trigger_design || 'simple'}${values.has_trigger_label === 'yes'
				? `:${values.trigger_label_alignment || 'right'}`
				: ''
				}`
		})
	}
)
