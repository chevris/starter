/**
 * WordPress dependencies
 */
 import { render } from '@wordpress/element';

/**
 * Internal dependencies
 */
import ReactMultiSelectComponent from './ReactMultiSelectComponent';

export const ReactMultiSelectControl = wp.customize.Control.extend({
	renderContent: function renderContent() {
		const control = this;
		render(
			<ReactMultiSelectComponent control={ control } />,
			control.container[ 0 ]
		);
	}
});
