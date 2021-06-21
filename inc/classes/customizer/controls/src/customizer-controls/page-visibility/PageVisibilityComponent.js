/**
 * WordPress dependencies
 */
import { useState, useEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { SelectControl } from '@wordpress/components';

/**
 * Internal dependencies
 */

/**
 * External dependencies
 */
import Select from 'react-select';

const PageVisibilityComponent = ({ control }) => {

	useEffect( () => {
		// console.log( 'choices: ', choices );
		// console.log( 'setting value (state): ', settingValue );
		// console.log( 'setting value (param): ', control.setting.get() )
	} );

	const defaultSettingValue = {
		rule: '',
		select: 'all',
		subRule: '',
		subSelection: [],
		ids: [],
	};

	const { label, choices } = control.params;
	const [settingValue, setSettingValue] = useState( control.setting.get() || defaultSettingValue );

	const ruleOptions = [].concat.apply( [], choices.map( option => option.options ) ); // Extract from choices array an array of rules ` [ {value: "global:site", label: "Entire Site"} ...] `

	const updateSettingValue = (newSetting) => {
		setSettingValue( settingValue => {
			return { ...settingValue, ...newSetting };
		} );
		control.setting.set( { ...settingValue, ...newSetting } );
	};

	return (
		<div className="themeslug-page-visibility">
			<div className="themeslug-control-bar">
				<span className="customize-control-title">{label}</span>
			</div>

			<div className="themeslug-rule-wrap">

				<Select
					options={ choices }
					value={ ( undefined !== settingValue.rule && '' !== settingValue.rule ? ruleOptions.filter( ( { value } ) => value === settingValue.rule ) : '' ) } // ex : {value: "global:site", label: "Entire Site"}
					onChange={ (newVal) => {
						if ( ! newVal ) {
							updateSettingValue( defaultSettingValue )
						} else {
							updateSettingValue( {
								rule: newVal.value,
								select: 'all',
								subRule: '',
								subSelection: [],
								ids: [],
							} )
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

export default PageVisibilityComponent;
