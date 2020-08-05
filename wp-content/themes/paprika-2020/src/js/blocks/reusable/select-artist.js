export default function selectPost() {
	const { registerBlockType } = wp.blocks;
	const { withSelect } = wp.data;
	const { SelectControl } = wp.components;

	const MySelectControl = ({ post, setAttributes, ...props }) => (
		<SelectControl
			label="Select A Post: "
			value={post ? post : 0}
			options={props.options}
			onChange={(post) => {
				setAttributes({ post: post });
			}}
		/>
	);

	registerBlockType("paprika/artist-select", {
		title: "Artist Select",
		description: "Adds an artist block to the page",
		icon: "star-filled",
		category: "common",
		attributes: {
			post: {
				type: "string",
			},
		},
		parent: ["paprika/artist"],
		edit: withSelect((select) => {
			return {
				posts: select("core").getEntityRecords("postType", "artist", {
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
			options.unshift({ value: 0, label: "Select" });

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
