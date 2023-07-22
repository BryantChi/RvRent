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

                <div id="pdfContainer" style="width: 100%; height: 100vh;"></div>
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
        const pdfUrl = "{{ env('APP_URL') . '/uploads/' . $series }}";

        // 用於存儲 PDF.js 的實例
        let pdfInstance = null;

        // 用於儲存當前頁面和頁面總數
        let currentPage = 1;
        let totalPages = 0;

        // 初始化 PDF.js
        pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
            pdfInstance = pdf;
            totalPages = pdf.numPages;

            // 顯示第一頁
            showPage(currentPage);
        });

        // 顯示特定頁面
        function showPage(pageNumber) {
            pdfInstance.getPage(pageNumber).then(page => {
                const scale = 1.5;
                const viewport = page.getViewport({
                    scale
                });

                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };

                page.render(renderContext).promise.then(() => {
                    // 清空 pdfContainer 並顯示新的頁面
                    const container = document.getElementById('pdfContainer');
                    container.innerHTML = '';
                    container.appendChild(canvas);
                });
            });
        }

        // 當使用者滾動到頁面底部時，檢查是否到達最後一頁並加載下一頁
        $(window).scroll(function() {
            const windowHeight = $(window).height();
            const documentHeight = $(document).height();
            const scrollTop = $(window).scrollTop();

            // 判斷是否已經滑到最底部
            if (scrollTop + windowHeight >= documentHeight) {
                // 判斷是否到達最後一頁
                if (currentPage < totalPages) {
                    currentPage++;
                    showPage(currentPage);
                } else {
                    // 已經到達最後一頁，執行相應操作
                    console.log('已經到達最後一頁');
                    $('#readed').attr('disabled', false);
                }
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
