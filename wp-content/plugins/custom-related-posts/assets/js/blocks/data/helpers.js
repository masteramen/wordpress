const { apiFetch } = wp;
const { withSelect } = wp.data;

export default {
    selectRelationsForCurrentPost: withSelect( ( select, ownProps ) => {
        const { getCurrentPostId } = select( 'core/editor' );

        const postId = getCurrentPostId();
        const relations = select( 'custom-related-posts' ).getRelations( null, {
            postId,
        } );
    
        // Component doesn't update when passing along relations only. Problem because of "isShallowEqual"?
        return {
            postId,
            relations,
            relationToIDs: Object.keys(relations.to).map((id) => parseInt(id)),
            relationFromIDs: Object.keys(relations.from).map((id) => parseInt(id)),
        }
    } ),
    saveRelation: (base, target, type) => {
        apiFetch( {
            path: `custom-related-posts/v1/relations/${ base }`,
            method: 'POST',
            data: {
                target,
                type,
            },
        } );
    },
    removeRelation: (base, target, type) => {
        apiFetch( {
            path: `custom-related-posts/v1/relations/${ base }`,
            method: 'DELETE',
            data: {
                target,
                type,
            },
        } );
    },
}