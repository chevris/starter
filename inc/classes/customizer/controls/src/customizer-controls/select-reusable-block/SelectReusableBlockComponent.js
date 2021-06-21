/**
 * WordPress dependencies
 */
import { useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */

/**
 * External dependencies
 */
import Select from 'react-select';

const SelectReusableBlockComponent = ({ control }) => {

	const { label, choices } = control.params;
	const [settingValue, setSettingValue] = useState( control.setting.get() || '' );

	const updateSettingValue = (newVal) => {
		setSettingValue( newVal );
		control.setting.set( newVal );
	};

	return (
		<div className="themeslug-select-reusable-block">
			<div className="themeslug-control-bar">
				<span className="customize-control-title">{label}</span>
			</div>

			<div className="themeslug-select-reusable-block-wrap">

			<Select
				options={ choices }
				value={ ( settingValue ? choices.filter( ( { value } ) => value === settingValue ) : '' ) } // ex : {value: int ID, label: string 'block label'}
				onChange={ (newVal) => {
						if ( newVal ) {
							updateSettingValue( newVal.value )
						} else {
							updateSettingValue( '' )
						}
					} }
				isSearchable={ false }
				isClearable={ true }
				placeholder={ __( 'None' ) }
			/>

			</div>
		</div>
	);
};

export default SelectReusableBlockComponent;
