/**
 * WordPress dependencies
 */
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { __ } from '@wordpress/i18n';
import { useEffect, useRef } from '@wordpress/element';
  
/**
 * Internal dependencies
 */
import { connectWithSelect } from '../helpers/utils';
import FontSizeField from './FontSizeField';

const PluginDocumentSettingPanelThemeSlugTypography = ( { fontSizeMeta } ) => {

	const modifyIcon = <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><rect fill="none" height="24" width="24"/><path d="M12,2C6.48,2,2,6.48,2,12c0,5.52,4.48,10,10,10s10-4.48,10-10C22,6.48,17.52,2,12,2z M12.06,19v-2.01c-0.02,0-0.04,0-0.06,0 c-1.28,0-2.56-0.49-3.54-1.46c-1.71-1.71-1.92-4.35-0.64-6.29l1.1,1.1c-0.71,1.33-0.53,3.01,0.59,4.13c0.7,0.7,1.62,1.03,2.54,1.01 v-2.14l2.83,2.83L12.06,19z M16.17,14.76l-1.1-1.1c0.71-1.33,0.53-3.01-0.59-4.13C13.79,8.84,12.9,8.5,12,8.5c-0.02,0-0.04,0-0.06,0 v2.15L9.11,7.83L11.94,5v2.02c1.3-0.02,2.61,0.45,3.6,1.45C17.24,10.17,17.45,12.82,16.17,14.76z"/></svg>

	const icon = 0 === fontSizeMeta ? null : modifyIcon;

	// keep track of if it’s the first time the useEffect function is being run
	const firstUpdate = useRef(true);
	useEffect( () => {
		if (firstUpdate.current) {
			firstUpdate.current = false;
			return;
		}
		// Do something if not first update
		const wrapperEl = document.querySelector('.editor-styles-wrapper');
		if ( wrapperEl ) {
			if ( 0 !== fontSizeMeta ) {
				wrapperEl.style.setProperty( '--global-fs-base', fontSizeMeta + 'px' );
			} else {
				wrapperEl.style.setProperty( '--global-fs-base', themeslugMetaLocalize.typography.font_size + 'px' );
			}

		}

	}, [ fontSizeMeta ] );

	return (
		<PluginDocumentSettingPanel
			name="typography-panel"
			icon={ icon } // "editor-textcolor"
			title={ __( 'Typography', 'themeslug' ) }
			className="themeslug-typography-panel"
		>
			<FontSizeField />
		</PluginDocumentSettingPanel>
	);
};

export default connectWithSelect( PluginDocumentSettingPanelThemeSlugTypography );
