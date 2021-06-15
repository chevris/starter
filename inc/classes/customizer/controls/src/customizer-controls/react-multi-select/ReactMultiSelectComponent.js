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
	const [value, setValue] = useState(control.setting.get());

	const updateValues = (newVal) => {
		setValue(newVal);
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
				className="themeslug-react-select"
				classNamePrefix="themeslug"
				value={ value }
				isMulti={ true }
				isSearchable={ false }
				isClearable={ true }
				placeholder={ __( 'Not visible' ) }
				onChange={ updateValues }
			/>
		</div>
	);
};

export default ReactMultiSelectComponent;
