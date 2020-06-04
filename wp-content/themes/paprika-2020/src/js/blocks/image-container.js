export default function rgcTwoUpCardContainerBlock() {
	const { registerBlockType } = wp.blocks;
	const {
		InnerBlocks,
		InspectorControls,
		RichText,
		MediaUpload,
	} = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "image-container";
	const blockTitle = "Image Container";
	const blockDescription = "Add an image to the page";
	const blockCategory = "common";
	const blockIcon = "screenoptions"; // Dashicons: https://developer.wordpress.org/resource/dashicons/

	registerBlockType(`paprika/${blockSlug}`, {
		title: i18n.__(blockTitle),
		description: i18n.__(blockDescription),
		category: blockCategory,
		icon: blockIcon,
		attributes: {
			imageUrl: {
				type: "string",
				default:
					"https://via.placeholder.com/690x460.png?text=Click+to+replace+this+image",
			},
			imageId: {
				type: "string",
				default: "",
			},
			imageAlt: {
				type: "string",
				default: "Placeholder Image",
			},
			title: {
				type: "string",
			},
		},
		edit: (props, editor = false, save = false) => {
			const { setAttributes, attributes } = props;
			const { imageUrl, imageId, imageAlt, title } = attributes;

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
						<MediaUpload
							onSelect={(image) => {
								updateAttributeValue(
									"imageUrl",
									image.sizes.full.url
								);
								updateAttributeValue("imageAlt", image.alt);
								updateAttributeValue("imageId", image.id);
							}}
							type="image"
							render={({ open }) => {
								return <img src={imageUrl} onClick={open} />;
							}}
						/>
					</div>
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
								allowedBlocks={[
									"core/paragraph",
									"core/button",
									"pg/subtitle",
								]}
							/>
						)}
					</div>
				</div>,
			];
		},
		save: ({ attributes }) => {
			const { imageUrl, imageId, imageAlt, title } = attributes;
			return <InnerBlocks.Content />;
		},
	});
}
