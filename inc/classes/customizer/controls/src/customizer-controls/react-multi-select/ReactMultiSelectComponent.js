/**
 * WordPress dependencies
 */
import { useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { Tooltip, Button } from '@wordpress/components';

/**
 * External dependencies
 */
import Select from 'react-select';

const ReactMultiSelectComponent = ({ control }) => {

	const { choices, label, reset_values } = control.params;
	const [settingValue, setSettingValue] = useState(control.setting.get() || [] );

	const updateValues = (newVal) => {
		setSettingValue(newVal);
		control.setting.set(newVal);
	};

	const Reset = () => {
		return (
			<Tooltip text={ __( 'Default values', 'themeslug' ) }>
				<Button
					className="reset themeslug-reset"
					onClick={ () => {
						updateValues( reset_values );
					} }
				>
					reset
				</Button>
			</Tooltip>
		);
	};

	return (
		<div className="themeslug-react-multiselect">
			<div className="themeslug-control-bar">
				<span className="customize-control-title">{label}</span>
				<div className="side-control"><Reset /></div>
			</div>
			<Select
				options={ choices }
				value={ choices.filter( ( { value } ) => settingValue.includes( value ) ) }
				onChange={ ( newVal ) => {
					if ( newVal.length ) {
						const newArr = newVal.map( ( obj ) => obj.value );
						updateValues(newArr );
					} else {
						updateValues( [] );
					}
				} }
				className="themeslug-react-select"
				classNamePrefix="themeslug"
				isMulti={ true }
				menuPosition={ "fixed" }
				isSearchable={ false }
				isClearable={ true }
				placeholder={ __( 'Not visible' ) }
			/>
		</div>
	);
};

export default ReactMultiSelectComponent;
