export default function scheduleBlock() {
	/**
	 * SCHEDULE GUTENBERG BLOCK
	 */

	const { registerBlockType } = wp.blocks;
	const { InnerBlocks, RichText } = wp.blockEditor;
	const { i18n } = wp;

	registerBlockType("paprika/schedule", {
		title: i18n.__("Schedule Block"),
		description: i18n.__("Builds a schedule"),
		category: "festivals-blocks",
		icon: "calendar-alt", // Dashicons: https://developer.wordpress.org/resource/dashicons/
		edit: (props, editor = false, save = false) => {
			return [
				<div
					className={`custom-card ${
						editor ? "custom-card--editor" : "custom-card--fe"
					}`}
				>
					<div>
						<p> This non-editable block adds a schedule.</p>
						{save ? (
							<InnerBlocks.Content />
						) : (
							<InnerBlocks template={[]} templateLock="all" />
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
