/**
 * WordPress dependencies
 */
 import { render } from '@wordpress/element';

/**
 * Internal dependencies
 */
 import MultiSelectComponent from './MultiSelectComponent';

export const MultiSelectControl = wp.customize.Control.extend({
	renderContent: function renderContent() {
		const control = this;
		render(
			<MultiSelectComponent control={ control } />,
			control.container[ 0 ]
		);
	}
});
