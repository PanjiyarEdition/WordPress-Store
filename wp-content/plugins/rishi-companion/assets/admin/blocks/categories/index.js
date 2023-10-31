import { registerBlockType } from "@wordpress/blocks";
import { __ } from "@wordpress/i18n";
import attributes from "./attributes";
import Edit from "./Edit.js";
import Save from "./Save.js";

/**
 * Register: Details Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType("rishi-blocks/categories", {
	title: __("Rishi - Categories", "rishi-companion"),
	description: __("Add a customizable Categories.", "rishi-companion"),
	category: "rishi-blocks",
	icon: "category",
	supports: {
		multiple: true,
		color: {
			__experimentalSkipSerialization: true,
			__experimentalDefaultControls: {
				background: true,
				text: true,
			}
		},
		__experimentalSelector: ".category-post-count"
	},
	keywords: [
		__("Categories", "rishi-comapanion"),
		__("Rishi Categories", "rishi-comapanion"),
	],
	attributes,
	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
     edit: ({ attributes, setAttributes, className, isSelected, clientId }) => {
		return (
			<Edit
				{...{
					attributes,
					setAttributes,
					className,
					isSelected,
					clientId,
				}}
			/>
		);
	},

	save({ attributes, className }) {
		return <Save {...{ attributes, className }} />;
	},
});