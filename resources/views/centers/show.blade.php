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




    <div class="row">
        <div class="col">
            <div class="card  mb-3">
                <div class="card-header bg-lighter"><strong>{{ $center->location->name }} /
                        {{ $center->center_name }}</strong>
                </div>
                <div class="card-body">

                    <div class="col-md-3 float-end">
                        <div>
                            @if ($center->img != '')
                                <a href="<?= asset('storage/' . $center->img) ?>" target="_blank">
                                    <img src="<?= asset('storage/' . $center->img) ?>" class="w-100" />
                                </a>
                            @else
                                <?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>
                                <img class=" float-end" style="width: 125px ; height: 125px;"
                                    src="{{ $root }}/assets/img/branding/sedqilogo1.png">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9 float-start">


                        {{-- ---------------------UPDATE FORM---------------------------- --}}
                        <form method="POST" action="{{ route('centers.update', $center->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="maincenter_id" name="maincenter_id"
                                value="{{ $center->maincenter_id }}">
                            <input type="hidden" id="id" name="id" value="{{ $center->id }}">
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
                                                        <label class="form-label" for="center_name">اسم العمارة
                                                            <i class="fa fa-asterisk " style="color: red"
                                                                aria-hidden="true"></i></label>
                                                        <input type="text" name="center_name"
                                                            value="{{ $center->center_name }}" class="form-control"
                                                            required />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="center_location">المنطقة <i
                                                                class="fa fa-asterisk " style="color: red"
                                                                aria-hidden="true"></i></label>
                                                        <select id="center_location" name="center_location" required
                                                            class="select2 form-select" data-allow-clear="true">
                                                            <option value="">اختر</option>
                                                            @foreach ($locations as $row)
                                                                <option value="{{ $row->id }}"
                                                                    @if ($center->center_location == $row->id) {{ 'selected' }} @endif>
                                                                    {{ $row->name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="hainame">الحي </label>
                                                        <input type="text" name="hainame" value="{{ $center->hainame }}"
                                                            class="form-control" />

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="street">الشارع
                                                        </label>
                                                        <input type="text" name="street" value="{{ $center->street }}"
                                                            class="form-control" />

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="Building_no">رقم
                                                            العمارة </label>
                                                        <input type="text" name="Building_no"
                                                            value="{{ $center->Building_no }}" class="form-control" />

                                                    </div>



                                                    <div class="col-md-6">
                                                        <label class="form-label" for="sak_no"> الموقع على
                                                            الخريطة </label>
                                                        <input type="text" name="gps" value="{{ $center->gps }}"
                                                            class="form-control" />
                                                        <a href='{{ $center->gps }}'
                                                            target='_blank'>{{ $center->gps }}</a>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label" for="sak_no">رقم الصك
                                                        </label>
                                                        <input type="text" name="sak_no" value="{{ $center->sak_no }}"
                                                            class="form-control" />

                                                    </div>


                                                    <div class="col-md-6">
                                                        <label class="form-label" for="electric_no"> حساب شركة
                                                            الكهرباء <i class="fa fa-asterisk " style="color: red"
                                                                aria-hidden="true"></i></label>
                                                        <input type="text" id="electric_no" name="electric_no"
                                                            value="{{ $center->electric_no }}" class="form-control" />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label" for="woter_no"> حساب شركة
                                                            المياة <i class="fa fa-asterisk " style="color: red"
                                                                aria-hidden="true"></i></label>
                                                        <input type="text" id="woter_no" name="woter_no"
                                                            value="{{ $center->woter_no }}" class="form-control" />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label" for="left_electric_no"> حساب
                                                            اخر للمصاعد
                                                        </label>
                                                        <input type="text" id="left_electric_no"
                                                            name="left_electric_no"
                                                            value="{{ $center->left_electric_no }}"
                                                            class="form-control" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="file" class="form-label"> صورة</label>
                                                        <input type="file"
                                                            accept=".jpg, .jpeg, .pdf, image/jpeg, application/pdf"
                                                            name="file" id="imgFile"
                                                            onchange="validate_and_loadFile(event,this.id)"
                                                            class="form-control">
                                                        <img id="imgFile_view" width="150px" height="100px"
                                                            border="4" hidden />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="othercontents" class="form-label">
                                                            تحتوي على </label>
                                                        <br>
                                                        <?php $arr = explode(',', $center->othercontents);
                                                        ?>
                                                        @foreach ($others as $row)
                                                            <input type="checkbox" class="checkbox"
                                                                @if (in_array($row->id, $arr)) {{ 'checked' }} @endif
                                                                name="othercontents[]" value="{{ $row->id }}">
                                                            {{ $row->name }}

                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        @endforeach

                                                    </div>


                                                    <div class="col-md-12">
                                                        <label class="form-label" for="notes"> ملاحظات
                                                        </label>
                                                        <textarea id="notes" name="notes" class="form-control">{{ $center->notes }}</textarea>
                                                    </div>

                                                </div>



                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">الغاء </button>
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
                        {{-- ---------------------END UPDATE FORM---------------------------- --}}

                    </div>

                </div>
            </div>


            <div class="card mb-3">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">

{{--                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-contracts"
                                role="tab" aria-selected="true">
                                العقود والدفعات
                            </button>
                        </li>
                        --}}
                        <li class="nav-item">
                            <button class="nav-link active " data-bs-toggle="tab" data-bs-target="#form-tabs-units"
                                role="tab" aria-selected="true">
                                الوحدات
                            </button>
                        </li>


                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-files"
                                role="tab" aria-selected="false">
                                المرفقات
                            </button>
                        </li>

                        </li>
                    </ul>
                </div>

                <div class="tab-content">

{{--                    <div class="tab-pane fade active show " id="form-tabs-contracts" role="tabpanel">--}}

{{--                        <a href="#collapseContract" data-bs-toggle="collapse" data-bs-target="#collapseContract">--}}
{{--                            <i class="fa fa-plus " aria-hidden="true"></i>--}}
{{--                            تسجيل عقد جديد--}}
{{--                        </a>--}}


{{--                        <div class="collapse" id="collapseContract">--}}
{{--                            <form method="POST" action="" enctype="multipart/form-data">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" name="maincenter_id" value="{{ $center->maincenter_id }}">--}}
{{--                                <input type="hidden" name="center_id" value="{{ $center->id }}">--}}
{{--                                <input type="hidden" name="unit_id" value="">--}}
{{--                                <div class="card card-body">--}}


{{--                                    <div class="row g-3">--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <label class="form-label" for="renter_id"> المستأجر <i--}}
{{--                                                    class="fa fa-asterisk " style="color: red"--}}
{{--                                                    aria-hidden="true"></i></label>--}}
{{--                                            <select id="renter_id" name="renter_id" class="select2 form-select"--}}
{{--                                                data-allow-clear="true">--}}
{{--                                                <option value="">اختر </option>--}}
{{--                                                @foreach ($renters as $row)--}}
{{--                                                    <option value="{{ $row->id }}">{{ $row->name }}--}}
{{--                                                    </option>--}}
{{--                                                @endforeach--}}

{{--                                            </select>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-4">--}}
{{--                                            <label class="form-label">تاريخ بداية العقد</label>--}}
{{--                                            <div class="calendar-group" data-group="start" data-range-group="contract"--}}
{{--                                                data-validate="range">--}}
{{--                                                <div class="field-row gregorian-row ">--}}
{{--                                                    <input type="text" class="gregorian-date"--}}
{{--                                                        onchange="calculateDiff();" name="start_date" id="start_date"--}}
{{--                                                        placeholder="ميلادي" autocomplete="off">--}}
{{--                                                    <div class="ios-switch-container">--}}
{{--                                                        <span class="switch-label">هجري</span>--}}
{{--                                                        <label class="ios-switch">--}}
{{--                                                            <input type="checkbox" class="calendar-switch">--}}
{{--                                                            <span class="ios-slider"></span>--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                                <div class="field-row hijri-row hidden">--}}
{{--                                                    <input type="text" class="hijri-date" name="start_dateh"--}}
{{--                                                        placeholder="هجري" autocomplete="off">--}}
{{--                                                    <div class="ios-switch-container">--}}
{{--                                                        <span class="switch-label-hijri">ميلادي</span>--}}
{{--                                                        <label class="ios-switch">--}}
{{--                                                            <input type="checkbox" class="calendar-switch-hijri" checked>--}}
{{--                                                            <span class="ios-slider"></span>--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-4  ">--}}


{{--                                            <div class="row g-2">--}}
{{--                                                <!-- السنة -->--}}
{{--                                                <div class="col-md-4">--}}
{{--                                                    <label for="period_year" class="form-label">سنة</label>--}}
{{--                                                    <select name="period_year" id="period_year"--}}
{{--                                                        onchange="calculateEndDate()" class="select2 form-select"--}}
{{--                                                        data-allow-clear="true">--}}
{{--                                                        <option value="0" selected>0</option>--}}
{{--                                                        <!-- من 0 إلى 10 -->--}}
{{--                                                        <?php for ($i = 1; $i <= 10; $i++): ?>--}}
{{--                                                        <option value="<?= $i ?>"><?= $i ?></option>--}}
{{--                                                        <?php endfor; ?>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}

{{--                                                <!-- الشهر -->--}}
{{--                                                <div class="col-md-4">--}}
{{--                                                    <label for="period_month" class="form-label">شهر</label>--}}
{{--                                                    <select name="period_month" id="period_month"--}}
{{--                                                        onchange="calculateEndDate()" class="select2 form-select"--}}
{{--                                                        data-allow-clear="true">--}}
{{--                                                        <option value="0" selected>0</option>--}}
{{--                                                        <!-- من 0 إلى 11 -->--}}
{{--                                                        <?php for ($i = 1; $i <= 11; $i++): ?>--}}
{{--                                                        <option value="<?= $i ?>"><?= $i ?></option>--}}
{{--                                                        <?php endfor; ?>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}

{{--                                                <!-- اليوم -->--}}
{{--                                                <div class="col-md-4">--}}
{{--                                                    <label for="period_day" class="form-label">يوم</label>--}}
{{--                                                    <select name="period_day" id="period_day"--}}
{{--                                                        onchange="calculateEndDate()" class="select2 form-select"--}}
{{--                                                        data-allow-clear="true">--}}
{{--                                                        <option value="0" selected>0</option>--}}
{{--                                                        <!-- من 0 إلى 30 -->--}}
{{--                                                        <?php for ($i = 1; $i <= 30; $i++): ?>--}}
{{--                                                        <option value="<?= $i ?>"><?= $i ?></option>--}}
{{--                                                        <?php endfor; ?>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}


{{--                                        </div>--}}
{{--                                        <!-- الحقل العقد نهاية -->--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <label class="form-label">تاريخ نهاية العقد</label>--}}
{{--                                            <div class="calendar-group" data-group="end" data-range-group="contract"--}}
{{--                                                data-validate="range">--}}
{{--                                                <div class="field-row gregorian-row ">--}}
{{--                                                    <input type="text" class="gregorian-date "--}}
{{--                                                        onchange="calculateDiff();" name="end_date" id="end_date"--}}
{{--                                                        placeholder="ميلادي">--}}
{{--                                                    <div class="ios-switch-container">--}}
{{--                                                        <span class="switch-label">هجري</span>--}}
{{--                                                        <label class="ios-switch">--}}
{{--                                                            <input type="checkbox" class="calendar-switch">--}}
{{--                                                            <span class="ios-slider"></span>--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="field-row hijri-row hidden">--}}
{{--                                                    <input type="text" class="hijri-date" name="end_dateh"--}}
{{--                                                        placeholder="هجري">--}}
{{--                                                    <div class="ios-switch-container">--}}
{{--                                                        <span class="switch-label-hijri">ميلادي</span>--}}
{{--                                                        <label class="ios-switch">--}}
{{--                                                            <input type="checkbox" class="calendar-switch-hijri" checked>--}}
{{--                                                            <span class="ios-slider"></span>--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}


{{--                                        <div class="col-md-4">--}}
{{--                                            <label class="form-label" for="year_amount"> قيمة الإيجار السنوي <i--}}
{{--                                                    class="fa fa-asterisk " style="color: red"--}}
{{--                                                    aria-hidden="true"></i></label>--}}
{{--                                            <input type='text' onkeypress="return onlyNumbers(event)"--}}
{{--                                                onkeyup="return numberValidation(event)" id="year_amount"--}}
{{--                                                name="year_amount" class="form-control" required />--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-4">--}}
{{--                                            <label class="form-label" for="no_of_payments">عدد الدفعات <i--}}
{{--                                                    class="fa fa-asterisk " style="color: red"--}}
{{--                                                    aria-hidden="true"></i></label>--}}
{{--                                            <input type='text' onkeypress="return onlyNumbers(event)"--}}
{{--                                                onkeyup="return numberValidation(event)" id="no_of_payments"--}}
{{--                                                name="no_of_payments" class="form-control" required />--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <label class="form-label" for="insurance_amount">قيمة التأمين <i--}}
{{--                                                    class="fa fa-asterisk " style="color: red"--}}
{{--                                                    aria-hidden="true"></i></label>--}}
{{--                                            <input type='text' onkeypress="return onlyNumbers(event)"--}}
{{--                                                onkeyup="return numberValidation(event)" id="insurance_amount"--}}
{{--                                                name="insurance_amount" class="form-control" />--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <label class="form-label" for="services_amount">قيمة الخدمات <i--}}
{{--                                                    class="fa fa-asterisk " style="color: red"--}}
{{--                                                    aria-hidden="true"></i></label>--}}
{{--                                            <input type='text' onkeypress="return onlyNumbers(event)"--}}
{{--                                                onkeyup="return numberValidation(event)" id="services_amount"--}}
{{--                                                name="services_amount" class="form-control" />--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <label class="form-label" for="delay_fine"> غرامة التأخير في اليوم الواحد <i--}}
{{--                                                    class="fa fa-asterisk " style="color: red"--}}
{{--                                                    aria-hidden="true"></i></label>--}}
{{--                                            <input type='text' onkeypress="return onlyNumbers(event)"--}}
{{--                                                onkeyup="return numberValidation(event)" id="delay_fine"--}}
{{--                                                name="delay_fine" class="form-control" />--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-8">--}}
{{--                                            <label class="form-label" for="notes"> ملاحظات </label>--}}
{{--                                            <textarea id="notes" name="notes" class="form-control"></textarea>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                </div>--}}
{{--                                <div class="card-footer">--}}
{{--                                    <button type="submit" name="btn_add_contract" class="btn btn-primary "> حفظ--}}
{{--                                        &nbsp;--}}
{{--                                        <i class="fa-solid fa-floppy-disk"></i> </button>--}}
{{--                                    <button type="reset" class="btn btn-secondary"--}}
{{--                                        data-bs-dismiss="modal">الغاء</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <hr class="my-1" />--}}
{{--                        @if (!empty($contracts))--}}
{{--                            <div class="card-datatable table-responsive pt-0">--}}
{{--                                <table class="table table-striped  display responsive nowrap FathyTable">--}}
{{--                                    <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th class="  ">#</th>--}}
{{--                                            <th> المستأجر </th>--}}
{{--                                            <th> بداية العقد </th>--}}
{{--                                            <th> نهاية العقد </th>--}}
{{--                                            <th> المدة باليوم </th>--}}
{{--                                            <th> الايجار السنوي </th>--}}
{{--                                            <th> القيمة الاجمالية </th>--}}
{{--                                            <th> عدد الدفعات </th>--}}
{{--                                            <th> التأمين </th>--}}
{{--                                            <th> الخدمات </th>--}}
{{--                                            <th class="no-print">اجراءات</th>--}}
{{--                                        </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                        <?php $i = 1; ?>--}}
{{--                                        @foreach ($contracts as $key => $row)--}}
{{--                                            --}}{{-- ----class = " @if ($row->id == $currnet_contract_id){{'bg-success bg-gradient  '}}"@endif------ --}}
{{--                                            <tr class="table-info  " id="contract{{$row->id}}">--}}
{{--                                                <td class="   "><?= $i ?></td>--}}
{{--                                                <td>{{ $row->renter->name }}</td>--}}
{{--                                                <td>{{ $row->start_date }} م - {{ $row->start_dateh }} هـ</td>--}}
{{--                                                <td>{{ $row->end_date }} م - {{ $row->end_dateh }} هـ</td>--}}
{{--                                                <td>--}}

{{--                                                        <?= date_diff(date_create($row->start_date), date_create($row->end_date))->format('%a') + 1 ?>--}}
{{--                                                </td>--}}
{{--                                                <td>{{ number_format($row->year_amount, 2) }}--}}

{{--                                                    <span style="font-size: 23px;"--}}
{{--                                                          class="icon-saudi_riyal_new"></span>--}}
{{--                                                </td>--}}

{{--                                                <td>--}}
{{--                                                        <?php $total = $row->year_amount * $row->period_year + ($row->year_amount / 12) * $row->period_month + ($row->year_amount / 365) * $row->period_day;--}}
{{--                                                        ?>--}}
{{--                                                    {{ number_format($total, 2) }}--}}

{{--                                                    <span style="font-size: 23px;"--}}
{{--                                                          class="icon-saudi_riyal_new"></span>--}}
{{--                                                </td>--}}

{{--                                                <td>{{ $row->no_of_payments }}</td>--}}
{{--                                                <td>{{ number_format($row->insurance_amount, 2) }}--}}

{{--                                                    <span style="font-size: 23px;"--}}
{{--                                                          class="icon-saudi_riyal_new"></span>--}}
{{--                                                </td>--}}
{{--                                                <td>{{ number_format($row->services_amount, 2) }}--}}

{{--                                                    <span style="font-size: 23px;"--}}
{{--                                                          class="icon-saudi_riyal_new"></span>--}}
{{--                                                </td>--}}
{{--                                                <td class="no-print">--}}
{{--                                                    <a href="javascript:void(0)"--}}
{{--                                                       onclick="fn_delete_object({{ $row->id }}, 'contract', 'contract{{ $row->id }}')"--}}
{{--                                                       class="btn btn-sm btn-danger delete-record">--}}
{{--                                                        <i class="fa-solid fa-trash-can pe-2"></i> حذف--}}
{{--                                                    </a>--}}


{{--                                                </td>--}}

{{--                                            </tr>--}}
{{--                                            @if (!empty($row->payments))--}}
{{--                                                <tr class="bg-dark  bg-gradient  text-white contract{{$row->id}}">--}}
{{--                                                    <td><span class="d-block ">--}}
{{--                                                                <?= $i . '-' . '0' ?> </span></td>--}}
{{--                                                    <td><span class="d-block"> المبلغ </span></td>--}}
{{--                                                    <td><span class="d-block"> البيان </span></td>--}}
{{--                                                    <td><span class="d-block"> موعد الدفع ميلادي </span></td>--}}
{{--                                                    <td><span class="d-block"> موعد الدفع هجري </span></td>--}}
{{--                                                    <td><span class="d-block"> باقي على الموعد </span></td>--}}


{{--                                                    <td><span class="d-block">الحالة </span></td>--}}
{{--                                                    <td><span class="d-block"> تاريخ الدفع ميلادي </span></td>--}}
{{--                                                    <td><span class="d-block"> تاريخ الدفع هجري </span></td>--}}
{{--                                                    <td class="no-print"><span class="d-block">اجراءات </span>--}}
{{--                                                    </td>--}}


{{--                                                </tr>--}}
{{--                                                    <?php $j = 1; ?>--}}
{{--                                                @foreach ($row->payments as $key => $payment)--}}
{{--                                                        <?php $days = dateDiff(today(), $payment->p_date);--}}
{{--                                                        if ($days <= 0 && $payment->status == 0) {--}}
{{--                                                            $class = 'table-danger';--}}
{{--                                                        } elseif ($days <= 7 && $payment->status == 0) {--}}
{{--                                                            $class = 'table-warning';--}}
{{--                                                        } else {--}}
{{--                                                            $class = '';--}}
{{--                                                        }--}}

{{--                                                        ?>--}}
{{--                                                    <tr class="{{ $class }} contract{{$row->id}}"--}}
{{--                                                        id="payment{{$payment->id}}">--}}

{{--                                                        <td><?= $i . '-' . $j ?></td>--}}
{{--                                                        <td>{{ number_format($payment->amount, 2) }}--}}
{{--                                                            <span style="font-size: 23px;"--}}
{{--                                                                  class="icon-saudi_riyal_new"></span>--}}
{{--                                                        </td>--}}

{{--                                                        <td>--}}
{{--                                                            @if ($payment->payment_no == 0)--}}
{{--                                                                {{ $payment->notes }}--}}
{{--                                                            @else--}}
{{--                                                                'دفعة رقم:' : {{ $payment->payment_no }}--}}
{{--                                                            @endif--}}
{{--                                                        </td>--}}
{{--                                                        <td>{{ $payment->p_date }} م--}}
{{--                                                        </td>--}}
{{--                                                        <td>--}}
{{--                                                            {{ $payment->p_dateh }} هـ--}}
{{--                                                        </td>--}}
{{--                                                        <td>--}}
{{--                                                            @if ($days > 0)--}}
{{--                                                                {{ $days }}--}}
{{--                                                                يوم--}}
{{--                                                            @elseif ($days <= 0 && $payment->status == 0)--}}
{{--                                                                {{ $days }}--}}
{{--                                                                يوم--}}
{{--                                                            @else--}}
{{--                                                                {{ '----' }}--}}
{{--                                                            @endif--}}
{{--                                                        </td>--}}


{{--                                                        <td>--}}
{{--                                                            @if ($payment->status)--}}
{{--                                                                <i class="fa fa-circle-check  text-success"--}}
{{--                                                                   aria-hidden="true"></i>--}}
{{--                                                            @else--}}
{{--                                                                <i class="fa-solid fa-circle-xmark text-danger"></i>--}}
{{--                                                            @endif--}}
{{--                                                        </td>--}}
{{--                                                        <td>--}}
{{--                                                            @if ($payment->actual_date != '')--}}
{{--                                                                {{ $payment->actual_date }} م--}}
{{--                                                            @endif--}}
{{--                                                        </td>--}}
{{--                                                        <td>--}}
{{--                                                            @if ($payment->actual_dateh != '')--}}
{{--                                                                {{ $payment->actual_dateh }} هـ--}}
{{--                                                            @endif--}}
{{--                                                        </td>--}}

{{--                                                        <td class="no-print">--}}


{{--                                                            @if ($payment->status)--}}
{{--                                                                <a href="{{ route('payments.print', $payment->id) }}"--}}
{{--                                                                   target="_blank" class="btn btn-sm btn-warning"--}}
{{--                                                                   alt="طباعة" alt="طباعة">--}}
{{--                                                                    <i class="fa-solid fa-print"></i>--}}
{{--                                                                </a>--}}
{{--                                                            @else--}}
{{--                                                                <a href="#"--}}
{{--                                                                   onclick="fn_payement({{ $payment }})"--}}
{{--                                                                   class="btn btn-sm btn-warning" alt="الدفع"--}}
{{--                                                                   alt="الدفع">--}}
{{--                                                                    <i class="fas fa-sack-dollar"></i>--}}
{{--                                                                </a>--}}
{{--                                                            @endif--}}

{{--                                                            <a href="javascript:void(0)"--}}
{{--                                                               onclick="fn_delete_object({{ $payment->id }}, 'payment', 'payment{{ $payment->id }}')"--}}
{{--                                                               class="btn btn-sm btn-danger delete-record">--}}
{{--                                                                <i class="fa-solid fa-trash-can pe-2"></i> حذف--}}
{{--                                                            </a>--}}


{{--                                                        </td>--}}


{{--                                                    </tr>--}}
{{--                                                        <?php $j++; ?>--}}
{{--                                                @endforeach--}}
{{--                                            @endif--}}

{{--                                                <?php $i++; ?>--}}
{{--                                        @endforeach--}}
{{--                                    </tbody>--}}

{{--                                    <tfoot>--}}
{{--                                        <tr>--}}

{{--                                            <th> # </th>--}}
{{--                                            <th> المستأجر </th>--}}
{{--                                            <th> بداية العقد </th>--}}
{{--                                            <th> نهاية العقد </th>--}}
{{--                                            <th> المدة باليوم </th>--}}
{{--                                            <th> الايجار السنوي </th>--}}
{{--                                            <th> القيمة الاجمالية </th>--}}
{{--                                            <th> عدد الدفعات </th>--}}
{{--                                            <th> عدد الدفعات </th>--}}
{{--                                            <th> التأمين </th>--}}
{{--                                            <th> الخدمات </th>--}}
{{--                                            <th class="no-print">اجراءات</th>--}}
{{--                                        </tr>--}}
{{--                                    </tfoot>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        @else--}}
{{--                            لا يوجد عقود مسجلة--}}
{{--                        @endif--}}

{{--                    </div>--}}





                    <div class="tab-pane   fade active show" id="form-tabs-units" role="tabpanel">
                        <a href="#exampleModal" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                            اضافة شقة جديدة <i class=" fa-solid fa-plus pe-2 " aria-hidden="true"></i>
                        </a>



                        @if (!empty($units))


                            <div class="card-datatable table-responsive pt-0">
                                <table class="table table-striped display responsive nowrap FathyTable ">
                                    <thead>
                                        <tr>
                                            <th>#</th>

                                            <th> نوع الوحدة </th>
                                            <th> الدور </th>
                                            <th> رقم الوحدة </th>
                                            <th> حساب الكهرباء </th>
                                            <th> المستأجر الحالي </th>
                                            <th class="no-print"> صورة </th>
                                            <th class="no-print">اجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($units as $key => $unit)
                                            <tr id="unit{{$unit->id}}">
                                                <td>{{ ++$i }}</td>

                                                <td>{{ $unit->unitType->name }}</td>
                                                <td>{{ $unit->floor_no }}</td>

                                                <td>{{ $unit->unit_no }}</td>
                                                <td>{{ $unit->electric_no }}</td>
                                                <td>{{ @$unit->renter->name }}</td>
                                                <td class="no-print">
                                                    <a href="#exampleModal{{ $unit->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $unit->id }}">
                                                        <i class="fa-solid fa-address-card fa-2xl"></i>
                                                    </a>

                                                    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="exampleModal{{ $unit->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"> صورة </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img class="d-block"
                                                                        src="<?= asset('storage/' . $unit->img) ?>"
                                                                        width="100%">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">اغلاق</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>


                                                <td class="no-print">


                                                    <a href="{{ route('units.show', $unit->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fa-solid fa-circle-info pe-2"></i> فتح
                                                    </a>
                                                    <a href="{{ route('units.edit', $unit->id) }}"
                                                        class="btn btn-sm btn-primary"><i
                                                            class="fa-regular fa-pen-to-square pe-2"></i> تعديل</a>
                                                    <a href="javascript:void(0)"
                                                       onclick="fn_delete_object({{ $unit->id }}, 'unit', 'unit{{ $unit->id }}')"
                                                       class="btn btn-sm btn-danger delete-record">
                                                        <i class="fa-solid fa-trash-can pe-2"></i> حذف
                                                    </a>


                                                </td>

                                            </tr>

                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>

                                            <th> نوع الوحدة </th>
                                            <th> الدور </th>
                                            <th> رقم الوحدة </th>
                                            <th> حساب الكهرباء </th>
                                            <th> المستأجر الحالي </th>
                                            <th class="no-print"> صورة </th>
                                            <th class="no-print">اجراءات</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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
                                        <input type="hidden" name="object_id" value="{{ $center->id }}">
                                        <input type="hidden" name="object_name" value="centers">
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
                        <span>
                            <a class="btn bt-show" href="#"
                                onclick="fn_add_file_row('file_attach'); return false ; ">
                                + اضافة مرفق </a>
                        </span>
                        <form method="POST" action="{{ route('allfiles.add_files') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="object_id" value="{{ $center->id }}">
                            <input type="hidden" name="object_name" value="centers">

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
    </div>













    <!------------------------------------------------------->

    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <form method="POST" action="{{ route('units.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="maincenter_id" name="maincenter_id" value="{{ $center->maincenter_id }}">
                    <input type="hidden" id="center_id" name="center_id" value="{{ $center->id }}">
                    <div class="container-xxl">
                        <div class="authentication-wrapper authentication-basic container-p-y">
                            <div class="authentication-inner py-4">
                                <!-- Login -->
                                <div class="card border">

                                    <h5 id="mctitle">

                                        {{ $center->maincenter->name }} /
                                        {{ $center->location->name }} /
                                        {{ $center->center_name }}

                                        <div class="card-body">


                                            <!-- Login -->
                                            <div class="card border">
                                                <div class="card-body">

                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="unit_type"> نوع
                                                                الوحدة <i class="fa fa-asterisk " style="color: red"
                                                                    aria-hidden="true"></i></label>
                                                            <select id="unit_type" name="unit_type"
                                                                class="select2 form-select" data-allow-clear="true">
                                                                <option value="">اختر </option>
                                                                @foreach ($types as $row)
                                                                    <option value="{{ $row->id }}">
                                                                        {{ $row->name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="form-label" for="unit_description">وصف الوحدة <i
                                                                    class="fa fa-asterisk " style="color: red"
                                                                    aria-hidden="true"></i></label>
                                                            <input type="text" id="unit_description"
                                                                name="unit_description" class="form-control" />
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="no_of_rooms"> عدد الغرف
                                                            </label>
                                                            <input type="text" id="no_of_rooms" name="no_of_rooms"
                                                                class="form-control" />
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="no_of_wc"> عدد دورات المياة
                                                            </label>
                                                            <input type="text" id="no_of_wc" name="no_of_wc"
                                                                class="form-control" />
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="activity"> النشاط </label>
                                                            <input type="text" id="activity" name="activity"
                                                                class="form-control" />
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="form-label" for="woter_no"> حساب
                                                                المياه </label>
                                                            <input type="text" id="woter_no" name="woter_no"
                                                                class="form-control" />
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="form-label" for="electric_no">
                                                                حساب الكهرباء <i class="fa fa-asterisk "
                                                                    style="color: red" aria-hidden="true"></i></label>
                                                            <input type="text" id="electric_no" name="electric_no"
                                                                class="form-control" />
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="form-label" for="floor_no">
                                                                الدور<i class="fa fa-asterisk " style="color: red"
                                                                    aria-hidden="true"></i></label>
                                                            <input type="text" id="floor_no" name="floor_no"
                                                                class="form-control" />
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label" for="unit_no"> رقم
                                                                الوحدة <i class="fa fa-asterisk " style="color: red"
                                                                    aria-hidden="true"></i></label>
                                                            <input type="text" id="unit_no" name="unit_no"
                                                                class="form-control" />
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="form-label" for="current_renter_id"> المستأجر
                                                                الحالي
                                                            </label>
                                                            <select id="current_renter_id" name="current_renter_id"
                                                                class="select2 form-select" data-allow-clear="true">
                                                                <option value="">اختر </option>
                                                                @foreach ($renters as $row)
                                                                    <option value="{{ $row->id }}">
                                                                        {{ $row->name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>





                                                        <div class="col-md-4">
                                                            <label for="file" class="form-label"> صورة
                                                            </label>
                                                            <input type="file"
                                                                accept=".jpg, .jpeg, .pdf, image/jpeg, application/pdf"
                                                                name="file" id="imgFile2"
                                                                onchange="validate_and_loadFile(event,this.id)"
                                                                class="form-control">
                                                            <img id="imgFile2_view" width="150px" height="100px"
                                                                border="4" hidden />
                                                        </div>


                                                        <div class="col-md-4">
                                                            <label class="form-label" for="notes">
                                                                ملاحظات </label>
                                                            <textarea id="notes" name="notes" class="form-control"></textarea>
                                                        </div>



                                                    </div>



                                                </div>
                                            </div>




                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">الغاء </button>
                                                <button type="submit" name="btn_add_unit"
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



    <!-- Modal -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="payment_id" id="payment_id">
                <input type="hidden" name="true_amount" id="true_amount">
                <input type="hidden" name="emp_name" id="emp_name">
                <input type="hidden" name="maincenter_id" value="{{ $center->maincenter_id }}">
                <input type="hidden" name="unit_id" value="0">
                <input type="hidden" name="center_id" value="{{ $center->id }}">

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
                                <input type="text" onkeypress="return onlyNumbers(event)"
                                    onkeyup="return numberValidation(event)" id="amount" name="amount"
                                    class="form-control" />
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

    <script>
        $(document).ready(function() {
            // Your code here will run once the DOM is ready
            // console.log("Document is ready!");
            // $("#myButton").click(function() {
            //     // Handle button click
            // });
        });




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

        function fn_delete_unit(id) {
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
                    window.location.href = "../../units/destroy/" + id
                }
            });
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

            var start_date = new Date(start);
            var end_date = new Date(end);
            end_date.setDate(end_date.getDate() + 1)

            if (end_date < start_date) {

                return;
            }

            let years = end_date.getFullYear() - start_date.getFullYear();
            let months = end_date.getMonth() - start_date.getMonth();
            let days = end_date.getDate() - start_date.getDate();
            if (days < 0) {
                months--;

                let daysInPrevMonth = new Date(endYear, endMonth, 0).getDate();
                days += daysInPrevMonth;
            }

            if (months < 0) {
                years--;
                months += 12;
            }
            $('#period_month').val(months).trigger('change');
            $('#period_year').val(years).trigger('change');
            $('#period_day').val(days).trigger('change');

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


            console.log(row);

            $('#renter_name').val(row['contract']['renter']['name']);
            $('#amount').val(row['amount']);
            $('#true_amount').val(row['amount']);
            $('#payment_notes').val(row['notes']);
            $('#payment_id').val(row['id']);

            //  $('#emp_name').val($("#emp_id option:selected").text());
            $('#paymentModal').modal('show');


        }
    </script>
@endsection
