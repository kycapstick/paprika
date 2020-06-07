export default function paprikaFinePrintBlock() {
	const { registerBlockType } = wp.blocks;
	const { InnerBlocks, RichText } = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "fine-print";
	const blockTitle = "Fine Print";
	const blockDescription = "Fine print for donor cards";
	const blockCategory = "common";

	registerBlockType(`paprika/${blockSlug}`, {
		title: i18n.__(blockTitle),
		description: i18n.__(blockDescription),
		category: blockCategory,
		parent: ["paprika/donor-two-up"],
		attributes: {
			copy: {
				type: "string",
			},
		},
		edit: (props, editor = false, save = false) => {
			const { setAttributes, attributes } = props;
			const { copy } = attributes;

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
							tagName="p"
							placeholder="Add fine print for donor card."
							keepPlaceholderOnFocus={true}
							value={copy}
							onChange={(changes) => {
								updateAttributeValue("copy", changes);
							}}
						/>
						{save ? <InnerBlocks.Content /> : <InnerBlocks />}
					</div>
				</div>,
			];
		},
		save: ({ attributes }) => {
			const { copy } = attributes;
			return <InnerBlocks.Content />;
		},
	});
}
