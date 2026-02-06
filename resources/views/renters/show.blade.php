@extends('layouts.app')

@section('content')



    <?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>



    <div class="row">
        <div class="col">
            <div class="card  mb-3">
                <div class="card-header bg-light">
                    <strong>{{ $renter->name }} </strong>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 float-end">
                            <div>
                                @if ($renter->img != '')
                                    <a href="<?= asset('storage/' . $renter->img) ?>" target="_blank">
                                        <img src="<?= asset('storage/' . $renter->img) ?>" class="w-100" />
                                    </a>
                                @else
                                    <?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>
                                    <img class=" float-end" style="width: 125px ; height: 125px;"
                                        src="{{ $root }}/assets/img/branding/sedqilogo1.png">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9 float-start">
                            <div class="row">
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">

                                        رقم الهوية
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $renter->id_no }} </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        الجوال
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $renter->mobile_no }}
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        الجنسية
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $renter->nat->name }}
                                    </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        ملاحظات
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $renter->notes }} </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="row">
                        <div class="card mb-3">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs" role="tablist">

                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-files"
                                            role="tab" aria-selected="false">
                                            المرفقات
                                        </button>
                                    </li>

                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="form-tabs-files" role="tabpanel">

                                    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="editFile" tabindex="-1"
                                        aria-labelledby="editFileLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">

                                                <form method="POST" action="{{ route('allfiles.update_files') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="object_id" value="{{ $renter->id }}">
                                                    <input type="hidden" name="object_name" value="renters">
                                                    <input type="hidden" id="file_id" name="file_id" value="">

                                                    <div class="container-xxl">
                                                        <div
                                                            class="authentication-wrapper authentication-basic container-p-y">
                                                            <div class="authentication-inner py-4">
                                                                <!-- Login -->
                                                                <div class="card border">

                                                                    <div class="card-body">

                                                                        <div class="row g-3">
                                                                            <div class="col-md-6">
                                                                                <label class="form-label"
                                                                                    for="name">عنوان الملف
                                                                                    <i class="fa fa-asterisk "
                                                                                        style="color: red"
                                                                                        aria-hidden="true"></i></label>
                                                                                <input type="text" name="title"
                                                                                    id="title" class="form-control"
                                                                                    required />
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <label class="form-label"
                                                                                    for="name">ارفاق الملف
                                                                                </label>
                                                                                <input type="file" name="file"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>





                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">الغاء
                                                                        </button>
                                                                        <button type="submit" name="btn_add_ohda"
                                                                            class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">

                                                                            <i class="fa-solid fa-floppy-disk pe-2"></i>
                                                                            حفظ
                                                                        </button>
                                                                    </div>



                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            </form>


                                        </div>
                                    </div>
                                    <span>
                                        <a class="btn bt-show" href="#"
                                            onclick="fn_add_file_row('file_attach'); return false ; ">
                                            + اضافة مرفق </a>
                                    </span>
                                    <form method="POST" action="{{ route('allfiles.add_files') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="object_id" value="{{ $renter->id }}">
                                        <input type="hidden" name="object_name" value="renters">

                                        <table class="table  display responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>عنوان الملف </th>
                                                    <th> الملف </th>
                                                    <th> اجراءات </th>
                                                </tr>
                                            </thead>
                                            <tbody id="file_attach">
                                                @if (!empty($files))
                                                    @foreach ($files as $file)
                                                        <tr id="tfile{{ $file->id }}">
                                                            <td>{{ $file->title }}</td>
                                                            <td>
                                                                <i class="ti ti-file"></i>
                                                                <span class="align-middle ms-1">
                                                                    <a href="<?= asset('storage/' . $file->url) ?>"
                                                                        target="_blank">
                                                                        عرض الملف </a></span>

                                                            </td>

                                                            <td> <a href="#"
                                                                    onclick="fn_update_file({{ $file }})"
                                                                    class="btn btn-sm btn-primary"><i
                                                                        class="fa-regular fa-pen-to-square pe-2"></i>
                                                                    تعديل</a>
                                                                <a href="#"
                                                                    onclick="fn_delete_file({{ $file->id }})"
                                                                    class="btn btn-sm btn-danger delete-record"><i
                                                                        class="fa-solid fa-trash-can pe-2"></i>
                                                                    حذف</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif


                                            </tbody>


                                        </table>
                                        <div class="pt-4 btn-save-files" style="display: none">
                                            <button type="submit"
                                                class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"><i
                                                    class="fa-solid fa-floppy-disk pe-2"></i> حفظ
                                                الملفات </button>


                                        </div>

                                    </form>



                                </div>

                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->

    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="payment_id" id="payment_id">
                <input type="hidden" name="emp_name" id="emp_name">
                <div class="modal-content">
                    <div class="modal-header  bg-primary">
                        <h5 class="modal-title bg-lighter text-white" id="paymentModalLabel"> بيانات الدفع</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="renter_name"> المستأجر </label>
                                <input type="text" id="renter_name" name="renter_name" class="form-control"
                                    readonly />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="amount"> المبلغ </label>
                                <input type="text" id="amount" name="amount" class="form-control" readonly />
                            </div>

                            <div class="col-md-4">
                                <label class="form-label"> تاريخ الدفع </label>
                                <div class="calendar-group" data-group="actualdate">
                                    <div class="field-row gregorian-row ">
                                        <input type="text" class="gregorian-date" name="actual_date"
                                            placeholder="ميلادي" autocomplete="off">
                                        <div class="ios-switch-container">
                                            <span class="switch-label">هجري</span>
                                            <label class="ios-switch">
                                                <input type="checkbox" class="calendar-switch">
                                                <span class="ios-slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="field-row hijri-row hidden">
                                        <input type="text" class="hijri-date" name="actual_dateh" placeholder="هجري"
                                            autocomplete="off">
                                        <div class="ios-switch-container">
                                            <span class="switch-label-hijri">ميلادي</span>
                                            <label class="ios-switch">
                                                <input type="checkbox" class="calendar-switch-hijri" checked>
                                                <span class="ios-slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <label class="form-label" for="emp_id"> المستلم </label>

                                <select id="emp_id" name="emp_id" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">اختر </option>
                                    @foreach ($emps as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="payment_type"> طريقة الدفع </label>

                                <select id="payment_type" name="payment_type" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="">اختر </option>
                                    @foreach ($payment_types as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="notes"> ملاحظات </label>
                                <input type="text" id="payment_notes" name="notes" class="form-control" />
                            </div>


                        </div>




                    </div>
                    <div class="modal-footer">
                        <hr>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                        <button type="submit" name="btn_savePayment" class="btn btn-primary">

                            حفظ البيانات </button>
                    </div>
                </div>
            </form>
        </div>
    </div>





    <input type="hidden" id="aurl" value="{{ $root }}/units/get_center2/">
    <input type="hidden" id="aurl2" value="{{ $root }}/units/get_units/">
    <script>
        function calculateEndDate() {

            let start = document.getElementById("start_date").value;

            if (!start) {
                Swal.fire({
                    icon: "error",
                    title: "خطأ !",
                    text: "يجب اختيار تاريخ بداية العقد أولا !",
                    footer: ''
                });
                return;
            }

            let years = parseInt($('#period_year').val() || 0);
            let months = parseInt($('#period_month').val() || 0);
            let days = parseInt($('#period_day').val() || 0);

            let start_date = new Date(start);

            let end_date = new Date(start_date);

            end_date.setFullYear(end_date.getFullYear() + years);

            end_date.setMonth(end_date.getMonth() + months);

            end_date.setDate(end_date.getDate() + days);

            end_date.setDate(end_date.getDate() - 1);
            let yyyy = end_date.getFullYear();
            let mm = String(end_date.getMonth() + 1).padStart(2, '0');
            let dd = String(end_date.getDate()).padStart(2, '0');

            let formattedEndDate = `${yyyy}-${mm}-${dd}`;

            $('#end_date').val(formattedEndDate);
        }



        function calculateDiff() {
            let start = document.getElementById("start_date").value;
            let end = document.getElementById("end_date").value;

            if (!start || !end) return;

            // Split components to avoid timezone shifts
            let s = start.split('-').map(Number);
            let e = end.split('-').map(Number);

            let start_date = new Date(s[0], s[1] - 1, s[2]);
            let end_date = new Date(e[0], e[1] - 1, e[2]);


            end_date.setDate(end_date.getDate() + 1);

            if (end_date < start_date) return;

            let years = end_date.getFullYear() - start_date.getFullYear();
            let months = end_date.getMonth() - start_date.getMonth();
            let days = end_date.getDate() - start_date.getDate();

            // Handle negative days by borrowing from the previous month
            if (days < 0) {
                months--;

                let prevMonth = new Date(end_date.getFullYear(), end_date.getMonth(), 0);
                days += prevMonth.getDate();
            }


            if (months < 0) {
                years--;
                months += 12;
            }

            $('#period_month').val(months).trigger('change');
            $('#period_year').val(years).trigger('change');
            $('#period_day').val(days).trigger('change');
        }


        function fn_get_units(id) {
            if (id != '' && id > 0) {

                var url = $('#aurl2').val() + id;


                $.ajax({
                    url: url,
                    method: 'GET',
                    data: id,
                    dataType: 'text',
                    success: function(data) {

                        $('#unit_id').html(data);

                        $('#unit_id').trigger('change');
                        $('#unit_div').show();


                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error("AJAX error:", status, error);
                    }
                });
            }

        }

        function fn_get_centers(id) {
            if (id != '' && id > 0) {

                var url = $('#aurl').val() + id;


                $.ajax({
                    url: url,
                    method: 'GET',
                    data: id,
                    dataType: 'text',
                    success: function(data) {

                        $('#center_id').html(data);

                        $('#center_id').trigger('change');
                        $('#center_div').show();


                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error("AJAX error:", status, error);
                    }
                });
            }

        }

        function replace_number(inputString) {
            if (inputString === undefined || inputString === null) {
                return '';
            }

            let str = String(inputString).trim();
            if (str === '') {
                return '';
            }

            const arabicToEnglishMap = {
                '٠': '0',
                '١': '1',
                '٢': '2',
                '٣': '3',
                '٤': '4',
                '٥': '5',
                '٦': '6',
                '٧': '7',
                '٨': '8',
                '٩': '9'
            };

            return str.replace(/[٠-٩]/g, function(d) {
                return arabicToEnglishMap[d];
            });
        }


        function fn_payement(row) {


            // console.log(row);

            $('#renter_name').val(row['contract']['renter']['name']);
            $('#amount').val(row['amount']);
            $('#payment_notes').val(row['notes']);
            $('#payment_id').val(row['id']);

            //  $('#emp_name').val($("#emp_id option:selected").text());
            $('#paymentModal').modal('show');


        }



        function nWin() {
            var w = window.open();
            var html = $("#NoteView").html();

            $(w.document.body).html(html);
            w.print();
        }

        /*function printDiv(divId) {
            var printContents = document.getElementById("NoteView").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }*/
    </script>
@endsection
