// import { handleBackgroundOptionFor } from '../../../../js/src/js/customizer/sync/variables/background'
import rtEvents from '../../src/js/events';
// import { updateAndSaveEl } from '../../../src/js/frontend/header/render-loop'

rtEvents.on(
	'rt:header:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		/*
		const handleBackgroundOptionForSpecific = id =>
			handleBackgroundOptionFor({
				id,
				selector: 'header',
				addToDescriptors: {
					fullValue: true
				},
				responsive: true,
				valueExtractor: ({
					is_absolute,
					headerBackground,
					absoluteHeaderBackground
				}) =>
					is_absolute === 'yes'
						? absoluteHeaderBackground
						: headerBackground
			})

		variableDescriptors['global'] = {
			...handleBackgroundOptionForSpecific('is_absolute'),
			...handleBackgroundOptionForSpecific('headerBackground'),
			...handleBackgroundOptionForSpecific('absoluteHeaderBackground')
		}
		*/
	}
)

rtEvents.on('ct:header:sync:item:global', ({ optionId, optionValue }) => { })