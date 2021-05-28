/**
 * WordPress dependencies
 */
import { compose } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';
import { ColorIndicator, ColorPalette } from '@wordpress/components';

/**
 * Internal dependencies
 */
import { connectWithSelect, connectWithDispatch } from '../helpers/utils';

const decorate = compose(
	connectWithSelect,
	connectWithDispatch
);

const overrideBackgroundColor = ( newValue ) => {

	const wrapperEl = document.querySelector('.editor-styles-wrapper');
	if ( wrapperEl ) {

		if ( undefined === newValue ) {
			wrapperEl.style.setProperty( '--global-cl-bg', themeslugMetaLocalize.colors.background_color );
		} else {
			wrapperEl.style.setProperty( '--global-cl-bg', newValue );
		}

	}
}

const BackgroundColorField = ( { backgroundColorMeta, colorPalette, setMetaValue } ) => {

	const customizerColor = themeslugMetaLocalize.colors.background_color.toUpperCase();

	return (
		<div className="themeslug-background-color-control">
			<span>Background color</span>
			<ColorIndicator 
				colorValue={ backgroundColorMeta ? backgroundColorMeta : customizerColor }
			/>
			<ColorPalette
				colors={colorPalette}
				value={ backgroundColorMeta ? backgroundColorMeta : customizerColor }
				onChange={ ( newValue ) => {
					console.log(newValue)
					setMetaValue( '_theme_slug_meta_background_color', newValue || '' );
					overrideBackgroundColor( newValue );
				} }
			/>
		</div>
	);
};

export default decorate( BackgroundColorField );
