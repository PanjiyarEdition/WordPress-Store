import { __ } from "@wordpress/i18n";
const attributes = {
	block_id: {
		type: "string",
	},
	categoriesList: {
		type: "array",
		default: []
	},
	categoriesLabel: {
		type: "string",
		default: __("Categories", "rishi-companion"),
	},
	category_selected: {
		type: "array",
		default: []
	},
	category: {
		type: "array",
		default: []
	},
	layoutStyle: {
		type: "object",
		default: {
			value: "layout-type-1",
			label: __("Layout One", "rishi-companion")
		},
	},
	showPostCount: {
		type: "boolean",
		default: true,
	},
	colors: {
		type: "object",
	}
};
export default attributes;
