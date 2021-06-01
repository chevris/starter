/**
 * WordPress dependencies
 */
import { compose } from '@wordpress/compose';
import { __ } from '@wordpress/i18n';
import { RangeControl } from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';

/**
 * Internal dependencies
 */
import { connectWithSelect, connectWithDispatch } from '../helpers/utils';

const decorate = compose(
	connectWithSelect,
	connectWithDispatch
);

const FontSizeField = ( { fontSizeMeta, setMetaValue } ) => {

	const [ value, setValue ] = useState( fontSizeMeta );

	useEffect( () => {
		setMetaValue( '_theme_slug_meta_font_size', value || 0 );
	}, [ value ] );

	return (
		<RangeControl
			label={ __( 'Font size (px)', 'themeslug' ) }
			allowReset={true}
			min={1}
			max={50}
			step="1"
			value={ fontSizeMeta && 0 !== fontSizeMeta ? fontSizeMeta : themeslugMetaLocalize.typography.font_size }
			onChange={ setValue }
		/>
	);
};

export default decorate( FontSizeField );
