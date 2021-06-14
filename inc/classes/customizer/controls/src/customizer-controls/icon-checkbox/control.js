/**
 * WordPress dependencies
 */
 import { render } from '@wordpress/element';

/**
 * Internal dependencies
 */
import IconCheckboxComponent from './icon-checkbox-component.js';

export const IconCheckboxControl = wp.customize.Control.extend({
	renderContent: function renderContent() {
		const control = this;
		render(
			<IconCheckboxComponent control={ control } />,
			control.container[ 0 ]
		);
	}
});
