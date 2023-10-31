import BlockInspector from "./Inspector";
import { __ } from "@wordpress/i18n";
import { Fragment } from "@wordpress/element";
import AuthorBio from "./AuthorBio";

export default ({
	attributes,
	setAttributes,
	className,
	isSelected
}) => {
	
	return (
		<Fragment>
			<BlockInspector
				{...{ attributes, setAttributes, className, isSelected }}
			/>
			<AuthorBio {...{ attributes, setAttributes }}/>
		</Fragment>
	);
};
