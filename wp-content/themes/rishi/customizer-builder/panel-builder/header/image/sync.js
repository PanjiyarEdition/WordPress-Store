import { typographyOption } from '../../../src/js/customizer/sync/variables/typography'
import { updateAndSaveEl } from '../../../src/js/frontend/header/render-loop'
import rtEvents from '../../../src/js/events';
import {
	responsiveClassesFor,
	getRootSelectorFor,
	assembleSelector,
	mutateSelector,
} from '../../../src/js/customizer/sync/helpers'

const getVariables = ({ itemId, panelType }) => ({
	// Image Max Width Size
	header_image_max_width: {
		selector: '.header-image-section',
		variable: 'max-width',
		responsive: true,
		unit: 'px',
	},
})

rtEvents.on(
	'rt:header:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['image'] = ({ itemId }) =>
			getVariables({ itemId, panelType: 'header' })
	}
)