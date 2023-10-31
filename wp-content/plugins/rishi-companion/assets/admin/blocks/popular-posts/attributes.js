import { __ } from "@wordpress/i18n";
const attributes = {
	block_id: {
		type: "string",
	},
	popularPosts: {
		type: "array",
		default: []
	},
	popularPostLabel: {
		type: "string",
		default: __("Popular Posts", "rishi-companion"),
	},
	popularPostCount: {
		type: "number",
		default: 3,
	},
	popularPostsType: {
		type: "string",
		default: "views",
	},	
	popularPostViewCount: {
		type: "boolean",
		default: false,
	},
	popularPostCommentCount: {
		type: "boolean",
		default: false,
	},
	layoutStyle: {
		type: "string",
		default: "layout-type-1",
	},
	popularPostShowThumbnail: {
		type: "boolean",
		default: true,
	},
	popularImageSize: {
		type: "string",
		default: "default",
	},
	popularPostShowDate: {
		type: "boolean",
		default: true,
	},
	openInNewTab: {
		type: "boolean",
		default: false,
	},
};
export default attributes;