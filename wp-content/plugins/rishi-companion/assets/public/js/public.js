import './lazyload'
import './public-path';

const initOverlayTrigger = () => {
    [
        ...document.querySelectorAll(".cb__header-trigger"),
        ...document.querySelectorAll(".cb__offcanvas-trigger"),
    ].map((menuToggle) => {
        let offcanvas = document.querySelector(menuToggle.hash);

        if (offcanvas) {
            if (!offcanvas.hasListener) {
                offcanvas.hasListener = true;

                offcanvas.addEventListener("click", (event) => {
                    if (event.target && event.target.matches("a")) {
                        const menuToggle = document.querySelector(".cb__header-trigger");

                        if (event.target.closest(".woocommerce-mini-cart")) {
                            return;
                        }

                        menuToggle && menuToggle.click();
                    }
                });
            }
        }

        if (menuToggle && !menuToggle.hasListener) {
            menuToggle.hasListener = true;

            menuToggle.addEventListener("click", (event) => {
                event.preventDefault();

                import("./frontend/overlay").then(({
                    handleClick
                }) =>
                    handleClick(event, {
                        container: offcanvas,
                    })
                );
            });
        }
    });
};

const initHeaderSearchTriggers = () => {
    var headerSearchbtns = document.querySelectorAll('.header-search-btn'),
        elem = document.querySelector('.search-toggle-form'),
        headerCloseBtnSS = document.querySelectorAll('.btn-form-close'),
        searchField = document.querySelector('.search-form-section .search-field'),
        searchSubmit = document.querySelector('.search-form-section .search-submit'),
        fadeInInterval,
        fadeOutInterval;

    //fadeInFunction
    function fadeIn(element) {
        searchField.focus();
        clearInterval(fadeInInterval);
        clearInterval(fadeOutInterval);

        element.fadeIn = function (timing) {
            var newValue = 0;

            element.style.display = 'block';
            element.style.opacity = 0;

            fadeInInterval = setInterval(function () {

                if (newValue < 1) {
                    newValue += 0.1;
                } else if (newValue === 1) {
                    clearInterval(fadeInInterval);
                }

                element.style.opacity = newValue;

            }, timing);

        }

        element.fadeIn(2);
    }

    //functionfadeOut
    function fadeOut(element) {
        clearInterval(fadeInInterval);
        clearInterval(fadeOutInterval);

        element.fadeOut = function (timing) {
            var newValue = 1;
            element.style.opacity = 1;

            fadeOutInterval = setInterval(function () {

                if (newValue > 0) {
                    newValue -= 0.1;
                } else if (newValue < 0) {
                    element.style.opacity = 0;
                    element.style.display = 'none';
                    clearInterval(fadeOutInterval);
                }

                element.style.opacity = newValue;

            }, timing);

        }

        element.fadeOut(2);
    }

    if (headerSearchbtns !== null) {
        headerSearchbtns.forEach(function (headerSearchbtn) {
            var modalKey = headerSearchbtn.dataset.modalKey;
            var element = document.querySelector(`.search-toggle-form[data-modal-key="${modalKey}"]`);
            var headerCloseBtn = document.querySelector(`.search-toggle-form[data-modal-key="${modalKey}"] .btn-form-close`);
            var SearchFormFld = document.querySelector(`.search-toggle-form[data-modal-key="${modalKey}"] .search-field`);
            var SearchFormScn = document.querySelector(`.search-toggle-form[data-modal-key="${modalKey}"] .search-submit`);
            headerSearchbtn.addEventListener('click', function (event) {
                event.preventDefault();
                this.classList.add('active');
                fadeIn(element);
                searchField.focus();
            });

            headerCloseBtn.addEventListener('click', function (event) {
                // event.preventDefault();
                fadeOut(element);
                searchField.blur();
                headerSearchbtn.classList.remove('active');
            });

            if (element !== null) {
                element.addEventListener('click', function (event) {
                    fadeOut(element);
                })
            }

            document.addEventListener('keyup', function (e) {
                if (e.key == "Escape") {
                    fadeOut(element);
                }
            });

            if (SearchFormFld !== null) {
                SearchFormFld.addEventListener('click', function (e) {
                    e.stopPropagation();
                })
            }

            if (SearchFormScn !== null) {
                SearchFormScn.addEventListener('click', function (e) {
                    e.stopPropagation();
                })
            }
        });
    }
};

const CmpWhenDocumentLoaded = (cb) => {
    if (/comp|inter|loaded/.test(document.readyState)) {
        cb();
    } else {
        document.addEventListener("DOMContentLoaded", cb, false);
    }
};

CmpWhenDocumentLoaded(() => {
    initOverlayTrigger();
    initHeaderSearchTriggers();
});