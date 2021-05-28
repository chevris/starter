import './index.scss';

/**
 * WordPress dependencies
 */
import { registerPlugin } from '@wordpress/plugins';
 
 /**
  * Internal dependencies
  */
import StyleSidebar from './components/StyleSidebar';
import PluginDocumentSettingPanelThemeSlugTypography from './components/TypographyPanel';
import PluginDocumentSettingPanelThemeSlugColors from './components/ColorsPanel';

/*
registerPlugin( 'theme-slug-style-meta-sidebar', {
	icon: 'editor-textcolor',
	render: () => <StyleSidebar name='theme-slug-style-sidebar'/>,
} );
*/

registerPlugin( 'plugin-document-setting-panel-theme-slug-typography', {
	render: PluginDocumentSettingPanelThemeSlugTypography,
	icon: null,
} );

registerPlugin( 'plugin-document-setting-panel-theme-slug-colors', {
	render: PluginDocumentSettingPanelThemeSlugColors,
	icon: null,
} );