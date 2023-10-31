/**
 * Activate a plugin
 *
 * @return void
 */
function rishi_activatePlugin() {
	var data = new FormData();
	data.append('action', 'rishi_get_install_starter');
	data.append('security', RishiDashboard.ajax_nonce);
	data.append('status', RishiDashboard.status);
	jQuery.ajax({
		method: 'POST',
		url: RishiDashboard.ajaxURL,
		data: data,
		contentType: false,
		processData: false,
	})
		.done(function (response, status, stately) {
			if (response.success) {
				location.replace(RishiDashboard.starterURL);
			}
		})
		.fail(function (error) {
			console.log(error);
		});
}
/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
import { useState, Fragment } from '@wordpress/element';
const { Button, Spinner } = wp.components;
export const Starter = () => {
	const [working, setWorking] = useState(null);
	const handleClick = () => {
		setWorking(true);
		rishi_activatePlugin();
	};
	return (
		<Fragment>
			<div className="ri-desk-starter-inner" style={{ margin: '20px auto', textAlign: 'center' }}>
				<h2>{__('Rishi Theme Templates To Get Started', 'rishi')}</h2>
				<div className="image-container">
					<img width="772" height="250" src={RishiDashboard.starterImage} />
				</div>
				<p>{__('Rishi Theme includes variety of starter templates suited for different niches of websites. New designs are added frequently to the collection.', 'rishi')} <a target="_blank" href="https://rishitheme.com/starter-sites/">{__('Visit here ', 'rishi')}</a>{__('to see all the templates.', 'rishi')}</p>
				{RishiDashboard.starterTemplates && (
					<a
						className="ri-action-starter ri-desk-button"
						href={RishiDashboard.starterURL}
					>
						{RishiDashboard.starterLabel}
					</a>
				)}
				{!RishiDashboard.starterTemplates && (
					<Button
						className="ri-action-starter ri-desk-button"
						onClick={() => handleClick()}
					>
						{RishiDashboard.starterLabel}
						{working && (
							<Spinner />
						)}
					</Button>

				)}

			</div>
		</Fragment>
	);
};

export default Starter;
