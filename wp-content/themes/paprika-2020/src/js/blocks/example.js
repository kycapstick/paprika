export default function exampleBlock() {
	/**
	 * EXAMPLE GUTENBERG BLOCK
	 */

	const { registerBlockType } = wp.blocks;
	const { InspectorControls } = wp.editor;
	const { TextControl } = wp.components;
	const { i18n } = wp;

	const block = (attributes, editor = false) => {
		const { title, copy } = attributes;

		return (
			<section className="example-block">
				<div className="example-block__container">
					<h2 className="example-block__title">{title}</h2>
					<p className="example-block__copy">{copy}</p>
				</div>
			</section>
		);
	};

	registerBlockType("pg/block", {
		title: i18n.__("Example Block"),
		description: i18n.__(
			"This is just an example - delete me and create your own!"
		),
		category: "common",
		icon: "star-filled", // Dashicons: https://developer.wordpress.org/resource/dashicons/
		attributes: {
			title: {
				type: "string",
				default: "Example Block Title",
			},
			copy: {
				type: "string",
			},
		},
		edit: (props) => {
			const { setAttributes, attributes } = props;

			const onTextTitleChange = (value) => {
				setAttributes({ title: value });
			};

			const onTextCopyChange = (value) => {
				setAttributes({ copy: value });
			};

			return [
				<InspectorControls>
					<hr />
					<h2>Attributes</h2>
					<div className="nanopay-controls__container">
						<TextControl
							value={attributes.title}
							onChange={onTextTitleChange}
							label="Title"
						/>
					</div>
					<div className="nanopay-controls__container">
						<TextControl
							value={attributes.copy}
							onChange={onTextCopyChange}
							label="Copy"
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
