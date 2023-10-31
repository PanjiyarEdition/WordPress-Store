import { _n, sprintf } from '@wordpress/i18n'

const PostCard = ({ item }) => {
    const {
        showPostThumbnail,
        showPostTitle,
        showViewsCount,
        showCommentsCount,
        image,
        link,
        title,
        date,
        date_new,
        showDate,
        cat_lists,
        openInNewTab,
        meta,
        postsBy,
        commentCount
    } = item
    const target = openInNewTab ? '_blank' : '_self'
    const viewsCount = meta || 0
    return <li>
        {showPostThumbnail &&
            <a target={target} href={link} className={`post-thumbnail ${image ? '' : 'fallback-img'}`} rel="noopener">
                {image &&
                    <img
                        className="image-preview"
                        src={image}
                        alt="image-alt"
                    />
                }
            </a>
        }
        <div className="widget-entry-header">
            {cat_lists &&
                <span className="cat-links">
                    {cat_lists?.map((cat_item, cat_index) =>
                        <a key={cat_index} target={target} href={cat_item.link} rel="noopener">{cat_item.name}</a>
                    )}
                </span>
            }
            <h3 className="entry-title"><a target={target} href={link} rel="noopener">{title}</a></h3>
            <div className="entry-meta">
                {showDate && date &&
                    <span className="posted-on">
                        <a target={target} href={link} rel="noopener">
                            <time dateTime={date}>{date_new}</time>
                        </a>
                    </span>
                }

                {postsBy == 'views' && showViewsCount &&
                    <span className="view-count">{sprintf(_n("%s View", "%s Views", parseInt(viewsCount)), viewsCount)}</span>
                }
                {postsBy == 'comments' && showCommentsCount &&
                    <span className="comment-count">{sprintf(_n("%s Comment", "%s Comments", parseInt(commentCount)), commentCount)}</span>
                }
            </div>
        </div>
    </li>
}

export default PostCard
