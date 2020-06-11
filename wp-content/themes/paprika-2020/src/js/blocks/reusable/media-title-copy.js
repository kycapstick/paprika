export default function paprikaCardTitleCopyBlock() {
	const { registerBlockType } = wp.blocks;
	const { InnerBlocks, RichText } = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "media-title-copy";
	const blockTitle = "Media Title Copy";
	const blockDescription = "Title and copy for media cards";
	const blockCategory = "common";
	const blockIcon = "format-gallery"; // Dashicons: https://developer.wordpress.org/resource/dashicons/

	registerBlockType(`paprika/${blockSlug}`, {
		title: i18n.__(blockTitle),
		description: i18n.__(blockDescription),
		category: blockCategory,
		icon: blockIcon,
		parent: ["paprika/media-quote"],
		attributes: {
			title: {
				type: "string",
			},
			subtitle: {
				type: "string",
			},
		},
		edit: (props, editor = false, save = false) => {
			const { setAttributes, attributes } = props;
			const { title, subtitle } = attributes;

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
							placeholder="Headline."
							keepPlaceholderOnFocus={true}
							value={title}
							onChange={(changes) => {
								updateAttributeValue("title", changes);
							}}
						/>
						<RichText
							class="components-text-control__input"
							tagName="p"
							placeholder="Add optional speaker."
							keepPlaceholderOnFocus={true}
							value={subtitle}
							onChange={(changes) => {
								updateAttributeValue("subtitle", changes);
							}}
						/>
						{save ? <InnerBlocks.Content /> : <InnerBlocks />}
					</div>
				</div>,
			];
		},
		save: ({ attributes }) => {
			const { title, subtitle } = attributes;
			return <InnerBlocks.Content />;
		},
	});
}
