import './sidebar.scss';

/**
 * WordPress dependencies
 */
import { registerPlugin } from '@wordpress/plugins';
 
 /**
  * Internal dependencies
  */
 import PostStyleSidebar from './components/PostStyleSidebar';
 
 registerPlugin( 'meta-sidebar', {
	 icon: 'admin-post',
	 render: PostStyleSidebar,
 } );