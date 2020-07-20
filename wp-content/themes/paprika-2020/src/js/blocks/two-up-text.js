export default function paprikaTwoUpCardsBlock() {
	const { registerBlockType } = wp.blocks;
	const { InnerBlocks } = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "two-up-columns";
	const blockTitle = "Two Up Columns";
	const blockDescription = "Set of 2 columns";
	const blockCategory = "layout";
	const blockIcon = "editor-table"; // Dashicons: https://developer.wordpress.org/resource/dashicons/

	registerBlockType(`paprika/${blockSlug}`, {
		title: i18n.__(blockTitle),
		description: i18n.__(blockDescription),
		category: blockCategory,
		icon: blockIcon,
		attributes: {},
		edit: (props, editor = false, save = false) => {
			return [
				<div
					className={`custom-card ${
						editor ? "custom-card--editor" : "custom-card--fe"
					}`}
				>
					{save ? (
						<InnerBlocks.Content />
					) : (
						<InnerBlocks
							template={[["paprika/column"], ["paprika/column"]]}
							templateLock="all"
						/>
					)}
				</div>,
			];
		},
		save: ({ attributes }) => {
			return <InnerBlocks.Content />;
		},
	});
}
