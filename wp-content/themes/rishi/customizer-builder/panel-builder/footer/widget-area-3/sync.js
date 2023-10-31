import {
	handleWidgetAreaVariables,
	handleWidgetAreaOptions
} from '../widget-area-1/sync'
import rtEvents from '../../../src/js/events';

rtEvents.on(
	'rt:footer:sync:collect-variable-descriptors',
	variableDescriptors => {
		variableDescriptors['footer-three'] = handleWidgetAreaVariables({
			selector: '[data-column="footer-three"]'
		})
	}
)

rtEvents.on('ct:footer:sync:item:footer-three', changeDescriptor =>
	handleWidgetAreaOptions({
		selector: '[data-column="footer-three"]',
		changeDescriptor
	})
)
