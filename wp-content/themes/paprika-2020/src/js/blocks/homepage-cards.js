export default function paprikaHomepageCardsBlock() {
	const { registerBlockType } = wp.blocks;
	const {
		InnerBlocks,
		InspectorControls,
		RichText,
		MediaUpload,
	} = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "homepage-cards";
	const blockTitle = "Homepage Cards";
	const blockDescription = "Set of 4 cards with related links";
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
			secondTitle: {
				type: "string",
			},
			thirdTitle: {
				type: "string",
			},
			fourthTitle: {
				type: "string",
			},
			link: {
				type: "string",
			},
			secondLink: {
				type: "string",
			},
			thirdLink: {
				type: "string",
			},
			fourthLink: {
				type: "string",
			},
		},
		edit: (props, editor = false, save = false) => {
			const { setAttributes, attributes } = props;
			const {
				title,
				secondTitle,
				thirdTitle,
				fourthTitle,
				link,
				secondLink,
				thirdLink,
				fourthLink,
			} = attributes;

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
							value={secondTitle}
							onChange={(changes) => {
								updateAttributeValue("secondTitle", changes);
							}}
						/>
						<RichText
							class="components-text-control__input"
							tagName="a"
							placeholder="Add link for second image."
							keepPlaceholderOnFocus={true}
							value={secondLink}
							onChange={(changes) => {
								updateAttributeValue("secondLink", changes);
							}}
						/>
						<RichText
							class="components-text-control__input"
							tagName="h3"
							placeholder="Add a title for the third card here."
							keepPlaceholderOnFocus={true}
							value={thirdTitle}
							onChange={(changes) => {
								updateAttributeValue("thirdTitle", changes);
							}}
						/>
						<RichText
							class="components-text-control__input"
							tagName="a"
							placeholder="Add link for the third card."
							keepPlaceholderOnFocus={true}
							value={thirdLink}
							onChange={(changes) => {
								updateAttributeValue("thirdLink", changes);
							}}
						/>
						<RichText
							class="components-text-control__input"
							tagName="h3"
							placeholder="Add title for the fourth card."
							keepPlaceholderOnFocus={true}
							value={fourthTitle}
							onChange={(changes) => {
								updateAttributeValue("fourthTitle", changes);
							}}
						/>
						<RichText
							class="components-text-control__input"
							tagName="a"
							placeholder="Add link for fourth card."
							keepPlaceholderOnFocus={true}
							value={fourthLink}
							onChange={(changes) => {
								updateAttributeValue("fourthLink", changes);
							}}
						/>
						{save ? (
							<InnerBlocks.Content />
						) : (
							<InnerBlocks
								template={[
									["core/image"],
									["core/image"],
									["core/image"],
									["core/image"],
								]}
								templateLock="all"
							/>
						)}
					</div>
				</div>,
			];
		},
		save: ({ attributes }) => {
			const {
				title,
				secondTitle,
				thirdTitle,
				fourthTitle,
				link,
				secondLink,
				thirdLink,
				fourthLink,
			} = attributes;
			return <InnerBlocks.Content />;
		},
	});
}
