/**
 * WordPress dependencies
 */
import { PluginSidebar, PluginSidebarMoreMenuItem } from '@wordpress/edit-post';
import { __ } from '@wordpress/i18n';
import { compose } from '@wordpress/compose';
import { withDispatch } from '@wordpress/data';
import { useShortcut } from '@wordpress/keyboard-shortcuts';
import { useCallback } from '@wordpress/element';

/**
 * Internal dependencies
 */
import PostStyleSidebarMetaFields from './PostStyleSidebarMetaFields';

const decorate = compose(
	withDispatch( ( dispatch ) => {
		dispatch( 'core/keyboard-shortcuts' ).registerShortcut( {
			name: 'themeslug/open-post-style-sidebar',
			category: 'global',
			description: __( 'Open post style meta sidebar', 'themeslug' ),
			keyCombination: {
				modifier: 'access',
				character: 's',
			},
		} );
	} )
);

const PostStyleSidebar = () => {
	useShortcut(
		'themeslug/open-post-style-sidebar',
		useCallback(
			() => {
				const currentActiveSidebar = wp.data.select( 'core/edit-post' ).getActiveGeneralSidebarName();
				if ( currentActiveSidebar ) {
					wp.data.dispatch( 'core/edit-post' ).closeGeneralSidebar( currentActiveSidebar );
					if ( 'meta-sidebar/themeslug-post-style-sidebar' !== currentActiveSidebar ) {
						wp.data.dispatch( 'core/edit-post' ).openGeneralSidebar( 'meta-sidebar/themeslug-post-style-sidebar' );
					}
				} else {
					wp.data.dispatch( 'core/edit-post' ).openGeneralSidebar( 'meta-sidebar/themeslug-post-style-sidebar' );
				}
			},
			[]
		)
	);

	const sidebarLabel = __( 'Post Styles', 'themeslug' );

	return (
		<>
			<PluginSidebarMoreMenuItem
				target="themeslug-post-style-sidebar"
			>
				{ sidebarLabel }
			</PluginSidebarMoreMenuItem>
			<PluginSidebar
				name="themeslug-post-style-sidebar"
				title={ sidebarLabel }
			>
				<PostStyleSidebarMetaFields />
			</PluginSidebar>
		</>
	);
};

export default decorate( PostStyleSidebar );
