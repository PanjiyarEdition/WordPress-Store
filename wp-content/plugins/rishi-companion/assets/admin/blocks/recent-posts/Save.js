import { __ } from "@wordpress/i18n";
export default ({ attributes, className }) => {
	const {
		recentPostLabel,
		recentPostCount,
		recentPostShowThumbnail,
		recentPostShowDate,
        layoutStyle,
		openInNewTab,
		recentPosts
	} = attributes;
	
    var target = openInNewTab ? '_blank' : '_self'
	
    return (
		<section id="rishi_recent_posts" className="rishi_sidebar_widget_recent_post">
            {recentPostLabel ? <h2 className="widget-title"><span>{recentPostLabel}</span></h2> : '' }
            <ul className={layoutStyle}>
                {recentPosts.slice(0,recentPostCount)?.map((item, index) => 
                    <li key={index}>
                        { recentPostShowThumbnail &&
                            <a target={target} href={item.link} className={`post-thumbnail ${item?.image ? '' : 'fallback-img'}`} rel="noopener"> 
                                { item?.image &&
                                    <img
                                        className="image-preview"
                                        src={item.image}
                                        alt="image-alt"
                                    />
                                }
                            </a>
                        }
                        <div className="widget-entry-header">
                            <>
                            {item.cat_lists &&
                                <span className="cat-links">
                                    { item.cat_lists?.map((cat_item,cat_index) =>
                                        <a key={cat_index} target={target} href={cat_item.link} rel="noopener">{cat_item.name}</a>
                                    )}
                                </span>
                            }             
                            </>           
                            <h3 className="entry-title"><a target={target} href={item.link} rel="noopener">{item.title}</a></h3>
                            <>
                            { recentPostShowDate && item?.date &&
                                <div className="entry-meta">
                                    <span className="posted-on">
                                        <a target={target} href={item.link} rel="noopener">
                                            <time dateTime={item.date}>{item.date_new}</time>
                                        </a>
                                    </span>
                                </div>
                            }
                            </>
                        </div>
                    </li>
                )}
            </ul>
        </section> 
	);
};
