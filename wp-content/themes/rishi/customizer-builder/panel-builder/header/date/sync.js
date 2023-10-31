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
	...typographyOption({
		id: 'headerDateFont',
		selector: '.header-date-section',
	}),

	// Icon Size
	header_date_icon_size: {
		selector: '.header-date-section',
		variable: 'icon-size',
		responsive: true,
		unit: 'px',
	},

	/* Default State */
	// Text Color
	headerDateColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.header-date-section',
					})
				}),
			),
			variable: 'headerDateInitialColor',
			type: 'color:default'
		},

	],

	// Icon Color
	headerDateIconColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.header-date-section',
					})
				}),
			),
			variable: 'headerDateInitialIconColor',
			type: 'color:default'
		},
	],
	/* Transparent State */
	// Text Color
	transparentHeaderDateColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.header-date-section',
					}),				
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				}),
			),

			variable: 'headerDateInitialColor',
			type: 'color:default',
		},
	],

	// Icon Color
	transparentHeaderDateIconColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.header-date-section',
					}),				
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				}),
			),

			variable: 'headerDateInitialIconColor',
			type: 'color:default',
		},
	],

	/* Sticky State */
	// Text Color
	stickyHeaderDateColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.header-date-section',
					}),				
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'headerDateInitialColor',
			type: 'color:default'
		},
	],

	// Icon Color
	stickyHeaderDateIconColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.header-date-section',
					}),				
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'headerDateInitialIconColor',
			type: 'color:default'
		},
	],
})

rtEvents.on(
	'rt:header:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['date'] = ({ itemId }) =>
			getVariables({ itemId, panelType: 'header' })
	}
)