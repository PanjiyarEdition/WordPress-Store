import { useState, useMemo, useEffect } from "@wordpress/element";
import apiFetch from "@wordpress/api-fetch";
import { addQueryArgs } from "@wordpress/url";

const goFetch = async (url, query) => {
    const response = await apiFetch({
        path: addQueryArgs(url, query),
        method: "GET",
    })

    return await response
}

const usePosts = (query) => {
    const [posts, setPosts] = useState([])

    useEffect(() => {
        goFetch(`/wp/v2/posts?_embed`, query)
            .then(response => setPosts(response?.map((item) => {
                let options = { year: 'numeric', month: 'long', day: 'numeric' };
                let date_new = new Date(item.date).toLocaleDateString("en-US", options);
                return {
                    id: item.id,
                    image: item?._embedded?.['wp:featuredmedia'] ? item._embedded?.['wp:featuredmedia']?.['0']?.source_url : "",
                    title: item.title.rendered,
                    content: item.content.rendered,
                    author: item.author,
                    type: item.type,
                    link: item.link,
                    date: item.date,
                    date_new: date_new,
                    status: item.status,
                    cat_lists: item?._embedded?.['wp:term']?.['0'] ? item._embedded['wp:term']['0'] : [],
                    commentCount: item.comments_count,
                    meta: item?.meta?.['_rishi_post_view_count'],
                }
            })))
    }, []);

    return posts
}

const usePostCategories = query => {
    const [data, setData] = useState([])

    useEffect(() => {
        goFetch(`wp/v2/categories`, query)
            .then(response => setData(response?.map((item) => {
                return {
                    id: item.id,
                    count: item.count,
                    name: item.name,
                    taxonomy: item.taxonomy,
                    image: item.image_url,
                    link: item.link,
                }
            })))
    }, []);

    return data
}

export { usePosts, usePostCategories, goFetch }
