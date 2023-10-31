import {
	handleWidgetAreaVariables,
	handleWidgetAreaOptions
} from '../widget-area-1/sync'
import rtEvents from '../../../src/js/events';

rtEvents.on(
	'rt:footer:sync:collect-variable-descriptors',
	variableDescriptors => {
		variableDescriptors['footer-two'] = handleWidgetAreaVariables({
			selector: '[data-column="footer-two"]'
		})
	}
)

rtEvents.on('ct:footer:sync:item:footer-two', changeDescriptor =>
	handleWidgetAreaOptions({
		selector: '[data-column="footer-two"]',
		changeDescriptor
	})
)
