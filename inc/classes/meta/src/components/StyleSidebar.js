/**
 * WordPress dependencies
 */
import { withPluginContext } from '@wordpress/plugins';
import { PluginSidebar, PluginSidebarMoreMenuItem } from '@wordpress/edit-post';
import { __ } from '@wordpress/i18n';
import { compose } from '@wordpress/compose';
import { withDispatch, withSelect } from '@wordpress/data';
import { useShortcut } from '@wordpress/keyboard-shortcuts';
import { useCallback } from '@wordpress/element';
 
 /**
  * Internal dependencies
  */
 import StyleSidebarMetaFields from './StyleSidebarMetaFields';
 
 const decorate = compose(
	withPluginContext((context, { name }) => ({
		sidebarName: `${context.name}/${name}`,
	})),

	withSelect( ( select, { sidebarName } ) => {

		return {
			isActive: select('core/edit-post').getActiveGeneralSidebarName() === sidebarName,
		}
	} ),

	withDispatch( ( dispatch ) => {
		dispatch( 'core/keyboard-shortcuts' ).registerShortcut( {
			name: 'themeslug/open-style-sidebar',
			category: 'global',
			description: __( 'Open post style sidebar', 'themeslug' ),
			keyCombination: {
				modifier: 'access',
				character: 's',
			},
		} );
	} )
 );
 
 const StyleSidebar = (
	{
		name,
		isActive,
	}
 ) => {
	 useShortcut(
		 'themeslug/open-style-sidebar',
		 useCallback(
			 () => {
				 const currentActiveSidebar = wp.data.select( 'core/edit-post' ).getActiveGeneralSidebarName();
				 if ( currentActiveSidebar ) {
					 wp.data.dispatch( 'core/edit-post' ).closeGeneralSidebar( currentActiveSidebar );
					 if ( 'theme-slug-style-meta-sidebar/theme-slug-style-sidebar' !== currentActiveSidebar ) {
						 wp.data.dispatch( 'core/edit-post' ).openGeneralSidebar( 'theme-slug-style-meta-sidebar/theme-slug-style-sidebar' );
					 }
				 } else {
					 wp.data.dispatch( 'core/edit-post' ).openGeneralSidebar( 'theme-slug-style-meta-sidebar/theme-slug-style-sidebar' );
				 }
			 },
			 []
		 )
	 );
 
	const sidebarLabel = themeslugMetaLocalize.post_type_name + ' ' + __( 'Style', 'themeslug' );
 
	return (
		<>
			<PluginSidebarMoreMenuItem
			target={name}
			icon='editor-textcolor'
			>
			{ sidebarLabel }
			</PluginSidebarMoreMenuItem>
			<PluginSidebar
			name={name}
			title={ sidebarLabel }
			>
				<StyleSidebarMetaFields />
			</PluginSidebar>
		</>
	);
 };
 
 export default decorate( StyleSidebar );
 