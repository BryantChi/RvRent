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
                <div id="pdfContainer" style="width: 100%; height: 100vh;">
                    <canvas id="pdfViewer" style="border: 1px solid black;"></canvas>
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
                <input type="button" class="btn btn-next" value="下一步">
            </div>
        </div>
    </section>
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <script>
        $('#readed').attr('disabled', true);
        $('.btn-next').attr('disabled', true);
        $('.btn-next').addClass('btn-secondary');
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


        $(document).ready(function() {
            var pdfPath = "{{ env('APP_URL') . '/uploads/' . $series }}"; // 替換成你的 PDF 檔案路徑
            var currentPage = 1;
            var totalPages = 0;

            function loadPDF() {
                pdfjsLib.getDocument(pdfPath).promise.then(function(pdf) {
                    totalPages = pdf.numPages;
                    showPage(currentPage);
                });
            }

            function showPage(pageNumber) {
                pdfjsLib.getDocument(pdfPath).promise.then(function(pdf) {
                    pdf.getPage(pageNumber).then(function(page) {
                        var canvas = document.getElementById("pdfViewer");
                        var context = canvas.getContext("2d");

                        var viewport = page.getViewport({
                            scale: 1
                        });
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport,
                        };
                        page.render(renderContext);
                    });
                });
            }

            function checkIfLastPageAndBottom() {
                var pdfViewer = $("#pdfViewer");
                var pdfHeight = pdfViewer.height();
                var scrollHeight = pdfViewer[0].scrollHeight;
                var scrollTop = pdfViewer.scrollTop();

                if (scrollHeight - scrollTop === pdfHeight) {
                    if (currentPage === totalPages) {
                        console.log("已經到達最後一頁且到達最底部！");
                        // You can perform relevant actions or show a message here
                        $('#readed').attr('disabled', false);
                    }
                }
            }

            $("#pdfViewer").on("scroll", function() {
                checkIfLastPageAndBottom();
            });

            // Load the PDF file
            loadPDF();
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
