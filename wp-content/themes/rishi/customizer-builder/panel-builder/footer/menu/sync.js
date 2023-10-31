import { typographyOption } from "../../../src/js/customizer/sync/variables/typography"
import rtEvents from '../../../src/js/events';
import {
	responsiveClassesFor,
	getRootSelectorFor,
	assembleSelector,
	mutateSelector,
} from '../../../src/js/customizer/sync/helpers'


export const handleMenuVariables = ({ itemId }) => ({
	footerMenuItemsSpacing: {
		selector: assembleSelector(
			getRootSelectorFor({ itemId, panelType: 'footer' })
		),
		variable: 'menu-items-spacing',
		responsive: true,
		unit: 'px',
	},

	footerMenuAlignment: {
		selector: assembleSelector(
			mutateSelector({
				selector: getRootSelectorFor({ itemId, panelType: 'footer' }),
				operation: 'replace-last',
				to_add: `[data-column="${itemId}"]`,
			})
		),
		variable: 'horizontal-alignment',
		responsive: true,
		unit: '',
	},

	footerMenuVerticalAlignment: {
		selector: assembleSelector(
			mutateSelector({
				selector: getRootSelectorFor({ itemId, panelType: 'footer' }),
				operation: 'replace-last',
				to_add: `[data-column="${itemId}"]`,
			})
		),
		variable: 'vertical-alignment',
		responsive: true,
		unit: '',
	},

	...typographyOption({
		id: 'footerMenuFont',

		selector: assembleSelector(
			mutateSelector({
				selector: getRootSelectorFor({ itemId, panelType: 'footer' }),
				operation: 'suffix',
				to_add: 'ul',
			})
		),
	}),

	footerMenuFontColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: getRootSelectorFor({
						itemId,
						panelType: 'footer',
					}),
					operation: 'suffix',
					to_add: '> ul > li > a',
				})
			),
			variable: 'linkInitialColor',
			type: 'color:default',
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: getRootSelectorFor({
						itemId,
						panelType: 'footer',
					}),
					operation: 'suffix',
					to_add: '> ul > li > a',
				})
			),
			variable: 'linkHoverColor',
			type: 'color:hover',
		},
	],

	footerMenuMargin: {
		selector: assembleSelector(
			getRootSelectorFor({ itemId, panelType: 'footer' })
		),
		type: 'spacing',
		variable: 'margin',
		responsive: true,
		important: true,
	},
})

export const handleMenuOptions = ({
	selector,
	changeDescriptor: { optionId, optionValue },
}) => {
	const el = document.querySelector('.footer-menu')

	if (optionId === 'stretch_menu') {
		el.removeAttribute('data-stretch')

		if (optionValue === 'yes') {
			el.dataset.stretch = ''
		}
	}

	if (optionId === 'footer_menu_visibility') {
		responsiveClassesFor(optionValue, el)
	}
}

rtEvents.on('ct:footer:sync:item:menu', (changeDescriptor) => {
	const selector = '.footer-menu'
	handleMenuOptions({ selector, changeDescriptor })
})

rtEvents.on('ct:footer:sync:item:menu-secondary', (changeDescriptor) => {
	const selector = '.footer-menu-2'
	handleMenuOptions({ selector, changeDescriptor })
})

rtEvents.on(
	'rt:footer:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['menu'] = handleMenuVariables
	}
)

rtEvents.on(
	'rt:footer:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['menu-secondary'] = handleMenuVariables
	}
)
