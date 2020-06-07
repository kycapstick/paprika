export default function newsBlock() {
	/**
	 * EXAMPLE GUTENBERG BLOCK
	 */

	const { registerBlockType } = wp.blocks;
	const { InspectorControls, RichText } = wp.editor;
	const { TextControl, SelectControl } = wp.components;
	const { i18n } = wp;

	registerBlockType("paprika/news", {
		title: i18n.__("News Block"),
		description: i18n.__("Please enter a title and select a post below"),
		category: "common",
		icon: "shield", // Dashicons: https://developer.wordpress.org/resource/dashicons/
		attributes: {
			title: {
				type: "string",
			},
			options: {
				type: "array",
			},
			selectedPost: {
				type: "number",
				default: 0,
			},
		},
		edit: (props, editor = false, save = false) => {
			const { setAttributes, attributes } = props;
			const { title, selectedPost, options } = attributes;
			function onPostChange(value) {
				setAttributes({ selectedPost: value });
			}

			function onTitleChange(value) {
				setAttributes({ title: value });
			}

			function loadOptions() {
				wp.apiFetch({ path: "/wp/v2/posts?per_page=-1" }).then(
					function (posts) {
						const options = posts.map((post) => {
							return {
								value: post.id,
								label: post.title.rendered,
							};
						});
						setAttributes({ options });
					}
				);
			}

			return [
				<section className="example-block">
					<div className="nanopay-controls__container">
						<RichText
							class="components-text-control__input"
							tagName="p"
							placeholder="Add an optional subtitle text here."
							keepPlaceholderOnFocus={true}
							value={title}
							onChange={onTitleChange}
							label="Title"
						/>
					</div>
					<div className="nanopay-controls__container">
						<SelectControl
							value={selectedPost}
							onChange={onPostChange}
							onClick={() => {
								if (options.length <= 1) {
									return loadOptions();
								}
							}}
							label="Post"
							options={options}
						/>
					</div>
				</section>,
			];
		},
		save: ({ attributes }) => {
			const { title, selectedPost, options } = attributes;
		},
	});
}
