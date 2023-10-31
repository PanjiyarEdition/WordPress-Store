import { Fragment } from "@wordpress/element";
import BlockInspector from "./Inspector";
import PopularPosts from "./popularPosts";


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
			<PopularPosts {...{ attributes, setAttributes }} />
		</Fragment>
	);
};
