import BlockInspector from "./Inspector";
import { __ } from "@wordpress/i18n";
import { Fragment } from "@wordpress/element";
import Facebook from "./Facebook";

export default ({
	attributes,
    setAttributes,
    className,
}) => {

	return (
		<Fragment>
			<BlockInspector
				{...{ attributes, setAttributes, className}}
			/>
			<Facebook {...{ attributes, setAttributes }}/>
		</Fragment>
	);
};
