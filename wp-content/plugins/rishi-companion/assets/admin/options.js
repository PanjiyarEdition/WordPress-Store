import { Fill } from '@wordpress/components'
import { Fragment } from '@wordpress/element'
import rtEvents from 'rt-events'
import PanelsManager from './header/PanelsManager'
import CustomizerResetOptions from './options/CustomizerResetOptions'
import DisplayCondition from './options/DisplayCondition'
import SimpleButton from './options/SimpleButton'


rtEvents.on('rishi:options:before-option', (args) => {
	if (!args.option) {
		return
	}

	if (args.option.type === 'rt-header-builder') {
		let prevHeaderBuilder = args.content

		args.content = (
			<Fragment>
				{prevHeaderBuilder}

				<Fill name="PlacementsBuilderPanelsManager">
					<PanelsManager />
				</Fill>
			</Fragment>
		)
	}
})

rtEvents.on('rishi:options:register', (opts) => {
	opts['rishi-display-condition'] = DisplayCondition
	opts['rt-customizer-reset-options'] = CustomizerResetOptions
	opts['rt-simple-button'] = SimpleButton
})
