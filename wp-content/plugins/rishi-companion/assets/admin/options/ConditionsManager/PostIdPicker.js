import { useEffect, useState, useMemo } from '@wordpress/element'
import { __ } from '@wordpress/i18n'

const { Select } = window.rishiExports.customizerControls || window.rishiExports.options;
const withUniqueIDs = (data) =>
	data.filter(
		(value, index, self) =>
			self.findIndex((m) => m.ID === value.ID) === index
	)

let allPostsCache = []

const PostIdPicker = ({ condition, onChange }) => {
	const [allPosts, setAllPosts] = useState(allPostsCache)

	const postTypeToDisplay = useMemo(
		() =>
		({
			post_ids: 'post',
			page_ids: 'page',
			custom_post_type_ids: 'ct_cpt',
		}[condition.rule]),
		[condition.rule]
	)

	const currentPostId = useMemo(
		() => (condition.payload || {}).post_id || '',
		[condition.payload && condition.payload.post_id]
	)

	const fetchPosts = (searchQuery = '') => {
		fetch(
			`${wp.ajax.settings.url}?action=rc_get_conditions_all_posts`,
			{
				headers: {
					Accept: 'application/json',
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({
					post_type: postTypeToDisplay,

					...(searchQuery ? { search_query: searchQuery } : {}),
					...(currentPostId ? { alsoInclude: currentPostId } : {}),
				}),
				method: 'POST',
			}
		)
			.then((r) => r.json())
			.then(({ data: { posts } }) => {
				setAllPosts((allPosts) =>
					withUniqueIDs([...allPosts, ...posts])
				)

				allPostsCache = withUniqueIDs([...allPostsCache, ...posts])
			})
	}

	useEffect(() => {
		fetchPosts()
	}, [postTypeToDisplay])

	return (
		<Select
			option={{
				appendToBody: true,
				defaultToFirstItem: false,
				searchPlaceholder: __(
					'Type to search by ID or title...',
					'rishi-companion'
				),
				placeholder:
					condition.rule === 'post_ids'
						? __('Select post', 'rishi-companion')
						: condition.rule === 'page_ids'
							? __('Select page', 'rishi-companion')
							: __('Custom Post Type ID', 'rishi-companion'),
				choices: allPosts
					.filter(({ post_type }) =>
						postTypeToDisplay === 'ct_cpt'
							? post_type !== 'post' && post_type !== 'page'
							: postTypeToDisplay === post_type
					)
					.map((post) => ({
						key: post.ID,
						value: post.post_title,
					})),
				search: true,
			}}
			value={currentPostId}
			onChange={(post_id) => onChange(post_id)}
			onInputValueChange={(value) => {
				if (allPosts.find(({ post_title }) => post_title === value)) {
					return
				}

				fetchPosts(value)
			}}
		/>
	)
}

export default PostIdPicker
