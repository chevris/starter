/* global wp */
import './index.scss';
import { PresetsControl } from './customizer-controls/presets/control';
import { RangeControl } from './customizer-controls/range/control';

wp.customize.controlConstructor.theme_slug_presets_control = PresetsControl;
wp.customize.controlConstructor.theme_slug_range_control = RangeControl;
