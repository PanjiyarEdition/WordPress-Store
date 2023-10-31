import rtEvents from 'rt-events';
import $ from "jquery";
import lazyload from "vanilla-lazyload";
// import { onDocumentLoaded } from "../helpers";
let lz = null;

const maybeInit = () => {
  if (lz) {
    lz.update();
    return;
  }

  const lazyLoadCallback = () => {
    lz = new lazyload({
      data_src: "rt-lazy",
      data_srcset: "rt-lazy-set",

      elements_selector: "img[data-rt-lazy]",

      callback_load(img) {
        let container = img.closest('[class*="rt-image-container"]');

        let action = () => {
          if (!container) return;

          container.classList.remove("rt-lazy");
          container.classList.add("rt-lazy-loading-start");

          requestAnimationFrame(() => {
            container.classList.remove("rt-lazy-loading-start");
            container.classList.add("rt-lazy-loading");

            whenTransitionEnds(container.firstElementChild, () => {
              container.classList.remove("rt-lazy-loading");
              container.classList.add("rt-lazy-loaded");
            });
          });
        };

        if (navigator.userAgent.toLowerCase().indexOf("firefox") > -1) {
          setTimeout(action, 500);
        } else {
          action();
        }
      },
    });
  };
  lazyLoadCallback();
};

function onDocumentLoaded() {
  if ($) {
    $(window).on("elementor/frontend/init", () => {
      elementorFrontend.hooks.addAction("frontend/element_ready/global", () =>
        rtEvents.trigger("rt:images:lazyload:update")
      );
    });

    $(document.body).on("ubermenuopen", function () {
      rtEvents.trigger("rt:images:lazyload:update");
    });

    $(window).on("wcpf_update_products", function () {
      rtEvents.trigger("rt:images:lazyload:update");
    });

    $(document).on("wpf_ajax_success", () =>
      rtEvents.trigger("rt:images:lazyload:update")
    );

    $(document).on("blog_infiniteScroll_ajax", () =>
      rtEvents.trigger("rt:images:lazyload:update")
    );
  }

  document.addEventListener("rt:masonry_loaded", () => {
    maybeInit();
  });

  if (document.querySelector("img[data-rt-lazy]")) {
    maybeInit();
  }

  rtEvents.on("rt:images:lazyload:update", () => {
    $ && $("body").trigger("jetpack-lazy-images-load");

    if (window.jetpackLazyImagesModule) {
      window.jetpackLazyImagesModule();
    }

    let jetpackEvent = new Event("jetpack-lazy-images-load");
    document.body.dispatchEvent(jetpackEvent);
    maybeInit();
  });
}
document.addEventListener('DOMContentLoaded', onDocumentLoaded(), false);

function whenTransitionEnds(el, cb) {
  const end = () => {
    el.removeEventListener("transitionend", onEnd);
    cb();
  };

  const onEnd = (e) => {
    if (e.target === el) {
      end();
    }
  };

  el.addEventListener("transitionend", onEnd);
}
