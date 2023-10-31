import React from 'react';

const Sidebar = (props) => {
	return (
		<>
			<div className="sidebar">
				<div className="heading">
					<h5>
						{props.SidebarTitle}
					</h5>
				</div>
				<div className="content">
					<p>
						{props.SidebarContent}
					</p>
				</div>
				<a href={props.SidebarLink} className="btn btn--secondary" target="_blank">
					<span className="content-icon">
						{props.SidebarIcon}
					</span>
					{props.SidebarBtnContent}
					<span className="icon-arrow">
						{props.SidebarRightIcon}
					</span>
				</a>
			</div>
		</>
	)
}

export default Sidebar;
