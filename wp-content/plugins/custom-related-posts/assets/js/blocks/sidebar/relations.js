const { __ } = wp.i18n;

const { Fragment } = wp.element;
const { compose } = wp.compose;
const { withDispatch } = wp.data;

import Data from '../data/helpers';
import Relation from './relation';

const relationsList = (relations, onRemoveRelation) => {
	return (
		<ul>
			{
				Object.keys(relations).map( (key) => {
					let post = relations[key];
					
					return (
						<Relation
							post={post}
							key={key}
							onRemove={onRemoveRelation}
						/>
					)
				})
			}
		</ul>
	);
};

function Relations( props ) {
	const { relations, relationToIDs, relationFromIDs } = props;

	return (
		<Fragment>
			{
				0 < relationToIDs.length
				&&
				<Fragment>
					<h3>{ __( 'This post links to' )}</h3>
					{ relationsList(relations.to, props.onRemoveRelationTo ) }
				</Fragment>
			}
			{
				0 < relationFromIDs.length
				&&
				<Fragment>
					<h3>{ __( 'This post get links from' )}</h3>
					{ relationsList(relations.from, props.onRemoveRelationFrom ) }
				</Fragment>
			}
		</Fragment>
) };

const applyWithDispatch = withDispatch( ( dispatch, ownProps ) => {
	const { removeRelationTo, removeRelationFrom } = dispatch( 'custom-related-posts' );

    return {
		onRemoveRelationTo: ( target ) => {
			return removeRelationTo( ownProps.postId, target );
		},
		onRemoveRelationFrom: ( target ) => {
			return removeRelationFrom( ownProps.postId, target );
		},
    }
} );

export default compose(
    Data.selectRelationsForCurrentPost,
    applyWithDispatch
)( Relations );