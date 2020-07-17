export default function participantsBlock() {
	/**
	 * SCHEDULE GUTENBERG BLOCK
	 */

	const { registerBlockType } = wp.blocks;
	const { InnerBlocks, RichText } = wp.blockEditor;
	const { i18n } = wp;

	registerBlockType("paprika/participants", {
		title: i18n.__("Participants Block"),
		description: i18n.__("Builds a set of participant links"),
		category: "post-blocks",
		icon: "calendar-alt", // Dashicons: https://developer.wordpress.org/resource/dashicons/
		edit: (props, editor = false, save = false) => {
			return [
				<div
					className={`custom-card ${
						editor ? "custom-card--editor" : "custom-card--fe"
					}`}
				>
					<div>
						<p> This non-editable block adds participants.</p>
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
