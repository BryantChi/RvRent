//Flatpickr
var today = new Date();
var tomorrow = new Date();
// tomorrow.setDate(today.getDate() + 1);

$("#checkin-date").flatpickr({
    defaultDate: today,
    minDate: "today",
    locale: "zh_tw",
});

$("#checkout-date").flatpickr({
    defaultDate: today,
    minDate: "today",
    locale: "zh_tw",
});

// var lastBirthdayYear = today.getFullYear() - 20;
// var lastBirthdayMonth = today.getMonth() + 1;
// var lastBirthdayDate = today.getDate();
// var lastBirthdayStr =
//     lastBirthdayYear + "-" + lastBirthdayMonth + "-" + lastBirthdayDate;
// var lastBirthday = new Date(lastBirthdayStr);
// var lastBirth = "<?php echo $user->birthday; ?>";
// if (lastBirth != null || lastBirth != "") {
//     lastBirthday = new Date(lastBirth);
// }

// $("#birth-date").flatpickr({
//     defaultDate: lastBirthday,
//     maxDate: lastBirthday,
//     locale: "zh_tw",
// });

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
