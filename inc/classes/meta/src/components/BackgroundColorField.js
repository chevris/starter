/**
 * WordPress dependencies
 */
import { compose } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';
import { ColorIndicator, ColorPalette } from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';

/**
 * Internal dependencies
 */
import { connectWithSelect, connectWithDispatch } from '../helpers/utils';

const decorate = compose(
	connectWithSelect,
	connectWithDispatch
);

const BackgroundColorField = ( { backgroundColorMeta, colorPalette, setMetaValue } ) => {

	const customizerColor = themeslugMetaLocalize.colors.background_color.toUpperCase();

	const [ value, setValue ] = useState( backgroundColorMeta );

	useEffect( () => {
		setMetaValue( '_theme_slug_meta_background_color', value || '' );
	}, [ value ] );

	return (
		<div className="themeslug-background-color-control">
			<span>Background color</span>
			<ColorIndicator 
				colorValue={ backgroundColorMeta ? backgroundColorMeta : customizerColor }
			/>
			<ColorPalette
				colors={colorPalette}
				value={ backgroundColorMeta ? backgroundColorMeta : customizerColor }
				onChange={ setValue }
			/>
		</div>
	);
};

export default decorate( BackgroundColorField );
