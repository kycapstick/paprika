export default function paprikaCardTitleBlock() {
	const { registerBlockType } = wp.blocks;
	const { InnerBlocks, RichText } = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "card-title";
	const blockTitle = "Card Title";
	const blockDescription = "Title and links for cards";
	const blockCategory = "common";
	const blockIcon = "format-gallery"; // Dashicons: https://developer.wordpress.org/resource/dashicons/

	registerBlockType(`paprika/${blockSlug}`, {
		title: i18n.__(blockTitle),
		description: i18n.__(blockDescription),
		category: blockCategory,
		icon: blockIcon,
		parent: [
			"paprika/homepage-cards",
			"paprika/reverse-mason-image",
			"paprika/mason-image",
			"paprika/mason-three-up",
		],
		attributes: {
			title: {
				type: "string",
			},
			link: {
				type: "string",
			},
		},
		edit: (props, editor = false, save = false) => {
			const { setAttributes, attributes } = props;
			const { title, link } = attributes;

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
							placeholder="Add optional card title."
							keepPlaceholderOnFocus={true}
							value={title}
							onChange={(changes) => {
								updateAttributeValue("title", changes);
							}}
						/>
						<RichText
							class="components-text-control__input"
							tagName="p"
							placeholder="Add optional link for card."
							keepPlaceholderOnFocus={true}
							value={link}
							onChange={(changes) => {
								updateAttributeValue("link", changes);
							}}
						/>
						{save ? <InnerBlocks.Content /> : <InnerBlocks />}
					</div>
				</div>,
			];
		},
		save: ({ attributes }) => {
			const { title, link } = attributes;
			return <InnerBlocks.Content />;
		},
	});
}
