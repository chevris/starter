/**
 * WordPress dependencies
 */
import { render } from '@wordpress/element';

/**
 * Internal dependencies
 */
import RangeComponent from './range-component.js';

export const RangeControl = wp.customize.Control.extend({
	renderContent: function renderContent() {
		const control = this;
		render(
			<RangeComponent control={ control } />,
			control.container[ 0 ]
		);
	}
});
