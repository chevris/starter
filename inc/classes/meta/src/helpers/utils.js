/**
 * WordPress dependencies
 */
import { withSelect, withDispatch } from '@wordpress/data';

export const connectWithSelect = withSelect( ( select ) => ( {
	mode: select( 'core/edit-post' ).getEditorMode(),
	metas: select( 'core/editor' ).getEditedPostAttribute( 'meta' ),

	// @todo: Make sure it only return colors added by add_theme_support('editor-color-palette', [...]) without default core editor colors
	colorPalette: select( "core/editor" ).getEditorSettings().colors,

	fontSizeMeta: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ '_theme_slug_meta_font_size' ],
	backgroundColorMeta: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ '_theme_slug_meta_background_color' ],
} ) );

export const connectWithDispatch = withDispatch( ( dispatch ) => ( {

	setMetaValue: ( id, value ) => {
		dispatch( 'core/editor' ).editPost( { meta: { [ id ]: value } } );
	},
} ) )
