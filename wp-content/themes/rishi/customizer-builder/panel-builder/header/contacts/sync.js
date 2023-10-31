import { typographyOption } from "../../../src/js/customizer/sync/variables/typography"
import { handleBackgroundOptionFor } from "../../../src/js/customizer/sync/variables/background"
import { updateAndSaveEl } from '../../../src/js/frontend/header/render-loop'
import rtEvents from '../../../src/js/events';
import {
	getRootSelectorFor,
	assembleSelector,
	mutateSelector,
} from '../../../src/js/customizer/sync/helpers'

const getVariables = ({ itemId, panelType }) => ({

	contacts_icon_size: {
		selector: '[data-header*="type-1"] [data-id="contacts"].customizer-builder__contact-info__header .cb__icon-container',
		variable: 'icon-size',
		responsive: true,
		unit: 'px',
	},

	contacts_spacing: {
		selector: '[data-header*="type-1"] [data-id="contacts"].customizer-builder__contact-info__header',
		variable: 'items-spacing',
		responsive: true,
		unit: 'px',
	},

	...typographyOption({
		id: 'contacts_font',
		selector: assembleSelector(
			mutateSelector({
				selector: getRootSelectorFor({ itemId, panelType }),
				operation: 'suffix',
				to_add: '.contact-info',
			})
		),
	}),

	contacts_margin: {
		selector: '[data-header*="type-1"] [data-id="contacts"].customizer-builder__contact-info__header',
		type: 'spacing',
		variable: 'margin',
		responsive: true,
		important: true,
	},

	// default state
	contacts_font_color: [
		{
			selector: '[data-header*="type-1"] [data-id="contacts"].customizer-builder__contact-info__header .contact-info',
			variable: 'color',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: '[data-header*="type-1"] [data-id="contacts"].customizer-builder__contact-info__header .contact-info',
			variable: 'linkInitialColor',
			type: 'color:link_initial',
			responsive: true,
		},

		{
			selector: '[data-header*="type-1"] [data-id="contacts"].customizer-builder__contact-info__header .contact-info',
			variable: 'linkHoverColor',
			type: 'color:link_hover',
			responsive: true,
		},
	],

	contacts_icon_color: [
		{
			selector: '[data-header*="type-1"] [data-id="contacts"].customizer-builder__contact-info__header .cb__icon-container',
			variable: 'icon-color',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: '[data-header*="type-1"] [data-id="contacts"].customizer-builder__contact-info__header .cb__icon-container',
			variable: 'icon-hover-color',
			type: 'color:hover',
			responsive: true,
		},
	],

	contacts_icon_background: [
		{
			selector: '[data-header*="type-1"] [data-id="contacts"].customizer-builder__contact-info__header .cb__icon-container',
			variable: 'background-color',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: '[data-header*="type-1"] [data-id="contacts"].customizer-builder__contact-info__header .cb__icon-container',
			variable: 'background-hover-color',
			type: 'color:hover',
			responsive: true,
		},
	],

	// transparent state
	transparent_contacts_font_color: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.contact-info',
					}),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'color',
			type: 'color:default',
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.contact-info',
					}),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'linkInitialColor',
			type: 'color:link_initial',
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.contact-info',
					}),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'linkHoverColor',
			type: 'color:link_hover',
		},
	],

	transparent_contacts_icon_color: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__icon-container',
					}),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'icon-color',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__icon-container',
					}),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'icon-hover-color',
			type: 'color:hover',
			responsive: true,
		},
	],

	transparent_contacts_icon_background: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__icon-container',
					}),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'background-color',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__icon-container',
					}),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'background-hover-color',
			type: 'color:hover',
			responsive: true,
		},
	],

	// sticky state
	sticky_contacts_font_color: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.contact-info',
					}),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'color',
			type: 'color:default',
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.contact-info',
					}),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'linkInitialColor',
			type: 'color:link_initial',
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.contact-info',
					}),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'linkHoverColor',
			type: 'color:link_hover',
		},
	],

	sticky_contacts_icon_color: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__icon-container',
					}),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'icon-color',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__icon-container',
					}),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'icon-hover-color',
			type: 'color:hover',
			responsive: true,
		},
	],

	sticky_contacts_icon_background: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__icon-container',
					}),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'background-color',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__icon-container',
					}),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'background-hover-color',
			type: 'color:hover',
			responsive: true,
		},
	],
})

rtEvents.on(
	'rt:header:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['contacts'] = ({ itemId }) =>
			getVariables({ itemId, panelType: 'header' })
	}
)

rtEvents.on(
	'ct:header:sync:item:contacts',
	({
		values: { contacts_icon_fill_type, contacts_icon_shape },
		optionId,
		optionValue,
	}) => {
		const selector = `[data-id="contacts"].customizer-builder__contact-info__header > ul`

		if (
			optionId === 'contacts_icon_fill_type' ||
			optionId === 'contacts_icon_shape'
		) {
			updateAndSaveEl(selector, (el) => {
				el.dataset.iconsType = `${contacts_icon_shape}${contacts_icon_shape === 'simple'
					? ''
					: `:${contacts_icon_fill_type}`
					}`
			})
		}
	}
)
