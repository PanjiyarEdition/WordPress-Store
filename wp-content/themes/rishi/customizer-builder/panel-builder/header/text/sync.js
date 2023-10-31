import { typographyOption } from '../../../src/js/customizer/sync/variables/typography'
import rtEvents from '../../../src/js/events';
import { updateAndSaveEl } from '../../../src/js/frontend/header/render-loop'
import { responsiveClassesFor } from '../../../src/js/customizer/sync/helpers'
import {
	getRootSelectorFor,
	assembleSelector,
	mutateSelector,
	getColumnSelectorFor,
} from '../../../src/js/customizer/sync/helpers'
import { select } from 'underscore';

const getVariables = ({ itemId, fullItemId, panelType }) => ({
	headerTextMaxWidth: {
		selector: assembleSelector(getRootSelectorFor({ itemId, panelType })),
		variable: 'maxWidth',
		responsive: true,
		unit: '%',
	},

	...typographyOption({
		id: 'headerTextFont',

		selector: assembleSelector(getRootSelectorFor({ itemId, panelType })),
	}),

	headerTextMargin: {
		selector: assembleSelector(getRootSelectorFor({ itemId, panelType })),
		type: 'spacing',
		variable: 'margin',
		responsive: true,
		important: true,
	},

	// default state
	headerTextColor: [
		{
			selector: assembleSelector(
				getRootSelectorFor({ itemId, panelType })
			),
			variable: 'color',
			type: 'color:default',
			responsive: true,
		},
		{
			selector: assembleSelector(
				getRootSelectorFor({ itemId, panelType })
			),
			variable: 'linkInitialColor',
			type: 'color:link_initial',
			responsive: true,
		},

		{
			selector: assembleSelector(
				getRootSelectorFor({ itemId, panelType })
			),
			variable: 'linkHoverColor',
			type: 'color:link_hover',
			responsive: true,
		},
	],
	headerLinkColor: [

		{
			selector: assembleSelector(
				getRootSelectorFor({ itemId, panelType })
			),
			variable: 'linkInitialColor',
			type: 'color:link_initial',
			responsive: true,
		},

		{
			selector: assembleSelector(
				getRootSelectorFor({ itemId, panelType })
			),
			variable: 'linkHoverColor',
			type: 'color:link_hover',
			responsive: true,
		},
	],


	// transparent state
	transparentHeaderTextColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: getRootSelectorFor({ itemId, panelType }),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'color',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: getRootSelectorFor({ itemId, panelType }),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'linkInitialColor',
			type: 'color:link_initial',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: getRootSelectorFor({ itemId, panelType }),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'linkHoverColor',
			type: 'color:link_hover',
			responsive: true,
		},
	],

	// sticky state
	stickyHeaderTextColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: getRootSelectorFor({ itemId, panelType }),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'color',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: getRootSelectorFor({ itemId, panelType }),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'linkInitialColor',
			type: 'color:link_initial',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: getRootSelectorFor({ itemId, panelType }),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'linkHoverColor',
			type: 'color:link_hover',
			responsive: true,
		},
	],

	// footer html
	footer_html_horizontal_alignment: {
		selector: assembleSelector(
			mutateSelector({
				selector: getRootSelectorFor({
					itemId,
					panelType: 'footer',
				}),
				operation: 'replace-last',
				to_add: getColumnSelectorFor({ itemId: fullItemId }),
			})
		),
		variable: 'horizontal-alignment',
		responsive: true,
		unit: '',
	},

	footer_html_vertical_alignment: {
		selector: assembleSelector(
			mutateSelector({
				selector: getRootSelectorFor({
					itemId,
					panelType: 'footer',
				}),
				operation: 'replace-last',
				to_add: getColumnSelectorFor({ itemId: fullItemId }),
			})
		),
		variable: 'vertical-alignment',
		responsive: true,
		unit: '',
	},
})

rtEvents.on(
	'rt:header:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['text'] = ({ itemId, fullItemId }) =>
			getVariables({ itemId, fullItemId, panelType: 'header' })
	}
)

rtEvents.on(
	'rt:footer:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['text'] = ({ itemId, fullItemId }) =>
			getVariables({ itemId, fullItemId, panelType: 'footer' })
	}
)

rtEvents.on('rt:header:sync:item:text', ({ itemId, optionId, optionValue }) => {
	const selector = `[data-id="${itemId}"]`

	if (optionId === 'visibility') {
		updateAndSaveEl(selector, (el) =>
			responsiveClassesFor({ ...optionValue, desktop: true }, el)
		)
	}

	if (optionId === 'header_text') {
		updateAndSaveEl(selector, (el) => {
			el.querySelector('.html-content').innerHTML = optionValue
		})
	}

	if (optionId === 'headerLinkUnderLine') {
		updateAndSaveEl(selector, (el) => {
			el.setAttribute('data-header-style', optionValue)			
		})
	}

})

rtEvents.on('ct:footer:sync:item:text', ({ itemId, optionId, optionValue }) => {
	const selector = `.cb__footer [data-id="${itemId}"]`
	const el = document.querySelector(selector)

	if (optionId === 'footer_visibility') {
		responsiveClassesFor(optionValue, el)
	}

	if (optionId === 'header_text') {
		el.querySelector('.html-content').innerHTML = optionValue
	}

	if (optionId === 'headerLinkUnderLine') {
		el.setAttribute('data-header-style', optionValue)
	}
})
