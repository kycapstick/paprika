export default function paprikaImageTextReverseBlock() {
	const { registerBlockType } = wp.blocks;
	const { InnerBlocks, RichText } = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "image-text-reverse";
	const blockTitle = "Image Text Reverse";
	const blockDescription = "Card with image beside text";
	const blockCategory = "layout";
	const blockIcon = "align-left"; // Dashicons: https://developer.wordpress.org/resource/dashicons/

	registerBlockType(`paprika/${blockSlug}`, {
		title: i18n.__(blockTitle),
		description: i18n.__(blockDescription),
		category: blockCategory,
		icon: blockIcon,
		attributes: {
			title: {
				type: "string",
			},
		},
		edit: (props, editor = false, save = false) => {
			const { setAttributes, attributes } = props;
			const { title } = attributes;

			function updateAttributeValue(attribute, value) {
				setAttributes({ [attribute]: value });
			}

			return [
				<div
					className={`custom-card ${
						editor ? "custom-card--editor" : "custom-card--fe"
					}`}
				>
					<RichText
						class="components-text-control__input"
						tagName="h2"
						placeholder="Add the optional title here."
						keepPlaceholderOnFocus={true}
						value={title}
						onChange={(changes) => {
							updateAttributeValue("title", changes);
						}}
					/>
					<div>
						{save ? (
							<InnerBlocks.Content />
						) : (
							<InnerBlocks
								template={[["core/image"], ["core/paragraph"]]}
								allowedBlocks={["core/paragraph"]}
							/>
						)}
					</div>
				</div>,
			];
		},
		save: ({ attributes }) => {
			const { title } = attributes;
			return <InnerBlocks.Content />;
		},
	});
}
