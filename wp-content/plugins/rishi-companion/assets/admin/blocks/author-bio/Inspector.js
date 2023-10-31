import { __,sprintf } from "@wordpress/i18n";
import { PanelBody, TextControl, RangeControl,SelectControl, Button,PanelRow } from "@wordpress/components";
import { InspectorControls, MediaUpload,URLInput,RichText} from "@wordpress/block-editor";

export default ({ attributes, setAttributes }) => {
	const {
		authorBioTitle,
		authorBioLabel,
		authorBioType,
		authorBioImageSize,
		authorBioGravatar,
		authorBioDesc,
		authorBioImageID,
		authorBioImageURL,
		authorBioImageAlt,
		authorBioSignImageID,
		authorBioSignImageURL,
		authorBioSignImageAlt,
		authorBioBtnLabel,
		authorBioBtnUrl,
		authorBioImageShape,
		authorBioAlignment
	} = attributes;

	const onSelectImage = (img) => {
		setAttributes({
			authorBioImageID: img.id,
			authorBioImageURL: img.url,
			authorBioImageAlt: img.alt,
		});
	};
	const onReplaceImage = (replace) => {
		setAttributes({
			authorBioImageID: replace.id,
			authorBioImageURL: replace.url,
			authorBioImageAlt: replace.alt,
		});
	};
	const onRemoveImage = () => {
		setAttributes({
			authorBioImageID: null,
			authorBioImageURL: null,
			authorBioImageAlt: null,
		});
	};

	const onSelectSignImage = (img) => {
		setAttributes({
			authorBioSignImageID: img.id,
			authorBioSignImageURL: img.url,
			authorBioSignImageAlt: img.alt,
		});
	};
	const onReplaceSignImage = (replace) => {
		setAttributes({
			authorBioSignImageID: replace.id,
			authorBioSignImageURL: replace.url,
			authorBioSignImageAlt: replace.alt,
		});
	};
	const onRemoveSignImage = () => {
		setAttributes({
			authorBioSignImageID: null,
			authorBioSignImageURL: null,
			authorBioSignImageAlt: null,
		});
	};

	const validateEmail = (email) => {
	return String(email)
		.toLowerCase()
		.match(
		/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
		);
	};

	return (
		<InspectorControls key="inspector">
			<PanelBody
				title={__("Settings", "rishi-companion")}
				className={"rishi-panel-label rishi-author"}
				initialOpen={true}
			>   
			<PanelRow>{__("Configure all the author details here:", "rishi-companion")}</PanelRow>
                <div className="rishi-blocks-option components-base-control">                
                    <TextControl
                        label={__("Title", "rishi-companion")}
                        className="recent-posts-title rishi-input-field"
                        value={authorBioTitle}
                        onChange={(authorBioTitle) => setAttributes({ authorBioTitle })}
                    />
					 <TextControl
                        label={__("Author Name", "rishi-companion")}
                        className="recent-author-title rishi-input-field"
                        value={authorBioLabel}
                        onChange={(authorBioLabel) => setAttributes({ authorBioLabel })}
                    />
					<div>
						<label>
							{__("Author Bio","rishi-companion")}
						</label>
					<RichText
                        tagName="p"
						className="rishi-blocks-option components-text-control__input"
                        value={ authorBioDesc }
                        allowedFormats={ [ 'core/bold', 'core/italic' ] }
                        onChange={ ( authorBioDesc ) => setAttributes( { authorBioDesc } ) } 
                        placeholder={ __( 'Write something about yourself...','rishi-companion' ) } 
                    />
					</div>
                </div>
				<div className="rishi-blocks-option components-base-control">
					<SelectControl
						label	   = {__("Display photo from:", "rishi-companion")}
						initialOpen= {false}
						value	   = {authorBioType}
						options    =  {[
							{ value: "gravatar", label: "Gravatar" },
							{ value: "authorbioimage", label: "Upload Photo" },
						]}
						onChange = { ( newType ) =>
							setAttributes({ authorBioType: newType })
						}
					/>
					{
						authorBioType == 'authorbioimage' &&
						<>
							<div className="rishi-blocks-option author-image">
								{
									authorBioImageID ? (
										<img width={authorBioImageSize} src={authorBioImageURL} alt={authorBioImageAlt} className={authorBioImageShape} />
									) : ""
								}
								
								{
									!authorBioImageID ? (
										<MediaUpload
											onSelect={
												onSelectImage
											}
											type="image"
											value={authorBioImageID}
											render={({
												open,
											}) => (
												<Button
													className={
														"author-bio-upload-btn upload-sign"
													}
													onClick={
														open
													}
												>
													{__(
														"Upload Bio Image",
														"rishi-comapanion"
													)}
												</Button>
											)}
										></MediaUpload>
									) : (
										<div className="author-bio-upload-btn-wrapper">
											<MediaUpload
												onSelect={
													onReplaceImage
												}
												type="image"
												value={
													authorBioImageID
												}
												render={({
													open,
												}) => (
													<Button
														className={
															"author-bio-replace-btn"
														}
														onClick={
															open
														}
													>
														{__(
															" Replace Image",
															"rishi-comapanion"
														)}
													</Button>
												)}
											></MediaUpload>							
											<Button
												className="author-bio-remove-image"
												onClick={
													onRemoveImage
												}
											>
												{__(
													"Remove Image",
													"rishi-comapanion"
												)}
											</Button>
										</div>
									)                   
								} 
									<RangeControl
									value={authorBioImageSize}
									min={80}
									step={5}
									max={ 500 }
									onChange={(newCount) =>
										setAttributes({
											authorBioImageSize: newCount,
										})
									}
								/> 
							</div>
						</>  
					}
					{
					authorBioType == 'gravatar' && 
						<>
						<TextControl
							label={__("Author Email", "rishi-companion")}
							className="author-bio-avatar rishi-input-field"
							value={ authorBioGravatar }
							onChange={ (authorBioGravatar) => setAttributes({ authorBioGravatar }) }
						/>
						<RangeControl
							value={authorBioImageSize}
							min={80}
							step={5}
							max={ 500 }
							onChange={(newCount) =>
								setAttributes({
									authorBioImageSize: newCount,
								})
							}
						/>
						<span
							className="rishi-block-desc-not"
							dangerouslySetInnerHTML={{
								__html: sprintf(
									__(
										"You can show your %sGravatar%s  image instead of manually uploading your photo. Just add your gravatar registered email address here.",
										"rishi-companion"
									),
									'<a href="https://en.gravatar.com/" target="_blank">',
									"</a>"
								),
							}}
						/>
					</>
				}
				</div>
				<div className="rishi-blocks-option components-base-control">
					<img src={authorBioSignImageURL} alt={authorBioSignImageAlt}/>
						{
						!authorBioSignImageID ? (
							<MediaUpload
								onSelect={
									onSelectSignImage
								}
								type="image"
								value={authorBioSignImageID}
								render={({
									open,
								}) => (
									<Button
										className={
											"author-bio-upload-btn upload-sign"
										}
										onClick={
											open
										}
									>
										{__(
											"Upload Sign Image",
											"rishi-comapanion"
										)}
									</Button>
								)}
							></MediaUpload>
						) : (
							<div className="author-bio-upload-btn-wrapper">
								<MediaUpload
									onSelect={
										onReplaceSignImage
									}
									type="image"
									value={
										authorBioSignImageID
									}
									render={({
										open,
									}) => (
										<Button
											className={
												"author-bio-replace-btn"
											}
											onClick={
												open
											}
										>
											{__(
												" Replace Sign Image",
												"rishi-comapanion"
											)}
										</Button>
									)}
								></MediaUpload>							
								<Button
									className="author-bio-remove-image"
									onClick={
										onRemoveSignImage
									}
								>
									{__(
										"Remove Sign Image",
										"rishi-comapanion"
									)}
								</Button>
							</div>
						)                   
					}  
				</div>

				<div className="rishi-blocks-option components-base-control">                
                    <TextControl
                        label={__("Button Label", "rishi-companion")}
                        className="recent-button-title rishi-input-field"
                        value={authorBioBtnLabel}
                        onChange={(authorBioBtnLabel) => setAttributes({ authorBioBtnLabel })}
                    />
					<URLInput
						className="recent-button-url rishi-input-field"
						value={ authorBioBtnUrl }
						onChange={ ( authorBioBtnUrl ) => setAttributes( { authorBioBtnUrl } ) }
					/>
				</div>
			</PanelBody>
			<PanelBody title="Design" initialOpen={ true }>
				<div className="rishi-blocks-option components-base-control rishi-author ">
					<SelectControl
						label	   = {__("Image Shape", "rishi-companion")}
						initialOpen= {false}
						value	   = {authorBioImageShape}
						options    =  {[
							{ value: "circle", label: "Circle" },
							{ value: "square", label: "Square" },
						]}
						onChange = { ( newType ) =>
							setAttributes({ authorBioImageShape: newType })
						}
					/>
					<SelectControl
						label	   = {__("Alignment", "rishi-companion")}
						initialOpen= {false}
						value	   = {authorBioAlignment}
						options    =  {[
							{ value: "left", label: "Left" },
							{ value: "center", label: "Center" },
							{ value: "right", label: "Right" },
						]}
						onChange = { ( newType ) =>
							setAttributes({ authorBioAlignment: newType })
						}
					/>
				</div>
			</PanelBody>
		</InspectorControls>
	);
};
