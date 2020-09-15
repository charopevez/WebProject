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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/main.js":
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*Search Suggestion function*/
$(document).ready(function () {
  $('.search_input').on('keyup', function () {
    var query = $(this).val();

    if (query != '') {
      var _token = $('input[name="_token"]').val();

      $.ajax({
        url: "autocomplete",
        method: "POST",
        data: {
          search: query,
          _token: _token
        },
        success: function success(data) {
          $('.search_suggestion').fadeIn();
          $('.search_suggestion').html(data);
        }
      });
    }
  });
  $(document).on('click', 'li', function () {
    $('.search_suggestion').val($(this).text());
    $('.search_suggestion').fadeOut();
  });
});
'use strict';

var searchBox = document.querySelectorAll('.search-box input[type="text"] + span');
searchBox.forEach(function (elm) {
  elm.addEventListener('click', function () {
    elm.previousElementSibling.value = '';
  });
});
/*Search Suggestion function*/

/*Animated menu*/

/*Animated menu*/

/*Preloader*/

(function ($) {
  "use strict";

  jQuery(document).ready(function () {
    // // Navigation for Mobile Device
    $('.custom-navbar').on('click', function () {
      $('.main-menu ul').slideToggle(500);
    });
    $(window).on('resize', function () {
      if ($(window).width() > 767) {
        $('.main-menu ul').removeAttr('style');
      }
    }); // Employee Slider

    $('.employee-slider').owlCarousel({
      loop: true,
      margin: 20,
      autoplay: true,
      autoplayTimeout: 2000,
      autoplayHoverPause: true,
      nav: false,
      dots: true,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1
        },
        576: {
          items: 1
        },
        768: {
          items: 1
        },
        992: {
          items: 2
        }
      }
    }); // Nice Select

    $('select').niceSelect(); // Range Slider

    $("#range").ionRangeSlider({
      hide_min_max: true,
      keyboard: true,
      min: 0,
      max: 5000,
      from: 1000,
      to: 4000,
      type: 'double',
      step: 1,
      prefix: "$",
      grid: true
    }); // Google Map

    if ($('#mapBox').length) {
      var $lat = $('#mapBox').data('lat');
      var $lon = $('#mapBox').data('lon');
      var $zoom = $('#mapBox').data('zoom');
      var $marker = $('#mapBox').data('marker');
      var $info = $('#mapBox').data('info');
      var $markerLat = $('#mapBox').data('mlat');
      var $markerLon = $('#mapBox').data('mlon');
      var map = new GMaps({
        el: '#mapBox',
        lat: $lat,
        lng: $lon,
        scrollwheel: false,
        scaleControl: true,
        streetViewControl: false,
        panControl: true,
        disableDoubleClickZoom: true,
        mapTypeControl: false,
        zoom: $zoom,
        styles: [{
          "featureType": "water",
          "elementType": "geometry.fill",
          "stylers": [{
            "color": "#dcdfe6"
          }]
        }, {
          "featureType": "transit",
          "stylers": [{
            "color": "#808080"
          }, {
            "visibility": "off"
          }]
        }, {
          "featureType": "road.highway",
          "elementType": "geometry.stroke",
          "stylers": [{
            "visibility": "on"
          }, {
            "color": "#dcdfe6"
          }]
        }, {
          "featureType": "road.highway",
          "elementType": "geometry.fill",
          "stylers": [{
            "color": "#ffffff"
          }]
        }, {
          "featureType": "road.local",
          "elementType": "geometry.fill",
          "stylers": [{
            "visibility": "on"
          }, {
            "color": "#ffffff"
          }, {
            "weight": 1.8
          }]
        }, {
          "featureType": "road.local",
          "elementType": "geometry.stroke",
          "stylers": [{
            "color": "#d7d7d7"
          }]
        }, {
          "featureType": "poi",
          "elementType": "geometry.fill",
          "stylers": [{
            "visibility": "on"
          }, {
            "color": "#ebebeb"
          }]
        }, {
          "featureType": "administrative",
          "elementType": "geometry",
          "stylers": [{
            "color": "#a7a7a7"
          }]
        }, {
          "featureType": "road.arterial",
          "elementType": "geometry.fill",
          "stylers": [{
            "color": "#ffffff"
          }]
        }, {
          "featureType": "road.arterial",
          "elementType": "geometry.fill",
          "stylers": [{
            "color": "#ffffff"
          }]
        }, {
          "featureType": "landscape",
          "elementType": "geometry.fill",
          "stylers": [{
            "visibility": "on"
          }, {
            "color": "#efefef"
          }]
        }, {
          "featureType": "road",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#696969"
          }]
        }, {
          "featureType": "administrative",
          "elementType": "labels.text.fill",
          "stylers": [{
            "visibility": "on"
          }, {
            "color": "#737373"
          }]
        }, {
          "featureType": "poi",
          "elementType": "labels.icon",
          "stylers": [{
            "visibility": "off"
          }]
        }, {
          "featureType": "poi",
          "elementType": "labels",
          "stylers": [{
            "visibility": "off"
          }]
        }, {
          "featureType": "road.arterial",
          "elementType": "geometry.stroke",
          "stylers": [{
            "color": "#d6d6d6"
          }]
        }, {
          "featureType": "road",
          "elementType": "labels.icon",
          "stylers": [{
            "visibility": "off"
          }]
        }, {}, {
          "featureType": "poi",
          "elementType": "geometry.fill",
          "stylers": [{
            "color": "#dadada"
          }]
        }]
      });
    }
  });
  jQuery(window).on('load', function () {
    // WOW JS
    new WOW().init(); // Preloader

    $('.preloader').fadeOut(500);
  });
})(jQuery);
/*Preloader*/

/*Search on site directly*/

/*Search on site directly*/

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/main.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\xampp\htdocs\52banana\resources\js\main.js */"./resources/js/main.js");


/***/ })

/******/ });