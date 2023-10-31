import { __ } from "@wordpress/i18n";
import { PanelBody, TextControl, RangeControl, ToggleControl, SelectControl } from "@wordpress/components";
import { InspectorControls } from "@wordpress/block-editor";

export default ({ attributes, setAttributes, className, isSelected }) => {

	const {
		popularPostLabel,
		popularPostCount,
		popularPostsType,
		popularPostViewCount,
		popularPostCommentCount,
		layoutStyle,
		popularPostShowThumbnail,
		popularImageSize,
		popularPostShowDate,
		openInNewTab
	} = attributes;

	return (
		<InspectorControls key="inspector">
			<PanelBody
				title={__("Settings", "rishi-companion")}
				className={"rishi-panel-label"}
				initialOpen={true}
			>
				<div className="rishi-blocks-option">
					<TextControl
						label={__("Title", "rishi-companion")}
						className="popular-posts-option popular-input-field"
						value={popularPostLabel}
						onChange={(popularPostLabel) => setAttributes({ popularPostLabel })}
					/>
				</div>
				<div className="rishi-blocks-option">
					<label>
                        {__("Number of Posts", "rishi-companion")}
                    </label>
					<RangeControl
						value={popularPostCount}
						min={1}
						step={1}
						onChange={(newCount) =>
							setAttributes({ popularPostCount: newCount })
						}
					/>
				</div>
				<div className="rishi-blocks-option">
					<SelectControl
						label	   ={__("Show Posts Based on", "rishi-companion")}
						initialOpen={false}
						value	   ={popularPostsType}
						options    ={[
							{ value: "views", label: __("Views", "rishi-companion") },
							{ value: "comments", label: __("Comments", "rishi-companion") },
						]}
						onChange    ={(newType) =>
							setAttributes({ popularPostsType: newType })
						}
					/>
				</div>
				<div className="rishi-blocks-option">
					<ToggleControl
						label={__("Featured Image", "rishi-companion")}
						className="popular-posts-option"
						checked={!!popularPostShowThumbnail}
						onChange={() =>
							setAttributes({ popularPostShowThumbnail: !popularPostShowThumbnail })
						}
					/>
				</div>
				{ popularPostShowThumbnail &&
                    <div className="rishi-blocks-option">
                        <SelectControl
                            label	   ={__("Image Size", "rishi-companion")}
                            initialOpen={false}
                            value	   ={popularImageSize}
                            options    ={[
                                { value: "default", label: __("Default", "rishi-companion") },
                                { value: "full_size", label: __("Full Size", "rishi-companion") },
                            ]}
                            onChange    ={(newType) =>
                                setAttributes({ popularImageSize: newType })
                            }
                        />
                    </div>
                }
				<div className="rishi-blocks-option">
					<ToggleControl
						label={__("Post Date", "rishi-companion")}
						className="popular-posts-option"
						checked={!!popularPostShowDate}
						onChange={() =>
							setAttributes({ popularPostShowDate: !popularPostShowDate })
						}
					/>
				</div>
				{popularPostsType == 'views' &&
					<div className="rishi-blocks-option">
						<ToggleControl
							label={__("Views Count", "rishi-companion")}
							className="popular-posts-option"
							checked={!!popularPostViewCount}
							onChange={() =>
								setAttributes({ popularPostViewCount: !popularPostViewCount })
							}
						/>
					</div>
				}
				{popularPostsType == 'comments' &&
					<div className="rishi-blocks-option">
						<ToggleControl
							label={__("Comments Count", "rishi-companion")}
							className="popular-posts-option"
							checked={!!popularPostCommentCount}
							onChange={() =>
								setAttributes({ popularPostCommentCount: !popularPostCommentCount })
							}
						/>
					</div>
				}
				<div className="rishi-blocks-option">
					<ToggleControl
						label={__("Open in New Tab", "rishi-companion")}
						checked={!!openInNewTab}
						onChange={() =>
							setAttributes({
								openInNewTab: !openInNewTab,
							})
						}
					/>
				</div>
				<div className="rishi-blocks-option">
					<SelectControl
						label={__("Layout", "rishi-companion")}
						value={layoutStyle}
						options={[
							{
								value: "layout-type-1",
								label: __("Layout One", "rishi-companion"),
							},
							{
								value: "layout-type-2",
								label: __("Layout Two", "rishi-companion"),
							},
							{
								value: "layout-type-3",
								label: __("Layout Three", "rishi-companion"),
							},
						]}
						onChange={(newStyle) =>
							setAttributes({ layoutStyle: newStyle })
						}
					/>
				</div>
			</PanelBody>
		</InspectorControls>
	);
};
