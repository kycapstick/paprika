export default function paprikaDonorTitleBlock() {
	const { registerBlockType } = wp.blocks;
	const { InnerBlocks, RichText } = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "donor-title";
	const blockTitle = "Donor Title";
	const blockDescription = "Tier and title for donor cards";
	const blockCategory = "common";
	const blockIcon = "format-gallery"; // Dashicons: https://developer.wordpress.org/resource/dashicons/

	registerBlockType(`paprika/${blockSlug}`, {
		title: i18n.__(blockTitle),
		description: i18n.__(blockDescription),
		category: blockCategory,
		icon: blockIcon,
		parent: ["paprika/donor-two-up", "paprika/donor-fw"],
		attributes: {
			tier: {
				type: "string",
			},
			title: {
				type: "string",
			},
		},
		edit: (props, editor = false, save = false) => {
			const { setAttributes, attributes } = props;
			const { tier, title } = attributes;

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
							placeholder="Add price value of tier."
							keepPlaceholderOnFocus={true}
							value={tier}
							onChange={(changes) => {
								updateAttributeValue("tier", changes);
							}}
						/>
						<RichText
							class="components-text-control__input"
							tagName="p"
							placeholder="Add title for tier."
							keepPlaceholderOnFocus={true}
							value={title}
							onChange={(changes) => {
								updateAttributeValue("title", changes);
							}}
						/>
						{save ? <InnerBlocks.Content /> : <InnerBlocks />}
					</div>
				</div>,
			];
		},
		save: ({ attributes }) => {
			const { title, tier } = attributes;
			return <InnerBlocks.Content />;
		},
	});
}
