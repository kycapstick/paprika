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
		},
		edit: (props, editor = false, save = false) => {
			const { setAttributes, attributes } = props;
			const { title } = attributes;

			function updateAttributeValue(attribute, value) {
				setAttributes({ [attribute]: value });
			}

			return [
				<InspectorControls>
					<hr />
					<p>Click image to replace.</p>
					<p>Minimum image dimensions: 690 x 460 pixels.</p>
				</InspectorControls>,
				<div
					className={`custom-card ${
						editor ? "custom-card--editor" : "custom-card--fe"
					}`}
				>
					<div>
						<RichText
							class="components-text-control__input"
							tagName="h3"
							id="two-up-card-title"
							placeholder="Add the card's title text here."
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
								template={[
									[
										"core/image",
										{
											className: "col-4",
										},
									],
									[
										"core/image",
										{
											className: "col-8",
										},
									],
								]}
								templateLock="all"
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
