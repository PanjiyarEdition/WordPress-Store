import { handleBackgroundOptionFor } from '../../../src/js/customizer/sync/variables/background'
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
		const handleSectionBackground = ({ itemId }) =>
			handleBackgroundOptionFor(
				{
				id: 'section',
				selector: assembleSelector(
					mutateSelector({
						selector: getRootSelectorFor({ itemId }),
						operation: 'suffix',
						to_add: '> section',
					})
				),

				responsive: true,
				addToDescriptors: {
					fullValue: true,
				},

				valueExtractor: ({ offcanvasBackground }) =>
					offcanvasBackground,
			}).section

		const handleRootBackground = ({ itemId }) =>
			handleBackgroundOptionFor({
				id: 'section',
				selector: assembleSelector(getRootSelectorFor({ itemId })),
				responsive: true,
				addToDescriptors: {
					fullValue: true,
				},

				valueExtractor: ({
					offcanvas_behavior,
					offcanvasBackdrop,
					offcanvasBackground,
				}) =>
					offcanvas_behavior === 'modal'
						? offcanvasBackground
						: offcanvasBackdrop,
			}).section

		variableDescriptors['offcanvas'] = ({ itemId }) => ({
			offcanvas_behavior: [
				...handleSectionBackground({ itemId }),
				...handleRootBackground({ itemId }),
			],
			offcanvasBackground: [
				...handleSectionBackground({ itemId }),
				...handleRootBackground({ itemId }),
			],
			offcanvasBackdrop: [...handleRootBackground({ itemId })],

			headerPanelShadow: {
				selector: assembleSelector(
					`${getRootSelectorFor({ itemId })[0]
					} [data-behaviour*="side"]`
				),
				type: 'box-shadow',
				variable: 'box-shadow',
				responsive: true,
			},

			side_panel_width: {
				selector: assembleSelector(getRootSelectorFor({ itemId })),
				variable: 'side-panel-width',
				responsive: true,
				unit: '',
			},

			offcanvas_content_vertical_alignment: {
				selector: assembleSelector(getRootSelectorFor({ itemId })),
				variable: 'vertical-alignment',
				responsive: true,
				unit: '',
			},

			offcanvasContentAlignment: {
				selector: assembleSelector(getRootSelectorFor({ itemId })),
				variable: 'horizontal-alignment',
				responsive: true,
				unit: '',
			},

			menu_close_button_color: [
				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'suffix',
							to_add: '.close-button',
						})
					),
					variable: 'closeButtonColor',
					type: 'color:default',
				},

				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'suffix',
							to_add: '.close-button',
						})
					),
					variable: 'closeButtonHoverColor',
					type: 'color:hover',
				},
			],

			menu_close_button_shape_color: [
				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'suffix',
							to_add: '.close-button',
						})
					),
					variable: 'closeButtonBackground',
					type: 'color:default',
				},

				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'suffix',
							to_add: '.close-button',
						})
					),
					variable: 'closeButtonHoverBackground',
					type: 'color:hover',
				},
			],
		})
	}
)

rtEvents.on(
	'ct:header:sync:item:offcanvas',
	({ optionId, optionValue, values }) => {
		const selector = '#offcanvas'

		if (
			optionId === 'offcanvas_behavior' ||
			optionId === 'side_panel_position'
		) {
			const el = document.querySelector('#offcanvas')

			if (document.body.dataset.panel) {
				// document.querySelector('.cb__header-trigger').click
			}

			setTimeout(() => {
				el.removeAttribute('data-behaviour')
				el.classList.add('rt-no-transition')

				requestAnimationFrame(() => {
					el.dataset.behaviour =
						values.offcanvas_behavior === 'modal'
							? 'modal'
							: `${values.side_panel_position}-side`

					setTimeout(() => {
						el.classList.remove('rt-no-transition')
					})
				})
			}, 300)
		}
	}
)
