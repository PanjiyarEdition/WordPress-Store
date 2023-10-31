import { handleRowVariables, handleRowOptions } from '../middle-row/sync'
import rtEvents from '../../../src/js/events';

rtEvents.on(
	'rt:footer:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['bottom-row'] = handleRowVariables
	}
)

rtEvents.on('ct:footer:sync:item:bottom-row', (changeDescriptor) =>
	handleRowOptions({
		selector: '.cb__footer [data-row="bottom"]',
		changeDescriptor,
	})
)
