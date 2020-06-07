export default function newsBlock() {
	/**
	 * EXAMPLE GUTENBERG BLOCK
	 */

	const { registerBlockType } = wp.blocks;
	const { InspectorControls } = wp.editor;
	const { TextControl, SelectControl } = wp.components;
	const { i18n } = wp;

	const block = (attributes, editor = false) => {
		const { title } = attributes;

		return (
			<section className="example-block">
				<h2>{title}</h2>
			</section>
		);
	};

	registerBlockType("paprika/news", {
		title: i18n.__("News Block"),
		description: i18n.__("Please enter a title and select a post below"),
		category: "common",
		icon: "shield", // Dashicons: https://developer.wordpress.org/resource/dashicons/
		attributes: {
			title: {
				type: "string",
				default: "Add title and post in sidebar",
			},
			options: {
				type: "array",
				default: [{ value: null, label: "Select", disabled: true }],
			},
			selectedPost: {
				type: "number",
				default: 0,
			},
		},
		edit: (props) => {
			const { setAttributes, attributes } = props;

			const onPostChange = (value) => {
				setAttributes({ selectedPost: value });
			};

			const onTitleChange = (value) => {
				setAttributes({ title: value });
			};

			const loadOptions = () => {
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
			};

			return [
				<InspectorControls>
					<hr />
					<h2>Attributes</h2>
					<div className="nanopay-controls__container">
						<TextControl
							value={attributes.title}
							onChange={onTitleChange}
							label="Title"
						/>
					</div>
					<div className="nanopay-controls__container">
						<SelectControl
							value={attributes.selectedPost}
							onChange={onPostChange}
							onClick={() => {
								if (attributes.options.length <= 1) {
									return loadOptions();
								}
							}}
							label="Post"
							options={attributes.options}
						/>
					</div>
				</InspectorControls>,
				block(attributes, true),
			];
		},
		save: (props) => {
			const { attributes } = props;
			return block(attributes, false);
		},
	});
}
