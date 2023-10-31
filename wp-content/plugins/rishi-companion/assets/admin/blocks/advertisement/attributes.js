import { __ } from "@wordpress/i18n";
const attributes = {
	advertisementLabel: {
		type: "string",
		default: __("Advertisement", "rishi-companion"),
	},
	advertisementType: {
		type: "string",
		default: "ad_code",
	},
	advertisementImageID: {
		type: "number",
		default: '',
	},
	advertisementImageURL: {
		type: "string",
		default: '',
	},
	advertisementImageAlt: {
		type: "string",
		default: '',
	},
	openInNewTab: {
		type: "boolean",
		default: false,
	},
	relAttributeNofollow: {
		type: "boolean",
		default: false,
	},
	relAttributeSponsored: {
		type: "boolean",
		default: false,
	},
	advertisementFeaturedLink: {
		type: "url",
		default: '',
	},
	advertisementCode: {
		type: "string",
		default: '',
	},
};
export default attributes;