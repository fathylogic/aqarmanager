@extends('layouts.app')

@section('content')

    @session('success')
    <div class="alert alert-success" role="alert">
        {{ $value }}
    </div>
    @endsession
    @if (\Session::has('danger'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! \Session::get('danger') !!}</li>
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="card  mb-3">
                <div class="card-header bg-lighter"><strong>{{ $maincenter->name }} </strong>
                </div>
                <div class="card-body">

                    <div class="col-md-3 float-end">
                        <div>
                            @if ($maincenter->img != '')
                                <a href="<?= asset('storage/' . $maincenter->img) ?>" target="_blank">
                                    <img src="<?= asset('storage/' . $maincenter->img) ?>" class="w-100"/>
                                </a>
                            @else
                                    <?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>
                                <img class=" float-end" style="width: 125px ; height: 125px;"
                                     src="{{ $root }}/assets/img/branding/sedqilogo1.png">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9 float-start">


                        <form method="POST" action="{{ route('maincenters.update', $maincenter->id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="container-xxl">
                                <div class="authentication-wrapper authentication-basic container-p-y">
                                    <div class="authentication-inner py-4">
                                        <!-- Login -->

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="name">اسم المركز الرئيسي <i
                                                        class="fa fa-asterisk " style="color: red"
                                                        aria-hidden="true"></i></label>
                                                <input type="text" id="name" name="name"
                                                       value="{{ $maincenter->name }}" class="form-control" required/>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="iban">حساب الايبان <i
                                                        class="fa fa-asterisk " style="color: red"
                                                        aria-hidden="true"></i></label>
                                                <div class="input-group mb-3" dir="ltr">
                                                    <span class="input-group-text" id="iban">SA</span>
                                                    <input type="text" value="{{ $maincenter->iban }}"
                                                           class="form-control" id="iban" dir="ltr" name="iban"
                                                           onkeypress="return onlyNumbers(event)"
                                                           onkeyup="return numberValidation(event)"
                                                           aria-describedby="iban">
                                                </div>


                                                @error('iban')
                                                <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="emp_id">الموظف المسئول </label>
                                                <select id="emp_id" name="emp_id" class="select2 form-select"
                                                        data-allow-clear="true">
                                                    <option value="">اختر</option>
                                                    @foreach ($emps as $row)
                                                        <option value="{{ $row->id }}"
                                                        @if ($maincenter->emp_id == $row->id)
                                                            {{ 'selected' }}
                                                            @endif>
                                                            {{ $row->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>


                                            <div class="col-md-6">
                                                <label for="file" class="form-label"> صورة </label>
                                                <input type="file" name="file" id="file" class="form-control">

                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label" for="notes"> ملاحظات </label>
                                                <textarea id="notes" name="notes"
                                                          class="form-control"> {{ $maincenter->notes }}</textarea>
                                            </div>

                                        </div>


                                        <div class="mb-3">
                                            <div class="pt-4">
                                                <button type="submit"
                                                        class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"><i
                                                        class="fa-solid fa-floppy-disk pe-2"></i> حفظ
                                                    التعديلات
                                                </button>


                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>


                </div>
            </div>


            <div class="card mb-3">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <button
                                class="nav-link @if ($current_tab == 'form-tabs-units' || $current_tab == '') {{ 'active' }} @endif "
                                data-bs-toggle="tab" data-bs-target="#form-tabs-units" role="tab" aria-selected="true">
                                العماير
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link  @if ($current_tab == 'form-tabs-ohda') {{ 'active' }} @endif"
                                    data-bs-toggle="tab" data-bs-target="#form-tabs-ohda" role="tab"
                                    aria-selected="false">
                                العهدة
                            </button>
                        </li>


                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-files"
                                    role="tab" aria-selected="false">
                                المرفقات
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div
                        class="tab-pane fade   @if ($current_tab == 'form-tabs-units' || $current_tab == '') {{ 'active show' }} @endif "
                        id="form-tabs-units" role="tabpanel">

                        <a href="#exampleModal" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"
                           data-bs-toggle="modal" data-bs-target="#exampleModal">
                            اضافة عمارة جديدة <i class=" fa-solid fa-plus pe-2 " aria-hidden="true"></i>
                        </a>

                        <div class="card-datatable table-responsive pt-0">
                            <table class="table table-striped  display responsive nowrap FathyTable ">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th> المنطقة</th>
                                    <th> العمارة</th>
                                    <th> حساب شركة الكهرباء</th>
                                    <th> حساب شركة المياة</th>
                                    <th class="no-print"> صورة المركز</th>
                                    <th class="no-print">اجراءات</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                @foreach ($centers as $key => $center)
                                    <tr id="center{{$center->id}}">
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $center->location->name }}</td>
                                        <td>{{ $center->center_name }}</td>
                                        <td>{{ $center->electric_no }}</td>
                                        <td>{{ $center->woter_no }}</td>

                                        <td class="no-print">
                                            <a href="#exampleModal{{ $center->id }}" data-bs-toggle="modal"
                                               data-bs-target="#exampleModal{{ $center->id }}">
                                                <i class="fa fa-eye " aria-hidden="true"></i>
                                            </a>
                                            <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="exampleModal{{ $center->id }}"
                                                 tabindex="-1" aria-labelledby="exampleModalLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"> الصورة </h5>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="<?= asset('storage/' . $center->img) ?>"
                                                                 width="100%">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">اغلاق
                                                            </button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>


                                        <td class="no-print">


                                            <a href="{{ route('centers.show', $center->id) }}"
                                               class="btn btn-sm btn-warning">
                                                <i class="fa-solid fa-circle-info pe-2"></i> فتح
                                            </a>

                                            <a href="{{ route('centers.edit', $center->id) }}"
                                               class="btn btn-sm btn-primary"><i
                                                    class="fa-regular fa-pen-to-square pe-2"></i> تعديل</a>
                                            <a href="javascript:void(0)"
                                               onclick="fn_delete_object({{ $center->id }}, 'center', 'center{{ $center->id }}')"
                                               class="btn btn-sm btn-danger delete-record">
                                                <i class="fa-solid fa-trash-can pe-2"></i> حذف
                                            </a>


                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                                <tfoot>
                                <th>#</th>
                                <th> المنطقة</th>
                                <th> العمارة</th>
                                <th> حساب شركة الكهرباء</th>
                                <th> حساب شركة المياة</th>
                                <th class="no-print"> صورة المركز</th>
                                <th class="no-print">اجراءات</th>
                                </tfoot>
                            </table>
                        </div>


                    </div>
                    <div class="tab-pane fade  @if ($current_tab == 'form-tabs-ohda') {{ 'active show' }} @endif"
                         id="form-tabs-ohda" role="tabpanel">


                        @if ($ohdas->count() > 0)
                            @foreach ($ohdas as $ohda)
                                <div class="row">
                                    <div class="col">
                                        <div class="card  mb-3">

                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-12 float-start">
                                                        <div class="row">
                                                            <div class="col-md-6 p-0 float-start mb-1">
                                                                <div
                                                                    class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">

                                                                    الموظف المسئول
                                                                </div>
                                                                <div
                                                                    class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                                                    {{ $ohda->employee->name }} </div>
                                                            </div>
                                                            <div class="col-md-6 p-0 float-start mb-1">
                                                                <div
                                                                    class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                                                    الرصيد
                                                                </div>
                                                                <div
                                                                    class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                                                    {{ $ohda->raseed }}
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6 p-0 float-start mb-1">
                                                                <div
                                                                    class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                                                    البيــــــان
                                                                </div>
                                                                <div
                                                                    class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                                                    {{ $ohda->purpose }} </div>
                                                            </div>
                                                            <div class="col-md-6 p-0 float-start mb-1">
                                                                <div
                                                                    class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                                                    تاريخ انشائها
                                                                </div>
                                                                <div
                                                                    class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                                                    {{ @$ohda->created_at }}
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="card mb-3">
                                                        <div class="card-header">
                                                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                                                <li class="nav-item">
                                                                    <button class="nav-link active" data-bs-toggle="tab"
                                                                            data-bs-target="#form-tabs-ohda_op{{ $ohda->id }}"
                                                                            role="tab" aria-selected="true">
                                                                        حركة الصرف
                                                                    </button>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <button class="nav-link " data-bs-toggle="tab"
                                                                            data-bs-target="#form-tabs-ohda_add{{ $ohda->id }}"
                                                                            role="tab" aria-selected="true">
                                                                        اضافة اموال
                                                                    </button>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <button class="nav-link " data-bs-toggle="tab"
                                                                            data-bs-target="#form-tabs-ohda_sarf{{ $ohda->id }}"
                                                                            role="tab" aria-selected="true">
                                                                        صرف أموال
                                                                    </button>
                                                                </li>


                                                            </ul>
                                                        </div>

                                                        <div class="tab-content">
                                                            <div class="tab-pane fade active show"
                                                                 id="form-tabs-ohda_op{{ $ohda->id }}"
                                                                 role="tabpanel">

                                                                @if (!empty($ohda->operatios))
                                                                    <div class="card-datatable table-responsive pt-0">
                                                                        <table
                                                                            class="table table-striped  display responsive nowrap FathyTable ">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>المبلغ الوارد</th>
                                                                                <th>المبلغ المنصرف</th>
                                                                                <th> الرصيد السابق</th>
                                                                                <th>البيــــــــــان</th>
                                                                                <th>المستلم</th>
                                                                                <th>طريقة ونوع الصرف</th>
                                                                                <th>رقم المستند</th>
                                                                                <th>التاريخ</th>


                                                                                <th class="no-print">اجراءات</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                            @foreach ($ohda->operatios as $op)
                                                                                    <?php $ser = '(' . str_pad(@$op->sarf->sereal, 4, '0', STR_PAD_LEFT) . ')' . $op->sarf->year_m . '-' . $op->sarf->year_h;
                                                                                    $date = $op->sarf->p_dateh . 'هـ' . $op->sarf->p_date;

                                                                                    ?>
                                                                                @if ($op->op_type == '+')
                                                                                    <tr class="table-success"
                                                                                        id="operation{{$op->id}}">
                                                                                @else
                                                                                    <tr class="table-danger"
                                                                                        id="operation{{$op->id}}">
                                                                                        @endif
                                                                                        <td>
                                                                                            @if ($op->op_type == '+')
                                                                                                {{ number_format($op->amount, 2) }}
                                                                                                <span
                                                                                                    style="font-size: 23px;"
                                                                                                    class="icon-saudi_riyal_new"></span>
                                                                                            @endif
                                                                                        </td>
                                                                                        <td>
                                                                                            @if ($op->op_type == '-')
                                                                                                {{ number_format($op->amount, 2) }}
                                                                                                <span
                                                                                                    style="font-size: 23px;"
                                                                                                    class="icon-saudi_riyal_new"></span>
                                                                                            @endif
                                                                                        </td>
                                                                                        <td> {{ number_format($op->last_amount, 2) }}
                                                                                            <span
                                                                                                style="font-size: 23px;"
                                                                                                class="icon-saudi_riyal_new"></span>
                                                                                        </td>
                                                                                        <td>{{ $op->masder }}</td>
                                                                                        <td>{{ $op->sarf->receved_by }}</td>
                                                                                        <td>{{ $op->sarf->sarfType->name }}
                                                                                            -
                                                                                            {{ @$op->sarf->paymentType->name }}
                                                                                        </td>


                                                                                        <td>{{ $ser }}</td>
                                                                                        <td>{{ $date }}</td>


                                                                                        <td>

                                                                                            <a href="{{ route('sarfs.show', $op->sarf_id) }}"
                                                                                               target="_blank"
                                                                                               class="btn btn-sm btn-warning">
                                                                                                <i
                                                                                                    class="fa-solid fa-circle-info pe-2"></i>
                                                                                                فتح
                                                                                            </a>

                                                                                            <a href="javascript:void(0)"
                                                                                               onclick="fn_delete_object({{ $op->id }}, 'operation', 'operation{{ $op->id }}')"
                                                                                               class="btn btn-sm btn-danger delete-record">
                                                                                                <i class="fa-solid fa-trash-can pe-2"></i>
                                                                                                حذف
                                                                                            </a>


                                                                                            <a href="#"
                                                                                               onclick="fn_update_OpAdd({{ $op }})"
                                                                                               class="btn btn-sm btn-primary"><i
                                                                                                    class="fa-regular fa-pen-to-square pe-2"></i>
                                                                                                تعديل</a>
                                                                                        </td>

                                                                                    </tr>
                                                                                    @endforeach
                                                                            </tbody>

                                                                            <tfoot>
                                                                            <tr>
                                                                                <th>المبلغ الوارد</th>
                                                                                <th>المبلغ المنصرف</th>
                                                                                <th> الرصيد السابق</th>
                                                                                <th>البيــــــــــان</th>
                                                                                <th>المستلم</th>
                                                                                <th>طريقة ونوع الصرف</th>
                                                                                <th>رقم المستند</th>
                                                                                <th>التاريخ</th>


                                                                                <th class="no-print">اجراءات</th>
                                                                            </tr>
                                                                            </tfoot>
                                                                        </table>
                                                                    </div>
                                                                @else
                                                                    لا يوجد عمليات
                                                                @endif

                                                            </div>

                                                            <div class="tab-pane fade  "
                                                                 id="form-tabs-ohda_add{{ $ohda->id }}"
                                                                 role="tabpanel">
                                                                @include('maincenters.add_to_ohda')
                                                            </div>

                                                            <div class="tab-pane fade  "
                                                                 id="form-tabs-ohda_sarf{{ $ohda->id }}"
                                                                 role="tabpanel">

                                                                @include('maincenters.create_sarf')

                                                            </div>


                                                        </div>
                                                    </div>

                                                </div>


                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        @else
                            لا يوجد عهدة مسجلة
                            <span>
                                <a href="#ohdaModal" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"
                                   data-bs-toggle="modal" data-bs-target="#ohdaModal">
                                    اضافة عهدة جديدة <i class=" fa-solid fa-plus pe-2 " aria-hidden="true"></i>
                                </a>
                            </span>
                        @endif


                    </div>


                    <div class="tab-pane fade" id="form-tabs-files" role="tabpanel">

                        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="editFile" tabindex="-1" aria-labelledby="editFileLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">

                                    <form method="POST" action="{{ route('allfiles.update_files') }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="object_id" value="{{ $maincenter->id }}">
                                        <input type="hidden" name="object_name" value="maincenters">
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
                                                                           class="form-control" required/>
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
                        <span>
                            <a class="btn bt-show" href="#"
                               onclick="fn_add_file_row('file_attach'); return false ; ">
                                + اضافة مرفق </a>
                        </span>
                        <form method="POST" action="{{ route('allfiles.add_files') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="object_id" value="{{ $maincenter->id }}">
                            <input type="hidden" name="object_name" value="maincenters">

                            <table class="table  display responsive nowrap">
                                <thead>
                                <tr>
                                    <th>عنوان الملف</th>
                                    <th> الملف</th>
                                    <th> اجراءات</th>
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

                                            <td><a href="#" onclick="fn_update_file({{ $file }})"
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
                                    الملفات
                                </button>


                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>








    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="creat_new_center">
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="maincenter_id" name="maincenter_id" value="{{ $maincenter->id }}">
                        <div class="container-xxl">
                            <div class="authentication-wrapper authentication-basic container-p-y">
                                <div class="authentication-inner py-4">
                                    <!-- Login -->
                                    <div class="card border">
                                        <div class="card-header">
                                            <h5 id="mctitle"></h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label" for="center_name">اسم
                                                        العمارة <i class="fa fa-asterisk " style="color: red"
                                                                   aria-hidden="true"></i></label>
                                                    <input type="text" name="center_name" class="form-control"
                                                           required/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="center_location">المنطقة <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <select id="center_location" name="center_location" required
                                                            class="select2 form-select" data-allow-clear="true">
                                                        <option value="">اختر</option>
                                                        @foreach ($locations as $row)
                                                            <option value="{{ $row->id }}">
                                                                {{ $row->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="hainame">الحي </label>
                                                    <input type="text" name="hainame" class="form-control"/>

                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="street">الشارع
                                                    </label>
                                                    <input type="text" name="street" class="form-control"/>

                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="Building_no">رقم
                                                        العمارة </label>
                                                    <input type="text" name="Building_no" class="form-control"/>

                                                </div>


                                                <div class="col-md-6">
                                                    <label class="form-label" for="sak_no"> الموقع على
                                                        الخريطة </label>
                                                    <input type="text" name="gps" class="form-control"/>

                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label" for="sak_no">رقم الصك
                                                    </label>
                                                    <input type="text" name="sak_no" class="form-control"/>

                                                </div>


                                                <div class="col-md-6">
                                                    <label class="form-label" for="electric_no"> حساب شركة
                                                        الكهرباء <i class="fa fa-asterisk " style="color: red"
                                                                    aria-hidden="true"></i></label>
                                                    <input type="text" id="electric_no" name="electric_no"
                                                           class="form-control"/>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label" for="woter_no"> حساب شركة
                                                        المياة <i class="fa fa-asterisk " style="color: red"
                                                                  aria-hidden="true"></i></label>
                                                    <input type="text" id="woter_no" name="woter_no"
                                                           class="form-control"/>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label" for="left_electric_no"> حساب
                                                        اخر للمصاعد
                                                    </label>
                                                    <input type="text" id="left_electric_no" name="left_electric_no"
                                                           class="form-control"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="file" class="form-label"> صورة</label>
                                                    <input type="file" name="file" id="file"
                                                           class="form-control">

                                                </div>
                                                <div class="col-md-6">
                                                    <label for="othercontents" class="form-label">
                                                        تحتوي على </label>
                                                    <br>
                                                    @foreach ($others as $row)
                                                        <input type="checkbox" class="checkbox" name="othercontents[]"
                                                               value="{{ $row->id }}">
                                                        {{ $row->name }}

                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    @endforeach

                                                </div>


                                                <div class="col-md-12">
                                                    <label class="form-label" for="notes"> ملاحظات
                                                    </label>
                                                    <textarea id="notes" name="notes" class="form-control"></textarea>
                                                </div>

                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">الغاء
                                                </button>
                                                <button type="submit" name="btn_add_center"
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
        </div>
    </div>



    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="ohdaModal" tabindex="-1" aria-labelledby="ohdaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="maincenter_id" name="maincenter_id" value="{{ $maincenter->id }}">
                    <input type="hidden" name="current_tab" value="form-tabs-ohda">
                    <div class="container-xxl">
                        <div class="authentication-wrapper authentication-basic container-p-y">
                            <div class="authentication-inner py-4">
                                <!-- Login -->
                                <div class="card border">

                                    <h5 id="mctitle">

                                        {{ $maincenter->name }} /


                                        <div class="card-body">


                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label class="form-label" for="emp_id">الموظف المسئول <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <select id="emp_id" name="emp_id" required
                                                            class="select2 form-select" data-allow-clear="true">
                                                        <option value="">اختر</option>
                                                        @foreach ($emps as $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label" for="purpose"> البيــــــان <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <input type="text" id="purpose" name="purpose" required
                                                           class="form-control"/>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label" for="raseed"> مبلغ العهدة <i
                                                            class="fa fa-asterisk " style="color: red"
                                                            aria-hidden="true"></i></label>
                                                    <input type="text" value="0" id="raseed" name="raseed"
                                                           required onkeypress="return onlyNumbers(event)"
                                                           onkeyup="return numberValidation(event)"
                                                           class="form-control"/>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label" for="masder"> مصدر مبلغ العهدة </label>
                                                    <input type="text" id="masder" name="masder" required
                                                           class="form-control"/>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label" for="esm_elmohawel"> اسم المحول </label>
                                                    <input type="text" id="esm_elmohawel" name="esm_elmohawel"
                                                           required class="form-control"/>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label"> تاريخ التحويل </label>
                                                    <div class="calendar-group" data-group="tdate">
                                                        <div class="field-row gregorian-row ">
                                                            <input type="text" class="gregorian-date" name="t_date"
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
                                                            <input type="text" class="hijri-date" name="t_dateh"
                                                                   placeholder="هجري" autocomplete="off">
                                                            <div class="ios-switch-container">
                                                                <span class="switch-label-hijri">ميلادي</span>
                                                                <label class="ios-switch">
                                                                    <input type="checkbox" class="calendar-switch-hijri"
                                                                           checked>
                                                                    <span class="ios-slider"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label" for="payment_type"> نوع الدفع </label>

                                                    <select id="payment_type" required name="payment_type"
                                                            class="select2 form-select" data-allow-clear="true">
                                                        <option value="">اختر</option>
                                                        @foreach ($payment_types as $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>

                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-label" for="hewala_no"> رقم الحوالة </label>
                                                    <input type="text" id="hewala_no" name="hewala_no" required
                                                           onkeypress="return onlyNumbers(event)"
                                                           onkeyup="return numberValidation(event)"
                                                           class="form-control"/>
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
    </div>

    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="editOpAdd" tabindex="-1" aria-labelledby="editOpAddLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form method="POST" action=""
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="operation_id" id="operation_id" value="">
                    <div class="modal-header">
                        <h5 class="modal-title"> تعديل بيانات حركة الصرف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label" for="amount"> المبلغ </label>
                                <input type="text" id="add_amount" name="amount"
                                       onkeypress="return onlyNumbers(event)"
                                       onkeyup="return numberValidation(event)" required
                                       class="form-control"/>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label"> تاريخ الدفع </label>
                                <div class="calendar-group" data-group="pdate" >
                                    <div class="field-row gregorian-row ">
                                        <input type="text" class="gregorian-date" name="p_date" id="add_p_date"
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
                                        <input type="text" class="hijri-date" name="p_dateh" id="add_p_dateh"
                                               placeholder="هجري" autocomplete="off">
                                        <div class="ios-switch-container">
                                            <span class="switch-label-hijri">ميلادي</span>
                                            <label class="ios-switch">
                                                <input type="checkbox" class="calendar-switch-hijri"
                                                       checked>
                                                <span class="ios-slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label class="form-label" for="payment_type"> طريقة الدفع </label>

                                <select id="add_payment_type" required name="payment_type"
                                        class="select2 form-select" data-allow-clear="true">
                                    <option value="">اختر</option>
                                    @foreach ($payment_types as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>


                            <div class="col-md-4">
                                <label class="form-label" for="masder"> المصدر </label>

                                <select id="add_masder" name="masder"
                                        class="select2 form-select" data-allow-clear="true">
                                    <option value="مبلغ مرحل (فائض من عهدة سابقة) ">مبلغ مرحل (فائض
                                        من عهدة
                                        سابقة)
                                    </option>
                                    <option value="بيع مواد">بيع مواد</option>
                                    <option value="مبلغ عهدة اضافي"> مبلغ عهدة اضافي</option>
                                    <option value="">أخرى توضح في البيان</option>

                                </select>

                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="s_desc"> البيان </label>
                                <input type="text" id="add_s_desc" name="s_desc" value="" required
                                       class="form-control">

                            </div>


                            <div class="col-md-4">
                                <label class="form-label" for="receved_by"> المستلم </label>
                                <input type="text" id="add_receved_by" name="receved_by" value=""
                                       required
                                       class="form-control">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">الغاء
                        </button>
                        <button type="submit" name="btn_update_op_add"
                                class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">

                            <i class="fa-solid fa-floppy-disk pe-2"></i>
                            حفظ
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>






    <script>
        function fn_set_amount(amount) {

            $("#amount").val(amount);
        }


        function fn_setSarfType() {
            var selected_type = $("input[name='sarf_type_id']:checked").val();

            $(".sarftype2").hide();
            $(".sarftype3").hide();
            $(".sarftype4").hide();
            $(".sarftype" + selected_type).show();


        }

        function fn_delete_center(id) {
            Swal.fire({
                title: "هل انت متأكد من انك تريد الحذف ?",
                text: "لا يمكنك استرجاعها مرة أخرى! سوف يتم حذف جميع ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "إلغاء",
                confirmButtonText: "نعم,  احذف!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../centers/destroy/" + id
                }
            });
        }
    </script>
@endsection
