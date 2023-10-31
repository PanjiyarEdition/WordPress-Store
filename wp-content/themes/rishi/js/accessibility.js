var rishi = rishi || {};

// event "polyfill"
rishi.createEvent = function (eventName) {
	var event;
	if (typeof window.Event === 'function') {
		event = new Event(eventName);
	} else {
		event = document.createEvent('Event');
		event.initEvent(eventName, true, false);
	}
	return event;
};
// outline for input, select, button, a tag
let rishi_body = document.querySelector('body');
var focusableElements = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
var modal = document.querySelectorAll(".search-toggle-form"); // select the modal by it's id

document.addEventListener('keydown', (e) => {
	if (e.keyCode == 9) {
		rishi_body.classList.add('keyboard-nav-on');
	}
})

document.addEventListener('mousemove', () => {
	rishi_body.classList.remove('keyboard-nav-on');

})

/*  -----------------------------------------------------------------------------------------------
    Cover Modals
--------------------------------------------------------------------------------------------------- */

rishi.coverModals = {

	init: function () {
		if (document.querySelector('.cover-modal')) {
			// Handle cover modals when they're toggled.
			this.onToggle();

			// Close on escape key press.
			this.closeOnEscape();

			// Hide and show modals before and after their animations have played out.
			// this.hideAndShowModals();

			this.keepFocusInModal();
		}
	},

	// Handle cover modals when they're toggled.
	onToggle: function () {
		document.querySelectorAll('.cover-modal').forEach(function (element) {
			element.addEventListener('toggled', function (event) {
				var modal = event.target,
					body = document.body;

				if (modal.classList.contains('active')) {
					body.classList.add('showing-modal');
				} else {
					body.classList.remove('showing-modal');
					body.classList.add('hiding-modal');

					// Remove the hiding class after a delay, when animations have been run.
					setTimeout(function () {
						body.classList.remove('hiding-modal');
					}, 500);
				}
			});
		});
	},

	// Close modal on escape key press.
	closeOnEscape: function () {
		document.addEventListener('keydown', function (event) {
			if (event.keyCode === 27) {
				event.preventDefault();
				document.querySelectorAll('.cover-modal.active').forEach(function (element) {
					this.untoggleModal(element);
				}.bind(this));
			}
		}.bind(this));
	},


	keepFocusInModal: function () {
		var _doc = document;

		_doc.addEventListener('keydown', function (event) {
			var toggleTarget, modal, selectors, elements, menuType, bottomMenu, activeEl, lastEl, firstEl, tabKey, shiftKey,
				clickedEl = rishi.toggles.clickedEl;

			if (clickedEl && _doc.body.classList.contains('showing-modal')) {
				toggleTarget = clickedEl.dataset.toggleTarget;
				selectors = 'input, a, button';
				modal = _doc.querySelector(toggleTarget);

				elements = modal.querySelectorAll(selectors);
				elements = Array.prototype.slice.call(elements);

				if ('.menu-modal' === toggleTarget) {
					menuType = window.matchMedia('(min-width: 9999px)').matches;
					menuType = menuType ? '.expanded-menu' : '.mobile-menu';

					elements = elements.filter(function (element) {
						return null !== element.closest(menuType) && null !== element.offsetParent;
					});

					elements.unshift(_doc.querySelector('.close-nav-toggle'));

					bottomMenu = _doc.querySelector('.menu-bottom > nav');

					if (bottomMenu) {
						bottomMenu.querySelectorAll(selectors).forEach(function (element) {
							elements.push(element);
						});
					}
				}

				if ('.main-menu-modal' === toggleTarget) {
					menuType = window.matchMedia('(min-width: 1025px)').matches;
					menuType = menuType ? '.expanded-menu' : '.mobile-menu';

					elements = elements.filter(function (element) {
						return null !== element.closest(menuType) && null !== element.offsetParent;
					});

					elements.unshift(_doc.querySelector('.close-main-nav-toggle'));

					bottomMenu = _doc.querySelector('.mobile-menus');

					if (bottomMenu) {
						bottomMenu.querySelectorAll(selectors).forEach(function (element) {
							elements.push(element);
						});
					}
				}

				lastEl = elements[elements.length - 1];
				firstEl = elements[0];
				activeEl = _doc.activeElement;
				tabKey = event.keyCode === 9;
				shiftKey = event.shiftKey;

				if (!shiftKey && tabKey && lastEl === activeEl) {
					event.preventDefault();
					firstEl.focus();
				}

				if (shiftKey && tabKey && firstEl === activeEl) {
					event.preventDefault();
					lastEl.focus();
				}
			}
		});
	}

}; // rishi.coverModals

