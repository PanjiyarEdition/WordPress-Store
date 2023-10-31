import {
	handleWidgetAreaVariables,
	handleWidgetAreaOptions
} from '../widget-area-1/sync'
import rtEvents from '../../../src/js/events';

rtEvents.on(
	'rt:footer:sync:collect-variable-descriptors',
	variableDescriptors => {
		variableDescriptors['footer-six'] = handleWidgetAreaVariables({
			selector: '[data-column="footer-six"]'
		})
	}
)

rtEvents.on('ct:footer:sync:item:footer-six', changeDescriptor =>
	handleWidgetAreaOptions({
		selector: '[data-column="footer-six"]',
		changeDescriptor
	})
)
