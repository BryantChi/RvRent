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

// 使用jQuery ajax來取得JSON資料
var continuousHolidays = [];
$.ajax({
    url: "https://cdn.jsdelivr.net/gh/ruyut/TaiwanCalendar/data/" + new Date().getFullYear() + ".json",
    method: 'GET',
    dataType: 'json',
    success: function(data) {
         // 用於存儲連續假期的結果
        let currentHolidays = []; // 暫時存儲當前連續的假期

        // 迭代資料
        for (let i = 0; i < data.length; i++) {
            // 如果當天是假期
            if (data[i].isHoliday) {
                currentHolidays.push(formatDateToYMD(data[i].date)); // 加入暫時陣列

                // 如果是資料的最後一天且當前連續假期的長度大於等於3，則加入結果陣列
                if (i == data.length - 1 && currentHolidays.length >= 3) {
                    continuousHolidays.push(currentHolidays);
                }
            } else {
                // 如果當天不是假期，但之前有連續的假期
                if (currentHolidays.length >= 3) {
                    $.each(currentHolidays, function(index, value) {
                        continuousHolidays.push(value);
                    })
                }
                // 清空暫時陣列
                currentHolidays = [];
            }
        }

        // 顯示結果
        // console.log(continuousHolidays);
        disableDate(continuousHolidays);
    },
    error: function(err) {
        console.error("Error fetching data:", err);
    }
});

$.ajax({
    url: "https://cdn.jsdelivr.net/gh/ruyut/TaiwanCalendar/data/" + (new Date().getFullYear()+1) + ".json",
    method: 'GET',
    dataType: 'json',
    success: function(data) {
         // 用於存儲連續假期的結果
        let currentHolidays = []; // 暫時存儲當前連續的假期

        // 迭代資料
        for (let i = 0; i < data.length; i++) {
            // 如果當天是假期
            if (data[i].isHoliday) {
                currentHolidays.push(formatDateToYMD(data[i].date)); // 加入暫時陣列

                // 如果是資料的最後一天且當前連續假期的長度大於等於3，則加入結果陣列
                if (i == data.length - 1 && currentHolidays.length >= 3) {
                    continuousHolidays.push(currentHolidays);
                }
            } else {
                // 如果當天不是假期，但之前有連續的假期
                if (currentHolidays.length >= 3) {
                    $.each(currentHolidays, function(index, value) {
                        continuousHolidays.push(value);
                    })
                }
                // 清空暫時陣列
                currentHolidays = [];
            }
        }

        // 顯示結果
        // console.log(continuousHolidays);
        disableDate(continuousHolidays);
    },
    error: function(err) {
        console.error("Error fetching data:", err);
    }
});

function disableDate(arr) {
    // console.log(continuousHolidays);
    var today = new Date();
    $("#checkin-date").flatpickr({
        defaultDate: today,
        minDate: "today",
        "locale": "zh_tw",
        disable: arr,
        dateFormat: "Y-m-d",
    });

    $("#checkout-date").flatpickr({
        defaultDate: today,
        minDate: "today",
        "locale": "zh_tw",
        disable: arr,
        dateFormat: "Y-m-d",
    });
}

function formatDateToYMD(dateStr) {
    let year = dateStr.substring(0, 4);
    let month = dateStr.substring(4, 6);
    let day = dateStr.substring(6, 8);
    return `${year}-${month}-${day}`;
}

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
