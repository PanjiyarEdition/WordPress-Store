import { sprintf, _n } from '@wordpress/i18n';
import classnames from 'classnames';

const CategoryCard = ({ item }) => {
    const {
        name,
        link,
        image,
        count,
        showPostCount,
        layoutStyle,
        colorProps
    } = item

    const categoryClass = classnames(
        'category-post-count',
        colorProps.className,
    );

    return <li>
        <a href={link} className={`${!image ? 'fallback-img' : ''}`} style={image && { backgroundImage: `url(${image})` } || {}}>
            {layoutStyle === 'layout-type-1' &&
                <span className="category-name">{name}</span>
            }
            {layoutStyle === 'layout-type-1' &&
                showPostCount && count > 0 &&
                <span className={`category-post-count rishi_sidebar_widget_categories ul li ${categoryClass}`} style={{ ...colorProps.style }}>
                    {sprintf(_n('%s Post', '%s Posts', parseInt(count)), count)}
                </span>
            }
            {layoutStyle === 'layout-type-2' &&
                <div className="category-content">
                    <span className="category-name">{name}</span>
                    {
                        showPostCount && count > 0 &&
                        <span className={`category-post-count rishi_sidebar_widget_categories ul li ${categoryClass}`} style={{ ...colorProps.style }}>
                            {sprintf(_n('%s Post', '%s Posts', parseInt(count)), count)}
                        </span>
                    }
                </div>
            }
        </a>
    </li>
}

export default CategoryCard
