import { Fragment, useEffect, useState } from "@wordpress/element";
import BlockInspector from "./Inspector";

import { goFetch } from "../_hooks";

const DEFAULT_QUERY = {
	per_page: 100,
	orderby: "date",
	order: "desc",
};

const structuredPostObject = (item) => {
	let options = { year: 'numeric', month: 'long', day: 'numeric' };
	let date = new Date(item.date).toLocaleDateString("en-US", options);
	return {
		id: item.id,
		image: item?._embedded?.['wp:featuredmedia'] ? item._embedded?.['wp:featuredmedia']?.['0']?.source_url : "",
		title: item.title.rendered,
		content: item.content.rendered,
		author: item.author,
		type: item.type,
		link: item.link,
		date: date,
		status: item.status,
		meta: item?.meta?.['_rishi_post_view_count'],
	}
}

export default ({
	attributes,
	setAttributes,
	className,
	isSelected
}) => {

	const {
		postsTabRecentLabel,
		postsTabPopularLabel,
		postsTabCount,
		postsTabShowThumbnail,
		postsTabShowDate,
	} = attributes;

	const [state, setState] = useState({
		recentPosts: [],
		popularPosts: [],
	})

	useEffect( () => {
		const loadData = async () => {
		const recentPosts = await goFetch(`/wp/v2/posts?_embed`, DEFAULT_QUERY)
		const popularPosts = await goFetch(`/wp/v2/posts?_embed`, {
			...DEFAULT_QUERY,
			rishi_orderby: 'views',
			rishi_blocks: 'yes',
			per_page: 100,
		})

		setState({
			recentPosts: recentPosts?.map(structuredPostObject) || [],
			popularPosts: popularPosts?.map(structuredPostObject) || [],
		})

		}

		loadData();
	}, [])


	const { recentPosts, popularPosts } = state

	const [activeTab, setActiveTab] = useState('tab-1');

	return (
		<Fragment>
			<BlockInspector
				{...{ attributes, setAttributes, className, isSelected }}
			/>

			<div className="rishi-posts-tabs">
				<ul className="nav-tabs">
					<li role="presentation" className={activeTab === 'tab-1' ? 'active' : ''} onClick={() => setActiveTab('tab-1')} data-tab="tab-1"><h2 className="section-title">{postsTabRecentLabel}</h2></li>
					<li role="presentation" className={activeTab === 'tab-2' ? 'active' : ''} data-tab="tab-2" onClick={() => setActiveTab('tab-2')}><h2 className="section-title">{postsTabPopularLabel}</h2></li>
				</ul>

				<div className="posts-tab-content">
					<div className={`grid ${activeTab === 'tab-1' ? 'active' : ''}`} onClick={() => setActiveTab('tab-1')} id="tab-1" >
						{recentPosts.slice(0, postsTabCount)?.map((item, index) =>
							<div className="tab-content" key={index}>
								{postsTabShowThumbnail &&
									<a href={item.link} rel="noopener" className={`post-thumbnail ${item?.image ? '' : 'fallback-img'}`}>
										{item?.image &&
											<img
												className="image-preview"
												src={item.image}
											/>
										}
									</a>
								}
								<div className="widget-entry-header">
									<h3 className="entry-title"><a href={item.link} rel="noopener">{item.title}</a></h3>
									{postsTabShowDate && item?.date &&
										<div className="entry-meta">
											<span className="posted-on">
												<a href={item.link} rel="noopener">
													<time dateTime={item.date}>{item.date}</time>
												</a>
											</span>
										</div>
									}
								</div>
							</div>
						)}
					</div>

					<div className={`grid ${activeTab === 'tab-2' ? 'active' : ''}`} onClick={() => setActiveTab('tab-2')} id="tab-2">
						{popularPosts.slice(0, postsTabCount)?.map((item, index) =>
							<div className="tab-content" key={index}>
								{postsTabShowThumbnail &&
									<a href={item.link} rel="noopener" className={`post-thumbnail ${item?.image ? '' : 'fallback-img'}`}>
										{item?.image &&
											<img
												className="image-preview"
												src={item.image}
											/>
										}
									</a>
								}
								<div className="widget-entry-header">
									<h3 className="entry-title"><a href={item.link} rel="noopener">{item.title}</a></h3>
									{postsTabShowDate && item?.date &&
										<div className="entry-meta">
											<span className="posted-on">
												<a href={item.link} rel="noopener">
													<time dateTime={item.date}>{item.date}</time>
												</a>
											</span>
										</div>
									}
								</div>
							</div>
						)}
					</div>
				</div>
			</div>
		</Fragment>
	);
};
