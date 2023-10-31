import { typographyOption } from "../../../src/js/customizer/sync/variables/typography"
import rtEvents from '../../../src/js/events';
import {
	getRootSelectorFor,
	assembleSelector,
	mutateSelector,
} from '../../../src/js/customizer/sync/helpers'

const getVariables = ({ itemId, panelType }) => ({
	contacts_icon_size: {
		selector: '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info',
		variable: 'icon-size',
		responsive: true,
		unit: 'px',
	},

	contacts_spacing: {
		selector: '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info',
		variable: 'items-spacing',
		responsive: true,
		unit: 'px',
	},

	...typographyOption({
		id: 'contacts_font',
		selector: '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info .contact-info',
	}),

	contacts_margin: {
		selector: '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info',
		type: 'spacing',
		variable: 'margin',
		responsive: true,
		important: true,
	},

	// default state
	contacts_font_color: [
		{
			selector: '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info .contact-info',
			variable: 'color',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info .contact-info',
			variable: 'linkInitialColor',
			type: 'color:link_initial',
			responsive: true,
		},

		{
			selector: '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info .contact-info',
			variable: 'linkHoverColor',
			type: 'color:link_hover',
			responsive: true,
		},
	],

	contacts_icon_color: [
		{
			selector: '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info .cb__icon-container',
			variable: 'icon-color',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info .cb__icon-container',
			variable: 'icon-hover-color',
			type: 'color:hover',
			responsive: true,
		},
	],

	contacts_icon_background: [
		{
			selector: '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info .cb__icon-container',
			variable: 'background-color',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info .cb__icon-container',
			variable: 'background-hover-color',
			type: 'color:hover',
			responsive: true,
		},
	],
})

rtEvents.on(
	'rt:footer:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['contacts'] = ({ itemId }) =>
			getVariables({ itemId, panelType: 'footer' })
	}
)

rtEvents.on(
	'ct:footer:sync:item:contacts',
	({
		values: { contacts_icon_fill_type, contacts_icon_shape },
		optionId,
		optionValue,
	}) => {
		const selector = [...document.querySelectorAll('[data-id="contacts"].cb__footer-contact-info > ul')];

		if (
			optionId === 'contacts_icon_fill_type' ||
			optionId === 'contacts_icon_shape'
		) {
			selector.map((el) => {
				el.dataset.iconsType = `${contacts_icon_shape}${contacts_icon_shape === 'simple'
					? ''
					: `:${contacts_icon_fill_type}`
					}`
			})
		}
	}
)
