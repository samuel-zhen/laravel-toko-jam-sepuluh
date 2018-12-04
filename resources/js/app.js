// Number formatting
$('#down_payment').number(true, 0, ',', '.')
$('#biaya').number(true, 0, ',', '.')

// =========================
// Services Modal

// Complete the service
$('.js--show-complete-service-modal').click(function () {
    $('.js--complete-service-modal form').attr('action', $(this).data('action'))
    $('.js--complete-service-modal #number').val($(this).data('number'))
    $('.js--complete-service-modal').modal('show')
})

// Complete the service (simplefied, show page)
$('.js--show-complete-modal').click(() => {
    $('.js--complete-service-modal').modal('show')
})

// Print service receipt
$('.js--show-print-service-receipt-modal').click(function () {
    $('.js--service-number').text($(this).data('number'))
    $('#js--service-date').text($(this).data('date'))
    $('#js--service-owner').text($(this).data('owner'))
    $('#js--service-merk').text($(this).data('merk'))
    $('#js--service-serial').text($(this).data('serial'))
    $('#js--service-dp').text($(this).data('dp'))
    $('#js--service-technician').text($(this).data('technician'))
    $('#js--service-note').text($(this).data('note'))
    $('#js--service-phone').text($(this).data('phone'))
    $('#js--print-service-modal').modal('show')
})

// Print service reciept (simplefied, show page)
$('#js--show-print-service-modal').click(() => {
    $('#js--print-service-modal').modal('show')
})


$('#js--print-service-receipt-button').click(() => {
    $('#js--service-receipt').printThis();
})

// Reservice the service number
$('#js--show-reservice-modal').click(() => {
    $('#js--reservice-service-modal').modal('show')
})

// Delete service
$('#js--show-delete-service-modal').click(() => {
    $('#js--delete-service-modal').modal('show')
})

// Cancel delivery service
$('#js--show-cancel-delivery-modal').click((e) => {
    e.preventDefault()
    $('#js--cancel-delivery-service-modal').modal('show')
})

// Cancel service payment
$('#js--show-cancel-payment-modal').click((e) => {
    e.preventDefault()
    $('#js--cancel-payment-service-modal').modal('show')
})

// =========================
// Payment Modal
$('.js--show-payment-modal').click(function () {
    $('#js--payment-modal form').attr('action', $(this).data('action'))
    $('#js--payment-modal #nama').val($(this).data('name'))
    $('#js--service-number').text($(this).data('number'))
    $('#js--down-payment').text($(this).data('down-payment'))
    $('#js--fee').text($(this).data('fee'))
    $('#js--remaining').text($(this).data('remaining'))
    $('#js--payment-modal').modal('show')
})

// =========================
// Agent Modal
$('#js--show-delete-agent-modal').click(() => {
    $('#js--delete-agent-modal').modal('show')
})

// =========================
// Delivery Modal

// Delete Delivery
$('.js--show-delete-delivery-modal').click(function () {
    $('#js--delete-delivery-modal form').attr('action', $(this).data('action'))
    $('#js--delivery-number').text($(this).data('number'))
    $('#js--delete-delivery-modal').modal('show')
})

// Print Delivery Receipt
$('.js--show-print-delivery-modal').click(function () {
    const numbers = $(this).data('numbers')
    const services = $(this).data('services')
    const servicesHtml = $('#js--delivery-services')

    servicesHtml.empty()

    $.each(numbers, function (index, number) {
        services[index].number = number
    })
    
    $('#js--delivery-date').text($(this).data('date'))
    $('#js--delivery-agent').text($(this).data('agent'))

    $.each(services, function (index, service) {
        const serviceHtml = `
            <tr class="top aligned">
                <td>1</td>
                <td>${service.number}</td>
                <td>
                    Merk : ${service.merk} <br>
                    No. Seri : ${service.serial_number} <br>
                    Ket : ${service.note} <br>
                </td>
            </tr>
        `
        servicesHtml.append(serviceHtml)
    })

    $('#js--print-delivery-modal').modal('show')
})

$('#js--print-delivery-receipt-button').click(() => {
    $('#js--delivery-receipt').printThis();
})

// Create Delivery
$('.dropdown').dropdown()
$('.js--select-service').checkbox()

let serviceId = '';
let serviceIds = [];
let serviceNumbers = [];
let serviceIdsInput = $('#services')
let selectedServicesText = $('#js--selected-services')

function checked(elm) {
    serviceId = elm.children('.check').val()
    serviceIds.push(serviceId)
    serviceNumbers.push(elm.children('.check').data('number'));
}

function unchecked(elm) {
    serviceId = elm.children('.check').val()
    let position = serviceIds.indexOf(serviceId)
    serviceIds.splice(position, 1);
    serviceNumbers.splice(position, 1);
}

function updateList() {
    serviceIdsInput.val(JSON.stringify(serviceIds))
    if (serviceIdsInput.val() === '[]') {
        selectedServicesText.text('Tidak ada servis yang terpilih.')    
    } else {
        selectedServicesText.text(serviceNumbers.toString())
    }
}

$('.js--select-service').click(function (e) {
    if ($(this).checkbox('is checked')) {
        checked($(this))
        updateList()
    } else if ($(this).checkbox('is unchecked')) {
        unchecked($(this))
        updateList()
    }
})