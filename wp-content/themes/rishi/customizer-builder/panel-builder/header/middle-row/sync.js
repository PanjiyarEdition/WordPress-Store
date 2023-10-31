import { handleBackgroundOptionFor } from '../../../src/js/customizer/sync/variables/background'
import rtEvents from '../../../src/js/events';
import { updateAndSaveEl } from '../../../src/js/frontend/header/render-loop'
import { withKeys } from '../../../src/js/customizer/sync/helpers'
// import { maybePromoteScalarValueIntoResponsive } from 'customizer-sync-helpers/dist/promote-into-responsive'

import {
	getRootSelectorFor,
	assembleSelector,
	mutateSelector,
} from '../../../src/js/customizer/sync/helpers'

export const handleRowVariables = ({ itemId }) => ({
	headerRowHeight: {
		selector: assembleSelector(getRootSelectorFor({ itemId })),
		variable: 'height',
		responsive: true,
		unit: 'px',
	},

	headerRowShadow: {
		selector: assembleSelector(getRootSelectorFor({ itemId })),
		variable: 'height',
		type: 'box-shadow',
		variable: 'box-shadow',
		forceOutput: true,
		responsive: true,
	},

	...handleBackgroundOptionFor({
		id: 'headerRowBackground',
		selector: assembleSelector(getRootSelectorFor({ itemId })),
		responsive: true,
	}),

	...withKeys(
		[
			'headerRowTopBorder',
			'transparentHeaderRowTopBorder',
			'stickyHeaderRowTopBorder',
			'headerRowTopBorderFullWidth',
		],
		[
			{
				selector: assembleSelector(getRootSelectorFor({ itemId })),
				variable: 'borderTop',
				type: 'border',
				responsive: true,

				fullValue: true,

				extractValue: ({
					headerRowTopBorder,
					headerRowTopBorderFullWidth,
				}) =>
					headerRowTopBorderFullWidth === 'yes'
						? headerRowTopBorder
						: {
							desktop: { style: 'none' },
							tablet: { style: 'none' },
							mobile: { style: 'none' },
						},
			},

			{
				selector: assembleSelector(
					mutateSelector({
						selector: getRootSelectorFor({ itemId }),
						operation: 'suffix',
						to_add: '> div',
					})
				),
				variable: 'borderTop',
				type: 'border',
				responsive: true,
				fullValue: true,

				extractValue: ({
					headerRowTopBorder,
					headerRowTopBorderFullWidth,
				}) =>
					headerRowTopBorderFullWidth !== 'yes'
						? headerRowTopBorder
						: {
							desktop: { style: 'none' },
							tablet: { style: 'none' },
							mobile: { style: 'none' },
						},
			},

			{
				selector: assembleSelector(
					mutateSelector({
						selector: getRootSelectorFor({ itemId }),
						operation: 'el-prefix',
						to_add: '[data-transparent-row="yes"]',
					})
				),

				variable: 'borderTop',
				type: 'border',
				responsive: true,

				fullValue: true,

				extractValue: ({
					transparentHeaderRowTopBorder,
					headerRowTopBorderFullWidth,
				}) =>
					headerRowTopBorderFullWidth === 'yes'
						? transparentHeaderRowTopBorder
						: {
							desktop: { style: 'none' },
							tablet: { style: 'none' },
							mobile: { style: 'none' },
						},
			},

			{
				selector: assembleSelector(
					mutateSelector({
						selector: mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'suffix',
							to_add: '> div',
						}),
						operation: 'el-prefix',
						to_add: '[data-transparent-row="yes"]',
					})
				),

				variable: 'borderTop',
				type: 'border',
				responsive: true,
				fullValue: true,

				extractValue: ({
					transparentHeaderRowTopBorder,
					headerRowTopBorderFullWidth,
				}) =>
					headerRowTopBorderFullWidth !== 'yes'
						? transparentHeaderRowTopBorder
						: {
							desktop: { style: 'none' },
							tablet: { style: 'none' },
							mobile: { style: 'none' },
						},
			},

			{
				selector: assembleSelector(
					mutateSelector({
						selector: getRootSelectorFor({ itemId }),
						to_add: '[data-sticky*="yes"]',
					})
				),

				variable: 'borderTop',
				type: 'border',
				responsive: true,

				fullValue: true,

				extractValue: ({
					stickyHeaderRowTopBorder,
					headerRowTopBorderFullWidth,
				}) =>
					headerRowTopBorderFullWidth === 'yes'
						? stickyHeaderRowTopBorder
						: {
							desktop: { style: 'none' },
							tablet: { style: 'none' },
							mobile: { style: 'none' },
						},
			},

			{
				selector: assembleSelector(
					mutateSelector({
						selector: mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'suffix',
							to_add: '> div',
						}),
						to_add: '[data-sticky*="yes"]',
					})
				),

				variable: 'borderTop',
				type: 'border',
				responsive: true,
				fullValue: true,

				extractValue: ({
					stickyHeaderRowTopBorder,
					headerRowTopBorderFullWidth,
				}) =>
					headerRowTopBorderFullWidth !== 'yes'
						? stickyHeaderRowTopBorder
						: {
							desktop: { style: 'none' },
							tablet: { style: 'none' },
							mobile: { style: 'none' },
						},
			},
		]
	),

	...withKeys(
		[
			'headerRowBottomBorder',
			'transparentHeaderRowBottomBorder',
			'stickyHeaderRowBottomBorder',

			'headerRowBottomBorderFullWidth',
		],
		[
			{
				selector: assembleSelector(getRootSelectorFor({ itemId })),
				variable: 'borderBottom',
				type: 'border',
				responsive: true,

				fullValue: true,

				extractValue: ({
					headerRowBottomBorder,
					headerRowBottomBorderFullWidth,
				}) =>
					headerRowBottomBorderFullWidth === 'yes'
						? headerRowBottomBorder
						: {
							desktop: { style: 'none' },
							tablet: { style: 'none' },
							mobile: { style: 'none' },
						},
			},

			{
				selector: assembleSelector(
					mutateSelector({
						selector: getRootSelectorFor({ itemId }),
						operation: 'suffix',
						to_add: '> div',
					})
				),
				variable: 'borderBottom',
				type: 'border',
				responsive: true,
				fullValue: true,

				extractValue: ({
					headerRowBottomBorder,
					headerRowBottomBorderFullWidth,
				}) =>
					headerRowBottomBorderFullWidth !== 'yes'
						? headerRowBottomBorder
						: {
							desktop: { style: 'none' },
							tablet: { style: 'none' },
							mobile: { style: 'none' },
						},
			},

			{
				selector: assembleSelector(
					mutateSelector({
						selector: getRootSelectorFor({ itemId }),
						operation: 'el-prefix',
						to_add: '[data-transparent-row="yes"]',
					})
				),

				variable: 'borderBottom',
				type: 'border',
				responsive: true,

				fullValue: true,

				extractValue: ({
					transparentHeaderRowBottomBorder,
					headerRowBottomBorderFullWidth,
				}) =>
					headerRowBottomBorderFullWidth === 'yes'
						? transparentHeaderRowBottomBorder
						: {
							desktop: { style: 'none' },
							tablet: { style: 'none' },
							mobile: { style: 'none' },
						},
			},

			{
				selector: assembleSelector(
					mutateSelector({
						selector: mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'suffix',
							to_add: '> div',
						}),
						operation: 'el-prefix',
						to_add: '[data-transparent-row="yes"]',
					})
				),

				variable: 'borderBottom',
				type: 'border',
				responsive: true,
				fullValue: true,

				extractValue: ({
					transparentHeaderRowBottomBorder,
					headerRowBottomBorderFullWidth,
				}) =>
					headerRowBottomBorderFullWidth !== 'yes'
						? transparentHeaderRowBottomBorder
						: {
							desktop: { style: 'none' },
							tablet: { style: 'none' },
							mobile: { style: 'none' },
						},
			},

			{
				selector: assembleSelector(
					mutateSelector({
						selector: getRootSelectorFor({ itemId }),
						to_add: '[data-sticky*="yes"]',
					})
				),

				variable: 'borderBottom',
				type: 'border',
				responsive: true,

				fullValue: true,

				extractValue: ({
					stickyHeaderRowBottomBorder,
					headerRowBottomBorderFullWidth,
				}) =>
					headerRowBottomBorderFullWidth === 'yes'
						? stickyHeaderRowBottomBorder
						: {
							desktop: { style: 'none' },
							tablet: { style: 'none' },
							mobile: { style: 'none' },
						},
			},

			{
				selector: assembleSelector(
					mutateSelector({
						selector: mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: 'suffix',
							to_add: '> div',
						}),
						to_add: '[data-sticky*="yes"]',
					})
				),

				variable: 'borderBottom',
				type: 'border',
				responsive: true,
				fullValue: true,

				extractValue: ({
					stickyHeaderRowBottomBorder,
					headerRowBottomBorderFullWidth,
				}) =>
					headerRowBottomBorderFullWidth !== 'yes'
						? stickyHeaderRowBottomBorder
						: {
							desktop: { style: 'none' },
							tablet: { style: 'none' },
							mobile: { style: 'none' },
						},
			},
		]
	),

	// Transparent
	...handleBackgroundOptionFor({
		id: 'transparentHeaderRowBackground',

		selector: assembleSelector(
			mutateSelector({
				selector: getRootSelectorFor({ itemId }),
				operation: 'el-prefix',
				to_add: '[data-transparent-row="yes"]',
			})
		),

		responsive: true,
	}),

	transparentHeaderRowShadow: {
		selector: assembleSelector(
			mutateSelector({
				selector: getRootSelectorFor({ itemId }),
				operation: 'el-prefix',
				to_add: '[data-transparent-row="yes"]',
			})
		),

		type: 'box-shadow',
		variable: 'box-shadow',
		forceOutput: true,
		responsive: true,
	},

	// Sticky
	...handleBackgroundOptionFor({
		id: 'stickyHeaderRowBackground',

		selector: assembleSelector(
			mutateSelector({
				selector: getRootSelectorFor({ itemId }),
				to_add: '[data-sticky*="yes"]',
			})
		),

		responsive: true,
	}),

	stickyHeaderRowShadow: {
		selector: assembleSelector(
			mutateSelector({
				selector: getRootSelectorFor({ itemId }),
				to_add: '[data-sticky*="yes"]',
			})
		),

		type: 'box-shadow',
		variable: 'box-shadow',
		forceOutput: true,
		responsive: true,
	},
})

export const handleRowOptions = ({
	selector,
	changeDescriptor: { optionId, optionValue, values },
}) => {
	if (optionId === 'headerRowWidth') {
		updateAndSaveEl(selector, (el) => {
			el.firstElementChild.classList.remove(
				'customizer_builder__container',
				'rt-container-fluid'
			)

			el.firstElementChild.classList.add(
				optionValue !== 'fixed' ? 'rt-container-fluid' : 'customizer_builder__container'
			)
		})
	}
}

rtEvents.on(
	'rt:header:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['middle-row'] = handleRowVariables
	}
)

rtEvents.on('ct:header:sync:item:middle-row', (changeDescriptor) =>
	handleRowOptions({
		selector: '[data-row="middle"]',
		changeDescriptor,
	})
)
