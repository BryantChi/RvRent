$(function () {
    var width = $(window).width();
    if (width >= 768) {
        $("#hero").backstretch(
            [
                "<?php echo asset('assets/img/hero/首頁模擬1-背景圖.jpg') ?>",
                "<?php echo asset('assets/img/hero/首頁模擬2-背景圖.jpg') ?>",
                "<?php echo asset('assets/img/hero/首頁模擬4-背景圖.jpg') ?>",
                "<?php echo asset('assets/img/hero/首頁模擬5-背景圖.jpg') ?>",
                "<?php echo asset('assets/img/hero/首頁模擬7-背景圖.jpg') ?>",
            ],
            {
                duration: 3000,
                fade: 750,
            }
        );
    } else {
        $("#hero").backstretch(
            [
                "<?php echo asset('assets/img/hero/手機模擬1-背景圖.jpg') ?>",
                "<?php echo asset('assets/img/hero/手機模擬2-背景圖.jpg') ?>",
                "<?php echo asset('assets/img/hero/手機模擬4-背景圖.jpg') ?>",
                "<?php echo asset('assets/img/hero/手機模擬5-背景圖.jpg') ?>",
            ],
            {
                duration: 3000,
                fade: 750,
            }
        );
    }

    $(document).ready(function () {
        $(window).resize(function () {
            var width = $(window).width();
            if (width >= 768) {
                $("#hero").backstretch(
                    [
                        "<?php echo asset('assets/img/hero/首頁模擬1-背景圖.jpg') ?>",
                        "<?php echo asset('assets/img/hero/首頁模擬2-背景圖.jpg') ?>",
                        "<?php echo asset('assets/img/hero/首頁模擬4-背景圖.jpg') ?>",
                        "<?php echo asset('assets/img/hero/首頁模擬5-背景圖.jpg') ?>",
                        "<?php echo asset('assets/img/hero/首頁模擬7-背景圖.jpg') ?>",
                    ],
                    {
                        duration: 3000,
                        fade: 750,
                    }
                );
            } else {
                $("#hero").backstretch(
                    [
                        "<?php echo asset('assets/img/hero/手機模擬1-背景圖.jpg') ?>",
                        "<?php echo asset('assets/img/hero/手機模擬2-背景圖.jpg') ?>",
                        "<?php echo asset('assets/img/hero/手機模擬4-背景圖.jpg') ?>",
                        "<?php echo asset('assets/img/hero/手機模擬5-背景圖.jpg') ?>",
                    ],
                    {
                        duration: 3000,
                        fade: 750,
                    }
                );
            }
        });
    });
});
