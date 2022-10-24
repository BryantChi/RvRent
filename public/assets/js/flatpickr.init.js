//Flatpickr
var today = new Date();
var tomorrow = new Date();
tomorrow.setDate(today.getDate() + 1);

$("#checkin-date").flatpickr({
    defaultDate:today
});

$("#checkout-date").flatpickr({
    defaultDate:tomorrow
});

$("#checkin-date2").flatpickr({
    defaultDate:today
});

$("#checkout-date2").flatpickr({
    defaultDate:tomorrow
});
