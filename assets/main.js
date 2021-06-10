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
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/main/index.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/main/index.js":
/*!***************************!*\
  !*** ./src/main/index.js ***!
  \***************************/
/*! no static exports found */
/***/ (function(module, exports) {

if ('loading' === document.readyState) {
  // The DOM has not yet been loaded.
  document.addEventListener('DOMContentLoaded', initScripts);
} else {
  // The DOM has already been loaded.
  initScripts();
}
/**
 * Initiate scripts when DOM loaded .
 */


function initScripts() {
  /**
   * Add listener to the overlay masks, so they can be removed and close drawers.
   *
   * @note: Opened drawer must have a class : [slug]-drawer-opened and
   * the overlay id must be mask-[slug]
   */
  document.addEventListener('click', function (e) {
    if (e.target && 'overlay-mask' === e.target.className) {
      var maskId = e.target.id;
      var drawer = maskId.split('-');
      document.body.classList.remove(drawer[1] + '-drawer-opened');
      document.documentElement.classList.remove('scroll-disabled');
      document.documentElement.style.removeProperty('margin-right');
      removeOverlay(maskId); // force the browser to process the display change first, then the transition

      setTimeout(function () {
        document.getElementById('drawer-header-js').setAttribute('hidden', '');
      }, 250);
    }
  });
  initDrawerHeader();
}
/**
 * Handles header drawer.
 */


function initDrawerHeader() {
  var togglers = document.getElementsByClassName('drawer-header-toggle');
  var siteHeader = document.getElementById('masthead');
  var drawerHeader = document.getElementById('drawer-header-js'); // No point if no toggler.

  if (!togglers.length) {
    return;
  }

  var drawerCloseButton = drawerHeader.getElementsByClassName('drawer-header-toggle')[0];
  var headerToggleButton = siteHeader.getElementsByClassName('drawer-header-toggle')[0];
  /**
   * Open / close header drawer.
   *
   * @note: Opened drawer must have a class : [slug]-drawer-opened and
   * the overlay id must be mask-[slug]
   */

  for (var i = 0; i < togglers.length; i++) {
    togglers[i].addEventListener('click', function (e) {
      e.preventDefault();

      if (document.body.classList.contains('header-drawer-opened')) {
        closeMenu('header-drawer-opened', headerToggleButton, 'mask-header'); // force the browser to process the display change first, then the transition

        setTimeout(function () {
          drawerHeader.setAttribute('hidden', '');
        }, 300);
      } else {
        drawerHeader.removeAttribute('hidden'); // force the browser to process the display change first, then the transition

        setTimeout(function () {
          openMenu('header-drawer-opened', drawerCloseButton, 'mask-header');
        }, 0);
      }
    }, false);
  }
}
/**
 * @description Opens specifed off-canvas menu.
 * @param {string} openingClass  The class to add to the body to toggle menu visibility.
 * @param {object} focusOnOpen The button used to close the menu on which we focus.
 * @param {string} maskId     The ID to use for the overlay.
 */


function openMenu(openingClass, focusOnOpen) {
  var maskId = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '';
  document.body.classList.add(openingClass);
  document.documentElement.style.setProperty('margin-right', window.innerWidth - document.documentElement.clientWidth + 'px');
  document.documentElement.classList.add('scroll-disabled');

  if (focusOnOpen) {
    focusOnOpen.focus();
  }

  if (maskId) {
    createOverlay(maskId);
  }
}
/**
 * @description Closes specifed slide-out menu.
 * @param {string} openingClass  The class to remove from the body to toggle menu visibility.
 * @param {object} focusOnClose The button used to open the menu on which we focus.
 * @param {string} maskId The ID to use for the overlay.
 */


function closeMenu(openingClass, focusOnClose) {
  var maskId = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : '';
  document.body.classList.remove(openingClass);
  document.documentElement.style.removeProperty('margin-right');
  document.documentElement.classList.remove('scroll-disabled');

  if (focusOnClose) {
    focusOnClose.focus();
  }

  if (maskId) {
    removeOverlay(maskId);
  }
}
/**
 * @description Creates semi-transparent overlay behind menus.
 * @param {string} maskId The ID to add to the div.
 */


function createOverlay(maskId) {
  var mask = document.createElement('div');
  mask.setAttribute('class', 'overlay-mask');
  mask.setAttribute('id', maskId);
  document.body.appendChild(mask);
}
/**
 * @description Removes semi-transparent overlay behind menus.
 * @param {string} maskId The ID to use for the overlay.
 */


function removeOverlay(maskId) {
  var mask = document.getElementById(maskId);
  mask.parentNode.removeChild(mask);
}

/***/ })

/******/ });