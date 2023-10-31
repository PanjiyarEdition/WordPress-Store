import { __, _n, sprintf } from "@wordpress/i18n";

export default ({ attributes, className }) => {
	const {
		popularPostLabel,
		popularPostCount,
		popularPostsType,
        popularPostViewCount,
		popularPostCommentCount,
		popularPostShowThumbnail,
		popularPostShowDate,
        layoutStyle,
		openInNewTab,
		popularPosts
	} = attributes;
	
	var target = openInNewTab ? '_blank' : '_self'
    
    return (
        <section id="rishi_popular_posts" className="rishi_sidebar_widget_popular_post">
            {popularPostLabel ? <h2 className="widget-title" itemProp="name"><span>{popularPostLabel}</span></h2> : '' }
            <ul id="rishi-popularpost-wrapper" className={layoutStyle}>
                {popularPosts.slice(0,popularPostCount)?.map((item, index) =>{
                    const cmnt_label = ( item.commentCount ) > 1 ? ' Comments' : ' Comment';
                    const views_label = ( item.meta ) > 1 ? ' Views' : ' View';
                    return (
                        <li key={index}>
                            { popularPostShowThumbnail &&
                                <a target={target} href={item.link} className={`post-thumbnail ${item?.image ? '' : 'fallback-img'}`} rel="noopener"> 
                                    { item?.image &&
                                        <img
                                            className="image-preview"
                                            src={item.image}
                                        />
                                    }
                                </a>
                            }
                            <div className="widget-entry-header">
                                {item.cat_lists &&
                                    <span className="cat-links">
                                        { item.cat_lists?.map((cat_item, cat_index) =>
                                            <a key={cat_index} target={target} href={cat_item.link} rel="noopener">{cat_item.name}</a>
                                        )}
                                    </span>
                                }
                                <h3 className="entry-title"><a target={target} href={item.link} rel="noopener">{item.title}</a></h3>
                            
                                {( popularPostShowDate || ( popularPostsType == 'views' && popularPostViewCount )
                                    || ( popularPostsType == 'comments' && popularPostCommentCount ) ) &&
                                    (
                                    <div className="entry-meta">
                                        {popularPostShowDate && item?.date &&
                                            <span className="posted-on">
                                                <a target={target} href={item.link} rel="noopener">
                                                    <time dateTime={item.date}>{item.date_new}</time>
                                                </a>
                                            </span>
                                        }
                                        {popularPostsType == 'views' && popularPostViewCount &&
                                            <span className="view-count">{item.meta + views_label}</span>
                                        }                                    
                                        {popularPostsType == 'comments' && popularPostCommentCount &&
                                            <span className="comment-count">{item.commentCount + cmnt_label}</span>
                                        }
                                    </div>
                                    )
                                }                               
                                
                            </div>
                        </li>
                    )
                }
                )}
            </ul>
        </section>  
    );
};
