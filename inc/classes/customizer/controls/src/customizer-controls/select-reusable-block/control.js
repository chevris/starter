/**
 * WordPress dependencies
 */
import { render } from '@wordpress/element';

/**
 * Internal dependencies
 */
import SelectReusableBlockComponent from './SelectReusableBlockComponent';

export const SelectReusableBlockControl = wp.customize.Control.extend({
	renderContent: function renderContent() {
		const control = this;
		render(
			<SelectReusableBlockComponent control={ control } />,
			control.container[ 0 ]
		);
	}
});