rishi.modalMenu = {

	init: function () {
		// If the current menu item is in a sub level, expand all the levels higher up on load.
		this.expandLevel();
	},

	expandLevel: function () {
		var modalMenus = document.querySelectorAll('.modal-menu');

		modalMenus.forEach(function (modalMenu) {
			var activeMenuItem = modalMenu.querySelector('.current-menu-item');

			if (activeMenuItem) {
				rishiFindParents(activeMenuItem, 'li').forEach(function (element) {
					var subMenuToggle = element.querySelector('.submenu-toggle');
					if (subMenuToggle) {
						rishi.toggles.performToggle(subMenuToggle, true);
					}
				});
			}
		});
	},
}; // rishi.modalMenu

rishi.toggles = {

	clickedEl: false,

	init: function () {
		// Do the toggle.
		this.toggle();
	},

	performToggle: function (element, instantly) {
		var target, timeOutTime, classToToggle,
			self = this,
			_doc = document,
			// Get our targets.
			toggle = element,
			targetString = toggle.dataset.toggleTarget,
			activeClass = 'active';

		// Elements to focus after modals are closed.
		if (!_doc.querySelectorAll('.show-modal').length) {
			self.clickedEl = _doc.activeElement;
		}

		if (targetString === 'next') {
			target = toggle.nextSibling;
		} else {
			target = _doc.querySelector(targetString);
		}

		// Trigger events on the toggle targets before they are toggled.
		if (target.classList.contains(activeClass)) {
			target.dispatchEvent(rishi.createEvent('toggle-target-before-active'));
		} else {
			target.dispatchEvent(rishi.createEvent('toggle-target-before-inactive'));
		}

		// Get the class to toggle, if specified.
		classToToggle = toggle.dataset.classToToggle ? toggle.dataset.classToToggle : activeClass;

		// For cover modals, set a short timeout duration so the class animations have time to play out.
		timeOutTime = 0;

		if (target.classList.contains('cover-modal')) {
			timeOutTime = 10;
		}

		setTimeout(function () {
			var focusElement,
				subMenued = target.classList.contains('sub-menu'),
				newTarget = subMenued ? toggle.closest('.menu-item').querySelector('.sub-menu') : target,
				duration = toggle.dataset.toggleDuration;

			// Toggle the target of the clicked toggle.
			if (toggle.dataset.toggleType === 'slidetoggle' && !instantly && duration !== '0') {
				rishiMenuToggle(newTarget, duration);
			} else {
				newTarget.classList.toggle(classToToggle);
			}

			// If the toggle target is 'next', only give the clicked toggle the active class.
			if (targetString === 'next') {
				toggle.classList.toggle(activeClass);
			} else if (target.classList.contains('sub-menu')) {
				toggle.classList.toggle(activeClass);
			} else {
				// If not, toggle all toggles with this toggle target.
				_doc.querySelector('*[data-toggle-target="' + targetString + '"]').classList.toggle(activeClass);
			}

			// Toggle aria-expanded on the toggle.
			rishiToggleAttribute(toggle, 'aria-expanded', 'true', 'false');

			if (self.clickedEl && -1 !== toggle.getAttribute('class').indexOf('close-')) {
				rishiToggleAttribute(self.clickedEl, 'aria-expanded', 'true', 'false');
			}

			// Toggle body class.
			if (toggle.dataset.toggleBodyClass) {
				_doc.body.classList.toggle(toggle.dataset.toggleBodyClass);
			}

			// Check whether to set focus.
			if (toggle.dataset.setFocus) {
				focusElement = _doc.querySelector(toggle.dataset.setFocus);

				if (focusElement) {
					if (target.classList.contains(activeClass)) {
						focusElement.focus();
					} else {
						focusElement.blur();
					}
				}
			}

			// Trigger the toggled event on the toggle target.
			target.dispatchEvent(rishi.createEvent('toggled'));

			// Trigger events on the toggle targets after they are toggled.
			if (target.classList.contains(activeClass)) {
				target.dispatchEvent(rishi.createEvent('toggle-target-after-active'));
			} else {
				target.dispatchEvent(rishi.createEvent('toggle-target-after-inactive'));
			}
		}, timeOutTime);
	},

	// Do the toggle.
	toggle: function () {
		var self = this;

		document.querySelectorAll('*[data-toggle-target]').forEach(function (element) {
			element.addEventListener('click', function (event) {
				event.preventDefault();
				self.performToggle(element);
			});
		});
	},

}; // rishi.toggles

