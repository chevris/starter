/**
 * WordPress dependencies
 */
import { render } from '@wordpress/element';

/**
 * Internal dependencies
 */
import PageVisibilityComponent from './PageVisibilityComponent';

export const PageVisibilityControl = wp.customize.Control.extend({
	renderContent: function renderContent() {
		const control = this;
		render(
			<PageVisibilityComponent control={ control } />,
			control.container[ 0 ]
		);
	}
});
