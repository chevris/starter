/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./inc/classes/customizer/controls/src/pane.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./inc/classes/customizer/controls/src/pane.js":
/*!*****************************************************!*\
  !*** ./inc/classes/customizer/controls/src/pane.js ***!
  \*****************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utils__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./utils */ "./inc/classes/customizer/controls/src/utils.js");
/**
 * Scripts for customizer controls panel.
 */

/**
 * Internal dependencies
 */
 // Dispatch custom event to handle device preview changes.

window.addEventListener('load', function () {
  var deviceFooterButtons = document.querySelector('#customize-footer-actions .devices');
  deviceFooterButtons.addEventListener('click', function (e) {
    var customEvent = new CustomEvent('themeslugChangedRepsonsivePreview', {
      'detail': e.target.dataset.device
    });
    document.dispatchEvent(customEvent);
  });
});
/**
 * Handle custom expanded sections.
 */

jQuery(document).ready(function () {
  wp.customize.section.each(function (section) {
    // Get the pane element of each section.
    var pane = jQuery('#sub-accordion-section-' + section.id),
        sectionLi = jQuery('#accordion-section-' + section.id); // Check if the section is expanded.

    if (sectionLi.hasClass('control-section-theme_slug_expanded_section')) {
      // Move element.
      pane.appendTo(sectionLi);
    }
  });
});
/**
 * Handle custom nested panels.
 *
 * @see https://wordpress.stackexchange.com/a/256103/17078
 */

(function () {
  var _panelEmbed, _panelIsContextuallyActive, _panelAttachEvents;

  wp.customize.bind('pane-contents-reflowed', function () {
    var panels = []; // Reflow panels

    wp.customize.panel.each(function (panel) {
      if ('theme_slug_nested_panel' !== panel.params.type || 'undefined' === typeof panel.params.panel) {
        return;
      }

      panels.push(panel);
    });
    panels.sort(wp.customize.utils.prioritySort).reverse();
    jQuery.each(panels, function (i, panel) {
      var parentContainer = jQuery('#sub-accordion-panel-' + panel.params.panel);
      parentContainer.children('.panel-meta').after(panel.headContainer);
    });
  }); // Extend Panel.

  _panelEmbed = wp.customize.Panel.prototype.embed;
  _panelIsContextuallyActive = wp.customize.Panel.prototype.isContextuallyActive;
  _panelAttachEvents = wp.customize.Panel.prototype.attachEvents;
  wp.customize.Panel = wp.customize.Panel.extend({
    attachEvents: function attachEvents() {
      var panel;

      if ('theme_slug_nested_panel' !== this.params.type || _.isUndefined(this.params.panel)) {
        _panelAttachEvents.call(this);

        return;
      }

      _panelAttachEvents.call(this);

      panel = this;
      panel.expanded.bind(function (expanded) {
        var parent = wp.customize.panel(panel.params.panel);

        if (expanded) {
          parent.contentContainer.addClass('current-panel-parent');
        } else {
          parent.contentContainer.removeClass('current-panel-parent');
        }
      });
      panel.container.find('.customize-panel-back').off('click keydown').on('click keydown', function (event) {
        if (wp.customize.utils.isKeydownButNotEnterEvent(event)) {
          return;
        }

        event.preventDefault(); // Keep this AFTER the key filter above

        if (panel.expanded()) {
          wp.customize.panel(panel.params.panel).expand();
        }
      });
    },
    embed: function embed() {
      var panel = this,
          parentContainer;

      if ('theme_slug_nested_panel' !== this.params.type || _.isUndefined(this.params.panel)) {
        _panelEmbed.call(this);

        return;
      }

      _panelEmbed.call(this);

      parentContainer = jQuery('#sub-accordion-panel-' + this.params.panel);
      parentContainer.append(panel.headContainer);
    },
    isContextuallyActive: function isContextuallyActive() {
      var panel = this,
          children,
          activeCount = 0;

      if ('theme_slug_nested_panel' !== this.params.type) {
        return _panelIsContextuallyActive.call(this);
      }

      children = this._children('panel', 'section');
      wp.customize.panel.each(function (child) {
        if (!child.params.panel) {
          return;
        }

        if (child.params.panel !== panel.id) {
          return;
        }

        children.push(child);
      });
      children.sort(wp.customize.utils.prioritySort);

      _(children).each(function (child) {
        if (child.active() && child.isContextuallyActive()) {
          activeCount += 1;
        }
      });

      return 0 !== activeCount;
    }
  });
})(jQuery);
/**
 * Handle collapsible sections.
 */


