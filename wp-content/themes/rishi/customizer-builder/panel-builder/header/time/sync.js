import { typographyOption } from "../../../src/js/customizer/sync/variables/typography"
import rtEvents from '../../../src/js/events';
import {
	responsiveClassesFor,
	getRootSelectorFor,
	assembleSelector,
	mutateSelector,
} from '../../../src/js/customizer/sync/helpers'

const getVariables = ({ itemId, panelType }) => {
	return {
		...typographyOption({
			id: 'headerTimeFont',
			selector: '.time-wrapper',
		}),

		header_time_icon_size: {
			selector: '.time-wrapper',
			variable: 'icon-size',
			responsive: true,
			unit: 'px',
		},

		// default state
		// Text Color
		headerTimeColor: [
			{
				selector: assembleSelector(
					mutateSelector({
						selector: mutateSelector({
							selector: getRootSelectorFor({ itemId, panelType }),
							operation: 'suffix',
							to_add: '.time-wrapper',
						}),
					}),
				),
				variable: 'headerTimeInitialColor',
				type: 'color:default'
			},

		],

		// Icon Color
		headerTimeIconColor: [
			{
				selector: assembleSelector(
					mutateSelector({
						selector: mutateSelector({
							selector: getRootSelectorFor({ itemId, panelType }),
							operation: 'suffix',
							to_add: '.time-wrapper',
						}),
					}),
				),
				variable: 'headerTimeInitialIconColor',
				type: 'color:default'
			},

		],

		// Transparent state
		// Text Color
		transparentHeaderTimeColor: [
			{
				selector: assembleSelector(
					mutateSelector({
						selector: mutateSelector({
							selector: getRootSelectorFor({ itemId, panelType }),
							operation: 'suffix',
							to_add: '.time-wrapper',
						}),
						operation: 'between',
						to_add: '[data-transparent-row="yes"]',
					}),
				),

				variable: 'headerTimeInitialColor',
				type: 'color:default',
			},
		],

		// Icon Color
		transparentHeaderTimeIconColor: [
			{
				selector: assembleSelector(
					mutateSelector({
						selector: mutateSelector({
							selector: getRootSelectorFor({ itemId, panelType }),
							operation: 'suffix',
							to_add: '.time-wrapper',
						}),
						operation: 'between',
						to_add: '[data-transparent-row="yes"]',
					}),
				),

				variable: 'headerTimeInitialIconColor',
				type: 'color:default',
			},
		],

		// Sticky state
		// Text Color
		stickyHeaderTimeColor: [
			{
				selector: assembleSelector(
					mutateSelector({
						selector: mutateSelector({
							selector: getRootSelectorFor({ itemId, panelType }),
							operation: 'suffix',
							to_add: '.time-wrapper',
						}),
						operation: 'between',
						to_add: '[data-sticky*="yes"]',
					})
				),
				variable: 'headerTimeInitialColor',
				type: 'color:default'
			},
		],

		// Icon Color
		stickyHeaderTimeIconColor: [
			{
				selector: assembleSelector(
					mutateSelector({
						selector: mutateSelector({
							selector: getRootSelectorFor({ itemId, panelType }),
							operation: 'suffix',
							to_add: '.time-wrapper',
						}),
						operation: 'between',
						to_add: '[data-sticky*="yes"]',
					})
				),
				variable: 'headerTimeInitialIconColor',
				type: 'color:default'
			},
		],

	}
}

rtEvents.on(
	'rt:header:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['time'] = ({ itemId, fullItemId }) =>
			getVariables({ itemId, fullItemId, panelType: 'header' })
	}
)

const TimeFormat = {
	set: function (_date) {
		this.time = new Date(_date)
	},
	// 12-hour format of an hour without leading zeros
	'g': function () {
		return this.time.getHours() % 12 || 12
	},
	// 24-hour format of an hour without leading zeros
	'G': function () {
		return this.time.getHours()
	},
	// 12-hour format of an hour with leading zeros
	'h': function () {
		return this.time.getHours() % 12 || 12
	},
	// 24-hour format of an hour with leading zeros
	'H': function () {
		return this.time.getHours()
	},
	// Minutes with leading zeros
	'i': function () {
		return this.setTwoDigits(this.time.getMinutes())
	},
	// 	Seconds with leading zeros
	's': function () {
		return this.setTwoDigits(this.time.getSeconds())
	},
	// am or pm for the time
	'a': function () {
		return this.formatAMPM(this.time.getHours(), 'a')
	},
	// am or pm for the time
	'A': function () {
		return this.formatAMPM(this.time.getHours(), 'A')
	},

	get: function (format) {
		let _this = this
		if (format) {
			let _format = format.split('')
			return _format.map(c => {
				if (_this[c]) {
					return _this[c]()
				}
				return c
			}).join('')
		}
	},

	formatAMPM: function (hours, uppercase) {
		if (uppercase === 'A') {
			var a = (hours >= 12) ? 'PM' : 'AM';
		} else {
			var a = (hours >= 12) ? 'pm' : 'am';
		}
		return a;
	},

	setTwoDigits: function (clock) {
		var b = clock <= 9 ? '0' + clock : clock;
		return b;
	}
}

rtEvents.on('ct:header:sync:item:time', ({ itemId, optionId, optionValue }) => {
	const selector = `[data-id="${itemId}"]`
	const el = document.querySelector(selector)
	if (optionId === "header_time_format_type") {
		TimeFormat.set(new Date())
		let $format = 'H:i';
		if (optionValue == 'format_1') {
			$format = 'g:i a';
		} if (optionValue == 'format_2') {
			$format = 'g:i A';
		} if (optionValue == 'format_3') {
			$format = 'H:i';
		} if (optionValue == 'format_4') {
			$format = 'H:i:s';
		}
		var finalDate = TimeFormat.get($format);

		el.querySelector('.rt-time').innerHTML = finalDate
	}

	if (optionId === 'header_time_format_custom') {
		TimeFormat.set(new Date())
		let $format = optionValue;
		var finalDate = TimeFormat.get($format);

		el.querySelector('.rt-time').innerHTML = finalDate
	}
	if (optionId === "header_time_ed_icon") {
		if ('no' === optionValue) {
			el.querySelector('.time-wrapper svg').setAttribute('data-type', 'none')
		} else {
			el.querySelector('.time-wrapper svg').setAttribute('data-type', 'block')
		}
	}
})
