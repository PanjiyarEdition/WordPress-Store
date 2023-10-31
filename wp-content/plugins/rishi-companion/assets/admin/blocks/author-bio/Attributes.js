import { __ } from "@wordpress/i18n";
const attributes = {
	block_id: {
		type: "string",
	},
	authorBioTitle: {
		type: "string",
		default: __("About me","rishi-companion" ),
	},
	authorBioImageSize:{
		type: "number",
		default: 190,
	},
	authorBioLabel: {
		type: "string",
		default:__("Sarah Jane","rishi-companion" ),
	},
	authorBioType: {
		type: "string",
		default: "gravatar",
	},
	authorBioGravatar: {
		type: "string",
		default: "",
	},
	authorBioImageID: {
		type: "number",
		default: '',
	},
	authorBioImageURL: {
		type: "string",
		default: '',
	},
	authorBioImageAlt: {
		type: "string",
		default: '',
	},
	authorBioSignImageID: {
		type: "number",
		default: '',
	},
	authorBioSignImageURL: {
		type: "string",
		default: '',
	},
	authorBioSignImageAlt: {
		type: "string",
		default: '',
	},
	authorBioDesc: {
		type: 'array',
		source: 'children',
		selector: 'p',
	},
	authorBioBtnLabel: {
		type: "string",
		default: __( 'Read More','rishi-companion' ),
	},
	authorBioBtnUrl: {
		type: "string",
	},
	authorBioImageShape: {
		type: "string",
		default: 'circle',
	},
	authorBioAlignment: {
		type: "string",
		default: 'left',
	}
};

export default attributes;
