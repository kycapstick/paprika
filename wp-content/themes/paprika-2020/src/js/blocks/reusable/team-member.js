export default function paprikaCardTitleCopyBlock() {
	const { registerBlockType } = wp.blocks;
	const { InnerBlocks, RichText } = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "team-member";
	const blockTitle = "Creative Team Member";
	const blockDescription = "A single creative team member";
	const blockCategory = "layout";
	const blockIcon = "format-gallery"; // Dashicons: https://developer.wordpress.org/resource/dashicons/

	registerBlockType(`paprika/${blockSlug}`, {
		title: i18n.__(blockTitle),
		description: i18n.__(blockDescription),
		category: blockCategory,
		icon: blockIcon,
		parent: ["paprika/show"],
		attributes: {
			title: {
				type: "string",
			},
			fullName: {
				type: "string",
			},
		},
		edit: (props, editor = false, save = false) => {
			const { setAttributes, attributes } = props;
			const { title, fullName } = attributes;

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
							placeholder="Add title"
							keepPlaceholderOnFocus={true}
							value={title}
							onChange={(changes) => {
								updateAttributeValue("title", changes);
							}}
						/>
						<RichText
							class="components-text-control__input"
							tagName="p"
							placeholder="Add text"
							keepPlaceholderOnFocus={true}
							value={fullName}
							onChange={(changes) => {
								updateAttributeValue("fullName", changes);
							}}
						/>
					</div>
				</div>,
			];
		},
		save: ({ attributes }) => {
			const { title, fullName } = attributes;
			return;
		},
	});
}
