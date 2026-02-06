@extends('layouts.app')

@section('content')
    <style>
        .yes {
            background-color: darkgreen !important;
            font-weight: bold;
            color: #ffffff !important;
        }

        .no {
            background-color: firebrick !important;
            font-weight: bold;
            color: black;
        }

        .form-note {
            margin-bottom: 0.25rem;
            font-size: 0.8125rem;
            color: blue;
        }
    </style>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> يوجد خطأ في بيانات الادخال.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>




    <div class="card mt-4">
        <div class="card-header fw-bold">
            سجل أحداث العقد
        </div>
        <div class="card-body">
            @forelse($contract->events as $event)
                <div class="border-start ps-3 mb-3">
                    <strong>
                        @switch($event->event_type)
                            @case('terminate') فسخ عقد @break
                            @case('assign') تقبيل عقد @break
                            @case('extend') تمديد عقد @break
                        @endswitch
                    </strong>
                    <div class="text-muted small">
                        تاريخ السريان: {{ $event->effective_date }}
                    </div>
                    <div>{{ $event->notes }}</div>
                </div>
            @empty
                <div class="text-muted">لا توجد أحداث مسجلة</div>
            @endforelse
        </div>
    </div>


    <div class="card mb-3">
        <div class="card-header fw-bold">
            إجراءات العقد
        </div>
        <div class="card-body d-flex gap-2">

            @if($contract->contract_status === 'active')
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#terminateModal">
                    فسخ العقد
                </button>

                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#assignModal">
                    تقبيل العقد
                </button>

                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#extendModal">
                    تمديد العقد
                </button>
            @endif

        </div>
    </div>

    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="terminateModal">
        <div class="modal-dialog modal-xl">
            <form method="POST" action="{{ url('contracts/'.$contract->id.'/terminate') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5>فسخ العقد</h5>
                    </div>
                    <div class="modal-body">
                        <label>تاريخ سريان الفسخ</label>
                        <input type="date" name="effective_date" class="form-control" required>

                        <label class="mt-2">ملاحظات</label>
                        <textarea name="notes" class="form-control"></textarea>

                        <div class="alert alert-warning mt-2">
                            ⚠ سيتم إلغاء جميع الدفعات بعد هذا التاريخ
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger">تأكيد الفسخ</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>

                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="assignModal">
        <div class="modal-dialog modal-xl">
            <form method="POST" action="{{ url('contracts/'.$contract->id.'/assign') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5>تقبيل العقد</h5>
                    </div>
                    <div class="modal-body">

                        <label>المستأجر الجديد</label>
                        <select name="new_renter_id" class="form-control" required>
                            @foreach($renters as $renter)
                                <option value="{{ $renter->id }}">
                                    {{ $renter->name }}
                                </option>
                            @endforeach
                        </select>

                        <label class="mt-2">تاريخ بداية التقبيل</label>
                        <input type="date" name="assign_date" class="form-control" required>

                        <div class="alert alert-info mt-2">
                            سيتم إنشاء عقد جديد تلقائيًا
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning">تأكيد التقبيل</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>

                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="extendModal">
        <div class="modal-dialog modal-xl">
            <form method="POST" action="{{ url('contracts/'.$contract->id.'/extend') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5>تمديد العقد</h5>
                    </div>
                    <div class="modal-body">

                        <label>تاريخ الانتهاء الجديد</label>
                        <input type="date" name="new_end_date" class="form-control" required>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success">تمديد</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="editFile" tabindex="-1"
         aria-labelledby="editFileLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <form method="POST" action="{{ route('allfiles.update_files') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="object_id" value="{{ $contract->id }}">
                    <input type="hidden" name="object_name" value="contracts">
                    <input type="hidden" id="file_id" name="file_id" value="">

                    <div class="container-xxl">
                        <div class="authentication-wrapper authentication-basic container-p-y">
                            <div class="authentication-inner py-4">
                                <!-- Login -->
                                <div class="card border">

                                    <div class="card-body">

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="name">عنوان
                                                    الملف
                                                    <i class="fa fa-asterisk "
                                                       style="color: red"
                                                       aria-hidden="true"></i></label>
                                                <input type="text" name="title"
                                                       id="title" class="form-control"
                                                       required/>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label" for="name">ارفاق
                                                    الملف
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

    <div class="card mb-3">
        <div class="card-header fw-bold">
            مرفقات العقد
        </div>
        <div class="card-body ">

        <span>
                                <a class="btn bt-show" href="#"
                                   onclick="fn_add_file_row('file_attach'); return false ; ">
                                    + اضافة مرفق </a>
                            </span>
<br>

            <form method="POST" action="{{ route('allfiles.add_files') }}"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="object_id" value="{{ $contract->id }}">
                <input type="hidden" name="object_name" value="contracts">

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
                                                            <a href="<?= asset('storage/' . $file->url) ?>"
                                                               target="_blank">
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
                    <button type="submit"
                            class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"><i
                            class="fa-solid fa-floppy-disk pe-2"></i> حفظ
                        الملفات
                    </button>


                </div>

            </form>


        </div>
    </div>

    <form method="POST" action="{{ route('contracts.update',$contract->id) }}" id="contractForm"
          enctype="multipart/form-data">
        @csrf
        <div class="container-xxl">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner py-4">
                    <!-- Login -->
                    <div class="card border">


                        <div class="card-body">

                            @if($contract->events->count() > 0)
                                <div class="alert alert-danger">
                                    هذا العقد يحتوي على أحداث (فسخ / تقبيل / تمديد)
                                    <br>
                                    لا يُسمح بتعديل بياناته الأساسية
                                </div>
                            @endif

                            <div class="row g-3">

                                <div class="col-md-4">
                                    <label class="form-label" for="e_no"> رقم العقد الالكتروني <i
                                            class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" value="{{$contract->e_no}}" maxlength="20" autocomplete="off"
                                         id="e_no" name="e_no"
                                           class="form-control"/>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" for="renter_id"> المستأجر </label>
                                    <select id="renter_id" name="renter_id" required
                                            class="select2 form-select" data-allow-clear="true">
                                        <option value="">اختر</option>

                                        @foreach ($renters as $row)
                                            <option value="{{ $row->id }}"
                                                    data-row='@json($row)' @if($row->id == $contract->renter_id)
                                                {{'selected'}}
                                                @endif>
                                                {{ $row->name }} - ( {{ @$row->nat->name }} ) - {{ @$row->mobile_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label" for="electric_no"> حسابات الكهرباء </label>

                                    <textarea id="electric_no" name="electric_no"
                                              class="form-control">{{$contract->electric_no}}</textarea>

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="water_no"> حسابات المياه </label>

                                    <textarea id="water_no" name="water_no"
                                              class="form-control">{{$contract->water_no}}</textarea>

                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="segel_togary">
                                        رقم   السجل التجاري
                                    </label>
                                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" onchange="checkIfRecordedBefor(this.value);" id="segel_togary" name="segel_togary"
                                           value="{{$contract->segel_togary}}"
                                           class="form-control"/>
                                </div>

                                <div class="col-md-9">
                                    <label class="form-label" for="c_notes"> ملاحظات العقد </label>
                                    <textarea name="c_notes" class="form-control">{{$contract->notes}}</textarea>
                                </div>


                                <div class="col-md-4">
                                    <label class="form-label" for="maincenter_id"> المركز الرئيسي <i
                                            class="fa fa-asterisk " style="color: red"
                                            aria-hidden="true"></i></label>
                                    <select name="maincenter_id"
                                            {{--                                            onchange="fn_get_centers(this.value )"--}}
                                            required class="select2 form-select" data-allow-clear="true">
                                        <option value="">اختر</option>

                                        @foreach ($maincenters as $row)
                                            <option @if($row->id == $contract->maincenter_id)
                                                        {{'selected'}}
                                                    @endif value="{{ $row->id }}">{{ $row->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-4" id="center_div">
                                    <label class="form-label" for="center_id"> العمارة <i
                                            class="fa fa-asterisk " style="color: red"
                                            aria-hidden="true"></i></label>

                                    <select id="center_id" name="center_id"
                                            {{--                                            onchange="fn_get_units(this.value)" --}}
                                            required
                                            class="select2 form-select" data-allow-clear="true">
                                        <option value="">اختر</option>

                                        @foreach ($centers as $row)
                                            <option @if($row->id == $contract->center_id)
                                                        {{'selected'}}
                                                    @endif value="{{ $row->id }}">{{ $row->center_name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-4" id="unit_div">
                                    <label class="form-label" for="unit_id"> الوحدة <i
                                            class="fa fa-asterisk " style="color: red"
                                            aria-hidden="true"></i></label>
                                    <select id="unit_id" name="unit_id"
                                            class="select2 form-select" data-allow-clear="true">
                                        @if($contract->unit_id)
                                            @foreach (@$units as $row)
                                                <option @if($row->id == @$contract->unit_id)
                                                            {{'selected'}}
                                                        @endif value="{{ $row->id }}">
                                                    {{@$row->unitType->name}}
                                                    رقم
                                                    {{$row->unit_no}} - {{$row->unit_description}}

                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <x-datepicker
                                    name_g="start_date"
                                    name_h="start_dateh"
                                    start_g="{{$contract->start_date}}"
                                    start_h="{{$contract->start_dateh}}"
                                    label="بداية العقد"
                                    col="6"
                                />


                                <div class="col-md-6  ">


                                    <div class="row g-2">
                                        <!-- السنة -->
                                        <div class="col-md-4">
                                            <label for="period_year" class="form-label">سنة</label>
                                            <select name="period_year" id="period_year" onchange="calculateEndDate()"
                                                    class="select2 form-select" data-allow-clear="true">
                                                <option value="0" selected>0</option>
                                                <!-- من 0 إلى 10 -->
                                                <?php for ($i = 1;
                                                           $i <= 10;
                                                           $i++): ?>
                                                <option value="<?= $i ?>" @if($contract->contractPeriod()['years']==$i)
                                                    {{'selected'}}
                                                    @endif><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>

                                        <!-- الشهر -->
                                        <div class="col-md-4">
                                            <label for="period_month" class="form-label">شهر</label>
                                            <select name="period_month" id="period_month" onchange="calculateEndDate()"
                                                    class="select2 form-select" data-allow-clear="true">
                                                <option value="0" selected>0</option>
                                                <!-- من 0 إلى 11 -->
                                                <?php for ($i = 1;
                                                           $i <= 11;
                                                           $i++): ?>
                                                <option value="<?= $i ?>" @if($contract->contractPeriod()['months']==$i)
                                                    {{'selected'}}
                                                    @endif><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>

                                        <!-- اليوم -->
                                        <div class="col-md-4">
                                            <label for="period_day" class="form-label">يوم</label>
                                            <select name="period_day" id="period_day" onchange="calculateEndDate()"
                                                    class="select2 form-select" data-allow-clear="true">
                                                <option value="0" selected>0</option>
                                                <!-- من 0 إلى 30 -->
                                                <?php for ($i = 1;
                                                           $i <= 30;
                                                           $i++): ?>
                                                <option value="<?= $i ?>" @if($contract->contractPeriod()['days']==$i)
                                                    {{'selected'}}
                                                    @endif><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <!-- الحقل العقد نهاية -->
                                <x-datepicker
                                    name_g="end_date"
                                    name_h="end_dateh"
                                    start_g="{{$contract->end_date}}"
                                    start_h="{{$contract->end_dateh}}"
                                    label="نهاية العقد"
                                    col="6"
                                />

                                <div class="col-md-3">
                                    <label class="form-label" for="year_amount"> قيمة دفعة الإيجار السنوي <i
                                            class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" onfocus="calculateDiff();"
                                           id="year_amount" name="year_amount" value="{{$contract->year_amount}}"
                                           class="form-control" required/>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="total_amount"> اجمالي قيمة العقد <i
                                            class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" onfocus="calculateDiff();"
                                           id="total_amount" name="total_amount" value="{{$contract->total_amount}}"
                                           class="form-control" required/>
                                </div>


                                <div class="col-md-3">
                                    <label class="form-label" for="insurance_amount">قيمة التأمين </label>
                                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" id="insurance_amount"
                                           name="insurance_amount" value="{{$contract->insurance_amount}}"
                                           class="form-control"/>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="services_amount">قيمة الخدمات </label>
                                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" id="services_amount"
                                           name="services_amount" value="{{$contract->services_amount}}"
                                           class="form-control"/>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label" for="delay_fine"> غرامة التأخير في اليوم الواحد </label>
                                    <input type='text' onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" id="delay_fine"
                                           name="delay_fine" value="{{$contract->delay_fine}}" class="form-control"/>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label" for="start_payment_amount"> الدفعة المقدمة
                                        (العربون) </label>
                                    <input type='text' onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" id="start_payment_amount"
                                           name="start_payment_amount" value="{{$contract->start_payment_amount}}"
                                           class="form-control"/>
                                    <span class="form-note">
                                     كدفعة منفصلة وتخصم من الدفعة الاولى
                                        </span>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label" for="no_of_payments">عدد الدفعات في السنة الواحدة <i
                                            class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" id="no_of_payments"
                                           name="no_of_payments" value="{{$contract->no_of_payments}}"
                                           class="form-control" required/>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="no_of_all_payments">عدد جميع الدفعات <i
                                            class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" id="no_of_all_payments"
                                           name="no_of_all_payments" value="{{$contract->no_of_all_payments}}"
                                           class="form-control" required/>
                                </div>

                                <div class="col-md-3">
                                    <label for="file" class="form-label"> صورة العقد </label>
                                    <input type="file" name="file" id="file" class="form-control">

                                </div>
                                <div class="col-md-3">
                                    <label for="file" class="form-label"> صورة العقد الحالية </label>
                                    @if($contract->img !='')
                                        <br>
                                        <a href="<?= asset('storage/' . $contract->img) ?>" target="_blank">
                                            عرض الملف
                                        </a>
                                    @else
                                        <br>
                                        لا يوجد صورة للعقد
                                    @endif

                                </div>


                                <div class="card-footer">
                                    <button type="submit" id="btn_save_contract" name="btn_save_contract"
                                            class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">
                                        حفظ &nbsp; <i class="fa-solid fa-floppy-disk"></i></button>
                                    <button type="reset"
                                            class="btn btn-warning me-sm-3 me-1 waves-effect waves-light">تراجع
                                    </button>

                                    <a href="{{ route('contracts.index') }}" class="btn btn-info me-sm-3 me-1 waves-effect waves-light"   >
                                        العودة الى العقود
                                    </a>
                                </div>

                                <hr>
                                <div class=" bg-lighter   bg-gradient  text-white">
                                    <?php
                                    $sumPayments = $contract->getSumPayments();
                                    // echo " {$sumPayments['years']} سنة , {$period['months']} شهر,  {$period['days']} يوم";

                                    //  print_r($sumPayments) ;

                                    ?>
                                    <div class="row">

                                        <div
                                            class="col-md-4 border rounded text-center fw-bold bg-dark float-start  h-100">
                                            مجموع مبالغ العقد كاملا     :
                                            {{ $sumPayments['all'] }}
                                            <span style="font-size: 23px;"
                                                  class="icon-saudi_riyal_new"></span>
                                        </div>




                                        <div
                                            class="col-md-4 border rounded text-center fw-bold bg-dark float-start h-100">
                                            مجموع المبالغ المدفوعة :
                                            {{ $sumPayments['payed'] }}

                                            <span style="font-size: 23px;"
                                                  class="icon-saudi_riyal_new"></span>
                                        </div>

                                        <div
                                            class="col-md-4 border rounded text-center fw-bold bg-dark float-start  h-100">
                                            مجموع المبالغ المتبقية :
                                            {{ $sumPayments['notPayed'] }}

                                            <span style="font-size: 23px;"
                                                  class="icon-saudi_riyal_new"></span>
                                        </div>

                                    </div>


                                </div>

                                <hr>
                                <div id="payments_table_container" style="display:block;">

                                    @if (!empty($contract->payments))
                                        <div class="card-datatable table-responsive pt-0">
                                            <table
                                                class="table FathyTable table-striped  display responsive text-nowrap ">
                                                <thead>
                                                <tr class="bg-dark  bg-gradient  text-white contract{{$row->id}}">
                                                    <td><span class="d-block ">
                                                                رقم الدفعة  </span></td>
                                                    <td><span class="d-block"> المبلغ </span></td>
                                                    <td><span class="d-block"> البيان </span></td>
                                                    <td><span class="d-block"> موعد الدفع ميلادي </span></td>
                                                    <td><span class="d-block"> موعد الدفع هجري </span></td>
                                                    <td><span class="d-block"> باقي على الموعد </span></td>


                                                    <td><span class="d-block">الحالة </span></td>
                                                    <td><span class="d-block"> تاريخ الدفع ميلادي </span></td>
                                                    <td><span class="d-block"> تاريخ الدفع هجري </span></td>
                                                    <td class="no-print"><span class="d-block">اجراءات </span>
                                                    </td>


                                                </tr>
                                                </thead>
                                                    <?php $j = 1; ?>
                                                @foreach ($contract->payments as $key => $payment)
                                                        <?php $days = dateDiff(today(), $payment->p_date);
                                                        if ($days <= 0 && $payment->status == 0) {
                                                            $class = 'table-danger';
                                                        } elseif ($days <= 7 && $payment->status == 0) {
                                                            $class = 'table-warning';
                                                        } else {
                                                            $class = '';
                                                        }

                                                        ?>
                                                    <tr class="{{ $class }} contract{{$row->id}}"
                                                        id="payment{{$payment->id}}">

                                                        <td>{{$payment->payment_no}}</td>
                                                        <td>{{ number_format($payment->amount, 2) }}
                                                            <span style="font-size: 23px;"
                                                                  class="icon-saudi_riyal_new"></span>
                                                        </td>

                                                        <td>

                                                            {{ $payment->notes }}

                                                        </td>
                                                        <td>{{ $payment->p_date }} م
                                                        </td>
                                                        <td>
                                                            {{ $payment->p_dateh }} هـ
                                                        </td>
                                                        <td>
                                                            @if ($days > 0)
                                                                {{ $days }}
                                                                يوم
                                                            @elseif ($days <= 0 && $payment->status == 0)
                                                                {{ $days }}
                                                                يوم
                                                            @else
                                                                {{ '----' }}
                                                            @endif
                                                        </td>


                                                        <td>
                                                            @if ($payment->status)
                                                                <i class="fa fa-circle-check  text-success"
                                                                   aria-hidden="true"></i>
                                                            @else
                                                                <i class="fa-solid fa-circle-xmark text-danger"></i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($payment->actual_date != '')
                                                                {{ $payment->actual_date }} م
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($payment->actual_dateh != '')
                                                                {{ $payment->actual_dateh }} هـ
                                                            @endif
                                                        </td>

                                                        <td class="no-print">


                                                            <a href="javascript:void(0)"
                                                               onclick="fn_payement({{ $payment }})"
                                                               class="btn btn-sm btn-warning" alt="الدفع"
                                                               alt="الدفع">

                                                                <i class="fas fa-sack-dollar pe-2"></i>
                                                                الدفع
                                                            </a>

                                                            <a href="javascript:void(0)"
                                                               onclick="fn_update_payement({{ $payment }})"
                                                               class="btn btn-sm btn-primary"><i
                                                                    class="fa-regular fa-pen-to-square pe-2"></i> تعديل</a>
                                                            <a href="javascript:void(0)"
                                                               onclick="fn_delete_object({{ $payment->id }}, 'payment', 'payment{{ $payment->id }}')"
                                                               class="btn btn-sm btn-danger delete-record">
                                                                <i class="fa-solid fa-trash-can pe-2"></i> حذف
                                                            </a>
                                                            @if ($payment->status)
                                                                <a href="{{ route('payments.print', $payment->id) }}"
                                                                   target="_blank" class="btn btn-sm btn-warning"
                                                                   alt="طباعة" alt="طباعة">
                                                                    <i class="fa-solid fa-print pe-2"></i>
                                                                    طباعة
                                                                </a>

                                                            @endif

                                                        </td>


                                                    </tr>
                                                        <?php $j++; ?>
                                                @endforeach
                                            </table>
                                        </div>
                                    @endif

                                </div>

                            </div>


                            <div class="mb-3">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- Modal -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="paymentModal" tabindex="-1"
         aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="payment_id" id="payment_id">
                <input type="hidden" name="true_amount" id="true_amount">
                <input type="hidden" name="emp_name" id="emp_name">
                <input type="hidden" name="maincenter_id" value="{{ $contract->maincenter_id }}">
                <input type="hidden" name="unit_id" value="{{ $contract->unit_id }}">
                <input type="hidden" name="center_id" value="{{ $contract->center_id }}">

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
                                       readonly/>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="amount"> المبلغ </label>
                                <input type="text" onkeypress="return onlyNumbers(event)" required
                                       onkeyup="return numberValidation(event)" id="amount" name="amount"
                                       class="form-control"/>
                            </div>

                            <x-datepicker
                                name_g="actual_date"
                                name_h="actual_dateh"
                                start_g=""
                                label="الدفع"
                                col="4"
                            />


                            <div class="col-md-4">
                                <label class="form-label" for="payment_type"> طريقة الدفع </label>

                                <select id="payment_type" name="payment_type" class="select2 form-select"
                                        data-allow-clear="true">
                                    <option value="">اختر</option>
                                    @foreach ($payment_types as $row)
                                        <option value="{{ $row->id }}"
                                        @if($row->id == 5 )
                                            {{'selected'}}
                                            @endif
                                        >{{ $row->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="notes"> نظير </label>
                                <input type="text" id="payment_notes" name="notes" class="form-control"/>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="notes"> المستلم </label>
                                <input type="text" id="receved_by" name="receved_by" class="form-control" value="وصية أوقاف إبراهيم صدقي محمد سعيد أفندي"/>
                            </div>


                        </div>


                    </div>
                    <div class="modal-footer">
                        <hr>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                        <button type="submit" name="btn_savePayment" class="btn btn-primary">

                            حفظ البيانات
                        </button>
                        <span class="form-note">في حال تغير المبلغ المدفوع عن المبلغ الاصلي سوف يتم معالجة الفرق في الدفعة التالية مباشرة  </span>

                    </div>
                </div>
            </form>
        </div>
    </div>




    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="updatePaymentModal" tabindex="-1"
         aria-labelledby="updatePaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form method="POST" action="" name="updatePaymenForm" id="updatePaymenForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="payment_id" id="u_payment_id">
                <input type="hidden" name="true_amount" id="true_amount">
                <input type="hidden" name="emp_name" id="emp_name">
                <input type="hidden" id="hf_maincenter_id" name="maincenter_id" value="{{ $contract->maincenter_id }}">
                <input type="hidden" id="hf_unit_id" name="unit_id" value="{{ $contract->unit_id }}">
                <input type="hidden" id="hf_center_id" name="center_id" value="{{ $contract->center_id }}">

                <div class="modal-content">
                    <div class="modal-header  bg-primary">
                        <h5 class="modal-title bg-lighter text-white" id="updatePaymentModalLabel"> تعديل تاريخ ومبلغ
                            الدفعة </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6">
                                <label class="form-label" for="amount"> المبلغ </label>
                                <input type="text" onkeypress="return onlyNumbers(event)" required
                                       onkeyup="return numberValidation(event)" id="u_amount" name="amount"
                                       class="form-control"/>
                            </div>

                            <x-datepicker
                                name_g="p_date"
                                name_h="p_dateh"
                                start_g=""
                                label="موعد الدفع"
                                col="6"
                            />

                            <div class="col-md-12">
                                <label class="form-label" for="notes"> ملاحظات </label>
                                <input type="text" id="u_payment_notes" name="notes" class="form-control"/>
                            </div>


                        </div>


                    </div>
                    <div class="modal-footer">
                        <hr>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                        <button type="submit" name="btn_updatePayment" class="btn btn-primary">

                            حفظ البيانات
                        </button>

                        <span class="form-note">سوف يتم تعديل المبلغ دون تأثير على اي دفعة أخرى </span>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <input type="hidden" id="countUpdate" value="0">
    <input type="hidden" id="aurl" value="{{ $root }}/units/get_center2/">
    <input type="hidden" id="aurl2" value="{{ $root }}/units/get_units/">

@endsection

@section('js')

    <script>


        $(document).ready(function () {


            captureOriginalFormValues();
            setTimeout(captureOriginalFormValues, 800);
            $('#contractForm').on('submit', handleContractSubmitConfirmation);
        });


        const fieldLabels = {
            e_no: 'رقم العقد الالكتروني',
            renter_id: 'المستأجر',
            maincenter_id: 'المركز الرئيسي',
            center_id: 'العمارة',
            unit_id: 'الوحدة',
            start_date: 'بداية العقد (ميلادي)',
            end_date: 'نهاية العقد (ميلادي)',
            year_amount: 'قيمة دفعة الإيجار السنوي',
            total_amount: 'إجمالي قيمة الإيجار',
            insurance_amount: 'قيمة التأمين',
            services_amount: 'قيمة الخدمات',
            delay_fine: 'غرامة التأخير',
            start_payment_amount: 'الدفعة المقدمة (العربون)',
            no_of_payments: 'عدد الدفعات في السنة الواحدة',
            no_of_all_payments: 'عدد جميع الدفعات',
            c_notes: 'ملاحظات العقد',
            segel_togary: 'السجل التجاري  ',
            period_year: 'مدة العقد (سنة)',
            period_month: 'مدة العقد (شهر)',
            period_day: 'مدة العقد (يوم)'
        };


        const criticalFields = ['no_of_payments', 'year_amount',  'services_amount', 'total_amount', 'start_payment_amount', 'no_of_all_payments'];
        let originalFormValues = {};

        function captureOriginalFormValues() {
            const $form = $('#contractForm');
            if (!$form.length || $form.data('snapshotTaken')) {
                return;
            }

            const snapshot = {};
            $form.find('input[name], select[name], textarea[name]').each(function () {
                const name = $(this).attr('name');
                if (!name) {
                    return;
                }
                snapshot[name] = normalizeFieldValue($(this).val());
            });

            originalFormValues = snapshot;
            $form.data('snapshotTaken', true);
        }

        function normalizeFieldValue(value) {
            if (Array.isArray(value)) {
                return value.join(',');
            }
            return (value ?? '').toString().trim();
        }

        function handleContractSubmitConfirmation(event) {
            const $form = $(this);

            if ($form.data('confirmed')) {
                return true;
            }

            const changes = [];
            let hasCriticalChange = false;

            $form.find('input[name], select[name], textarea[name]').each(function () {
                const name = $(this).attr('name');
                if (!name || !(name in originalFormValues)) {
                    return;
                }

                const currentValue = normalizeFieldValue($(this).val());
                const originalValue = originalFormValues[name];

                if (currentValue === originalValue) {
                    return;
                }

                changes.push({
                    label: fieldLabels[name] || name,
                    originalValue: originalValue || 'فارغ',
                    currentValue: currentValue || 'فارغ'
                });

                if (criticalFields.includes(name)) {
                    hasCriticalChange = true;
                }
            });

            if (!changes.length) {
                return true;
            }

            let message = 'تم تعديل الحقول التالية:\n\n';
            message += changes
                .map(item => `- ${item.label}: "${item.originalValue}" → "${item.currentValue}"`)
                .join('\n');

            if (hasCriticalChange) {
                message = '\n\n        تم التعديل على احد على بعض البيانات المالية ! ';
                message += '\n\nتنبيه: نتيجة لذلك سوف يتم حذف جميع الدفعات المسجلة ويتم انشاء دفعات جديدة وفقا لهذا التغيير.';
            }

            message += '\n\nهل ترغب في متابعة الحفظ؟';


            if (!confirm(message)) {
                event.preventDefault();
                return false;
            }

            $form.data('confirmed', true);
            $form.trigger('submit');
            event.preventDefault();


        }

        function fn_payement(row) {


            // console.log(row);

            $('#renter_name').val(row['contract']['renter']['name']);
            $('#amount').val(row['amount']);
            $('#true_amount').val(row['amount']);
            $('#payment_notes').val(row['notes']);
            $('#payment_id').val(row['id']);

            //  $('#emp_name').val($("#emp_id option:selected").text());
            $('#paymentModal').modal('show');


        }

        function fn_update_payement(row) {
            console.log(row);
            $('#u_amount').val(row['amount']);

            $('#u_payment_notes').val(row['notes']);
            $('#u_payment_id').val(row['id']);

            $('#updatePaymentModal').modal('show');


        }


        function updateTotal() {
            let total = 0;
            const inputs = document.querySelectorAll('.payment-input');

            inputs.forEach(input => {
                total += parseFloat(input.value) || 0;
            });

            // Format the total once
            const formattedTotal = total.toFixed(2);

            // Update the display
            const $totalSum = $('#total_sum');
            $totalSum.html(formattedTotal);

            // Get the target amount, ensuring it's treated as a comparable number
            const targetAmount = parseFloat($('#total_amount_input').val()) || 0;

            // Compare directly using numbers (rounded to 2 decimals to match the display)
            const isMatch = Math.abs(total - targetAmount) < 0.001;

            // Use toggleClass for cleaner logic
            $totalSum.toggleClass("yes", isMatch);
            $totalSum.toggleClass("no", !isMatch);

            if (isMatch)
                $("#btn_save_contract").prop("disabled", false);
            else
                $("#btn_save_contract").prop("disabled", true);
        }

        function generatePayments() {
            const startDateVal = document.getElementById('start_date').value;
            const endDateVal = document.getElementById('end_date').value;
            const yearAmount = parseFloat(document.getElementById('year_amount').value);
            const noOfPayments = parseInt(document.getElementById('no_of_payments').value);
            const servicesAmount = parseFloat(document.getElementById('services_amount').value) || 0;
            const insuranceAmount = parseFloat(document.getElementById('insurance_amount').value) || 0;

            let differenceInDays = 0
            if (!startDateVal || !endDateVal || isNaN(yearAmount) || isNaN(noOfPayments)) {
                alert('يرجى إدخال جميع البيانات المطلوبة');
                return;
            }
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
            /*
           حتى الان معانا
           عدد السنين والشهور والايام
           نحسب قيمة اليوم من السنة
           ونحسب قيمة كل دفعة

           نضيف صف بقيمة التأمين
           نعمل لوب بعدد السنين داخلها لوب بعدد الدفعات
           نضيف الدفعات ثم
           نشوف قيمة الايام الباقية ونيفها كدفعه واحدة في الميعاد التالي
           داخل لوب السنين نضيف قيمة الخدمات
             */

            const daysBetweenPayments = Math.floor(365 / noOfPayments);
            const singlePaymentAmount = (yearAmount / noOfPayments).toFixed(2);
            const dayAmount = (yearAmount / 365).toFixed(2);
            const totalAmount = ((years * yearAmount) + ((30 * months) + days) * dayAmount).toFixed(2);

            let sumAmount = 0.00;
            let currentPaymentDate = new Date(start);
            let lastPaymentDate = new Date(start);

            const body = document.getElementById('payments_body');
            body.innerHTML = '';


            let x = 1;
            if (insuranceAmount > 0) {
                const row = document.createElement('tr');
                // Use local date instead of ISO to avoid timezone shifts
                const y = currentPaymentDate.getFullYear();
                const m = String(currentPaymentDate.getMonth() + 1).padStart(2, '0');
                const d = String(currentPaymentDate.getDate()).padStart(2, '0');
                const dateStr = `${y}-${m}-${d}`;


                row.innerHTML = `
            <td>${x}</td>
            <td>
            <div class="calendar-group" data-group="startdate${x}"> <div class="field-row gregorian-row "><span class="input-group-text calendar-trigger"><i class="fas fa-calendar-alt"></i></span> <input type="text" class="gregorian-date" name="payment_dates[]" value="${dateStr}" placeholder="ميلادي" autocomplete="off"> </div> </div>

            </td>
            <td><input type="text"  name="payment_note[]" class="form-control" value="مبلغ التأمين "></td>
            <td><input type="text" lang="en" name="payment_amounts[]" class="form-control payment-input"
                       value="${insuranceAmount}" oninput="updateTotal()"></td>
        `;
                sumAmount += parseFloat(insuranceAmount);
                body.appendChild(row);
                x++;
            }

            for (let i = 1; i <= years; i++) {
                if (servicesAmount > 0) {
                    const row = document.createElement('tr');
                    // Use local date instead of ISO to avoid timezone shifts
                    const y = currentPaymentDate.getFullYear();
                    const m = String(currentPaymentDate.getMonth() + 1).padStart(2, '0');
                    const d = String(currentPaymentDate.getDate()).padStart(2, '0');
                    const dateStr = `${y}-${m}-${d}`;


                    row.innerHTML = `
            <td>${x}</td>
            <td>
<div class="calendar-group" data-group="startdate${x}"> <div class="field-row gregorian-row "><span class="input-group-text calendar-trigger"><i class="fas fa-calendar-alt"></i></span> <input type="text" class="gregorian-date" name="payment_dates[]" value="${dateStr}" placeholder="ميلادي" autocomplete="off"> </div> </div>

</td>
            <td><input type="text"  name="payment_note[]" class="form-control" value=" قيمة الخدمات    "></td>
            <td><input type="text" lang="en" name="payment_amounts[]" class="form-control payment-input"
                       value="${servicesAmount}" oninput="updateTotal()"></td>
        `;
                    sumAmount += parseFloat(servicesAmount);
                    body.appendChild(row);
                    x++;
                }


                for (let j = 1; j <= noOfPayments; j++) {
                    const row = document.createElement('tr');
                    // Use local date instead of ISO to avoid timezone shifts
                    const y = currentPaymentDate.getFullYear();
                    const m = String(currentPaymentDate.getMonth() + 1).padStart(2, '0');
                    const d = String(currentPaymentDate.getDate()).padStart(2, '0');
                    const dateStr = `${y}-${m}-${d}`;


                    row.innerHTML = `
            <td>${x}</td>
            <td>
<div class="calendar-group" data-group="startdate${x}"> <div class="field-row gregorian-row "><span class="input-group-text calendar-trigger"><i class="fas fa-calendar-alt"></i></span> <input type="text" class="gregorian-date" name="payment_dates[]" value="${dateStr}" placeholder="ميلادي" autocomplete="off"> </div> </div>

</td>
            <td><input type="text"  name="payment_note[]" class="form-control" value=" دفعة ايجار       "></td>
            <td><input type="text" lang="en" name="payment_amounts[]" class="form-control payment-input"
                       value="${singlePaymentAmount}" oninput="updateTotal()"></td>
        `;
                    sumAmount += parseFloat(singlePaymentAmount);
                    body.appendChild(row);

                    currentPaymentDate.setDate(currentPaymentDate.getDate() + daysBetweenPayments);

                    x++;

                }


            }

            if (months > 0 || days > 0) {

                let remDays = (30 * months) + days;
                lastPaymentDate.setDate(currentPaymentDate.getDate() - daysBetweenPayments);

                let differenceInMs = currentPaymentDate - lastPaymentDate;
                const millisecondsPerDay = 1000 * 60 * 60 * 24;

                differenceInDays = Math.round(differenceInMs / millisecondsPerDay);

                console.log(remDays);
                if (remDays >= daysBetweenPayments) {
                    remDays -= daysBetweenPayments;
                    const row = document.createElement('tr');
                    // Use local date instead of ISO to avoid timezone shifts
                    const y = currentPaymentDate.getFullYear();
                    const m = String(currentPaymentDate.getMonth() + 1).padStart(2, '0');
                    const d = String(currentPaymentDate.getDate()).padStart(2, '0');
                    const dateStr = `${y}-${m}-${d}`;


                    row.innerHTML = `
            <td>${x}</td>
            <td>
                                    <div class="calendar-group" data-group="startdate${x}"> <div class="field-row gregorian-row "><span class="input-group-text calendar-trigger"><i class="fas fa-calendar-alt"></i></span> <input type="text" class="gregorian-date" name="payment_dates[]" value="${dateStr}" placeholder="ميلادي" autocomplete="off"> </div> </div>

</td>
            <td><input type="text"  name="payment_note[]" class="form-control" value=" دفعة ايجار       "></td>
            <td><input type="text" lang="en" name="payment_amounts[]" class="form-control payment-input"
                       value="${singlePaymentAmount}" oninput="updateTotal()"></td>
        `;
                    sumAmount += parseFloat(singlePaymentAmount);
                    body.appendChild(row);
                    lastPaymentDate = currentPaymentDate;
                    currentPaymentDate.setDate(currentPaymentDate.getDate() + daysBetweenPayments);

                    x++;

                }
                console.log(remDays);
                if (remDays > 0) {
                    const row = document.createElement('tr');
                    // Use local date instead of ISO to avoid timezone shifts
                    const y = currentPaymentDate.getFullYear();
                    const m = String(currentPaymentDate.getMonth() + 1).padStart(2, '0');
                    const d = String(currentPaymentDate.getDate()).padStart(2, '0');
                    const dateStr = `${y}-${m}-${d}`;
                    let remAmount = (remDays * dayAmount).toFixed(2)

                    row.innerHTML = `
            <td>${x}</td>
            <td>
<div class="calendar-group" data-group="startdate${x}"> <div class="field-row gregorian-row "><span class="input-group-text calendar-trigger"><i class="fas fa-calendar-alt"></i></span> <input type="text" class="gregorian-date" name="payment_dates[]" value="${dateStr}" placeholder="ميلادي" autocomplete="off"> </div> </div>

</td>
            <td><input type="text"  name="payment_note[]" class="form-control" value=" دفعة ايجار       "></td>
            <td><input type="text" lang="en" name="payment_amounts[]" class="form-control payment-input"
                       value="${remAmount}" oninput="updateTotal()"></td>
        `;
                    sumAmount += parseFloat(remAmount);
                    body.appendChild(row);
                }

            }

            document.getElementById('payments_table_container').style.display = 'block';
            $('#payments_body .gregorian-date').each(function () {
                if (!$(this).data('calendarsPicker')) {
                    $(this).calendarsPicker({
                        calendar: $.calendars.instance('gregorian'),
                        dateFormat: 'yyyy-mm-dd',
                        onSelect: function (date) {
                        }
                    });
                }
            });
            $('#payments_body .calendar-switch').on('change', function () {
                var $group = $(this).closest('.calendar-group');
                if ($(this).is(':checked')) {
                    $group.find('.gregorian-row').addClass('hidden');
                    $group.find('.hijri-row').removeClass('hidden');
                } else {
                    $group.find('.hijri-row').addClass('hidden');
                    $group.find('.gregorian-row').removeClass('hidden');
                }
            });
            $('#payments_body .calendar-switch-hijri').on('change', function () {
            });

            const safeAmount = parseFloat(sumAmount) || 0;
            const formattedAmount = safeAmount.toFixed(2);

            $('#total_amount').html(formattedAmount);
            $('#total_amount_input').val(formattedAmount);

            updateTotal();

        }

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
            let dateParts = start.split('-');
            let start_date;
            if (dateParts.length === 3) {
                // إنشاء التاريخ (السنة، الشهر - 1 لأن الأشهر تبدأ من 0، اليوم)
                start_date = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
            } else {
                start_date = new Date(start.replace(/-/g, "/"));
            }


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
            $('#end_date').trigger('change');
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
                    success: function (data) {

                        $('#unit_id').html(data);

                        $('#unit_id').trigger('change');
                        $('#unit_div').show();


                    },
                    error: function (xhr, status, error) {
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
                    success: function (data) {

                        $('#center_id').html(data);

                        $('#center_id').trigger('change');
                        $('#center_div').show();


                    },
                    error: function (xhr, status, error) {
                        // Handle errors
                        console.error("AJAX error:", status, error);
                    }
                });
            }

        }

        function fn_show_add_center(id) {
            if (id == 0) {
                $('#centermodal').modal('show');
            } else {
                $('#centermodal').modal('hide');
            }
        }


        $(document).ready(function () {

            const table = $('.payments');

            table.on('click', 'tbody tr', function () {

                // إزالة التحديد من كل الصفوف
                table.find('tbody tr').removeClass('row-selected');

                // إضافة التحديد للصف الحالي
                $(this).addClass('row-selected');

            });

        });
    </script>

@endsection
