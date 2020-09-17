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

/*filtering result*/

/*variables*/


var filtersActive = []; // an array to store the active filters

var $filters = []; // for the filters

var $sortBy = []; // for the filters

var showAll = []; // identify the "show all" button

var ascending;
var cFilter, cFilterData; // declare a variable to store the filter and one for the data to filter by

$(document).ready(function () {
  //adding filter event
  $filters = $('.site-filter'); // find the filters

  showAll = $('.showAll'); // identify the "show all" button

  $filters.click(function () {
    // if filters are clicked
    cFilter = $(this);
    cFilterData = cFilter.attr('data-filter'); // read filter value

    highlightFilter();
    applyFilter();
  }); //adding sorting event

  $sortBy = $('.sortBy'); // find the filters

  $sortBy.click(function () {
    var parameter = $(this).attr('data-column'); // read sorting value

    ascending = $(this).attr('data-order'); //get ascending value

    console.log(ascending);
    sortby('.sortable-items', parameter, ascending);
    $(this).attr('data-order', ascending === 'asc' ? 'desc' : 'asc');
    if (ascending === 'asc') $(this).addClass('data-order', 'desc').removeClass('data-order', 'asc');else $(this).addClass('data-order', 'asc').removeClass('data-order', 'desc');
    $(".sortable-items").pagify(9, 8, ".sorting-item.show-item");
    limitPages(8);
  });
  $(".sortable-items").pagify(9, 8, ".sorting-item.show-item");
  $(".custom-pagination").wrap("<div class='navbar-panel'></div>");
  limitPages(8); //add panel on top
  //$(".navbar-panel").clone().prependTo("#searchResult");
}); //controllers handle

function highlightFilter() {
  var filterClass = 'site-filter-active';

  if (cFilter.hasClass(filterClass)) {
    cFilter.removeClass(filterClass);
    removeActiveFilter(cFilterData);
  } else if (cFilter.hasClass('showAll')) {
    $filters.removeClass(filterClass);
    filtersActive = []; // clear the array

    cFilter.addClass(filterClass);
  } else {
    showAll.removeClass(filterClass);
    cFilter.addClass(filterClass);
    filtersActive.push(cFilterData);
  }
}

function applyFilter() {
  var $works = $('.item'); // find the portfolio items
  // go through all portfolio items and hide/show as necessary

  $works.each(function () {
    var i;
    var classes = $(this).attr('class').split(' ');

    if (cFilter.hasClass('showAll') || filtersActive.length === 0) {
      // makes sure we catch the array when its empty and revert to the default of showing all items
      $works.addClass('show-item'); //show them all
    } else {
      $(this).removeClass('show-item');

      for (i = 0; i < classes.length; i++) {
        if (filtersActive.indexOf(classes[i]) > -1) {
          $(this).addClass('show-item');
        }
      }
    }
  });
  $(".sortable-items").pagify(9, 8, ".sorting-item.show-item");
  limitPages(8);
} // remove deselected filters from the ActiveFilter array


function removeActiveFilter(item) {
  var index = filtersActive.indexOf(item);

  if (index > -1) {
    filtersActive.splice(index, 1);
  }
}
/*Filtering result*/

/*Sorting result*/

/**
 *@param{HTMLDivElement} block in what sorting occures
 *@param{data-tag} sort by tag value
 *@param{asc} sorting order
 *
 */

/*sortingbyvalue*/


function sortby(block, value) {
  var asc = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'asc';
  //find block for sorting
  var $wrapper = $(block);
  var items = $wrapper.find('.sorting-item'); //sort
  //console.log(value);

  items.sort(function (a, b) {
    if ($(a).data(value) < $(b).data(value)) {
      return asc === "asc" ? -1 : 1;
    }

    if ($(a).data(value) > $(b).data(value)) {
      return asc === "asc" ? 1 : -1;
    }

    return 0;
  }); //update

  items.appendTo($wrapper);
  $(".sortable-items").pagify(9, 8, ".sorting-item.show-item");
}
/*Sorting result*/

/*Pagination*/


