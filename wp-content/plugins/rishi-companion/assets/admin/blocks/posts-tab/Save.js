import { __ } from "@wordpress/i18n";
export default ({ attributes, className }) => {
	const {
		postsTabRecentLabel,
        postsTabPopularLabel,
		postsTabCount,
		postsTabShowThumbnail,
		postsTabShowDate,
		postsTabs,
		postsTabsPopular
	} = attributes;

    return (        
        <div className="rishi-posts-tabs">
            <ul className="nav-tabs">
                <li role="presentation" className="active" data-tab="tab-1"><h2 className="section-title">{postsTabRecentLabel}</h2></li>
                <li role="presentation" data-tab="tab-2" ><h2 className="section-title">{postsTabPopularLabel}</h2></li>
            </ul>
            <div className="posts-tab-content">
            <div className="grid active" id="tab-1" >
                    {postsTabs.slice(0,postsTabCount)?.map((item, index) => 
                        <div class="tab-content" key={index}>
                            { postsTabShowThumbnail &&
                                <a href={item.link} rel="noopener" className={`post-thumbnail ${item?.image ? '' : 'fallback-img'}`}> 
                                    { item?.image &&
                                        <img
                                            className="image-preview"
                                            src={item.image}
                                        />
                                    }
                                </a>
                            }
                            <div className="widget-entry-header">                       
                                <h3 className="entry-title"><a href={item.link}>{item.title}</a></h3>
                                { postsTabShowDate && item?.date &&
                                    <div className="entry-meta">
                                        <span className="posted-on">
                                            <a href={item.link}>
                                                <time dateTime={item.date}>{item.date}</time>
                                            </a>
                                        </span>
                                    </div>
                                }
                            </div>
                        </div>
                    )}
                </div>
                <div className="grid" id="tab-2">
                    {postsTabsPopular.slice(0,postsTabCount)?.map((item, index) => 
                        <div className="tab-content" key={index}>
                            { postsTabShowThumbnail &&
                                <a href={item.link} rel="noopener" className={`post-thumbnail ${item?.image ? '' : 'fallback-img'}`}> 
                                    { item?.image &&
                                        <img
                                            className="image-preview"
                                            src={item.image}
                                        />
                                    }
                                </a>
                            }
                            <div className="widget-entry-header">                        
                                <h3 className="entry-title"><a href={item.link} rel="noopener">{item.title}</a></h3>
                                { postsTabShowDate && item?.date &&
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
	);
};
