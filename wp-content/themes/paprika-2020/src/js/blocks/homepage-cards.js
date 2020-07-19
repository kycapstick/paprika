export default function paprikaHomepageCardsBlock() {
	const { registerBlockType } = wp.blocks;
	const { InnerBlocks, RichText } = wp.blockEditor;
	const { i18n } = wp;

	const blockSlug = "homepage-cards";
	const blockTitle = "Homepage Cards";
	const blockDescription = "Set of 2 cards with related links";
	const blockCategory = "layout";
	const blockIcon = "screenoptions"; // Dashicons: https://developer.wordpress.org/resource/dashicons/

	registerBlockType(`paprika/${blockSlug}`, {
		title: i18n.__(blockTitle),
		description: i18n.__(blockDescription),
		category: blockCategory,
		icon: blockIcon,
		attributes: {
			customColor0: {
				type: "string",
				default: "about",
			},
			customColor1: {
				type: "string",
				default: "about",
			},
		},
		edit: (props, editor = false, save = false) => {
			const { setAttributes, attributes } = props;

			const { customColor0, customColor1 } = attributes;

			function updateAttributeValue(attribute, value) {
				setAttributes({ [attribute]: value });
			}

			return [
				<div
					className={`custom-card ${
						editor ? "custom-card--editor" : "custom-card--fe"
					}`}
				>
					<label class="custom-label" htmlFor="customColor0">
						Card 1 Color
					</label>
					<select
						class="custom-input"
						name="customColor0"
						id="customColor0"
						value={customColor0}
						onChange={(e) => {
							updateAttributeValue(
								"customColor0",
								e.target.value
							);
						}}
					>
						<option value="about" default>
							About
						</option>
						<option value="festivals">Festivals</option>
						<option value="support">Support</option>
						<option value="press">Press</option>
					</select>
					<label class="custom-label" htmlFor="customColor1">
						Card 2 Color
					</label>
					<select
						class="custom-input"
						name="customColor1"
						id="customColor1"
						value={customColor1}
						onChange={(e) => {
							console.log(e.target.value);
							updateAttributeValue(
								"customColor1",
								e.target.value
							);
						}}
					>
						<option value="about" default>
							About
						</option>
						<option value="festivals">Festivals</option>
						<option value="support">Support</option>
						<option value="press">Press</option>
					</select>
					{save ? (
						<InnerBlocks.Content />
					) : (
						<InnerBlocks
							template={[
								["paprika/card-title"],
								["core/image"],
								["paprika/card-title"],
								["core/image"],
							]}
							templateLock="all"
						/>
					)}
				</div>,
			];
		},
		save: ({ attributes }) => {
			const { customColor0, customColor1 } = attributes;
			return <InnerBlocks.Content />;
		},
	});
}
