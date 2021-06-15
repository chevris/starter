/**
 * WordPress dependencies
 */
import { useState } from '@wordpress/element';

/**
 * Internal dependencies
 */
import MultiSelect from './MultiSelect';

const MultiSelectComponent = ({ control }) => {

	const { choices, reset_values, label } = control.params;
	const [value, setValue] = useState(control.setting.get());

	const updateValues = (newVal) => {
		setValue(newVal);
		control.setting.set(newVal);
	};

	return (
		<MultiSelect
			label={label}
			choices={choices}
			reset_values={reset_values}
			onChange={updateValues}
			currentValue={value}
		/>
	);
};

export default MultiSelectComponent;
