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

                <div id="pdf-container" style="width: 100%; height: 100vh;"></div>
                <div class="w-100">
                    <button id="prev-page" class="btn btn-primary3 mx-1">Previous Page</button>
                    <button id="next-page" class="btn btn-primary3 mx-1">Next Page</button>
                </div>


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
    <script>
        $('#readed').attr('disabled', true);
        $('.btn-next').attr('disabled', true);
        // $('.btn-next').addClass('btn-secondary');
        $('#readed').click(function() {
            if ($('#readed').is(":checked")) {
                $('#readed').attr('disabled', true)
                $('.btn-next').attr('disabled', false);
                $('.btn-next').removeClass('btn-secondary');
                $('.btn-next').addClass('btn-primary3');
            }
        });


        $('.btn-next').click(function() {
            window.location.href = "{{ route('car_rent_s4') }}";
        });


        // 初始化 PDF.js
        // pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.js';

        $(document).ready(function() {
            // PDF 文件路徑
            const pdfUrl = "{{ env('APP_URL') . '/uploads/' . $series }}";

            // 初始化 PDF 查看器
            let pdfDoc = null;
            let pageNum = 1;
            const scale = 1.5;
            const container = document.getElementById('pdf-container');

            function renderPage(pageNum) {
                pdfDoc.getPage(pageNum).then(function(page) {
                    const viewport = page.getViewport({
                        scale: scale
                    });
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    const renderContext = {
                        canvasContext: context,
                        viewport: viewport,
                    };

                    page.render(renderContext).promise.then(function() {
                        container.innerHTML = '';
                        container.appendChild(canvas);
                    });
                });
            }

            // 加載 PDF 文件
            pdfjsLib.getDocument(pdfUrl).promise.then(function(pdfDoc_) {
                pdfDoc = pdfDoc_;
                renderPage(pageNum);
            });

            // 頁面切換
            $('#prev-page').on('click', function() {
                if (pageNum <= 1) return;
                pageNum--;
                renderPage(pageNum);
            });

            $('#next-page').on('click', function() {
                if (pageNum >= pdfDoc.numPages) return;
                pageNum++;
                renderPage(pageNum);
            });

            // 判斷是否滑到最後一頁且到最底部
            $(window).scroll(function() {
                const currentPageElement = document.querySelector('canvas');
                if (!currentPageElement) return;

                const currentPageRect = currentPageElement.getBoundingClientRect();
                const bottomOffset = 100; // 距離底部的偏移量

                if (currentPageRect.bottom <= window.innerHeight + bottomOffset) {
                    // 滑到最底部，進行相應的處理
                    if (pageNum === pdfDoc.numPages) {
                        console.log('已經滑到最後一頁且到最底部');
                        // 在這裡添加您的處理邏輯
                        $('#readed').attr('disabled', false);
                    }
                }
            });
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
