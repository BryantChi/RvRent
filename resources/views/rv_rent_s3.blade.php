@extends('layouts.master')

@section('content_section')
    @include('layouts.sub_hero')

    @include('layouts.rent_step_bar')

    <section class="section">
        <div class="container">
            <div class="section-title mx-auto text-center">
                <h2>露營車租賃契約書</h2>
            </div>
            <div class="row mb-3 mx-md-auto mx-3">
                {{-- <iframe src="{{ env('APP_URL') . '/uploads/' . $series }}" width="100%" style="height: 100vh;" seamless scrolling="yes" type="application/pdf" frameborder="0"></iframe> --}}
                {{-- <div id="pdfContainer" style="width: 100%; height: 100vh;">
                    <canvas id="pdfViewer" style="border: 1px solid black;"></canvas>
                </div> --}}

                <div id="pdfContainer"></div>
                {{-- <div class="w-100">
                    <button id="prev-page" class="btn btn-primary3 mx-1">Previous Page</button>
                    <button id="next-page" class="btn btn-primary3 mx-1">Next Page</button>
                </div> --}}


                <p class="my-3"><a class="h5" target="_blank"
                        href="{{ env('APP_URL') . '/uploads/' . $series }}">點此下載租賃條款契約書</a></p>
            </div>
            <div class="row mb-3 mx-md-auto mx-3">
                <div class="form-group form-check form-control-lg d-flex align-items-center">
                    <input type="checkbox" class="form-check-input" name="readed" id="readed" value="*請選擇“同意”繼續操作*">
                    <label class="form-check-label" style="font-size: 1.2rem !important;"
                        for="readed">*請選擇“同意”繼續操作*</label>
                </div>
            </div>
            <div class="row justify-content-center">
                <input type="button" class="btn btn-secondary btn-next" value="下一步">
            </div>
        </div>
    </section>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script> --}}
    <style>
        #pdfContainer {
            max-width: 100%;
            /* 最大寬度設定為100% */
            overflow-x: auto;
            /* 如果PDF寬度超出容器，啟用水平滾動 */
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


        // PDF 文件的 URL
        var pdfUrl = "{{ env('APP_URL') . '/uploads/' . $series }}";

        // 初始化 PDF.js
        pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
            pdfInstance = pdf;
            totalPages = pdf.numPages;

            // 顯示第一頁
            showPage(currentPage);
        });

        // 創建PDF的Canvas元素
        var canvas = document.createElement("canvas");
        var context = canvas.getContext("2d");

        // 將Canvas添加到PDF顯示容器中
        $("#pdfContainer").append(canvas);

        // 使用PDF.js Library載入PDF
        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
            // 獲取PDF的總頁數
            var totalNumPages = pdf.numPages;

            // 顯示第一頁
            showPage(1);

            // 在pdfContainer中監聽滾動事件
            $("#pdfContainer").on("scroll", function() {
                // 計算PDF容器的底部位置
                var containerTop = $("#pdfContainer").offset().top;
                var containerBottom = containerTop + $("#pdfContainer").height();

                // 計算最後一頁的底部位置
                var lastPageNum = parseInt($("#pdfContainer").data("lastPageNum"));
                var lastPageBottom = $("#pdfContainer .pdf-page[data-page='" + lastPageNum + "']").offset()
                    .top + $("#pdfContainer .pdf-page[data-page='" + lastPageNum + "']").height();

                // 如果PDF容器出現在最後一頁，載入下一頁
                if (containerBottom >= lastPageBottom) {
                    // 獲取目前顯示的頁面號碼
                    var currentPageNum = parseInt($("#pdfContainer").data("pageNum") || 1);

                    // 如果目前顯示的頁面號碼小於總頁數，則載入下一頁
                    if (currentPageNum < totalNumPages) {
                        currentPageNum++;
                        showPage(currentPageNum);
                    } else {
                        $('#readed').attr('disabled', true);
                    }
                }
            });

            // 顯示指定頁面
            function showPage(pageNum) {
                pdf.getPage(pageNum).then(function(page) {
                    var viewport = page.getViewport({
                        scale: 1
                    });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    // 將頁面號碼存儲在pdfContainer中
                    $("#pdfContainer").data("pageNum", pageNum);

                    // 將最後一頁號碼存儲在pdfContainer中
                    if (pageNum === totalNumPages) {
                        $("#pdfContainer").data("lastPageNum", pageNum);
                    }

                    // 將頁面渲染到Canvas中
                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext);

                    // 將頁面添加到pdfContainer中，以便判斷是否到達最後一頁
                    $("#pdfContainer").append('<div class="pdf-page" data-page="' + pageNum + '"></div>');
                });
            }
        });
    </script>
    <script>
        // 當文件載入完成時，初始化 PDF.js
        // window.addEventListener("DOMContentLoaded", function () {
        //   var pdfFile = "{{ env('APP_URL') . '/uploads/' . $series }}"; // 替換成你的 PDF 檔案路徑
        //   PDFJS.getDocument(pdfFile).then(function (pdf) {
        //     pdf.getPage(1).then(function (page) {
        //       var canvas = document.getElementById("pdfViewer");
        //       var context = canvas.getContext("2d");

        //       var viewport = page.getViewport({ scale: 1 });
        //       canvas.height = viewport.height;
        //       canvas.width = viewport.width;

        //       var renderContext = {
        //         canvasContext: context,
        //         viewport: viewport,
        //       };
        //       page.render(renderContext);
        //     });
        //   });
        // });
        // $(document).ready(function() {
        //     var pdfPath = "{{ env('APP_URL') . '/uploads/' . $series }}"; // 替換成你的 PDF 檔案路徑

        //     PDFJS.getDocument(pdfPath).then(function(pdf) {
        //         pdf.getPage(1).then(function(page) {
        //             var canvas = document.getElementById("pdfViewer");
        //             var context = canvas.getContext("2d");

        //             var viewport = page.getViewport({
        //                 scale: 1
        //             });
        //             canvas.height = viewport.height;
        //             canvas.width = viewport.width;

        //             var renderContext = {
        //                 canvasContext: context,
        //                 viewport: viewport,
        //             };
        //             page.render(renderContext);
        //         });
        //     });
        // });
    </script>
@endsection
