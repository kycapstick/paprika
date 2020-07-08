export default function paprikaSingleColumnBlock() {
	const { registerBlockType } = wp.blocks;
	const { InnerBlocks } = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "column";
	const blockTitle = "Single Column";
	const blockDescription = "Column for content";
	const blockCategory = "layout";
	const blockIcon = "screenoptions"; // Dashicons: https://developer.wordpress.org/resource/dashicons/

	registerBlockType(`paprika/${blockSlug}`, {
		title: i18n.__(blockTitle),
		description: i18n.__(blockDescription),
		category: blockCategory,
		icon: blockIcon,
		parent: ["paprika/two-up-columns"],
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
							template={[["core/heading"], ["core/paragraph"]]}
							allowedBlocks={[
								"core/heading",
								"core/paragraph",
								"core/list",
							]}
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
