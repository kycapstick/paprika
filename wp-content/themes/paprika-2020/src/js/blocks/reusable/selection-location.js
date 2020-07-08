export default function selectLocation() {
	const { registerBlockType } = wp.blocks;
	const { withSelect } = wp.data;
	const { SelectControl } = wp.components;

	const MySelectControl = ({ post, setAttributes, ...props }) => (
		<SelectControl
			label="Select A Location: "
			value={post ? post : 0}
			options={props.options}
			onChange={(post) => {
				setAttributes({ post: post });
			}}
		/>
	);

	registerBlockType("paprika/location-select", {
		title: "Location Select",
		description: "Adds a locaton post to the page",
		icon: "star-filled",
		category: "common",
		attributes: {
			post: {
				type: "string",
			},
		},
		parent: ["paprika/location"],
		edit: withSelect((select) => {
			return {
				posts: select("core").getEntityRecords("postType", "location", {
					per_page: -1,
				}),
			};
		})(({ posts, attributes, setAttributes }) => {
			if (!posts) {
				return "Loading...";
			}

			if (posts && posts.length === 0) {
				return "No posts";
			}
			const options = posts.map((post) => {
				return {
					value: post.id,
					label: post.title.rendered,
				};
			});

			return (
				<div>
					<MySelectControl
						setAttributes={setAttributes}
						options={options}
						post={attributes.post}
					/>
				</div>
			);
		}),
		save: function ({ attributes }) {
			const { post } = attributes;
		},
	});
}
