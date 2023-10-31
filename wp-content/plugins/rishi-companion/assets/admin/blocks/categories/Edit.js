import BlockInspector from "./Inspector";
import { __ } from "@wordpress/i18n";
import { Fragment, useState, useEffect } from "@wordpress/element";
import Categories from "./Categories";

import { usePostCategories } from "../_hooks";

const DEFAULT_QUERY = {
	per_page: 100,
};
export default ({
	attributes,
	setAttributes,
	className,
	isSelected
}) => {

	const [categories, setCategories] = useState([])

	const allCategories = usePostCategories(DEFAULT_QUERY);

	useEffect(() => {
		setCategories(allCategories)
	}, [allCategories])

	return (
		<Fragment>
			<BlockInspector
				{...{ attributes, setAttributes, className, isSelected }}
				categories={categories}
			/>
			<Categories {...{ attributes, setAttributes }} categories={categories} />
		</Fragment>
	);
};
