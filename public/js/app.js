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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(2);


/***/ }),
/* 1 */
/***/ (function(module, exports) {

// Number formatting
$('#down_payment').number(true, 0, ',', '.');
$('#biaya').number(true, 0, ',', '.');

// =========================
// Services Modal

// Complete the service
$('.js--show-complete-service-modal').click(function () {
    $('.js--complete-service-modal form').attr('action', $(this).data('action'));
    $('.js--complete-service-modal #number').val($(this).data('number'));
    $('.js--complete-service-modal').modal('show');
});

// Complete the service (simplefied, show page)
$('.js--show-complete-modal').click(function () {
    $('.js--complete-service-modal').modal('show');
});

// Print service receipt
$('.js--show-print-service-receipt-modal').click(function () {
    $('.js--service-number').text($(this).data('number'));
    $('#js--service-date').text($(this).data('date'));
    $('#js--service-owner').text($(this).data('owner'));
    $('#js--service-merk').text($(this).data('merk'));
    $('#js--service-serial').text($(this).data('serial'));
    $('#js--service-dp').text($(this).data('dp'));
    $('#js--service-technician').text($(this).data('technician'));
    $('#js--service-note').text($(this).data('note'));
    $('#js--service-phone').text($(this).data('phone'));
    $('#js--print-service-modal').modal('show');
});

// Print service reciept (simplefied, show page)
$('#js--show-print-service-modal').click(function () {
    $('#js--print-service-modal').modal('show');
});

$('#js--print-service-receipt-button').click(function () {
    $('#js--service-receipt').printThis();
});

// Reservice the service number
$('#js--show-reservice-modal').click(function () {
    $('#js--reservice-service-modal').modal('show');
});

// Delete service
$('#js--show-delete-service-modal').click(function () {
    $('#js--delete-service-modal').modal('show');
});

// Cancel delivery service
$('#js--show-cancel-delivery-modal').click(function (e) {
    e.preventDefault();
    $('#js--cancel-delivery-service-modal').modal('show');
});

// Cancel service payment
$('#js--show-cancel-payment-modal').click(function (e) {
    e.preventDefault();
    $('#js--cancel-payment-service-modal').modal('show');
});

// =========================
// Payment Modal
$('.js--show-payment-modal').click(function () {
    $('#js--payment-modal form').attr('action', $(this).data('action'));
    $('#js--payment-modal #nama').val($(this).data('name'));
    $('#js--service-number').text($(this).data('number'));
    $('#js--down-payment').text($(this).data('down-payment'));
    $('#js--fee').text($(this).data('fee'));
    $('#js--remaining').text($(this).data('remaining'));
    $('#js--payment-modal').modal('show');
});

// =========================
// Agent Modal
$('#js--show-delete-agent-modal').click(function () {
    $('#js--delete-agent-modal').modal('show');
});

// =========================
// Delivery Modal

// Delete Delivery
$('.js--show-delete-delivery-modal').click(function () {
    $('#js--delete-delivery-modal form').attr('action', $(this).data('action'));
    $('#js--delivery-number').text($(this).data('number'));
    $('#js--delete-delivery-modal').modal('show');
});

// Print Delivery Receipt
$('.js--show-print-delivery-modal').click(function () {
    var numbers = $(this).data('numbers');
    var services = $(this).data('services');
    var servicesHtml = $('#js--delivery-services');

    servicesHtml.empty();

    $.each(numbers, function (index, number) {
        services[index].number = number;
    });

    $('#js--delivery-date').text($(this).data('date'));
    $('#js--delivery-agent').text($(this).data('agent'));

    $.each(services, function (index, service) {
        var serviceHtml = '\n            <tr class="top aligned">\n                <td>1</td>\n                <td>' + service.number + '</td>\n                <td>\n                    Merk : ' + service.merk + ' <br>\n                    No. Seri : ' + service.serial_number + ' <br>\n                    Ket : ' + service.note + ' <br>\n                </td>\n            </tr>\n        ';
        servicesHtml.append(serviceHtml);
    });

    $('#js--print-delivery-modal').modal('show');
});

$('#js--print-delivery-receipt-button').click(function () {
    $('#js--delivery-receipt').printThis();
});

// Create Delivery
$('.dropdown').dropdown();
$('.js--select-service').checkbox();

var serviceId = '';
var serviceIds = [];
var serviceNumbers = [];
var serviceIdsInput = $('#services');
var selectedServicesText = $('#js--selected-services');

function checked(elm) {
    serviceId = elm.children('.check').val();
    serviceIds.push(serviceId);
    serviceNumbers.push(elm.children('.check').data('number'));
}

function unchecked(elm) {
    serviceId = elm.children('.check').val();
    var position = serviceIds.indexOf(serviceId);
    serviceIds.splice(position, 1);
    serviceNumbers.splice(position, 1);
}

function updateList() {
    serviceIdsInput.val(JSON.stringify(serviceIds));
    if (serviceIdsInput.val() === '[]') {
        selectedServicesText.text('Tidak ada servis yang terpilih.');
    } else {
        selectedServicesText.text(serviceNumbers.toString());
    }
}

$('.js--select-service').click(function (e) {
    if ($(this).checkbox('is checked')) {
        checked($(this));
        updateList();
    } else if ($(this).checkbox('is unchecked')) {
        unchecked($(this));
        updateList();
    }
});

/***/ }),
/* 2 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);