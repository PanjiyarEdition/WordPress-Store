import rtEvents from 'rt-events'
import cookie from 'js-cookie'

const initCookies = () => {
	const notification = document.querySelector('.cookie-notification')

	if (!notification) return

	if (cookie.get('rc_cookies_consent_accepted')) {
		notification.remove()
		return
	}

	requestAnimationFrame(() => {
		notification.classList.remove('rt-fade-in-start')
		notification.classList.add('rt-fade-in-end')

		whenTransitionEnds(notification, () => {
			notification.classList.remove('rt-fade-in-end')
		})
	});
	[...notification.querySelectorAll('button')].map((el) => {
		el.addEventListener('click', (e) => {
			e.preventDefault()

			if (el.classList.contains('rt-accept')) {
				const periods = {
					onehour: 36e5,
					oneday: 864e5,
					oneweek: 7 * 864e5,
					onemonth: 31 * 864e5,
					threemonths: 3 * 31 * 864e5,
					sixmonths: 6 * 31 * 864e5,
					oneyear: 365 * 864e5,
					forever: 10000 * 864e5,
				}

				cookie.set('rc_cookies_consent_accepted', 'true', {
					expires: new Date(
						new Date() * 1 +
						periods[el.closest('[data-period]').dataset.period]
					),
					sameSite: 'lax',
				})
			}

			if (el.classList.contains('ct-decline-close')) {
				const periods = {
					onehour: 36e5,
					oneday: 864e5,
					oneweek: 7 * 864e5,
					onemonth: 31 * 864e5,
					threemonths: 3 * 31 * 864e5,
					sixmonths: 6 * 31 * 864e5,
					oneyear: 365 * 864e5,
					forever: 10000 * 864e5,
				}

				cookie.set('rc_cookies_consent_accepted', 'false', {
					expires: new Date(
						new Date() * 1 +
						periods[el.closest('[data-period]').dataset.period]
					),
					sameSite: 'lax',
				})
			}

			notification.classList.add('rt-fade-start')

			requestAnimationFrame(() => {
				notification.classList.remove('rt-fade-start')
				notification.classList.add('rt-fade-end')

				whenTransitionEnds(notification, () => {
					notification.parentNode.removeChild(notification)
				})
			})
		})
	})
}

function OndocumentLoaded() {
	initCookies();
	rtEvents.on('rishi:cookies:init', () => {
		initCookies()
	})
}

document.addEventListener('DOMContentLoaded', OndocumentLoaded(), false);

function whenTransitionEnds(el, cb) {
	setTimeout(() => {
		cb()
	}, 300)
	return

	const end = () => {
		el.removeEventListener('transitionend', onEnd)
		cb()
	}

	const onEnd = (e) => {
		if (e.target === el) {
			end()
		}
	}

	el.addEventListener('transitionend', onEnd)
}


//delay code start
let cookie_consent_wrap = document.querySelector(".cookie-notification") // section reference
let cc_close_btn = document.querySelector('.rt-close.close'); // cross button reference

//toggle active
const displayActive = () => {
	cookie_consent_wrap.classList.add('active');
}

//delay 
if (null !== cookie_consent_wrap) {
	const spTimeout = setTimeout(displayActive, rishi_companion_cookie_consent.delay * 1000)
	//section toggle
	cc_close_btn.addEventListener("click", () => {
		cookie_consent_wrap.classList.remove('active');
	});
}


//delay code end