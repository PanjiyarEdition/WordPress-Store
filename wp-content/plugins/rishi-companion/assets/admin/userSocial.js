import AdditionalUserSetting from './userSocials/Main'
import { render } from '@wordpress/element'

const onDocumentLoaded = (cb) => {
	if (/comp|inter|loaded/.test(document.readyState)) {
		cb()
	} else {
		document.addEventListener('DOMContentLoaded', cb, false)
	}
}

onDocumentLoaded(() => {

	const a = document.createElement('a')
	document.body.appendChild(a)
	render(<AdditionalUserSetting />, a)
})
