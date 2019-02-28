const { __ } = wp.i18n;
const { Fragment } = wp.element;
const { Button } = wp.components;
const { compose } = wp.compose;
const { withDispatch } = wp.data;

import Data from '../data/helpers';

function Post( props ) {
	const { post, relationToIDs, relationFromIDs } = props;

	let linked = false;
	if ( relationToIDs.includes(post.id) && relationFromIDs.includes(post.id) ) {
		linked = 'both';
	} else if ( relationToIDs.includes(post.id) ) {
		linked = 'to';
	} else if ( relationFromIDs.includes(post.id) ) {
		linked = 'from';
	}

	return (
		<tr>
			<td>{ post.post_type }</td>
			<td>{ post.date_display }</td>
			<td><a href={ post.permalink} target="_blank">{ post.title }</a></td>
			<td>
				{
					'both' === linked
					?
					<Button
						isDefault={true}
						disabled={true}
					>{ __( 'Already linked' ) }</Button>
					:
					<Fragment>
						<Button
							className="crp-add-relations-button-to"
							isDefault={true}
							disabled={ false !== linked }
							onClick={ () => props.onAddRelationTo( post ) }
						>{ __( 'To' ) }</Button>
						<Button
							className="crp-add-relations-button-both"
							isPrimary={true}
							onClick={ () => props.onAddRelationBoth( post ) }
						>{ __( 'Both' ) }</Button>
						<Button
							className="crp-add-relations-button-from"
							isDefault={true}
							disabled={ false !== linked }
							onClick={ () => props.onAddRelationFrom( post ) }
						>{ __( 'From' ) }</Button>
					</Fragment>
				}
			</td>
		</tr>
) };

const applyWithDispatch = withDispatch( ( dispatch, ownProps ) => {
	const { addRelationTo, addRelationBoth, addRelationFrom } = dispatch( 'custom-related-posts' );

    return {
		onAddRelationTo: ( post ) => {
			return addRelationTo( ownProps.postId, post );
		},
		onAddRelationBoth: ( post ) => {
			return addRelationBoth( ownProps.postId, post );
		},
		onAddRelationFrom: ( post ) => {
			return addRelationFrom( ownProps.postId, post );
		},
    }
} );

export default compose(
    Data.selectRelationsForCurrentPost,
    applyWithDispatch
)( Post );