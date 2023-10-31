import rtEvents from '../../../src/js/events';
import {
	getCache,
	handleResponsiveSwitch,
} from '../../../src/js/customizer/sync/helpers'
import { updateAndSaveEl } from '../../../src/js/frontend/header/render-loop'
import {
	responsiveClassesFor,
	getRootSelectorFor,
	assembleSelector,
	mutateSelector,
} from '../../../src/js/customizer/sync/helpers'

rtEvents.on(
	"rt:header:sync:collect-variable-descriptors",
	(variableDescriptors) => {
		variableDescriptors["socials"] = ({ itemId }) => ({
			socialsIconSize: {
				selector: assembleSelector(getRootSelectorFor({ itemId })),
				variable: "icon-size",
				responsive: true,
				unit: "px",
			},

			socialsIconSpacing: {
				selector: assembleSelector(getRootSelectorFor({ itemId })),
				variable: "spacing",
				responsive: true,
				unit: "px",
			},

			headerSocialsMargin: {
				selector: assembleSelector(getRootSelectorFor({ itemId })),
				type: "spacing",
				variable: "margin",
				responsive: true,
				important: true,
			},

			socialsLabelVisibility: handleResponsiveSwitch({
				selector: assembleSelector(
					mutateSelector({
						selector: getRootSelectorFor({ itemId }),
						operation: "suffix",
						to_add: ".cb__label",
					})
				),
			}),

			// default state
			headerSocialsIconColor: [
				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: "suffix",
							to_add: '[data-color="custom"]',
						})
					),
					variable: "icon-color",
					type: "color:default",
					responsive: true,
				},

				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: "suffix",
							to_add: '[data-color="custom"]',
						})
					),
					variable: "icon-hover-color",
					type: "color:hover",
					responsive: true,
				},
			],

			headerSocialsIconBackground: [
				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: "suffix",
							to_add: '[data-color="custom"]',
						})
					),
					variable: "background-color",
					type: "color:default",
					responsive: true,
				},

				{
					selector: assembleSelector(
						mutateSelector({
							selector: getRootSelectorFor({ itemId }),
							operation: "suffix",
							to_add: '[data-color="custom"]',
						})
					),
					variable: "background-hover-color",
					type: "color:hover",
					responsive: true,
				},
			],

			// transparent state
			transparentHeaderSocialsIconColor: [
				{
					selector: assembleSelector(
						mutateSelector({
							selector: mutateSelector({
								selector: getRootSelectorFor({ itemId }),
								operation: "suffix",
								to_add: '[data-color="custom"]',
							}),

							operation: "between",
							to_add: '[data-transparent-row="yes"]',
						})
					),

					variable: "icon-color",
					type: "color:default",
					responsive: true,
				},

				{
					selector: assembleSelector(
						mutateSelector({
							selector: mutateSelector({
								selector: getRootSelectorFor({ itemId }),
								operation: "suffix",
								to_add: '[data-color="custom"]',
							}),

							operation: "between",
							to_add: '[data-transparent-row="yes"]',
						})
					),

					variable: "icon-hover-color",
					type: "color:hover",
					responsive: true,
				},
			],

			transparentHeaderSocialsIconBackground: [
				{
					selector: assembleSelector(
						mutateSelector({
							selector: mutateSelector({
								selector: getRootSelectorFor({ itemId }),
								operation: "suffix",
								to_add: '[data-color="custom"]',
							}),

							operation: "between",
							to_add: '[data-transparent-row="yes"]',
						})
					),

					variable: "background-color",
					type: "color:default",
					responsive: true,
				},

				{
					selector: assembleSelector(
						mutateSelector({
							selector: mutateSelector({
								selector: getRootSelectorFor({ itemId }),
								operation: "suffix",
								to_add: '[data-color="custom"]',
							}),

							operation: "between",
							to_add: '[data-transparent-row="yes"]',
						})
					),

					variable: "background-hover-color",
					type: "color:hover",
					responsive: true,
				},
			],

			// sticky state
			stickyHeaderSocialsIconColor: [
				{
					selector: assembleSelector(
						mutateSelector({
							selector: mutateSelector({
								selector: getRootSelectorFor({ itemId }),
								operation: "suffix",
								to_add: '[data-color="custom"]',
							}),

							operation: "between",
							to_add: '[data-sticky*="yes"]',
						})
					),
					variable: "icon-color",
					type: "color:default",
					responsive: true,
				},

				{
					selector: assembleSelector(
						mutateSelector({
							selector: mutateSelector({
								selector: getRootSelectorFor({ itemId }),
								operation: "suffix",
								to_add: '[data-color="custom"]',
							}),

							operation: "between",
							to_add: '[data-sticky*="yes"]',
						})
					),
					variable: "icon-hover-color",
					type: "color:hover",
					responsive: true,
				},
			],

			stickyHeaderSocialsIconBackground: [
				{
					selector: assembleSelector(
						mutateSelector({
							selector: mutateSelector({
								selector: getRootSelectorFor({ itemId }),
								operation: "suffix",
								to_add: '[data-color="custom"]',
							}),

							operation: "between",
							to_add: '[data-sticky*="yes"]',
						})
					),
					variable: "background-color",
					type: "color:default",
					responsive: true,
				},

				{
					selector: assembleSelector(
						mutateSelector({
							selector: mutateSelector({
								selector: getRootSelectorFor({ itemId }),
								operation: "suffix",
								to_add: '[data-color="custom"]',
							}),

							operation: "between",
							to_add: '[data-sticky*="yes"]',
						})
					),
					variable: "background-hover-color",
					type: "color:hover",
					responsive: true,
				},
			],
		});
	}
);

