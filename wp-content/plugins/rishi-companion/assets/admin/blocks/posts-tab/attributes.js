import { __ } from "@wordpress/i18n";
const attributes = {
	block_id: {
		type: "string",
	},
	postsTabs: {
		type: "array",
		default: []
	},
	postsTabsPopular: {
		type: "array",
		default: []
	},
	postsTabRecentLabel: {
		type: "string",
		default: __("Recent Posts", "rishi-companion"),
	},
    postsTabPopularLabel: {
		type: "string",
		default: __("Popular Posts", "rishi-companion"),
	},
	postsTabCount: {
		type: "number",
		default: 3,
	},
	postsTabShowThumbnail: {
		type: "boolean",
		default: true,
	},
	tabImageSize: {
		type: "string",
		default: "default",
	},
	postsTabShowDate: {
		type: "boolean",
		default: true,
	}
};

export default attributes;