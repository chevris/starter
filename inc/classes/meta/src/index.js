import './index.scss';

/**
 * WordPress dependencies
 */
 import { registerPlugin } from '@wordpress/plugins';
 
 /**
  * Internal dependencies
  */
import StyleSidebar from './components/StyleSidebar';
 
 registerPlugin( 'theme-slug-style-meta-sidebar', {
	icon: 'editor-textcolor',
	render: StyleSidebar,
 } );