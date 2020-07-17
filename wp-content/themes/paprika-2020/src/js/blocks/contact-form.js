export default function contactFormBlock() {
	/**
	 * CONTACT FORM GUTENBERG BLOCK
	 */

	const { registerBlockType } = wp.blocks;
	const { InnerBlocks, RichText } = wp.blockEditor;
	const { i18n } = wp;

	registerBlockType("paprika/contact-form", {
		title: i18n.__("Contact Form Block"),
		description: i18n.__("Builds a contact form"),
		category: "post-blocks",
		icon: "admin-customizer", // Dashicons: https://developer.wordpress.org/resource/dashicons/
		edit: (props, editor = false, save = false) => {
			return [
				<div
					className={`custom-card ${
						editor ? "custom-card--editor" : "custom-card--fe"
					}`}
				>
					<div>
						<p> This non-editable block adds a contact form.</p>
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
