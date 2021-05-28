/**
 * WordPress dependencies
 */
import { compose } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';
import { RangeControl } from '@wordpress/components';

/**
 * Internal dependencies
 */
import { connectWithSelect, connectWithDispatch } from '../helpers/utils';

const decorate = compose(
	connectWithSelect,
	connectWithDispatch
);

const overrideFontSize = ( newValue ) => {

	const wrapperEl = document.querySelector('.editor-styles-wrapper');
	if ( wrapperEl ) {

		if ( undefined === newValue ) {
			wrapperEl.style.setProperty( '--global-fs-base', themeslugMetaLocalize.typography.font_size + 'px' );
		} else {
			wrapperEl.style.setProperty( '--global-fs-base', newValue + 'px' );
		}

	}
}

const FontSizeField = ( { fontSizeMeta, setMetaValue } ) => {

	return (
		<RangeControl
			label={ __( 'Font size (px)', 'themeslug' ) }
			allowReset={true}
			min={1}
			max={50}
			step="1"
			value={ fontSizeMeta && 0 !== fontSizeMeta ? fontSizeMeta : themeslugMetaLocalize.typography.font_size }
			onChange={ ( newValue ) => {
				setMetaValue( '_theme_slug_meta_font_size', newValue || 0 );
				overrideFontSize( newValue );
			} }
		/>
	);
};

export default decorate( FontSizeField );
