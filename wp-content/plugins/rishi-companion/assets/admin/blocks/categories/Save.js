import { __ } from "@wordpress/i18n";
import classnames from 'classnames';
import { __experimentalGetColorClassesAndStyles as getColorClassesAndStyles } from '@wordpress/block-editor'; //WordPress dependencies

export default ({ attributes }) => {
    const {
        categoriesLabel,
        layoutStyle,
        showPostCount,
        category
    } = attributes;

    const colorProps = getColorClassesAndStyles( attributes );

	const categoryClass = classnames(
		'category-post-count',
		colorProps.className,
	);
    const categoryStyle = {
		...colorProps.style
	};

    return (
        <section id="rishi_categories" className="rishi_sidebar_widget_categories">
        {
            categoriesLabel &&
            <h2 className="widget-title" itemProp="name">
                <span>{categoriesLabel}</span>
            </h2>
        }
        <ul id="rishi-categories-wrapper" className={layoutStyle.value}>
            {
                0 < category.length && category.map((item, index) => {
                    const imgUrl      = ( item['image_url'] ) ? item['image_url'] : '';
                    const imgClass    = ( item['image_url'] ) == '' ? 'fallback-img' : '';
                    const postCount   = ( item['count'] ) == 1 ? __(' Post', 'rishi-companion')  : __( ' Posts', 'rishi-companion');
                    return (
                        <li key={index}>
                            <a href={item['link']} className={imgClass} style={imgUrl && { backgroundImage: `url(${imgUrl})` } || {}}>
                                { layoutStyle.value === 'layout-type-1' &&
                                    <span className="category-name">{item['name']}</span>
                                }
                                { layoutStyle.value === 'layout-type-1' &&
                                    showPostCount && (item['count'] != 0) &&
                                    <span className={`category-post-count rishi_sidebar_widget_categories ul li ${categoryClass}`} style={categoryStyle}>
                                        {item['count']}
                                        {postCount}
                                    </span>
                                }
                                { layoutStyle.value === 'layout-type-2' &&
                                    <div className="category-content">
                                        <span className="category-name">{item['name']}</span>
                                        {
                                            showPostCount && (item['count'] != 0) &&
                                            <span className={`category-post-count rishi_sidebar_widget_categories ul li ${categoryClass}`} style={categoryStyle}>
                                                {item['count']}
                                                {postCount}
                                            </span>
                                        }
                                    </div>
                                }
                            </a>
                        </li>
                    )
                }
                )
            }
        </ul>
    </section>
    );
};
