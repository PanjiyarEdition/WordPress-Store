import { handleRowVariables, handleRowOptions } from '../middle-row/sync'
import rtEvents from '../../../src/js/events';

rtEvents.on(
	'rt:header:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['bottom-row'] = handleRowVariables
	}
)

rtEvents.on('ct:header:sync:item:bottom-row', (changeDescriptor) =>
	handleRowOptions({ selector: '[data-row="bottom"]', changeDescriptor })
)
