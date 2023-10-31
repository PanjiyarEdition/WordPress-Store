import { __ } from "@wordpress/i18n";
import { GenericOptionType } from 'rishi-options'
import apiFetch from "@wordpress/api-fetch";
import { useState, useEffect } from "@wordpress/element";
import _ from "underscore";

export default ({ setSettingPopup }) => {

	const [authorMeta, setAuthorMeta] = useState([]);

	useEffect(() => {
        apiFetch( { path: `wp/v2/users/${RishiCompanionUserSocial.user_id}` } ).then(
			( result ) => {
				setAuthorMeta( result.meta.rishi_author_social_links );
			}
		);
    }, []);
	
	const saveAuthorMeta = async () => {
		await apiFetch( 
			{ 	path: `wp/v2/users/${RishiCompanionUserSocial.user_id}`, 
				method: 'POST',
				data: { meta: { rishi_author_social_links: {...authorMeta} } }, 
			} ).then(
			( result ) => {
				setSettingPopup(false);
			}
	) };
	
	return (
		<>
			<div className="rt-add-user-settings-body">
				<GenericOptionType
					value={_.toArray(authorMeta)}
					values={_.toArray(authorMeta)}
					id="meta-items"
					option={{
						id: "meta-items",
						label: __("Add Links", "rishi-companion"),
						attr: { "data-type": "inner" },
						type: "rt-layers",
						manageable: true,
						settings: {
							"facebook": {
								id: "facebook",
								label: __("Facebook", "rishi-companion"),
								options: {
									url: {
										id: "url",
										label: __("URL", "rishi-companion"),
										type: "text",
									}
								}
							},
							"twitter": {
								id: "twitter",
								label: __("Twitter", "rishi-companion"),
								options: {
									url: {
										id: "url",
										label: __("URL", "rishi-companion"),
										type: "text",
									}
								}
							},
							"instagram": {
								id: "instagram",
								label: __("Instagram", "rishi-companion"),
								options: {
									url: {
										id: "url",
										label: __("URL", "rishi-companion"),
										type: "text",
									}
								}
							},
							"pinterest": {
								id: "pinterest",
								label: __("Pinterest", "rishi-companion"),
								options: {
									url: {
										id: "url",
										label: __("URL", "rishi-companion"),
										type: "text",
									}
								}
							},
							"linkedin": {
								id: "linkedin",
								label: __("Linkedin", "rishi-companion"),
								options: {
									url: {
										id: "url",
										label: __("URL", "rishi-companion"),
										type: "text",
									}
								}
							},
							"tiktok": {
								id: "tiktok",
								label: __("Tiktok", "rishi-companion"),
								options: {
									url: {
										id: "url",
										label: __("URL", "rishi-companion"),
										type: "text",
									}
								}
							},
							"medium": {
								id: "medium",
								label: __("Medium", "rishi-companion"),
								options: {
									url: {
										id: "url",
										label: __("URL", "rishi-companion"),
										type: "text",
									}
								}
							},							
						},
						itemClass: 'rt-inner-layer',
						value:_.toArray(authorMeta)
					}}
					hasRevertButton={true}
					onChange={(newValue) => setAuthorMeta(newValue)}
				/>
			</div>
			<div className="components-modal__footer">
				<button
					type="submit"
					className="rt-add-user-btn primary"
					onClick={(data) => saveAuthorMeta()}
				>
					{__("Save", "rishi-companion")}
				</button>
			</div>
		</>
	);
};