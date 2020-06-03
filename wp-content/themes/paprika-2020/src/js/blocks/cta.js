export default function ctaBlock() {
	/**
	 * CTA GUTENBERG BLOCK
	 */

	const { registerBlockType } = wp.blocks;
	const {
		InnerBlocks,
		InspectorControls,
		RichText,
		MediaUpload,
	} = wp.blockEditor;
	const { TextControl } = wp.components;
	const { i18n } = wp;

	const block = (attributes, editor = false) => {
		const { title, copy, url, actionText } = attributes;

		return (
			<section className="cta-block">
				<div className="cta-block__container">
					<h2 className="cta-block__title">{title}</h2>
					<p className="cta-block__copy">{copy}</p>
					<button href={url}>{actionText}</button>
				</div>
			</section>
		);
	};

	registerBlockType("paprika/cta", {
		title: i18n.__("CTA Block"),
		description: i18n.__("A call to action"),
		category: "common",
		icon: "dashicons-external", // Dashicons: https://developer.wordpress.org/resource/dashicons/
		attributes: {
			title: {
				type: "string",
			},
			copy: {
				type: "string",
			},
		},
		edit: (props, editor = false, save = false) => {
			const { setAttributes, attributes } = props;
			const { title, copy } = attributes;

			function updateAttributeValue(attribute, value) {
				setAttributes({ [attribute]: value });
			}

			return [
				<div
					className={`custom-card ${
						editor ? "custom-card--editor" : "custom-card--fe"
					}`}
				>
					<div>
						<RichText
							class="components-text-control__input"
							tagName="h2"
							placeholder="Add the cta title text here."
							keepPlaceholderOnFocus={true}
							value={title}
							onChange={(changes) => {
								updateAttributeValue("title", changes);
							}}
						/>
						<RichText
							class="components-text-control__input"
							tagName="p"
							placeholder="Add the cta copy here."
							keepPlaceholderOnFocus={true}
							value={copy}
							onChange={(changes) => {
								updateAttributeValue("copy", changes);
							}}
						/>

						{save ? (
							<InnerBlocks.Content />
						) : (
							<InnerBlocks allowedBlocks={["core/button"]} />
						)}
					</div>
				</div>,
			];
		},
		save: ({ attributes }) => {
			const { title, copy } = attributes;
			return <InnerBlocks.Content />;
		},
	});
}
