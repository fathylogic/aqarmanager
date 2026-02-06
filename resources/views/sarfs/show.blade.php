@extends('layouts.app')

@section('content')


    @if (\Session::has('danger'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! \Session::get('danger') !!}</li>
            </ul>
        </div>
    @endif

    <?php

    $ser = '(' . str_pad($sarf->sereal, 4, '0', STR_PAD_LEFT) . ')' . $sarf->year_m . '-' . $sarf->year_h;
    $pdateh = 'التاريخ:' . $sarf->p_dateh . 'هـ';
    $pdate = 'Date:' . $sarf->p_date;
    $pamount = '#' . $sarf->amount . 'ريال';

    ?>
    <div class="card  mb-3">
        <div class="card-header bg-lighter"><strong>بيانات الصرف</strong>
        </div>
        <div class="card-body">


            <div class="col-md-12 float-start">
                <div class="row">
                    <div class="col-md-6 p-0 float-start mb-1">
                        <div class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                            مصروف من
                        </div>
                        <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100"> {{ $sarf->sourceType->name }}
                            @if ($sarf->from_ohda_id != '')
                                ({{ $sarf->fromOhda->employee->name }})
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 p-0 float-start mb-1">
                        <div class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                            نوع الصرف

                        </div>
                        <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                            {{ $sarf->sarfType->name }}
                            @if ($sarf->service_type_id != '')
                                ({{ $sarf->serviceType->name }})
                            @endif
                        </div>


                    </div>
                </div>


                <div class="row">
                    @if ($sarf->service_type_id == '')
                        <div class="col-md-6 p-0 float-start mb-1">
                            <div
                                class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                الى
                            </div>
                            <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                @if ($sarf->to_ohda_id != '')
                                    ({{ $sarf->toOhda->employee->name }})
                                @elseif ($sarf->pay_role_id != '')
                                    ({{ $sarf->payrool->employee->name }})
                                @elseif ($sarf->recipient_id != '')
                                    ({{ $sarf->recipient->name }})
                                @endif
                            </div>
                        </div>
                    @endif
                    @if ($sarf->pay_role_id != '')
                        <div class="col-md-6 p-0 float-start mb-1">
                            <div
                                class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                راتب شهر

                            </div>
                            <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                {{ $sarf->payrool->salary_year_month }}
                            </div>


                        </div>
                    @endif
                </div>

                @if ($sarf->service_type_id != '')
                    <div class="row">
                        <div class="col-md-6 p-0 float-start mb-1">
                            <div
                                class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                المركز
                            </div>
                            <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                {{ @$sarf->center->center_name }}

                            </div>
                        </div>
                        @if (@$sarf->unit_id != '')
                            <div class="col-md-6 p-0 float-start mb-1">
                                <div
                                    class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                    الوحدة
                                </div>
                                <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">

                                    {{ @$sarf->unit->unitType->name . ' رقم : ' . @$sarf->unit->unit_no . '   (' . @$sarf->unit->renter->name . ') ' }}

                                </div>
                            </div>
                        @endif

                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6 p-0 float-start mb-1">
                        <div class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                            المبلغ
                        </div>
                        <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100"> #{{ $sarf->amount }}#


                            {{ $sarf->amount_txt }}

                        </div>
                    </div>
                    <div class="col-md-6 p-0 float-start mb-1">
                        <div class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                            التاريخ
                        </div>
                        <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100"> {{ $sarf->p_date }} م
                            الموافق
                            {{ $sarf->p_dateh }} هـ
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-6 p-0 float-start mb-1">
                        <div class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                            البيان
                        </div>
                        <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                            {{ $sarf->s_desc }}

                        </div>
                    </div>
                    <div class="col-md-6 p-0 float-start mb-1">
                        <div class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                            المستلم
                        </div>
                        <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">

                           @if ($sarf->pay_role_id != '')
                                 {{ $sarf->payrool->employee->name }}
                            @else
                            {{ $sarf->receved_by }}
                            @endif
                        </div>
                    </div>
                    <div class="row p-4" id="form-tabs-files" >

                        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="editFile" tabindex="-1" aria-labelledby="editFileLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">

                                    <form method="POST" action="{{ route('allfiles.update_files') }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="object_id" value="{{ $sarf->id }}">
                                        <input type="hidden" name="object_name" value="sarfs">
                                        <input type="hidden" id="file_id" name="file_id" value="">

                                        <div class="container-xxl">
                                            <div class="authentication-wrapper authentication-basic container-p-y">
                                                <div class="authentication-inner py-4">
                                                    <!-- Login -->
                                                    <div class="card border">

                                                        <div class="card-body">

                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="name">عنوان الملف
                                                                        <i class="fa fa-asterisk " style="color: red"
                                                                           aria-hidden="true"></i></label>
                                                                    <input type="text" name="title" id="title"
                                                                           class="form-control" required />
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="name">ارفاق الملف
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

                        <div class="row">
                            @if($sarf->img!='')
                                <div class="col-md-6">
                                     <span class="align-middle ms-1">
                                                        <a   href="<?= asset('storage/' . $sarf->img) ?>" target="_blank" class="btn btn-sm btn-primary"><i
                                                                class="fa-regular fa fa-eye pe-2"></i>
                                                            عرض الفاتورة </a></span>



                                </div>
                            @endif
                                <div class="col-md-6">
                                <span>
                            <a class="btn btn-sm btn-warning" href="javascript:void(0);"
                               onclick="fn_add_file_row('file_attach'); return false ; ">
                                + اضافة مرفق </a>
                        </span>
                                </div>
                        </div>
<br><br>
                        <form method="POST" action="{{ route('allfiles.add_files') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="object_id" value="{{ $sarf->id }}">
                            <input type="hidden" name="object_name" value="sarfs">

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
                                                        <a href="<?= asset('storage/' . $file->url) ?>" target="_blank">
                                                            عرض الملف </a></span>

                                            </td>

                                            <td> <a href="#" onclick="fn_update_file({{ $file }})"
                                                    class="btn btn-sm btn-primary"><i
                                                        class="fa-regular fa-pen-to-square pe-2"></i> تعديل</a>
                                                <a href="#" onclick="fn_delete_file({{ $file->id }})"
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
                                <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"><i
                                        class="fa-solid fa-floppy-disk pe-2"></i> حفظ
                                    الملفات </button>


                            </div>

                        </form>



                    </div>


                </div>



            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card  mb-3">
                    <div class="card-header bg-lighter">

                        <a href="{{ route('sarfs.print', $sarf->id) }}" target="_blank"
                            class="btn btn-label-secondary waves-effect invoice-btprint d-print-none px-2 py-1 border">
                            <i class='ti ti-printer mt-1 cursor-pointer d-sm-block d-none text-dark py-1 px-2 border-0'></i>
                            <strong class="text-black"> طباعة سند الصرف</strong>
                        </a>


                    </div>


                </div>
            </div>
        </div>
    </div>






    <script>
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






        function nWin() {
            var w = window.open();
            var html = $("#NoteView").html();

            $(w.document.body).html(html);
            w.print();
        }

        //    function printDiv(divId) {
        //             var printContents = document.getElementById("NoteView").innerHTML;
        //             var originalContents = document.body.innerHTML;

        //             document.body.innerHTML = printContents;

        //             window.print();

        //             document.body.innerHTML = originalContents;
        //         }


        $(function() {
            $("button#btNoteView").click(nWin);
        });
    </script>
@endsection
