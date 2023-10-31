import { useEffect, useState } from "@wordpress/element";
import { usePosts } from "../_hooks";

const DEFAULT_QUERY = {
    per_page: 100,
    orderby: "date",
    order: "desc",
};

import { BlockSection, PostCard } from "../components";

const PopularPosts = ({ attributes }) => {

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
    } = attributes;

    const [popularPosts, setPopularPosts] = useState([]);

    const allPosts = usePosts({
        ...DEFAULT_QUERY,
        rishi_orderby: popularPostsType,
        rishi_blocks: 'yes',
        per_page: 100,
    })

    useEffect(() => {
        setPopularPosts(allPosts);
    }, [allPosts]);

    return <BlockSection className="rishi_sidebar_widget_popular_post" sectionLabel={popularPostLabel} layoutStyle={layoutStyle}>
        {popularPosts?.slice(0, popularPostCount)?.map((item, index) => {
            return <PostCard key={index} item={{
                ...item,
                showPostThumbnail: popularPostShowThumbnail,
                showDate: popularPostShowDate,
                showViewsCount: popularPostViewCount,
                showCommentsCount: popularPostCommentCount,
                openInNewTab,
                postsBy: popularPostsType
            }}
            />
        })}
    </BlockSection>
}

export default PopularPosts;
