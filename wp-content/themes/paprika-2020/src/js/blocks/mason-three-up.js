export default function paprikaThreeUpImageBlock() {
	const { registerBlockType } = wp.blocks;
	const { InnerBlocks, RichText } = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "mason-three-up";
	const blockTitle = "Mason Three Up Image Block";
	const blockDescription =
		"Add three equally spaced images with title to the page";
	const blockCategory = "image-blocks";
	const blockIcon = "format-gallery"; // Dashicons: https://developer.wordpress.org/resource/dashicons/

	registerBlockType(`paprika/${blockSlug}`, {
		title: i18n.__(blockTitle),
		description: i18n.__(blockDescription),
		category: blockCategory,
		icon: blockIcon,
		edit: (props, editor = false, save = false) => {
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
								template={[
									["paprika/card-title"],
									["core/image"],
									["paprika/card-title"],
									["core/image"],
									["paprika/card-title"],
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
			return <InnerBlocks.Content />;
		},
	});
}
