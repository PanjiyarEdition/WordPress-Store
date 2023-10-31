import {
	handleWidgetAreaVariables,
	handleWidgetAreaOptions
} from '../widget-area-1/sync'
import rtEvents from '../../../src/js/events';

rtEvents.on(
	'rt:footer:sync:collect-variable-descriptors',
	variableDescriptors => {
		variableDescriptors['footer-four'] = handleWidgetAreaVariables({
			selector: '[data-column="footer-four"]'
		})
	}
)

rtEvents.on('ct:footer:sync:item:footer-four', changeDescriptor =>
	handleWidgetAreaOptions({
		selector: '[data-column="footer-four"]',
		changeDescriptor
	})
)
