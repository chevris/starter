/**
 * WordPress dependencies
 */
import { render } from '@wordpress/element';

/**
 * Internal dependencies
 */
import SelectBlocksComponent from './SelectBlocksComponent';

export const SelectBlocksControl = wp.customize.Control.extend({
	renderContent: function renderContent() {
		const control = this;
		render(
			<SelectBlocksComponent control={ control } />,
			control.container[ 0 ]
		);
	}
});
