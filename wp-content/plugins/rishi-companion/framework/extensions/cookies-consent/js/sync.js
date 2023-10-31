import './variables'
import rtEvents from 'rt-events'

import { renderWithStrategy } from './sync/helpers'

const maybeAnimateCookiesConsent = cb => {
	if (document.querySelector('.cookie-notification')) return

	renderWithStrategy({
		fragment_id: 'rc-cookies-consent-section',
		selector: '.cookie-notification',
		parent_selector: '#main-container'
	})

	return true
}

const render = () => {
	const didInsert = maybeAnimateCookiesConsent()

	const notification = document.querySelector('.cookie-notification')

	if (!notification) {
		return
	}

	if (notification.querySelector('.rc-cookies-content')) {
		notification.querySelector(
			'.rc-cookies-content'
		).innerHTML = wp.customize('cookie_consent_content')()
	}

	notification.querySelector('button.rt-accept').innerHTML = wp.customize(
		'cookie_consent_button_text'
	)()

	notification.querySelector('button.rt-close').innerHTML = wp.customize(
		'cookie_consent_button_two_text'
	)()

	const type = wp.customize('cookie_consent_type')()

	const position_one = wp.customize('cookie_consent_type_one')()
	const position_two = wp.customize('cookie_consent_type_two')()


	notification.dataset.innertype = 'type-1' === type ? position_one : position_two;

	notification.dataset.type = type

	notification.firstElementChild.classList.remove('rt-container', 'container')
	notification.firstElementChild.classList.add(
		type === 'type-1' ? 'container' : 'rt-container'
	)

	if (didInsert) {
		setTimeout(() => rtEvents.trigger('rishi:cookies:init'))
	}
}

wp.customize('cookie_consent_content', val =>
	val.bind(to => {
		render()
	})
)
wp.customize('cookie_consent_type', val => val.bind(to => render()))
wp.customize('cookie_consent_type_one', val => val.bind(to => render()))
wp.customize('cookie_consent_type_two', val => val.bind(to => render()))