rtEvents.on(
	"ct:header:sync:item:socials",
	({ itemId, optionId, optionValue, values }) => {
		const selector = `[data-id="${itemId}"]`;

		if (optionId === "socialsType" || optionId === "socialsFillType") {
			updateAndSaveEl(selector, (el) => {
				const box = el.querySelector(".cb__social-box");

				box.dataset.iconsType = `${values.socialsType}${values.socialsType === "simple"
					? ""
					: `:${values.socialsFillType || "solid"}`
					}`;
			});
		}

		if (optionId === "socialsIconSize") {
			updateAndSaveEl(
				selector,
				(el) =>
				(el.querySelector(".cb__social-box").dataset.size =
					values.socialsIconSize)
			);
		}

		if (optionId === "headerSocialsColor") {
			updateAndSaveEl(
				selector,
				(el) => (el.querySelector(".cb__social-box").dataset.color = optionValue)
			);
		}

		if (optionId === "header_socials") {
			updateAndSaveEl(selector, (el) => {
				const newHtml = getCache().querySelector(
					`.rara-customizer-preview-cache [data-id="socials-general-cache"]`
				).innerHTML;

				const cache = document.createElement("div");
				cache.innerHTML = newHtml;

				el.querySelector(".cb__social-box").innerHTML = "";

				optionValue.map(({ id, enabled }) => {
					if (!enabled) return;

					el.querySelector(".cb__social-box").appendChild(
						cache.querySelector(`[data-network=${id}]`)
					);
				});
			});
		}

		if (optionId === "visibility") {
			updateAndSaveEl(selector, (el) =>
				responsiveClassesFor({ ...optionValue, desktop: true }, el)
			);
		}

		if (
			optionId === "header_socials" ||
			optionId === "socialsLabelVisibility"
		) {
			const socialsLabelVisibility = values.socialsLabelVisibility || {
				desktop: false,
				tablet: false,
				mobile: false,
			};

			updateAndSaveEl(selector, (el) => {
				if (
					socialsLabelVisibility.desktop ||
					socialsLabelVisibility.tablet ||
					socialsLabelVisibility.mobile
				) {
					[...el.querySelectorAll("span.cb__label")].map((el) =>
						el.removeAttribute("hidden")
					);
				} else {
					[...el.querySelectorAll("span.cb__label")].map((el) =>
						el.setAttribute("hidden", "")
					);
				}
			});
		}
	}
);
