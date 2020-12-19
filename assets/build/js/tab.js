/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/tab.js":
/*!***********************!*\
  !*** ./src/js/tab.js ***!
  \***********************/
/*! namespace exports */
/*! exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.* */
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _sass_tab_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../sass/tab.scss */ "./src/sass/tab.scss");
/**
 * Plugin scripts.
 *
 * @package Elementor_Tab_Widget
 */
;
var tabContainer = document.querySelector('.tab-container');
var tabs = tabContainer.querySelectorAll('.tab');
var tabContents = tabContainer.querySelectorAll('.tab-content');
tabs.forEach(function (button) {
  button.addEventListener('click', function (event) {
    // Store the "theme" being selected.
    var tabTheme = button.getAttribute('data-theme');

    if (button.classList.contains('is-selected')) {
      // Abort if it's already selected.
      return;
    } else {
      // Go through the NodeList and remove 'old' is-selected.
      tabs.forEach(function (tab) {
        if (tab.classList.contains('is-selected')) {
          tab.classList.remove('is-selected');
        }
      }); // Add 'new' is-selected to clicked button.

      button.classList.add('is-selected');
    } // Loop through content sections' NodeList.


    tabContents.forEach(function (section) {
      // Store the data-theme for each section.
      var contentTheme = section.getAttribute('data-theme'); // check if the section data-theme is the same as the one that was clicked on the Tab button.

      if (contentTheme === tabTheme) {
        section.classList.add('is-selected');
      } else {
        section.classList.remove('is-selected');
      }
    });
  });
});

/***/ }),

/***/ "./src/sass/tab.scss":
/*!***************************!*\
  !*** ./src/sass/tab.scss ***!
  \***************************/
/*! namespace exports */
/*! exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.* */
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		if(__webpack_module_cache__[moduleId]) {
/******/ 			return __webpack_module_cache__[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
/******/ 	// startup
/******/ 	// Load entry module
/******/ 	__webpack_require__("./src/js/tab.js");
/******/ 	// This entry module used 'exports' so it can't be inlined
/******/ })()
;