import { handleMenuVariables, handleMenuOptions } from '../menu/sync'
import rtEvents from '../../../src/js/events';

rtEvents.on(
	'rt:header:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['menu-secondary'] = handleMenuVariables
		variableDescriptors['menu-tertiary'] = handleMenuVariables
	}
)

rtEvents.on('ct:header:sync:item:menu-secondary', (changeDescriptor) => {
	handleMenuOptions({
		selector: '.header-menu-2',
		changeDescriptor,
	})
})

rtEvents.on('ct:header:sync:item:menu-tertiary', (changeDescriptor) => {
	handleMenuOptions({
		selector: '.header-menu-3',
		changeDescriptor,
	})
})
