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
		variableDescriptors['mobile-menu'] = ({ itemId }) => ({
			...typographyOption({
				id: 'mobileMenuFont',
				selector: assembleSelector(getRootSelectorFor({ itemId })),
			}),

			mobileMenuColor: [
				{
					selector: assembleSelector(getRootSelectorFor({ itemId })),
					variable: 'linkInitialColor',
					type: 'color:default',
					responsive: true,
				},

				{
					selector: assembleSelector(getRootSelectorFor({ itemId })),
					variable: 'linkHoverColor',
					type: 'color:hover',
					responsive: true,
				},
			],

			mobile_menu_child_size: {
				selector: assembleSelector(getRootSelectorFor({ itemId })),
				variable: 'mobile_menu_child_size',
				unit: ''
			},

			mobile_menu_divider: {
				selector: assembleSelector(getRootSelectorFor({ itemId })),
				variable: 'mobile-menu-divider',
				type: 'border',
			},

			mobileMenuMargin: {
				selector: assembleSelector(getRootSelectorFor({ itemId })),
				type: 'spacing',
				variable: 'margin',
				responsive: true,
			},
			mobileMenuPadding: {
				selector: assembleSelector(getRootSelectorFor({ itemId })),
				type: 'spacing',
				variable: 'padding',
				responsive: true,
			},
		})
	}
)

rtEvents.on('ct:header:sync:item:mobile-menu', ({ optionId, optionValue }) => {
	const selector = '[data-id="mobile-menu"]'

	if (optionId === 'mobile_menu_type') {
		updateAndSaveEl(selector, (el) => (el.dataset.type = optionValue))
	}
})
