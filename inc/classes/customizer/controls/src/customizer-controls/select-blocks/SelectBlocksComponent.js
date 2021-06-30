/**
 * WordPress dependencies
 */
 import { useState, useEffect } from '@wordpress/element';
 import { Button, Dashicon } from '@wordpress/components';
 import { __ } from '@wordpress/i18n';
 
 /**
  * Internal dependencies
  */
 
 /**
  * External dependencies
  */
import times from 'lodash/times';
import Select from 'react-select';
 
 const SelectBlocksComponent = ({ control }) => {

	useEffect( () => {
		console.log( 'choices: ', choices )
		console.log( 'setting: ', settingValue )
	} );

	const defaultSettingValue = [
		{
			id: '',
			rule: 'global:site',
			select: 'all',
			subRule: '',
			subSelection: [],
			ids: [],
		}
	]
	const { label, choices } = control.params;
	
	// Extract from choices object an array of rule choices` [ {value: "global:site", label: "Entire Site"} ...] `
	const ruleChoices = [].concat.apply( [], choices.templates.map( obj => obj.options ) );

	const [settingValue, setSettingValue] = useState( control.setting.get() );

	const updateSettingValue = (newValues, blockIndex) => {
		const newSettingValue = settingValue.map( ( obj, objIndex ) => {
			if ( objIndex === blockIndex ) {
				obj = { ...obj, ...newValues };
			}
			return obj;
		} );
		setSettingValue( newSettingValue );
		control.setting.set( newSettingValue );
	};

	const blockControls = ( blockIndex ) => {

		return (
			<div className="themeslug-select-blocks__block">
				<div className="themeslug-select-blocks__select-block">
					{ 0 !== blockIndex && (
						<div className="themeslug-select-blocks__remove">
							<hr />
							<Button
								icon="no-alt"
								onClick={ () => {
									const settingValueFiltered = settingValue.filter( ( obj, objIndex ) => objIndex !== blockIndex );
									setSettingValue( settingValueFiltered );
									control.setting.set( settingValueFiltered );
								} }
								className="themeslug-remove-block"
								label={ __( 'Remove Block', 'themeslug' ) }
								disabled={ 1 === settingValue.length }
							/>
						</div>
						
					) }

					<div className="themeslug-control-bar themeslug-control-bar--subtitle">
						<span className="customize-control-title">{ __( 'Select a block', 'themeslug' ) }</span>
					</div>
					<Select
						options={ choices.blocks }
						value= { ( undefined !== settingValue[ blockIndex ] && undefined !== settingValue[ blockIndex ].id && '' !== settingValue[ blockIndex ].id ? choices.blocks.filter( ( { value } ) => value === settingValue[ blockIndex ].id ) : '' ) }
						onChange={ (newVal) => {
							if ( ! newVal ) {
								updateSettingValue( { id: '' }, blockIndex )
							} else {
								updateSettingValue( { id: newVal.value }, blockIndex )
							}
						} }
						isSearchable={ true }
						isClearable={ true }
						placeholder={ __( 'None' ) }
					/>
				</div>
				{ '' !== settingValue[ blockIndex ].id && (
					<div className="themeslug-select-blocks__template-visibility">
						<div className="themeslug-control-bar themeslug-control-bar--subtitle">
							<span className="customize-control-title">{ __( 'Visible on', 'themeslug' ) }</span>
						</div>
						<Select
							options={ choices.templates }
							value={ ( undefined !== settingValue[ blockIndex ] && undefined !== settingValue[ blockIndex ].rule && '' !== settingValue[ blockIndex ].rule ? ruleChoices.filter( ( { value } ) => value === settingValue[ blockIndex ].rule ) : '' ) } // ex : {value: "global:site", label: "Entire Site"}
							onChange={ (newVal) => {
								if ( ! newVal ) {
									updateSettingValue( { rule: '' }, blockIndex )
								} else {
									updateSettingValue( { rule: newVal.value }, blockIndex )
								}
							} }
							isSearchable={ false }
							isClearable={ true }
							placeholder={ __( 'None' ) }
						/>
					</div>
				) }
			</div>
		);
	}
 
	 return (
		<>
			<div className="themeslug-control-bar">
				<span className="customize-control-title">{label}</span>
			</div>

			<div className="themeslug-select-blocks">
				{ times( settingValue.length, ( i ) => blockControls( i ) ) }
			</div>

			<Button
				className="themeslug-select-blocks__add-block"
				isPrimary={ true }
				onClick={ () => {
					const settingValueExtended = settingValue.concat( defaultSettingValue );
					setSettingValue( settingValueExtended );
				} }
			>
				<Dashicon icon="plus" />
				{ __( 'Add new block', 'themeslug' ) }
			</Button>
		</>
	 );
 };
 
 export default SelectBlocksComponent;
 