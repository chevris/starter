/**
 * WordPress dependencies
 */
import { plusCircleFilled, cancelCircleFilled } from '@wordpress/icons';
import { Tooltip, Icon, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * External dependencies
 */
import PropTypes from 'prop-types';

const MultiSelect = ({ choices, reset_values, onChange, currentValue, label }) => {

	const Pill = ({ slug, isRemove = false }) => {
		const buttonIcon = isRemove ? cancelCircleFilled : plusCircleFilled;
		return (
			<Tooltip
				key={slug}
				text={
					isRemove
						? __('Remove Item', 'themeslug')
						: __('Add item', 'themeslug')
				}
			>
				<button
					type="button"
					className="token"
					onClick={() => {
						const newVal = isRemove
							? [...currentValue].filter((v) => v !== slug) // Return array of values minus this pill slug
							: [...currentValue, slug]; // Add this pill slug to selected values
						onChange(newVal);
					}}
				>
					<span className="title">{choices[slug]}</span>
					<Icon icon={buttonIcon} size={18} />
				</button>
			</Tooltip>
		);
	};

	const Reset = () => {
		return (
			<Tooltip text={ __( 'Default values', 'themeslug' ) }>
					<Button
						className="reset themeslug-reset"
						onClick={ () => {
							onChange( reset_values );
						} }
					>
						reset
					</Button>
				</Tooltip>
		);
	};

	const addable = Object.keys(choices)
		.filter((choice) => !currentValue.includes(choice)) // Return array of available choices that are not selected
		.map((slug, i) => <Pill key={i} slug={slug} />);

	const values = currentValue
		.filter((slug) => choices[slug])
		.map((slug, i) => <Pill key={i} slug={slug} isRemove={true} />); // Return array of Pill components for each selected value

	return (
		<div className="themeslug-multiselect">
			<div className="themeslug-control-bar">
				<span className="customize-control-title">{label}</span>
				<div className="side-control"><Reset /></div>
			</div>
			<div className="selected-options">
				{values.length ? (
					values
				) : (
					<span className="placeholder">
						{__('Add items by clicking the ones below.', 'themeslug')}
					</span>
				)}
			</div>
			<div className="available-options">
				{addable.length > 0 ? (
					addable
				) : (
					<span className="placeholder">
						{__('All items are already selected.', 'themeslug')}
					</span>
				)}
			</div>
		</div>
	);
};

MultiSelect.propTypes = {
	choices: PropTypes.object.isRequired,
	onChange: PropTypes.func.isRequired,
	currentValue: PropTypes.array.isRequired,
	label: PropTypes.string,
};

export default MultiSelect;
