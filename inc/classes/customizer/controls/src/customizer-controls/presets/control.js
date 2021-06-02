/**
 * WordPress dependencies
 */
 import { render } from '@wordpress/element';

/**
 * Internal dependencies
 */
import PresetsComponent from './presets-component.js';

export const PresetsControl = wp.customize.Control.extend({
	renderContent: function renderContent() {
		render(
			<PresetsComponent control={ this } />,
			this.container[ 0 ]
		);
	}
});
