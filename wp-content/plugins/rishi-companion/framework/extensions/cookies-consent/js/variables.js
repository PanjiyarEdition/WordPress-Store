import { handleVariablesFor } from 'customizer-sync-helpers';
import { typographyOption } from 'rishi-customizer-sync';

handleVariablesFor({
	
	...typographyOption({
		id: 'cookieContenttypo',
		selector: '.cookie-notification',
	}),
	cookieContentMaxWidth: {
        selector: '.cookie-notification',
        variable: 'cookieContentMaxWidth',
        responsive: true,
        unit: '',
    },
	cookieContentColor: [
		{
			selector: '.cookie-notification',
			variable: 'color',
			type: 'color:default'
		}
	],

	cookieIconColor: [
		{
			selector: '.cookie-notification',
			variable: 'iconColor',
			type: 'color:default'
		}
	],

	cookieBackground: {
		selector: '.cookie-notification',
		variable: 'backgroundColor',
		type: 'color'
	},

	cookieButtonBackground: [
		{
			selector: '.cookie-notification',
			variable: 'buttonInitialColor',
			type: 'color:default'
		},

		{
			selector: '.cookie-notification',
			variable: 'buttonHoverColor',
			type: 'color:hover'
		}
	],

	cookieButtonText: [
		{
			selector: '.cookie-notification',
			variable: 'buttonTextInitialColor',
			type: 'color:default'
		},

		{
			selector: '.cookie-notification',
			variable: 'buttonTextHoverColor',
			type: 'color:hover'
		}
	],

	cookieSecondaryButtonBackground: [
		{
			selector: '.cookie-notification',
			variable: 'buttonSecondaryInitialColor',
			type: 'color:default'
		},

		{
			selector: '.cookie-notification',
			variable: 'buttonSecondaryHoverColor',
			type: 'color:hover'
		}
	],

	cookieSecondaryButtonText: [
		{
			selector: '.cookie-notification',
			variable: 'buttonSecondaryTextInitialColor',
			type: 'color:default'
		},

		{
			selector: '.cookie-notification',
			variable: 'buttonSecondaryTextHoverColor',
			type: 'color:hover'
		}
	],

	cookieBorderColor: [
		{
			selector: '.cookie-notification',
			variable: 'borderColor',
			type: 'color:default'
		},
	],

	cookieMaxWidth: {
		selector: '.cookie-notification',
		variable: 'maxWidth',
		unit: 'px'
	},
	
	cookieTypeThreeMaxWidth: {
		selector: '.cookie-notification',
		variable: 'maxWidthTypeThree',
		responsive: true,
		unit: 'px'
	}
})