(function ($) {
  var pagify = {
    items: {},
    container: null,
    totalPages: 1,
    perPage: 3,
    currentPage: 0,
    maxPages: 5,
    createNavigation: function createNavigation() {
      this.totalPages = Math.ceil(this.items.length / this.perPage);
      $('.custom-pagination', this.container.parent()).remove();
      var pagination = $('<ul class="custom-pagination"></ul>').append('<li id="prev"><a class="nav prev disabled" data-next="false"><</a></li>');

      for (var i = 0; i < this.totalPages; i++) {
        var pageElClass = "page";
        if (!i) pageElClass = "page active";
        var pageEl = '<li><a class="' + pageElClass + '" data-page="' + (i + 1) + '">' + (i + 1) + "</a></li>";
        pagination.append(pageEl);
      }

      pagination.append('<li id="next"><a class="nav next" data-next="true">></a></li>');
      this.container.after(pagination);
      var that = this;
      $("body").off("click", ".nav");
      this.navigator = $("body").on("click", ".nav", function () {
        var el = $(this);
        that.navigate(el.data("next"));
      });
      $("body").off("click", ".page");
      this.pageNavigator = $("body").on("click", ".page", function () {
        var el = $(this);
        that.goToPage(el.data("page"));
      });
    },
    navigate: function navigate(next) {
      // default perPage to 5
      if (isNaN(next) || next === undefined) {
        next = true;
      }

      $(".custom-pagination .nav").removeClass("disabled");

      if (next) {
        this.currentPage++;
        if (this.currentPage > this.totalPages - 1) this.currentPage = this.totalPages - 1;
        if (this.currentPage == this.totalPages - 1) $(".custom-pagination .nav.next").addClass("disabled");
      } else {
        this.currentPage--;
        if (this.currentPage < 0) this.currentPage = 0;
        if (this.currentPage == 0) $(".custom-pagination .nav.prev").addClass("disabled");
      }

      this.showItems();
    },
    updateNavigation: function updateNavigation() {
      var pages = $(".custom-pagination .page");
      pages.removeClass("active");
      $('.custom-pagination .page[data-page="' + (this.currentPage + 1) + '"]').addClass("active");
      limitPages(8);
    },
    goToPage: function goToPage(page) {
      this.currentPage = page - 1;
      $(".custom-pagination .nav").removeClass("disabled");
      if (this.currentPage == this.totalPages - 1) $(".custom-pagination .nav.next").addClass("disabled");
      if (this.currentPage == 0) $(".custom-pagination .nav.prev").addClass("disabled");
      this.showItems();
    },
    showItems: function showItems() {
      this.items.hide();
      var base = this.perPage * this.currentPage;
      this.items.slice(base, base + this.perPage).show();
      this.updateNavigation();
    },
    init: function init(container, items, perPage) {
      this.container = container;
      this.currentPage = 0;
      this.totalPages = 1;
      this.perPage = perPage;
      this.items = items;
      this.createNavigation();
      this.showItems();
    }
  }; // stuff it all into a jQuery method!

  $.fn.pagify = function (perPage, maxPages, itemSelector) {
    var el = $(this);
    var items = $(itemSelector, el); // default perPage to 5

    if (isNaN(perPage) || perPage === undefined) {
      perPage = 3;
    } // don't fire if fewer items than perPage


    if (items.length <= perPage) {
      return true;
    } //defalt maxPages


    if (isNaN(maxPages) || maxPages === undefined) {
      maxPages = 3;
    }

    pagify.init(el, items, perPage, maxPages);
  };
})(jQuery); //hide unnesasary buttons


function limitPages(max) {
  var pagesLinks = $('.custom-pagination').find('li');
  var active = $('.active').data('page');
  console.log(active);

  if (pagesLinks.length - max > 0 && max > 5) {
    console.log(active);

    for (var i = 0; i < pagesLinks.length; i++) {
      if (i === 0 || i === 1 || i === pagesLinks.length - 1 || i === pagesLinks.length - 2 || i === active - 2 || i === active - 1 || i === active || i === active + 2 || i === active + 1) {
        pagesLinks[i].className = "visible";
      } else {
        pagesLinks[i].className = "invisible";
      }
    }
  }
}
/*Pagination*/

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