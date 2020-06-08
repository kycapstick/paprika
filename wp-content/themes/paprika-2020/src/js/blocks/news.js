export default function newsBlock() {
	/**
	 * NEWS GUTENBERG BLOCK
	 */

	const { registerBlockType } = wp.blocks;
	const { InnerBlocks, RichText } = wp.blockEditor;
	const { i18n } = wp;

	registerBlockType("paprika/news", {
		title: i18n.__("News Block"),
		description: i18n.__("Pull in a news post"),
		category: "post-blocks",
		icon: "sticky", // Dashicons: https://developer.wordpress.org/resource/dashicons/
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
							tagName="h2"
							placeholder="Add the title here."
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
								template={[["paprika/news-select"]]}
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