/**
 * Is the DOM ready?
 *
 * This implementation is coming from https://gomakethings.com/a-native-javascript-equivalent-of-jquerys-ready-method/
 *
 * @param {Function} fn Callback function to run.
 */
function rishiDomReady(fn) {
	if (typeof fn !== 'function') {
		return;
	}

	if (document.readyState === 'interactive' || document.readyState === 'complete') {
		return fn();
	}

	document.addEventListener('DOMContentLoaded', fn, false);
}

rishiDomReady(function () {
	rishi.toggles.init(); // Handle toggles.
	rishi.coverModals.init(); // Handle cover modals.
});

/* Toggle an attribute ----------------------- */

function rishiToggleAttribute(element, attribute, trueVal, falseVal) {
	if (trueVal === undefined) {
		trueVal = true;
	}
	if (falseVal === undefined) {
		falseVal = false;
	}
	if (element.getAttribute(attribute) !== trueVal) {
		element.setAttribute(attribute, trueVal);
	} else {
		element.setAttribute(attribute, falseVal);
	}
}

/**
 * Traverses the DOM up to find elements matching the query.
 *
 * @param {HTMLElement} target
 * @param {string} query
 * @return {NodeList} parents matching query
 */
function rishiFindParents(target, query) {
	var parents = [];

	// Recursively go up the DOM adding matches to the parents array.
	function traverse(item) {
		var parent = item.parentNode;
		if (parent instanceof HTMLElement) {
			if (parent.matches(query)) {
				parents.push(parent);
			}
			traverse(parent);
		}
	}

	traverse(target);

	return parents;
}




// search accessibility

modal.forEach(element => {
    var firstFocusableElement = element.querySelectorAll(focusableElements)[0]; // get first element to be focused inside modal
    var focusableContent = element.querySelectorAll(focusableElements);
    var lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal
    document.addEventListener('keydown', function (e) {
        var isTabPressed = e.key === 'Tab' || e.keyCode === 9;

        if (!isTabPressed) {
            return;
        }

        if (e.shiftKey) {
            // if shift key pressed for shift + tab combination
            if (document.activeElement === firstFocusableElement) {
                lastFocusableElement.focus(); // add focus for the last focusable element
                e.preventDefault();
            }
        } else {
            // if tab key is pressed
            if (document.activeElement === lastFocusableElement) {
                // if focused has reached to last focusable element then focus first focusable element after pressing tab
                firstFocusableElement.focus(); // add focus for the first focusable element
                e.preventDefault();
            }
        }
    });

    firstFocusableElement.focus();

});

