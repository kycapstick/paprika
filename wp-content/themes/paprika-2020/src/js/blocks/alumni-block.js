export default function paprikaAlumniBlock() {
	const { registerBlockType } = wp.blocks;
	const { InnerBlocks } = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "alumni";
	const blockTitle = "Alumni Block";
	const blockDescription = "Creates a list of alumni";
	const blockCategory = "about-blocks";
	const blockIcon = "id"; // Dashicons: https://developer.wordpress.org/resource/dashicons/

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
								["paprika/alumnus"],
								["paprika/alumnus"],
								["paprika/alumnus"],
								["paprika/alumnus"],
							]}
							allowedBlocks={["paprika/alumnus"]}
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
