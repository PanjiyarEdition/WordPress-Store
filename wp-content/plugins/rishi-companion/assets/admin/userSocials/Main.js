import { Modal } from "@wordpress/components";
import { useState } from "@wordpress/element";
import { __ } from "@wordpress/i18n";
import UserMain from './UserMain';

export default () => {    
	
	const [settingPopup, setSettingPopup] = useState(false);

	document.addEventListener("click", function (event) {
		if (event.target.id === "rt-additional-user-social-settings") {
			setSettingPopup(true);
		}
	});

	const closeModal = () => setSettingPopup(false);

	(function (window, wp) {
		// just to keep it cleaner - we refer to our link by id for speed of lookup on DOM.
		var link_id = "rt-additional-user-social-settings";
		var link_Label = __("User Social Links", "rishi-companion");

		// prepare our custom link's html.
		var link_html =
			'<a id="' +
			link_id +
			'" class="rt-additional-user-social-settings-btn">' +
			link_Label +
			"</a>";

			
		// check if gutenberg's editor root element is present.
		var editorEl = document.getElementById("profile-page");
		if (!editorEl) {
			return;
		}
		
		setTimeout(function () {
			if (!document.getElementById(link_id)) {
				var toolbalEl = editorEl.querySelector(
					".wp-header-end"
				);
				if (toolbalEl instanceof HTMLElement) {
					toolbalEl.insertAdjacentHTML("afterend", link_html);
				}
			}
		}, 1);
	})(window, wp);

	return (
		settingPopup && (
			<Modal
				title="User Social Links"
				onRequestClose={closeModal}
				shouldCloseOnClickOutside={false}
				className="rt-user-social-setting-wrapper"
			>
				<UserMain setSettingPopup={setSettingPopup} />
			</Modal>
		)
	);
};