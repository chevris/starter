/**
 * WordPress dependencies
 */
 import { useState, useEffect } from '@wordpress/element';
 import { Button, Dashicon, Tooltip } from '@wordpress/components';
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
		// console.log( control.params.label + ':blocks choices: ', choices.blocks )
		// console.log( control.params.label, settingValue )
	} );

	const { label, choices } = control.params;
	const showRemoveButton = false;
	const defaultNewSettingValue = control.params.new_default_value && control.params.new_default_value.length ? control.params.new_default_value : [
		{
			id: 'none',
			rule: 'global:site',
			select: 'all',
			sub_rule: '',
			sub_selection: [],
			ids: [],
		}
	];
	
	// Extract from choices object an array of rule choices` [ {value: "global:site", label: "Entire Site"} ...] `
	const ruleChoices = choices.templates ? [].concat.apply( [], choices.templates.map( obj => obj.options ) ) : [];

	const [settingValue, setSettingValue] = useState( control.setting.get() || [] );

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

	const customSelectStyles = {
		menu: (provided, state) => ({
		  ...provided,
		  backgroundColor: '#fff',
		}),
	  }

	const Reset = () => {
		return (
			<Tooltip text={ __( 'Reset blocks', 'themeslug' ) }>
				<Button
					className="reset themeslug-reset"
					onClick={ () => {
						setSettingValue( [] );
						control.setting.set( [] );
					} }
				>
					reset
				</Button>
			</Tooltip>
		);
	};

	const blockControls = ( blockIndex ) => {

		return (
			<div className="themeslug-select-blocks__block">
				<div className="themeslug-select-blocks__select-block">

					{ 0 !== blockIndex && <hr /> }

					{ showRemoveButton && (
						<div className="themeslug-select-blocks__remove">
							<Button
								icon="no-alt"
								onClick={ () => {
									const settingValueFiltered = settingValue.filter( ( obj, objIndex ) => objIndex !== blockIndex ); // Remove this object from the settingValue array
									setSettingValue( settingValueFiltered );
									control.setting.set( settingValueFiltered );
								} }
								className="themeslug-remove-block"
								label={ __( 'Remove Block', 'themeslug' ) }
							/>
						</div>
						
					) }

					<div className="themeslug-control-bar themeslug-control-bar--subtitle">
						<span className="customize-control-title">{ __( 'Select a block', 'themeslug' ) }</span>
					</div>
					<Select
						options={ choices.blocks }
						value= { ( undefined !== settingValue[ blockIndex ] && undefined !== settingValue[ blockIndex ].id && '' !== settingValue[ blockIndex ].id ? choices.blocks.filter( ( { value } ) => value === settingValue[ blockIndex ].id ) : { value: 'none', label: __( 'None', 'themeslug' ) } ) }
						onChange={ (newVal) => {
							if ( ! newVal ) {
								const settingValueFiltered = settingValue.filter( ( obj, objIndex ) => objIndex !== blockIndex ); // Remove this object from the settingValue array
								setSettingValue( settingValueFiltered );
								control.setting.set( settingValueFiltered );
							} else {
								updateSettingValue(
									{ id: newVal.value },
									blockIndex
								);
							}
						} }
						className={ "themeslug-select-blocks__select" }
						styles={ customSelectStyles }
						menuPosition={ "fixed" }
						isSearchable={ true }
						isClearable={ true }
					/>
				</div>
				{ choices.templates && (
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
							className={ "themeslug-select-blocks__select" }
							styles={ customSelectStyles }
							menuPosition={ "fixed" }
							isSearchable={ false }
							isClearable={ true }
							placeholder={ __( 'None', 'themeslug' ) }
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
				<div className="side-control"><Reset /></div>
			</div>

			<div className="themeslug-select-blocks">
				{ times( settingValue.length, ( i ) => blockControls( i ) ) }
			</div>

			<Button
				className="themeslug-select-blocks__add-block"
				onClick={ () => {
					const settingValueExtended = settingValue.concat( defaultNewSettingValue );
					setSettingValue( settingValueExtended );
					control.setting.set( settingValueExtended );
				} }
			>
				<Dashicon icon="plus" />
				<span hidden>{ __( 'Add block', 'themeslug' ) }</span>
			</Button>
		</>
	 );
 };
 
 export default SelectBlocksComponent;
 