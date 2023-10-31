import { __ } from "@wordpress/i18n";
import { PanelBody, TextControl, ToggleControl } from "@wordpress/components";
import { InspectorControls } from "@wordpress/block-editor";
import React from 'react';
import Select from 'react-select';
import makeAnimated from 'react-select/animated';

const animatedComponents = makeAnimated();

export default ({ attributes, setAttributes, categories }) => {

	const {
		categoriesLabel,
		categoriesList,
		category_selected,
		layoutStyle,
		showPostCount
	} = attributes;

	return (
		<InspectorControls key="inspector">
			<PanelBody
				title={__("Categories Settings", "rishi-companion")}
				className={"rishi-categories-panel-label"}
				initialOpen={true}
			>
				<div className="rishi-blocks-option">
					<TextControl
						label={__("Title", "rishi-companion")}
						className="categories-option categories-input-field"
						value={categoriesLabel}
						onChange={(categoriesLabel) => setAttributes({ categoriesLabel })}
					/>
				</div>
				<div className="rishi-blocks-option">
					<Select
						closeMenuOnSelect={true}
						placeholder={__("Choose Layout", "rishi-companion")}
						initialOpen={false}
						options={[
							{
								value: "layout-type-1",
								label: __("Layout One", "rishi-companion"),
							},
							{
								value: "layout-type-2",
								label: __("Layout Two", "rishi-companion"),
							},
						]}
						onChange={(newStyle) =>
							setAttributes({ layoutStyle: newStyle })
						}
						value={layoutStyle}
					/>
				</div>
				<div className="rishi-blocks-option">
					<Select
						closeMenuOnSelect={false}
						components={animatedComponents}
						isMulti
						placeholder={__("Categories List", "rishi-companion")}
						initialOpen={false}
						options={categories.map(({ id, name }) => ({ label: name, value: id }))}
						onChange={(newValue) =>
							setAttributes({ category_selected: newValue })
						}
						value={category_selected}
					/>
				</div>
				<div className="rishi-blocks-option">
					<ToggleControl
						label={__("Show Post Count", "rishi-companion")}
						className="category-show-post-option"
						checked={!!showPostCount}
						onChange={() =>
							setAttributes({ showPostCount: !showPostCount })
						}
					/>
				</div>
			</PanelBody>
		</InspectorControls>
	);
};
