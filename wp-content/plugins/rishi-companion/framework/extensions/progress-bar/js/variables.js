import { handleVariablesFor } from 'customizer-sync-helpers'

handleVariablesFor({

	progressBarColor: [
		{
			selector: '#rt-progress-bar',
			variable: 'colorDefault',
			type: 'color:default'
		},

		{
			selector: '#rt-progress-bar',
			variable: 'colorProgress',
			type: 'color:progress'
		}
	],

	progressThickness: {
		selector: '#rt-progress-bar',
		variable: 'Thickness',
		unit: 'px'
	}
})
