import rtEvents from '../../../src/js/events';
import { updateAndSaveEl } from '../../../src/js/frontend/header/render-loop';


const getVariables = ({ itemId, panelType }) => ({
	header_bookmark_size: {
		selector: '.rt__bookmark a',
		variable: 'bookmark-icon-size',
		responsive: true,
		unit: 'px',
	},

    headerBookmarkColor: [
		{
			selector: '.rt__bookmark a',
			variable: 'bookmarkInitialColor',
			type: 'color:default',
			responsive: true,
		},

		{
            selector: '.rt__bookmark a',
			variable: 'bookmarkHoverColor',
			type: 'color:hover',
			responsive: true,
		},
	],

    headerBookmarkCountColor: [
		{
			selector: '.rt__bookmark a',
			variable: 'bookmarkInitialCountColor',
			type: 'color:default',
			responsive: true,
		},

		{
            selector: '.rt__bookmark a',
			variable: 'bookmarkHoverCountColor',
			type: 'color:hover',
			responsive: true,
		},
    ],

    headerBookmarkCountBGColor: [
		{
			selector: '.rt__bookmark a',
			variable: 'bookmarkInitialCountBgColor',
			type: 'color:default',
			responsive: true,
		},

		{
            selector: '.rt__bookmark a',
			variable: 'bookmarkHoverCountBgColor',
			type: 'color:hover',
			responsive: true,
		},
    ],
})

rtEvents.on(
	'rt:header:sync:collect-variable-descriptors',
	(variableDescriptors) => {
		variableDescriptors['bookmark'] = ({ itemId, fullItemId }) =>
			getVariables({ itemId, fullItemId, panelType: 'header' })
	}
)

rtEvents.on(
	'ct:header:sync:item:bookmark',
	({ itemId, optionId, optionValue }) => {
		const selector = `[data-id="${itemId}"]`
        if (optionId === 'header_bookmark_type') {
			updateAndSaveEl(selector, (el) => {
				const bookmark = el.querySelector('[class*="read-it-later added"]')
                if( optionValue === 'bookmark-two' ){
                    bookmark.classList.add( 'bookmark-two' )
                    bookmark.classList.remove( 'bookmark-one' )
                    bookmark.classList.remove( 'bookmark-three' )
                }else if( optionValue === 'bookmark-three' ){
                    bookmark.classList.add( 'bookmark-three' )
                    bookmark.classList.remove( 'bookmark-two' )
                    bookmark.classList.remove( 'bookmark-one' )
                }else if( optionValue === 'bookmark-one' ){
                    bookmark.classList.add( 'bookmark-one' ) 
                    bookmark.classList.remove( 'bookmark-three' ) 
                    bookmark.classList.remove( 'bookmark-two' ) 
                }
			})
		}

        if (optionId === 'header_bookmark_text') {
			updateAndSaveEl(selector, (el) => {
				el.querySelector('[class*="read-it-later-hover-text"]').innerHTML = optionValue
			})
		}

        if (optionId === 'bookmark_visibility') {
			updateAndSaveEl(selector, (el) => {
				responsiveClassesFor(
					{ ...optionValue },
					el.querySelector('.rt__bookmark')
				)
			})
		}
	}
)