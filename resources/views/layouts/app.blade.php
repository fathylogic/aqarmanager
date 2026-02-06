<!DOCTYPE html>




<?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ $root }}/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>أوقاف ابراهيم صدقي</title>

    <meta name="description" content="" />

    <!-- Favicon -->

    <link rel="icon" type="image/x-icon" href="{{ $root }}/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/css/rtl/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ $root }}/assets/css/demo.css" />


    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet"
        href="{{ $root }}/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet"
        href="{{ $root }}/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet"
        href="{{ $root }}/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/flatpickr/flatpickr.css" />

    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/quill/typography.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/quill/katex.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/quill/editor.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/jstree/jstree.css" />

    <!-- DataTable CSS -->
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/dataTables/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/dataTables/dataTables.bootstrap5.css" />

    <!-- Row Group CSS -->
    <link rel="stylesheet"
        href="{{ $root }}/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css" />
    <!-- Form Validation -->
    <link rel="stylesheet"
        href="{{ $root }}/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/css/pages/page-help-center.css" />
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/css/pages/app-email.css" />

    {{--  Datepicker CSS --}}
    <link rel="stylesheet" href="{{ $root }}/assets/vendor/libs/Datepicker/w3.css" />
    <!-- UmmalquraGregorianDatepicker CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/UmmalquraGregorianDatepicker/css/jquery.calendars.picker.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/UmmalquraGregorianDatepicker/css/ui-south-street.calendars.picker.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/UmmalquraGregorianDatepicker/css/HijriGorgStyle.css') }}" />


    <!-- Helpers -->
    <script src="{{ $root }}/assets/vendor/js/helpers.js"></script>

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ $root }}/assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ $root }}/assets/js/config.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* الصف المحدد */
        .table tbody tr.row-selected {
            background-color: #d1ecf1 !important;
        }

        /* تحسين الشكل عند المرور */
        .table tbody tr {
            cursor: pointer;
        }

    </style>
</head>

<body>
    <input type="hidden" name="rooturl" value="<?= $root ?>" id="rooturl">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('layouts.menu')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('layouts.nav')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">

                        @yield('content')

                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                                <div>
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    أوقاف إبراهيم صدقي محمد سعيد أفندي

                                </div>
                                <div>

                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- DataTable JS -->
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/dataTables.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/dataTables.bootstrap5.js">
    </script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/dataTables.buttons.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/buttons.bootstrap5.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/buttons.html5.min.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/buttons.print.min.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/jszip.min.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/pdfmake.min.js"></script>
    <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/DataTable/vfs_fonts.js"></script>
    <!-- Tajawal font for pdf print -->
    <script>
        pdfMake.fonts = {
            Tajawal: {
                normal: '{{ $root }}/fonts/Tajawal-Regular.ttf',
                bold: '{{ $root }}/fonts/Tajawal-Bold.ttf',
                italics: '{{ $root }}/fonts/Tajawal-Regular.ttf',
                bolditalics: '{{ $root }}/fonts/Tajawal-Bold.ttf'
            }
        };
    </script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ $root }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ $root }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="{{ $root }}/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="{{ $root }}/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ $root }}/assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/moment/moment.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/select2/select2.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/quill/katex.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/quill/quill.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/jstree/jstree.js"></script>

    <!-- Flat Picker -->
{{--    <script src="{{ $root }}/assets/vendor/libs/moment/moment.js"></script>--}}
{{--    <script src="{{ $root }}/assets/vendor/libs/flatpickr/flatpickr.js"></script>--}}

    <!-- Form Validation -->
    <script src="{{ $root }}/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="{{ $root }}/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

    <!-- Main JS -->
    <script src="{{ $root }}/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ $root }}/assets/js/form-layouts.js"></script>
    <script src="{{ $root }}/assets/js/app-email.js"></script>
    <script src="{{ $root }}/assets/js/forms-editors.js"></script>
    <script src="{{ $root }}/assets/js/extended-ui-treeview.js"></script>

    <!-- Time JS -->
    <script src="{{ $root }}/js/time.js"></script>

    <!-- UmmalquraGregorianDatepicker JS-->
    <script src="{{ asset('assets/vendor/libs/UmmalquraGregorianDatepicker/js/jquery.calendars.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/UmmalquraGregorianDatepicker/js/jquery.calendars.plus.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/UmmalquraGregorianDatepicker/js/jquery.plugin.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/UmmalquraGregorianDatepicker/js/jquery.calendars.picker.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/UmmalquraGregorianDatepicker/js/jquery.calendars.ummalqura.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/UmmalquraGregorianDatepicker/js/jquery.calendars.picker-ar-EG.js') }}">
    </script>
    {{-- <script type="text/javascript" src="{{ $root }}/assets/vendor/libs/UmmalquraGregorianDatepicker/js/HijriGorgScript.js"></script> --}}
    <script src="{{ asset('assets/vendor/libs/UmmalquraGregorianDatepicker/js/HijriGorgScript.js') }}"></script>

