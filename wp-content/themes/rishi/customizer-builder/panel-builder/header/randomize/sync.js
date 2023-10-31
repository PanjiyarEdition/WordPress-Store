import { typographyOption } from "../../../src/js/customizer/sync/variables/typography"
import rtEvents from '../../../src/js/events';
import {
	responsiveClassesFor,
	getRootSelectorFor,
	assembleSelector,
	mutateSelector,
} from '../../../src/js/customizer/sync/helpers'

const getVariables = ({ itemId, panelType }) => (    
	{
    // Typography
    ...typographyOption({
		id: 'headerRandomizeFont',
		selector: '.header-randomize-section',
	}),

	// Icon Size
	header_randomize_icon_size: {
		selector: '.header-randomize-section',
		variable: 'icon-size',
		responsive: true,
		unit: 'px',
	},

    /* Default State */
	// Text Color
	headerRandomizeColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.header-randomize-section',
					}),				
				}),
			),
			variable: 'headerRandomizeInitialColor',
			type: 'color:default'
		},
	],

    // Icon Color
    headerRandomizeIconColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.header-randomize-section',
					}),				
				}),
			),
			variable: 'headerRandomizeInitialIconColor',
			type: 'color:default'
		},
		{
			selector: assembleSelector(
				getRootSelectorFor({ itemId, panelType })
			),
			variable: 'headerRandomizeInitialIconHoverColor',
			type: 'color:hover'
		},
	],

    /* Transparent State */
	// Text Color
	transparentHeaderRandomizeColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.header-randomize-section',
					}),				
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				}),
			),

			variable: 'headerRandomizeInitialColor',
			type: 'color:default',
		},
	],

    // Icon Color
	transparentHeaderRandomizeIconColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.header-randomize-section',
					}),				
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				}),
			),

			variable: 'headerRandomizeInitialIconColor',
			type: 'color:default',
		},
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.header-randomize-section',
					}),				
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				}),
			),
			variable: 'headerRandomizeInitialIconHoverColor',
			type: 'color:hover'
		},
	],

    /* Sticky State */
	// Text Color
	stickyHeaderRandomizeColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.header-randomize-section',
					}),				
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'headerRandomizeInitialColor',
			type: 'color:default'
		},
	],

    // Icon Color
	stickyHeaderRandomizeIconColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.header-randomize-section',
					}),				
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'headerRandomizeInitialIconColor',
			type: 'color:default'
		},
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.header-randomize-section',
					}),				
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'headerRandomizeInitialIconHoverColor',
			type: 'color:hover'
		},
	]
})

rtEvents.on(
	'rt:header:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['randomize'] = ({ itemId }) =>
			getVariables({ itemId, panelType: 'header' })
	}
)