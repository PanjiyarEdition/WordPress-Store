import rtEvents from '../../../src/js/events';
import { updateAndSaveEl } from '../../../src/js/frontend/header/render-loop'
import {
	getRootSelectorFor,
	assembleSelector,
	responsiveClassesFor,
	mutateSelector,
	getColumnSelectorFor,
} from '../../../src/js/customizer/sync/helpers'

const getVariables = ({ itemId, fullItemId, panelType }) => ({
	headerCtaMargin: {
		selector: assembleSelector(getRootSelectorFor({ itemId, panelType })),
		type: 'spacing',
		variable: 'margin',
		responsive: true,
		important: true,
	},

	headerCtaRadius: {
		selector: assembleSelector(getRootSelectorFor({ itemId, panelType })),
		type: 'spacing',
		variable: 'buttonBorderRadius',
		responsive: true,
	},

	headerCtaPadding: {
		selector: assembleSelector(getRootSelectorFor({ itemId, panelType })),
		type: 'spacing',
		variable: 'headerCtaPadding',
		responsive: true,
		important: true,
	},

	// default state
	headerButtonFontColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: getRootSelectorFor({ itemId, panelType }),
					operation: 'suffix',
					to_add: '.cb__button',
				})
			),
			variable: 'buttonTextInitialColor',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: getRootSelectorFor({ itemId, panelType }),
					operation: 'suffix',
					to_add: '.cb__button',
				})
			),
			variable: 'buttonTextHoverColor',
			type: 'color:hover',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: getRootSelectorFor({ itemId, panelType }),
					operation: 'suffix',
					to_add: '.cb__button-ghost',
				})
			),
			variable: 'buttonTextInitialColor',
			type: 'color:default_2',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: getRootSelectorFor({ itemId, panelType }),
					operation: 'suffix',
					to_add: '.cb__button-ghost',
				})
			),
			variable: 'buttonTextHoverColor',
			type: 'color:hover_2',
			responsive: true,
		},
	],

	headerButtonForeground: [
		{
			selector: assembleSelector(
				getRootSelectorFor({ itemId, panelType })
			),
			variable: 'buttonInitialColor',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: assembleSelector(
				getRootSelectorFor({ itemId, panelType })
			),
			variable: 'buttonHoverColor',
			type: 'color:hover',
			responsive: true,
		},
	],

	header_button_border_color: [
		{
			selector: assembleSelector(
				getRootSelectorFor({ itemId, panelType })
			),
			variable: 'headerButtonBorderColor',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: assembleSelector(
				getRootSelectorFor({ itemId, panelType })
			),
			variable: 'headerButtonBorderHoverColor',
			type: 'color:hover',
			responsive: true,
		},
	],



	// transparent state
	transparentHeaderButtonFontColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__button',
					}),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'buttonTextInitialColor',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__button',
					}),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'buttonTextHoverColor',
			type: 'color:hover',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__button-ghost',
					}),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'buttonTextInitialColor',
			type: 'color:default_2',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__button-ghost',
					}),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'buttonTextHoverColor',
			type: 'color:hover_2',
			responsive: true,
		},
	],

	transparentHeaderButtonForeground: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: getRootSelectorFor({ itemId, panelType }),
					operation: 'between',
					to_add: '[data-transparent-row="yes"]',
				})
			),

			variable: 'buttonInitialColor',
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

			variable: 'buttonHoverColor',
			type: 'color:hover',
			responsive: true,
		},
	],

	// sticky state
	stickyHeaderButtonFontColor: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__button',
					}),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'buttonTextInitialColor',
			type: 'color:default',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__button',
					}),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'buttonTextHoverColor',
			type: 'color:hover',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__button-ghost',
					}),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'buttonTextInitialColor',
			type: 'color:default_2',
			responsive: true,
		},

		{
			selector: assembleSelector(
				mutateSelector({
					selector: mutateSelector({
						selector: getRootSelectorFor({ itemId, panelType }),
						operation: 'suffix',
						to_add: '.cb__button-ghost',
					}),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'buttonTextHoverColor',
			type: 'color:hover_2',
			responsive: true,
		},
	],

	stickyHeaderButtonForeground: [
		{
			selector: assembleSelector(
				mutateSelector({
					selector: getRootSelectorFor({ itemId, panelType }),
					operation: 'between',
					to_add: '[data-sticky*="yes"]',
				})
			),
			variable: 'buttonInitialColor',
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
			variable: 'buttonHoverColor',
			type: 'color:hover',
			responsive: true,
		},
	],

	header_button_minwidth: {
		selector: assembleSelector(getRootSelectorFor({ itemId })),
		variable: 'buttonMinWidth',
		responsive: true,
		unit: 'px',
	},

	headerCTAShadow: {
		selector: assembleSelector(
			mutateSelector({
				selector: getRootSelectorFor({ itemId, panelType }),
				operation: 'suffix',
				to_add: '.cb__button',
			})
		),
		type: 'box-shadow',
		variable: 'box-shadow',
		responsive: true,
	},

	headerCTAShadowHover: {
		selector: assembleSelector(
			mutateSelector({
				selector: getRootSelectorFor({ itemId, panelType }),
				operation: 'suffix',
				to_add: '.cb__button:hover',
			})
		),
		type: 'box-shadow',
		variable: 'box-shadow',
		responsive: true,
	},

	// footer button
	footer_button_horizontal_alignment: {
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

	footer_button_vertical_alignment: {
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
		variableDescriptors['button'] = ({ itemId, fullItemId }) =>
			getVariables({ itemId, fullItemId, panelType: 'header' })
	}
)

rtEvents.on(
	'rt:footer:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['button'] = ({ itemId, fullItemId }) =>
			getVariables({ itemId, fullItemId, panelType: 'footer' })
	}
)

rtEvents.on(
	'ct:header:sync:item:button',
	({ itemId, optionId, optionValue }) => {
		const selector = `[data-id="${itemId}"]`

		if (optionId === 'header_button_type') {
			updateAndSaveEl(selector, (el) => {
				const button = el.querySelector('[class*="cb__button"]')
				button.classList.remove('cb__button', 'cb__button-ghost')

				button.classList.add(
					optionValue === 'type-1' ? 'cb__button' : 'cb__button-ghost'
				)
			})
		}
		
		if (optionId === 'header_button_size') {
			updateAndSaveEl(selector, (el) => {
				el.querySelector(
					'[class*="cb__button"]'
				).dataset.size = optionValue
			})
		}

		if (optionId === 'header_button_text') {

			updateAndSaveEl(selector, (el) => {
				el.querySelector('[class*="cb__button"]').innerHTML = optionValue
			})
		}

		if (optionId === 'header_button_link') {
			updateAndSaveEl(selector, (el) => {
				el.querySelector('[class*="cb__button"]').href = optionValue
			})
		}

		if (optionId === 'button_visibility') {
			updateAndSaveEl(selector, (el) => {
				responsiveClassesFor(
					{ ...optionValue },
					el.querySelector('.cb__button')
				)
			})
		}

	}
)

rtEvents.on(
	'ct:footer:sync:item:button',
	({ itemId, optionId, optionValue }) => {
		const selector = `.cb__footer [data-id="${itemId}"]`
		const el = document.querySelector(selector);

		if (optionId === 'header_button_type') {
			const button = el.querySelector('[class*="cb__button"]')
			button.classList.remove('cb__button', 'cb__button-ghost')

			button.classList.add(
				optionValue === 'type-1' ? 'cb__button' : 'cb__button-ghost'
			)
		}

		if (optionId === 'visibility') {
			responsiveClassesFor(optionValue, el)
		}

		if (optionId === 'header_button_size') {
			el.querySelector('[class*="cb__button"]').dataset.size = optionValue
		}

		if (optionId === 'header_button_text') {
			el.querySelector('[class*="cb__button"]').innerHTML = optionValue
		}

		if (optionId === 'header_button_link') {
			el.querySelector('[class*="cb__button"]').href = optionValue
		}

		if (optionId === 'header_hide_button') {
			updateAndSaveEl(selector, (el) => {
				if (optionValue === true) {
					el.querySelector('[class*="cb__button"]').parentElement.style.visibility = "hidden";
				} else {
					el.querySelector('[class*="cb__button"]').parentElement.style.visibility = "visible";
				}
			})
		}

	}
)
