export default function paprikaShowCardBlock() {
	const { registerBlockType } = wp.blocks;
	const { InnerBlocks, RichText } = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "image-text";
	const blockTitle = "Image Text Card";
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
