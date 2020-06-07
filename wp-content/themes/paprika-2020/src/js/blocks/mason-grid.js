export default function paprikaMasonImageBlock() {
	const { registerBlockType } = wp.blocks;
	const {
		InnerBlocks,
		InspectorControls,
		RichText,
		MediaUpload,
	} = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "mason-image";
	const blockTitle = "Mason Image Container";
	const blockDescription = "Add side by side images with title to the page";
	const blockCategory = "common";
	const blockIcon = "format-gallery"; // Dashicons: https://developer.wordpress.org/resource/dashicons/

	registerBlockType(`paprika/${blockSlug}`, {
		title: i18n.__(blockTitle),
		description: i18n.__(blockDescription),
		category: blockCategory,
		icon: blockIcon,
		attributes: {
			title: {
				type: "string",
			},
			secondaryTitle: {
				type: "string",
			},
			link: {
				type: "string",
			},
			secondaryLink: {
				type: "string",
			},
		},
		edit: (props, editor = false, save = false) => {
			const { setAttributes, attributes } = props;
			const { title, secondaryTitle, link, secondaryLink } = attributes;

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
							tagName="h3"
							placeholder="Add the card's title text here."
							keepPlaceholderOnFocus={true}
							value={title}
							onChange={(changes) => {
								updateAttributeValue("title", changes);
							}}
						/>
						<RichText
							class="components-text-control__input"
							tagName="a"
							placeholder="Add link for first image."
							keepPlaceholderOnFocus={true}
							value={link}
							onChange={(changes) => {
								updateAttributeValue("link", changes);
							}}
						/>
						<RichText
							class="components-text-control__input"
							tagName="h3"
							placeholder="Add title for the second image here."
							keepPlaceholderOnFocus={true}
							value={secondaryTitle}
							onChange={(changes) => {
								updateAttributeValue("secondaryTitle", changes);
							}}
						/>
						<RichText
							class="components-text-control__input"
							tagName="a"
							placeholder="Add link for second image."
							keepPlaceholderOnFocus={true}
							value={secondaryLink}
							onChange={(changes) => {
								updateAttributeValue("secondaryLink", changes);
							}}
						/>
						{save ? (
							<InnerBlocks.Content />
						) : (
							<InnerBlocks
								template={[["core/image"], ["core/image"]]}
								templateLock="all"
							/>
						)}
					</div>
				</div>,
			];
		},
		save: ({ attributes }) => {
			const { title, secondaryTitle, link, secondaryLink } = attributes;
			return <InnerBlocks.Content />;
		},
	});
}
