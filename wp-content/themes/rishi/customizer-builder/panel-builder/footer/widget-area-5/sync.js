import {
	handleWidgetAreaVariables,
	handleWidgetAreaOptions
} from '../widget-area-1/sync'
import rtEvents from '../../../src/js/events';

rtEvents.on(
	'rt:footer:sync:collect-variable-descriptors',
	variableDescriptors => {
		variableDescriptors['footer-five'] = handleWidgetAreaVariables({
			selector: '[data-column="footer-five"]'
		})
	}
)

rtEvents.on('ct:footer:sync:item:footer-five', changeDescriptor =>
	handleWidgetAreaOptions({
		selector: '[data-column="footer-five"]',
		changeDescriptor
	})
)
