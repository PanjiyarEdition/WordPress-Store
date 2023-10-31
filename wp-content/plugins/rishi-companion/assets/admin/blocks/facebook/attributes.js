import { __ } from "@wordpress/i18n";
const attributes = {
    block_id: {
		type: "string",
	},
    facebookTitleLabel: {
		type: "string",
		default: __("Follow Us", "rishi-companion"),
	},
	facebookUrl: {
		type: "string",
		default: '',
	},
	facebookTabs :{
		type: "string",
		default: 'timeline',
	},
	facebookWidth :{
		type: "number",
		default: 300,
	},
	facebookHeight :{
		type: "number",
		default: 500,
	},
	facebookCoverPhoto: {
		type: "boolean",
		default: true,
	},
	facebookSmallHeader: {
		type: "boolean",
		default: false,
	},
};
export default attributes;