{{--    <script type="text/javascript" src="{{ $root }}/assets/js/hijri-date_.js"></script>--}}
{{--    <script type="text/javascript" src="{{ $root }}/assets/js/datepicker_.js"></script>--}}
    <script type="text/javascript" src="{{ $root }}/assets/js/my_script.js"></script>

    <script>


        $(document).ready(function () {

            const table = $('.FathyTable');

            table.on('click', 'tbody tr', function () {

                // إزالة التحديد من كل الصفوف
                table.find('tbody tr').removeClass('row-selected');

                // إضافة التحديد للصف الحالي
                $(this).addClass('row-selected');

            });

        });

        window.addEventListener('load', function() {
            const protocol = window.location.protocol;

            $.fn.dataTable.ext.buttons.reload = {
                text: 'Reload',
                action: function(e, dt, node, config) {
                    dt.ajax.reload();
                }
            };

            const rooturl = document.getElementById("rooturl").value;

            new DataTable('.FathyTable', {
                destroy: true,
                responsive: true,
                scrollX: true,
                scrollCollapse: true,
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ["10", "25", "50", "100", "الكل"]
                ],

                language: {
                    url: $('#rooturl').val() + '/assets/vendor/libs/DataTable/ar.json'
                },

                dom: '<"row"<"col-sm-12 col-md-6 py-3"B><"col-sm-12 col-md-6 text-start py-3"f>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-3"l><"col-sm-12 col-md-4"p>>',

                buttons: [{
                        extend: 'copy',
                        text: '<i class="fa-solid fa-copy"></i> نسخ',
                        className: 'btn-info btn-sm'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa-solid fa-file-excel"></i> إكسل',
                        className: 'btn-success btn-sm'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fa-solid fa-file-csv"></i> CSV',
                        className: 'btn-secondary btn-sm'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa-solid fa-file-pdf"></i> PDF',
                        className: 'btn-danger btn-sm',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        download: 'download',
                        filename: 'تقرير_' + new Date().toLocaleDateString('ar-EG'),
                        customize: function(doc) {
                            doc.defaultStyle = {
                                font: 'Tajawal',
                                alignment: 'right',
                                fontSize: 9
                            };
                            doc.styles.tableHeader = {
                                bold: true,
                                fontSize: 11,
                                color: 'white',
                                fillColor: '#28a745',
                                alignment: 'center'
                            };
                            doc.content[1].table.body.forEach(row => row.reverse());
                            doc.content.splice(0, 0, {
                                text: 'تقرير البيانات',
                                fontSize: 18,
                                bold: true,
                                alignment: 'center',
                                margin: [0, 20, 0, 20]
                            });
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa-solid fa-print"></i> طباعة',
                        className: 'btn-warning btn-sm',
                        pageSize: 'A4',
                        title: 'تقرير_' + new Date().toLocaleDateString('ar-EG'),
                        orientation: 'landscape',
                        exportOptions: {
                            columns: ':not(.no-print)'
                        },

                        customize: function(win) {
                            $(win.document).ready(function() {
                                setTimeout(function() {
                                    $(win.document.body)
                                        .attr('dir', 'rtl')
                                        .css({
                                            'direction': 'rtl',
                                            'text-align': 'right',
                                            'font-family': 'Tajawal, sans-serif',
                                            'font-size': '12px'
                                        });
                                    $(win.document.body).find('table')
                                        .css({
                                            'width': '100%',
                                            'table-layout': 'fixed',
                                            'border-collapse': 'collapse'
                                        })
                                        .removeClass('collapsed');
                                    $(win.document.body).find(
                                            'td.child, li.dtr-title, li.dtr-data')
                                        .remove();
                                    $(win.document.body).find('td').css('display',
                                        '');
                                    win.print();
                                }, 1000);
                            });
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa-solid fa-eye"></i> الأعمدة',
                        className: 'btn-primary btn-sm'
                    }
                ],

                columnDefs: [{
                    targets: -1,
                    orderable: false,
                    searchable: false
                }]
            });


        });


        function printDiv(divId) {
            const printArea = document.getElementById("NoteView");
            if (!printArea) {
                alert("المنطقة غير موجودة!");
                return;
            }
            const styles = Array.from(document.querySelectorAll('link[rel="stylesheet"], style'))
                .map(el => {
                    if (el.tagName === 'LINK') {
                        return `<link rel="stylesheet" href="${el.href}">`;
                    } else {
                        return `<style>${el.innerHTML}</style>`;
                    }
                }).join('');

            const fonts = Array.from(document.querySelectorAll('link[href*="fonts.googleapis.com"]'))
                .map(el => `<link rel="stylesheet" href="${el.href}">`).join('');

            const printWindow = window.open('', '_blank',
                'width=1150,height=800,resizable=no,scrollbars=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no'
            );
            printWindow.document.write(`
        <!DOCTYPE html>
        <html dir="rtl" lang="ar">
        <head>
            <meta charset="UTF-8">
            <title>طباعة الوصية</title>
            ${fonts}
            ${styles}
            <style>
                body { background: white !important; padding: 40px; line-height: 1.8; }
                @media print {
                    body { padding: 20px !important; }
                    @page { margin: 0.5cm; }
                    .no-print, .d-print-none, nav, header, footer, aside, button, .btn { display: none !important; }
                }
                .print-date {
                    margin-top: 10px;
                    text-align: left;
                    color: #666;
                    font-size: 14px;
                }
            </style>
        </head>
        <body class="NoteView">
            ${printArea.innerHTML}
            <div class="print-date">
                تاريخ الطباعة: ${new Date().toLocaleDateString('ar-EG')}
                - الساعة: ${new Date().toLocaleTimeString('ar-EG')}
            </div>
        </body>
        </html>
    `);

            printWindow.document.close();
            printWindow.focus();

            printWindow.onload = function() {
                setTimeout(() => {
                    printWindow.print();
                }, 100);
            };
        }
    </script>
    @if(session('success'))
        <script>

            Swal.fire({
                position: "center",
                icon: "success",
                title: "تم العمل بنجاح",
                showConfirmButton: false,
                timer: 1000
            });


        </script>
    @endif




    @session('danger')
        <script>
            Swal.fire({
                icon: "error",
                title: " لم تتم العملية ...",
                text: "   يوجد خطأ أثناء التنفيذ    !",
                footer: ''
            });
        </script>
    @endsession


    <ul id="ul_error">@if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif</ul>
</body>
<script>
    $(document).ready(function() {


        if ($('#ul_error').length > 0 && $('#ul_error').html()!='') {
            var err = $('#ul_error').html();
            if (err != '') {
                Swal.fire({
                    icon: "error",
                    title: " لم تتم العملية ...",
                    text: "   يوجد خطأ أثناء التنفيذ    !",
                    html: $('#ul_error').html(),
                    footer: ''
                });
            }
            $('#ul_error').hide();
        }

    });
</script>

@yield('js')

</html>
