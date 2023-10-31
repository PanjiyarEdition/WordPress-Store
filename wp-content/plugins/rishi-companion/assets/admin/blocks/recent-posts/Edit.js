import BlockInspector from "./Inspector";
import { __ } from "@wordpress/i18n";
import { Fragment } from "@wordpress/element";
import RecentPosts from "./recentPosts";

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
			<RecentPosts {...{ attributes, setAttributes }} />
		</Fragment>
	);
};