(function ($, api) {
  /**
   * Extend wp.customize.Section as a collapsible section
   */
  api.CollapsibleSection = api.Section.extend({
    defaultExpandedArguments: $.extend({}, api.Section.defaultExpandedArguments, {
      allowMultiple: true
    }),

    /**
     * wp.customize.CollapsibleSection
     *
     * Custom section which would act as a collapsible (accordion).
     *
     * @constructs wp.customize.CollapsibleSection
     * @augments   wp.customize.Section
     *
     * @param {string} id - ID.
     * @param {Object} options - Options.
     * @return {void}
     */
    initialize: function initialize(id, options) {
      var section = this;
      api.Section.prototype.initialize.call(section, id, options); // Move the section to it's parent panel.

      section.headContainer.append($('#sub-accordion-section-' + id));

      if (section.panel && section.panel()) {
        var panel = api.panel(section.panel());

        if (panel) {
          panel.container.last().addClass('control-section-collapse-parent');
        }
      }
    },

    /**
     * Attach events.
     *
     * @return {void}
     */
    attachEvents: function attachEvents() {
      var section = this;
      api.Section.prototype.attachEvents.call(section);

      if (section.panel() && api.panel(section.panel())) {
        api.panel(section.panel()).container.find('.customize-panel-back').on('click keydown', function (event) {
          if (api.utils.isKeydownButNotEnterEvent(event)) {
            return;
          }

          event.preventDefault(); // Keep this AFTER the key filter above.

          if (section.expanded()) {
            section.collapse({
              delayed: true
            });
          }
        });
      }
    },

    /**
     * Update UI to reflect expanded state
     *
     * @param {boolean}  expanded - Expanded state.
     * @param {Object}   args - Args.
     * @return {void}
     */
    onChangeExpanded: function onChangeExpanded(expanded, args) {
      var section = this; // Immediately call the complete callback if there were no changes.

      if (args.unchanged) {
        if (args.completeCallback) {
          args.completeCallback();
        }

        return;
      }

      var overlay = section.headContainer.closest('.wp-full-overlay');

      if (expanded) {
        if (!args.allowMultiple) {
          api.section.each(function (otherSection) {
            if (otherSection !== section) {
              otherSection.collapse({
                duration: args.duration
              });
            }
          });
        }

        section.contentContainer.addClass('open');

        if (false !== args.transition) {
          Object(_utils__WEBPACK_IMPORTED_MODULE_0__["expandSection"])(section.contentContainer.get(0));
        }

        overlay.addClass('section-collapse-open');
        section.headContainer.addClass('expanded');
      } else {
        setTimeout(function () {
          section.contentContainer.removeClass('open');
        }, 200);

        if (args.delayed) {
          setTimeout(function () {
            Object(_utils__WEBPACK_IMPORTED_MODULE_0__["collapseSection"])(section.contentContainer.get(0));
          }, 400);
        } else {
          Object(_utils__WEBPACK_IMPORTED_MODULE_0__["collapseSection"])(section.contentContainer.get(0));
        }

        overlay.removeClass('section-collapse-open');
        section.container.removeClass('busy');
        section.headContainer.removeClass('expanded');
      }
    }
  });
  /**
   * Extends wp.customize.sectionConstructor with section constructor for collapsible section.
   */

  $.extend(api.sectionConstructor, {
    collapse: api.CollapsibleSection
  });
})(jQuery, wp.customize);

/***/ }),

/***/ "./inc/classes/customizer/controls/src/utils.js":
/*!******************************************************!*\
  !*** ./inc/classes/customizer/controls/src/utils.js ***!
  \******************************************************/
/*! exports provided: collapseSection, expandSection */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "collapseSection", function() { return collapseSection; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "expandSection", function() { return expandSection; });
/* global requestAnimationFrame */

/**
 * Collapse a DOM node by animating it's height to 0.
 *
 * @param {Node} element
 */
var collapseSection = function collapseSection(element) {
  // Get the height of the element's inner content, regardless of its actual size.
  var sectionHeight = element.scrollHeight; // Temporarily disable all css transitions.

  var elementTransition = element.style.transition;
  element.style.transition = ''; // On the next frame (as soon as the previous style change has taken effect),
  // explicitly set the element's height to its current pixel height, so we
  // aren't transitioning out of 'auto'.

  requestAnimationFrame(function () {
    element.style.height = sectionHeight + 'px';
    element.style.transition = elementTransition; // On the next frame (as soon as the previous style change has taken effect),
    // have the element transition to height: 0.

    requestAnimationFrame(function () {
      element.style.height = 0 + 'px';
    });
  }); // Mark the section as "currently collapsed".

  element.setAttribute('data-collapsed', 'true');
};
/**
 * Expand a DOM node by animating it's height to full.
 *
 * @param {Node} element
 */

var expandSection = function expandSection(element) {
  // Get the height of the element's inner content, regardless of its actual size.
  var sectionHeight = element.scrollHeight + 2;

  var removeEvent = function removeEvent() {
    element.style.height = 'auto'; // Remove this event listener so it only gets triggered once.

    element.removeEventListener('transitionend', removeEvent);
  }; // Have the element transition to the height of its inner content.


  element.style.height = sectionHeight + 'px'; // When the next css transition finishes (which should be the one we just triggered).

  element.addEventListener('transitionend', removeEvent); // Mark the section as "currently not collapsed".

  element.setAttribute('data-collapsed', 'false');
};

/***/ })

/******/ });