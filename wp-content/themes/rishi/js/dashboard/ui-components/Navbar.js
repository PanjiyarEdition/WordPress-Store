import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import RishiTabs from "./tabs.js";
import { __ } from "@wordpress/i18n";

export const Navbar = () => {

	const [activeState, setactiveState] = useState(0);
	const activeToggle = (index) => {
		setactiveState(index);
	}

	return (
		<>
			<nav className="navbar">
				<div className="container">
					<div className="navbar-wrapper">
						<ul className="nav-menu">
							{
								RishiTabs && RishiTabs.map((tab, index) => {
									return (
										<li key={index} className="nav-item">
											<Link to={(0 === index) ? '?page=rishi-dashboard' : `?page=rishi-dashboard&tab=${tab.id}`} className={activeState === index ? "link-tabs active" : "link-tabs"}
												onClick={() => activeToggle(index)}
											>{tab.label}</Link>
										</li>
									)
								})
							}
						</ul>
					</div>
				</div>
			</nav>
		</>
	)
}

export default Navbar
