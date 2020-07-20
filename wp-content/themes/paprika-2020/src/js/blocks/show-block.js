export default function paprikaShowCardBlock() {
	const { registerBlockType } = wp.blocks;
	const { InnerBlocks, RichText } = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "show";
	const blockTitle = "Show Card";
	const blockDescription = "Card for show details with related link";
	const blockCategory = "festivals-blocks";
	const blockIcon = "tickets-alt"; // Dashicons: https://developer.wordpress.org/resource/dashicons/

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
						<RichText
							class="components-text-control__input"
							tagName="h3"
							placeholder="Add title"
							keepPlaceholderOnFocus={true}
							value={title}
							onChange={(changes) => {
								updateAttributeValue("title", changes);
							}}
						/>
						{save ? (
							<InnerBlocks.Content />
						) : (
							<InnerBlocks
								template={[["paprika/team-member"]]}
								allowedBlocks={
									(["paprika/team-member"],
									["core/paragraph"])
								}
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
