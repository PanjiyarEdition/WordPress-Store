import { __ } from "@wordpress/i18n";
const attributes = {
	recentPosts: {
		type: "array",
		default: []
	},
	recentPostLabel: {
		type: "string",
		default: __("Recent Posts", "rishi-companion"),
	},
	recentPostCount: {
		type: "number",
		default: 3,
	},
	recentPostShowThumbnail: {
		type: "boolean",
		default: true,
	},
	recentImageSize: {
		type: "string",
		default: "default",
	},
	recentPostShowDate: {
		type: "boolean",
		default: true,
	},
	layoutStyle: {
		type: "string",
		default: "layout-type-1",
	},
	openInNewTab: {
		type: "boolean",
		default: false,
	},
};

export default attributes;
