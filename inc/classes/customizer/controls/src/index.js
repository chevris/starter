/* global wp */
import './index.scss';
import { PresetsControl } from './customizer-controls/presets/control';
import { RangeControl } from './customizer-controls/range/control';
import { MultiSelectControl } from './customizer-controls/multi-select/control';
import { ReactMultiSelectControl } from './customizer-controls/react-multi-select/control';

// import { IconCheckboxControl } from './customizer-controls/icon-checkbox/control';

wp.customize.controlConstructor.theme_slug_presets_control = PresetsControl;
wp.customize.controlConstructor.theme_slug_range_control = RangeControl;
wp.customize.controlConstructor.theme_slug_multi_select_control = MultiSelectControl;
wp.customize.controlConstructor.theme_slug_react_multi_select_control = ReactMultiSelectControl;

// wp.customize.controlConstructor.theme_slug_icon_checkbox_control = IconCheckboxControl;
