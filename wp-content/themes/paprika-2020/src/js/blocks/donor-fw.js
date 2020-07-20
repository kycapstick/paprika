export default function paprikaDonorFWBlock() {
	const { registerBlockType } = wp.blocks;
	const { InnerBlocks } = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "donor-fw";
	const blockTitle = "Full Width Donor Card";
	const blockDescription = "Full width donor card";
	const blockCategory = "support-blocks";
	const blockIcon = "awards"; // Dashicons: https://developer.wordpress.org/resource/dashicons/

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
					{save ? (
						<InnerBlocks.Content />
					) : (
						<InnerBlocks
							template={[
								["paprika/donor-title"],
								["core/paragraph"],
								["core/list"],
								["paprika/fine-print"],
							]}
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
