import { useEffect, useState } from '@wordpress/element'
import cls from 'classnames'
import { __ } from '@wordpress/i18n'

const { Select } = window.rishiExports.customizerControls || window.rishiExports.options;

import PostIdPicker from './ConditionsManager/PostIdPicker'

let allPostsCache = []
let allTaxonomiesCache = []
let allLanguagesCache = []

const ConditionsManager = ({ value, onChange }) => {
	const allRules = RishiCompanionAdmin.all_condition_rules
		.reduce(
			(current, { rules, title }) => [
				...current,
				...rules.map((r) => ({
					...r,
					group: title,
				})),
			],
			[]
		)
		.reduce(
			(current, { title, id, ...rest }) => [
				...current,
				{
					key: id,
					value: title,
					...rest,
				},
			],
			[]
		)

	const [allPosts, setAllPosts] = useState(allPostsCache)
	const [allTaxonomies, setAllTaxonomies] = useState(allTaxonomiesCache)
	const [allLanguages, setAllLanguages] = useState(allLanguagesCache)

	const hasAdditions = (condition) =>
		condition.rule === 'post_ids' ||
		condition.rule === 'page_ids' ||
		condition.rule === 'custom_post_type_ids' ||
		condition.rule === 'taxonomy_ids' ||
		condition.rule === 'post_with_taxonomy_ids' ||
		condition.rule === 'current_language'

	useEffect(() => {
		fetch(
			`${wp.ajax.settings.url}?action=rc_get_conditions_all_taxonomies`,
			{
				headers: {
					Accept: 'application/json',
					'Content-Type': 'application/json',
				},
				method: 'POST',
			}
		)
			.then((r) => r.json())
			.then(({ data: { taxonomies, languages } }) => {
				setAllTaxonomies(taxonomies)
				allTaxonomiesCache = taxonomies

				setAllLanguages(languages)
				allLanguagesCache = languages
			})
	}, [])

	return (
		<div className="rt-display-conditions">
			{value.map((condition, index) => (
				<div
					className={cls('rt-condition-group', {
						'rt-cols-3': hasAdditions(condition),
						'rt-cols-2': !hasAdditions(condition),
					})}
					key={index}>
					<Select
						key="first"
						option={{
							inputClassName: 'rt-condition-type',
							selectInputStart: () => (
								<span className={`rt-${condition.type}`} />
							),
							placeholder: __('Select variation', 'rishi-companion'),
							choices: {
								include: __('Include', 'rishi-companion'),
								exclude: __('Exclude', 'rishi-companion'),
							},
						}}
						value={condition.type}
						onChange={(type) => {
							onChange(
								value.map((r, i) => ({
									...(i === index
										? {
											...condition,
											type,
										}
										: r),
								}))
							)
						}}
					/>

					<Select
						key="second"
						option={{
							appendToBody: true,
							placeholder: __('Select rule', 'rishi-companion'),
							choices:
								condition.category === 'user'
									? allRules.filter(
										({ key }) =>
											key.indexOf('user_') === 0
									)
									: allRules.filter(
										({ key }) =>
											key.indexOf('user_') === -1
									),
							search: true,
						}}
						value={condition.rule}
						onChange={(rule) => {
							onChange(
								value.map((r, i) => ({
									...(i === index
										? {
											...condition,
											rule,
										}
										: r),
								}))
							)
						}}
					/>

					{(condition.rule === 'post_ids' ||
						condition.rule === 'custom_post_type_ids' ||
						condition.rule === 'page_ids') && (
							<PostIdPicker
								condition={condition}
								onChange={(post_id) => {
									onChange(
										value.map((r, i) => ({
											...(i === index
												? {
													...condition,
													payload: {
														...condition.payload,
														post_id,
													},
												}
												: r),
										}))
									)
								}}
							/>
						)}

					{(condition.rule === 'taxonomy_ids' ||
						condition.rule === 'post_with_taxonomy_ids') && (
							<Select
								option={{
									appendToBody: true,
									defaultToFirstItem: false,
									placeholder: __('Select taxonomy', 'rishi-companion'),
									choices: allTaxonomies.map((taxonomy) => ({
										key: taxonomy.id,
										value: taxonomy.name,
										...(taxonomy.group
											? { group: taxonomy.group }
											: {}),
									})),
									search: true,
								}}
								value={(condition.payload || {}).taxonomy_id || ''}
								onChange={(taxonomy_id) => {
									onChange(
										value.map((r, i) => ({
											...(i === index
												? {
													...condition,
													payload: {
														...condition.payload,
														taxonomy_id,
													},
												}
												: r),
										}))
									)
								}}
							/>
						)}

					{condition.rule === 'current_language' && (
						<Select
							option={{
								appendToBody: true,
								defaultToFirstItem: false,
								placeholder: __('Select language', 'rishi-companion'),
								choices: allLanguages.map((language) => ({
									key: language.id,
									value: language.name,
								})),
								search: true,
							}}
							value={(condition.payload || {}).language || ''}
							onChange={(language) => {
								onChange(
									value.map((r, i) => ({
										...(i === index
											? {
												...condition,
												payload: {
													...condition.payload,
													language,
												},
											}
											: r),
									}))
								)
							}}
						/>
					)}

					<button
						type="button"
						onClick={(e) => {
							e.preventDefault()

							let newValue = [...value]
							newValue.splice(index, 1)

							onChange(newValue)
						}}>
						×
					</button>
				</div>
			))}

			<div className="rt-conditions-actions">
				<button
					type="button"
					className="button add-condition"
					onClick={(e) => {
						e.preventDefault()

						onChange([
							...value,
							{
								type: 'include',
								rule: 'everywhere',
								payload: {},
							},
						])
					}}>
					{__('Add Display Condition', 'rishi-companion')}
				</button>

				<button
					type="button"
					className="button add-condition"
					onClick={(e) => {
						e.preventDefault()

						onChange([
							...value,
							{
								type: 'include',
								rule: 'user_logged_in',
								payload: {},
								category: 'user',
							},
						])
					}}>
					{__('Add User Condition', 'rishi-companion')}
				</button>
			</div>
		</div>
	)
}
export default ConditionsManager
