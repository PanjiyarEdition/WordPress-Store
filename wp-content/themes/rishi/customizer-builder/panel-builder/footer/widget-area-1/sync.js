import rtEvents from '../../../src/js/events';

export const handleWidgetAreaVariables = ({ selector }) => ({
	// css here
})

export const handleWidgetAreaOptions = ({
	selector,
	changeDescriptor: { optionId, optionValue, values }
}) => { }

rtEvents.on(
	'rt:footer:sync:collect-variable-descriptors',
	variableDescriptors => {
		variableDescriptors['footer-one'] = handleWidgetAreaVariables({
			selector: '[data-column="footer-one"]'
		})
	}
)

rtEvents.on('ct:footer:sync:item:footer-one', changeDescriptor =>
	handleWidgetAreaOptions({
		selector: '[data-column="footer-one"]',
		changeDescriptor
	})
)
