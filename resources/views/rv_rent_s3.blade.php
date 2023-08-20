@extends('layouts.master')

@section('content_section')
    @include('layouts.sub_hero')

    @include('layouts.rent_step_bar')

    <section class="section">
        <div class="container">
            <div class="section-title mx-auto text-center">
                <h2>露營車租賃契約書</h2>
            </div>
            <div class="row mx-md-auto mx-3">
                {{-- <iframe src="{{ env('APP_URL') . '/uploads/' . $series }}" width="100%" style="height: 100vh;" seamless scrolling="yes" type="application/pdf" frameborder="0"></iframe> --}}
                {{-- <div id="pdfContainer" style="width: 100%; height: 100vh;">
                    <canvas id="pdfViewer" style="border: 1px solid black;"></canvas>
                </div> --}}

                <div id="pdfContainer"></div>
                <div class="w-100">
                    <!-- 顯示頁碼及總頁數的文本 -->
                    <div id="pageInfo" class="text-right mb-5"></div>
                    <!-- 手動切換頁的按鈕 -->
                    <button id="prevPage" class="btn btn-primary3">上一頁</button>
                    <button id="nextPage" class="btn btn-primary3">下一頁</button>
                </div>


                <p class="mt-3"><a class="h5" target="_blank"
                        href="{{ 'http://9o-traveller.com.tw/uploads/' . $series }}">點此下載租賃條款契約書</a></p>
            </div>
            <div class="row mb-3 mx-md-auto mx-3">
                <div class="form-group form-check form-control-lg d-flex align-items-center">
                    <input type="checkbox" class="form-check-input" name="readed" id="readed" value="*請在完整閱讀後選擇“同意”繼續操作*" data-access="false">
                    <label class="form-check-label" style="font-size: 1.2rem;"
                        for="readed">*請在完整閱讀後選擇“同意”繼續操作*</label>
                </div>
            </div>
            <div class="row justify-content-center">
                <input type="button" class="btn btn-secondary btn-next" value="下一步">
            </div>
        </div>
    </section>
    {{-- <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script> --}}
    <style>
        #pdfContainer {
            width: 100%;
            /* 最大寬度設定為100% */
            overflow-x: auto;
            /* 如果PDF寬度超出容器，啟用水平滾動 */
            overflow-y: auto;
            /* 啟用垂直滾動 */
            height: 100vh;
            border: 3px solid #747474;
        }

        @media (max-width: 768px) {
            #pdfContainer {
                height: 30rem;
            }

            .form-check-label {
                font-size: 1rem !important;
            }
        }
    </style>
    <script>
        $('#readed').attr('disabled', true);
        $('.btn-next').attr('disabled', true);
        // $('.btn-next').addClass('btn-secondary');
        $('#readed').click(function() {
            if ($('#readed').is(":checked")) {
                $('#readed').attr('disabled', true);
                $('.btn-next').attr('disabled', false);
                $('.btn-next').removeClass('btn-secondary');
                $('.btn-next').addClass('btn-primary3');
            }
        });


        $('.btn-next').click(function() {
            window.location.href = "{{ route('car_rent_s4') }}";
        });


        // pdfjsLib.GlobalWorkerOptions.workerSrc = '{{ asset("assets/js/pdfjs-3.9.179-dist/build/pdf.js") }}';
        // pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.js';
        // PDF 文件的 URL
        var pdfUrl = "{{ 'http://9o-traveller.com.tw/uploads/' . $series }}";

        // 創建PDF的Canvas元素
        var canvas = document.createElement("canvas");
        var context = canvas.getContext("2d");

        // 將Canvas添加到PDF顯示容器中
        $("#pdfContainer").append(canvas);

        // 使用PDF.js Library載入PDF
        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
            // 獲取PDF的總頁數
            var totalNumPages = pdf.numPages;

            // 初始頁碼為第一頁
            var currentPageNum = 1;

            // 顯示第一頁
            showPage(currentPageNum);

            // 顯示頁碼及總頁數
            $("#pageInfo").text(currentPageNum + " / " + totalNumPages + " 頁");

            // 監聽手動切換頁的事件
            $("#prevPage").on("click", function() {
                if (currentPageNum > 1) {
                    currentPageNum--;
                    showPage(currentPageNum);
                    updatePageInfo();
                }
            });

            $("#nextPage").on("click", function() {
                if (currentPageNum < totalNumPages) {
                    currentPageNum++;
                    showPage(currentPageNum);
                    updatePageInfo();
                }
            });

            // 監聽滾動事件
            // $("#pdfContainer").on("scroll", function() {
            //     // 計算視窗底部位置
            //     var windowHeight = $("#pdfContainer").height();
            //     var windowBottom = $("#pdfContainer").scrollTop() + windowHeight;

            //     // 計算PDF容器的底部位置
            //     var containerBottom = $("#pdfContainer").prop("scrollHeight");

            //     // 如果PDF容器出現在最後一頁，載入下一頁
            //     if (windowBottom >= containerBottom) {
            //         if (currentPageNum < totalNumPages) {
            //             currentPageNum++;
            //             showPage(currentPageNum);
            //             updatePageInfo();
            //         }
            //     }
            // });

            // 顯示指定頁面
            function showPage(pageNum) {
                pdf.getPage(pageNum).then(function(page) {
                    var viewport = page.getViewport({
                        scale: 1
                    });

                    // 計算Canvas的寬高比例以符合容器
                    var containerWidth = $("#pdfContainer").width();
                    if ($(window).width() < 767) {
                        var scale = 1;
                    } else {
                        var scale = containerWidth / viewport.width;
                    }
                    var scaledViewport = page.getViewport({
                            scale: scale
                    });


                    canvas.height = scaledViewport.height;
                    canvas.width = scaledViewport.width;

                    // 將頁面號碼存儲在pdfContainer中
                    $("#pdfContainer").data("pageNum", pageNum);

                    // 將最後一頁號碼存儲在pdfContainer中
                    if (pageNum === totalNumPages) {
                        $("#pdfContainer").data("lastPageNum", pageNum);
                    }

                    // 將頁面渲染到Canvas中
                    var renderContext = {
                        canvasContext: context,
                        viewport: scaledViewport
                    };
                    page.render(renderContext);
                });
            }

            // 更新顯示頁碼及總頁數
            function updatePageInfo() {
                $("#pageInfo").text(currentPageNum + " / " + totalNumPages + " 頁");

                if(currentPageNum == totalNumPages && $('#readed').data('access') == false) {
                    $('#readed').data('access', true);
                    $('#readed').attr('disabled', false);
                    $('.form-check-label').addClass('text-danger');
                }
            }
        });
    </script>
@endsection
