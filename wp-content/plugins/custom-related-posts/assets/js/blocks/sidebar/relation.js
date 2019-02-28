const { Button, Dashicon } = wp.components;

const Relation = (props) => {
	const { post } = props;

	return (
		<li>
			<Button
				className="crp-remove-relation-button"
				onClick={() => props.onRemove(post.id) }
			>
				<Dashicon icon="trash" />
			</Button> <a href={post.permalink} target="_blank">{ post.title }</a>
		</li>
) };

export default Relation;