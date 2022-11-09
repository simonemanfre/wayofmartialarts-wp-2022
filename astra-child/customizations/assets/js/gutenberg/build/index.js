/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/editor.scss":
/*!*************************!*\
  !*** ./src/editor.scss ***!
  \*************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ (function(module) {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ (function(module) {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ (function(module) {

module.exports = window["wp"]["element"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
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
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
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
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _editor_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./editor.scss */ "./src/editor.scss");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__);

//https://github.com/bigbite/gutenberg-postlist-demo/blob/master/src/block/block.js

/*
* 
* Blocks dynamic data
*
*/
var cats = [];
Object.entries(fabc_gutenberg_cats).forEach(_ref => {
  let [key, value] = _ref;
  return cats.push(value);
});
/*
* 
* Import CSS/SCSS file
*
*/


/*
* 
* Import components
*
*/





/*
* 
* Main Const
*
*/

const {
  registerBlockType
} = wp.blocks;
/*
* 
* Home Header
*
*/

registerBlockType('fabc-astra-child/home-header', {
  title: 'FABC Home Header',
  icon: 'smiley',
  category: 'theme',
  attributes: {
    gradient_color: {
      type: 'string'
    },
    main_cat_id: {
      type: 'string'
    },
    highlighted_cat_ids: {
      type: 'array'
    }
  },
  edit: class extends _wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Component {
    constructor(props) {
      super(...arguments);
      this.props = props;
    }

    render() {
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: "fabc-content-block"
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.Panel, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelBody, {
        title: "Settings"
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", null, "Primary Gradient Color"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.ColorPicker, {
        color: this.props.attributes.gradient_color,
        onChangeComplete: gradient_color => {
          this.props.setAttributes({
            gradient_color: gradient_color.hex
          });
        },
        enableAlpha: true,
        defaultValue: "#fbc724"
      }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.SelectControl, {
        label: "Main Category",
        value: this.props.attributes.main_cat_id,
        options: cats,
        onChange: main_cat_id => {
          this.props.setAttributes({
            main_cat_id: main_cat_id
          });
        }
      }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.SelectControl, {
        multiple: true,
        label: "Highlighted Categories",
        options: cats,
        value: this.props.attributes.highlighted_cat_ids,
        onChange: cat_ids => {
          this.props.setAttributes({
            highlighted_cat_ids: cat_ids
          });
        }
      })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, "FABC Home Header"));
    }

  },
  save: function (props) {
    return null;
  }
});
/*
* 
* Latest Articles
*
*/

registerBlockType('fabc-astra-child/latest-articles', {
  title: 'FABC Latest Articles',
  icon: 'smiley',
  category: 'theme',
  attributes: {
    title: {
      type: 'string'
    },
    main_cat_id: {
      type: 'string'
    },
    highlighted_cat_ids: {
      type: 'array'
    }
  },
  edit: class extends _wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Component {
    constructor(props) {
      super(...arguments);
      this.props = props;
    }

    render() {
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: "fabc-content-block"
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.Panel, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelBody, {
        title: "Settings"
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.TextControl, {
        label: "Title",
        value: this.props.attributes.title,
        onChange: title => {
          this.props.setAttributes({
            title: title
          });
        }
      }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.SelectControl, {
        label: "Main Category",
        value: this.props.attributes.main_cat_id,
        options: cats,
        onChange: main_cat_id => {
          this.props.setAttributes({
            main_cat_id: main_cat_id
          });
        }
      }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.SelectControl, {
        multiple: true,
        label: "Highlighted Categories",
        options: cats,
        value: this.props.attributes.highlighted_cat_ids,
        onChange: cat_ids => {
          this.props.setAttributes({
            highlighted_cat_ids: cat_ids
          });
        }
      })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, "FABC Latest Articles"));
    }

  },
  save: function (props) {
    return null;
  }
});
/*
* 
* Trending
*
*/

registerBlockType('fabc-astrsa-child/trending-widget', {
  title: 'FABC Trending',
  icon: 'smiley',
  category: 'theme',
  attributes: {
    title: {
      type: 'string'
    },
    tag_ids: {
      type: 'string'
    }
  },
  edit: class extends _wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Component {
    constructor(props) {
      super(...arguments);
      this.props = props;
    }

    render() {
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: "fabc-content-block"
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.Panel, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelBody, {
        title: "Settings"
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.TextControl, {
        label: "Title",
        value: this.props.attributes.title,
        onChange: title => {
          this.props.setAttributes({
            title: title
          });
        }
      }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.TextareaControl, {
        label: "Tag IDs",
        help: "Enter one ID per line.",
        value: this.props.attributes.tag_ids,
        onChange: tag_ids => {
          this.props.setAttributes({
            tag_ids: tag_ids
          });
        }
      })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, "FABC Trending"));
    }

  },
  save: function (props) {
    return null;
  }
});
/*
* 
* Trending Sticky
*
*/

registerBlockType('fabc-astrsa-child/trending-widget-sticky', {
  title: 'FABC Trending Sticky',
  icon: 'smiley',
  category: 'theme',
  attributes: {
    title: {
      type: 'string'
    },
    main_cat_id: {
      type: 'string'
    }
  },
  edit: class extends _wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Component {
    constructor(props) {
      super(...arguments);
      this.props = props;
    }

    render() {
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: "fabc-content-block"
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.Panel, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelBody, {
        title: "Settings"
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.TextControl, {
        label: "Title",
        value: this.props.attributes.title,
        onChange: title => {
          this.props.setAttributes({
            title: title
          });
        }
      }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.SelectControl, {
        label: "Main Category",
        value: this.props.attributes.main_cat_id,
        options: cats,
        onChange: main_cat_id => {
          this.props.setAttributes({
            main_cat_id: main_cat_id
          });
        }
      })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, "FABC Trending Sticky"));
    }

  },
  save: function (props) {
    return null;
  }
});
/*
* 
* Trending Sticky
*
*/

registerBlockType('fabc-astrsa-child/related-post', {
  title: 'FABC Related Post',
  icon: 'smiley',
  category: 'theme',
  attributes: {
    keywords: {
      type: 'string'
    },
    post_data: {
      type: 'string'
    }
  },
  edit: class extends _wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Component {
    constructor(props) {
      super(...arguments);
      this.props = props;
    }

    render() {
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: "fabc-content-block"
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.Panel, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelBody, {
        title: "Settings"
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: "fabc-related-post",
        id: generate_random_string(20)
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.TextControl, {
        className: "fabc-related-post-keywords",
        placeholder: "Enter keywords and hit enter",
        value: this.props.attributes.keywords,
        onChange: keywords => {
          this.props.setAttributes({
            keywords: keywords
          });
        }
      }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: "fabc-dynamic-results"
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h4", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, "Select Related Post"), " ", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        class: "fabc-loader"
      })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.SelectControl, {
        value: this.props.attributes.post_data,
        options: [{
          value: null,
          label: 'Select'
        }],
        onChange: post_data => {
          this.props.setAttributes({
            post_data: post_data
          });
        }
      })))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h3", null, "FABC Related Post", (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, print_related_post(this.props.attributes.post_data))));
    }

  },
  save: function (props) {
    return null;
  }
});
/**
 * 
 * Generate Random String
 * 
 */

function generate_random_string(length) {
  var result = '';
  var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  var charactersLength = characters.length;

  for (var i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }

  return result;
}
/**
 * 
 * Print Related Post In Admin
 * 
 */


function print_related_post(prop) {
  if (prop) {
    return JSON.parse(prop).label;
  }
}
}();
/******/ })()
;
//# sourceMappingURL=index.js.map