import { stringify } from 'querystringify';

const { __ } = wp.i18n;
const { apiFetch } = wp;
const { Component } = wp.element;
const { Modal } = wp.components;

import '../../../css/admin/modal.scss';
import Post from './post';

class AddRelationModal extends Component {
	constructor() {
		super( ...arguments );

		this.state = {
            search: '',
            posts: [],
            updatingPosts: false,
            needToUpdatePosts: false,
		}
    }

    onChangeSearch(event) {
        const search = event.target.value;

        if ( search !== this.state.search ) {
            this.setState({
                search,
                needToUpdatePosts: true,
            });
        }
    }

    componentDidUpdate() {
        if ( this.state.needToUpdatePosts ) {
            this.updatePosts();
        }
    }

    updatePosts() {
        if ( ! this.state.updatingPosts ) {
            if ( this.state.search.length < 2 ) {
                this.setState({
                    updatingPosts: false,
                    needToUpdatePosts: false,
                    posts: [],
                });
            } else {
                this.setState({
                    updatingPosts: true,
                    needToUpdatePosts: false,
                });

                const request = apiFetch( {
                    path: `/custom-related-posts/v1/search?${ stringify( {
                        keyword: this.state.search,
                    } ) }`,
                } );

                request.then( ( posts ) => {
                    this.setState( {
                        posts,
                        updatingPosts: false,
                    } );
                } );
            }
        }
    }

	render() {
        return (
            <Modal
                title={ __( 'Add Relations') }
                onRequestClose={ this.props.onClose }
                focusOnMount={ false }
                className="crp-add-relations-modal"
            >
                <div className="crp-add-relations">
                    <input
                        autoFocus
                        type="text"
                        placeholder={ __( 'Start typing to search...' ) }
                        className="crp-add-relations-search"
                        value={ this.state.search }
                        onChange={ this.onChangeSearch.bind(this) }
                    />
                    <table className="crp-add-relations-posts">
                        <thead>
                            <tr>
                                <th>{ __( 'Post Type' ) }</th>
                                <th>{ __( 'Date' ) }</th>
                                <th>{ __( 'Title' ) }</th>
                                <th>{ __( 'Link' ) }</th>
                            </tr>
                        </thead>
                        {
                            0 === this.state.posts.length
                            ?
                            <tbody>
                                <tr>
                                    <td colspan="4">
                                        <em>No posts found.</em>
                                    </td>
                                </tr>
                            </tbody>
                            :
                            <tbody>
                                {
                                    this.state.posts.map( (post, index) => {
                                        return (
                                            <Post
                                                post={post}
                                                key={index}
                                            />
                                        )
                                    })
                                }
                            </tbody>
                        }
                    </table>
                </div>
            </Modal>
        );
    }
}

export default AddRelationModal;