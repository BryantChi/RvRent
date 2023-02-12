//Flatpickr
var today = new Date();
var tomorrow = new Date();
// tomorrow.setDate(today.getDate() + 1);

$("#checkin-date").flatpickr({
    defaultDate:today,
    minDate: "today",
    "locale": "zh_tw",
});

$("#checkout-date").flatpickr({
    defaultDate:today,
    minDate: "today",
    "locale": "zh_tw",
});

// $("#checkin-date2").flatpickr({
//     defaultDate:today,
//     minDate: "today",
//     "locale": "zh_tw",
// });

// $("#checkout-date2").flatpickr({
//     defaultDate:today,
//     minDate: "today",
//     "locale": "zh_tw",
// });

// flatpickr('#heckin-date', {
//     "locale": "zh_tw",
//     "dateFormat": "Y/m/d",
//     "defaultDate":"today"
// defaultDate:new Date().fp_incr(1),
// });
