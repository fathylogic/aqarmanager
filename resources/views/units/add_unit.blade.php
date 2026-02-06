@extends('layouts.app')

@section('content')

    <style>
        /* Custom styles for fieldset */
        fieldset {
            border: 10px solid #f3a108 !important;
            padding: 1.5rem;
            margin-bottom: 1rem;
            background-color: #ffffff;
        }

        /* Custom styles for legend */
        legend {
            float: none;
            /* Crucial for proper legend behavior in Bootstrap 5 */
            width: auto;
            /* Ensures legend only takes up necessary width */
            padding: 0 0.5rem;
            /* Example: custom padding */
            font-size: 1.25rem;
            /* Example: custom font size */
            font-weight: bold;
            /* Example: custom font weight */

            margin-bottom: 0;
            /* Remove default margin for legend */
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





    <form method="POST" action="" enctype="multipart/form-data">
        @csrf


        <fieldset class="border p-3 mb-4">
            <legend class="float-none w-auto px-2 fs-5 fw-bold text-primary">
                بيانات الوحدة
            </legend>


            <div class="row g-3">


                <div class="col-md-4">
                    <label class="form-label" for="maincenter_id"> المركز الرئيسي <i class="fa fa-asterisk "
                            style="color: red" aria-hidden="true"></i></label>
                    <select name="maincenter_id" onchange="fn_get_centers(this.value)" required class="select2 form-select"
                        data-allow-clear="true">
                        <option value="">اختر </option>
                        <option value="0">مركز رئيسي جديد </option>
                        @foreach ($maincenters as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="col-md-4" id="center_div">
                    <label class="form-label" for="center_id"> العمارة <i class="fa fa-asterisk " style="color: red"
                            aria-hidden="true"></i></label>
                    <select id="center_id" name="center_id" onchange="fn_show_add_center(this.value)" required
                        class="select2 form-select" data-allow-clear="true">


                    </select>
                </div>



                <div class="col-md-4">
                    <label class="form-label" for="unit_type"> نوع الوحدة <i class="fa fa-asterisk " style="color: red"
                            aria-hidden="true"></i></label>
                    <select id="unit_type" name="unit_type" class="select2 form-select" data-allow-clear="true">
                        <option value="">اختر </option>
                        @foreach ($types as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="unit_description">وصف الوحدة <i class="fa fa-asterisk "
                            style="color: red" aria-hidden="true"></i></label>
                    <input type="text" autocomplete="off" id="unit_description" name="unit_description"
                        class="form-control" />
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="woter_no"> حساب المياه </label>
                    <input type="text" autocomplete="off" id="woter_no" name="woter_no" class="form-control" />
                </div>

                <div class="col-md-2">
                    <label class="form-label" for="electric_no"> حساب الكهرباء <i class="fa fa-asterisk " style="color: red"
                            aria-hidden="true"></i></label>
                    <input type="text" autocomplete="off" id="electric_no" name="electric_no" class="form-control" />
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="addad_no"> عداد الكهرباء <i class="fa fa-asterisk " style="color: red"
                            aria-hidden="true"></i></label>
                    <input type="text" autocomplete="off" id="addad_no" name="addad_no" class="form-control" />
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="floor_no"> الدور<i class="fa fa-asterisk " style="color: red"
                            aria-hidden="true"></i></label>
                    <input type="text" autocomplete="off" id="floor_no" name="floor_no" class="form-control" />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="unit_no"> رقم الوحدة <i class="fa fa-asterisk " style="color: red"
                            aria-hidden="true"></i></label>
                    <input type="text" autocomplete="off" id="unit_no" name="unit_no" class="form-control" />
                </div>
                <div class="col-md-4">
                    <label for="file" class="form-label"> صورة </label>
                    <input type="file" accept=".jpg, .jpeg, .pdf, image/jpeg, application/pdf" name="file"
                        id="imgFile" onchange="validate_and_loadFile(event,this.id)" class="form-control">
                    <img id="imgFile_view" width="150px" height="100px" border="4" hidden />
                </div>


                <div class="col-md-4">
                    <label class="form-label" for="notes"> ملاحظات </label>
                    <textarea name="notes" class="form-control"></textarea>
                </div>



            </div>

        </fieldset>





        <fieldset class="border p-3 mb-4">
            <legend class="float-none w-auto px-2 fs-5 fw-bold text-primary">
                بيانات العقد
            </legend>








            <div class="row g-3">

                <div class="col-md-12">
                    <label class="form-label" for="current_renter_id"> المستأجر الحالي </label>
                    <select id="current_renter_id" onchange="show_renter();" name="current_renter_id"
                        class="select2 form-select" data-allow-clear="true">
                        <option value="">اختر</option>
                        <option value="0">مستأجر جديد</option>
                        @foreach ($renters as $row)
                            <option value="{{ $row->id }}" data-row='@json($row)'>
                                {{ $row->name }} - ( {{ @$row->nat->name }} ) - {{ @$row->mobile_no }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row g-3" id="renter_div" style="display: none ;">
                    <div class="col-md-4">
                        <label class="form-label" for="name">الاسم <i class="fa fa-asterisk " style="color: red"
                                aria-hidden="true"></i></label>
                        <input type="text" autocomplete="off" id="name" name="name" class="form-control" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="id_type"> نوع الهوية <i class="fa fa-asterisk "
                                style="color: red" aria-hidden="true"></i></label>

                        <select id="id_type" name="id_type" class="select2 form-select" data-allow-clear="true">
                            <option value="">اختر </option>
                            @foreach ($id_types as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="id_no"> رقم الهوية <i class="fa fa-asterisk "
                                style="color: red" aria-hidden="true"></i></label>
                        <input type="text" autocomplete="off" id="id_no" name="id_no" class="form-control" />
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="nationality"> الجنسية <i class="fa fa-asterisk "
                                style="color: red" aria-hidden="true"></i></label>

                        <select id="nationality"  name="nationality" class="select2 form-select"
                            data-allow-clear="true">
                            <option value="">اختر </option>
                            @foreach ($nationalities as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="mobile_no"> رقم الجوال <i class="fa fa-asterisk "
                                style="color: red" aria-hidden="true"></i></label>
                        <input type="text" autocomplete="off" id="mobile_no" name="mobile_no"
                            class="form-control" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="employer"> جهة العمل </label>
                        <input type="text" autocomplete="off" id="employer" name="employer" class="form-control" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="work_no"> رقم جهة العمل </label>
                        <input type="text" autocomplete="off" id="work_no" name="work_no" class="form-control" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="other_no	"> رقم اخر للتواصل </label>
                        <input type="text" autocomplete="off" id="other_no" name="other_no" class="form-control" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="work_letter"> خطاب جهة العمل </label>
                        <input type="file" accept=".jpg, .jpeg, .pdf, image/jpeg, application/pdf" name="work_letter"
                            id="work_letter" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="file" class="form-label"> صورة الهوية</label>
                        <input type="file" accept=".jpg, .jpeg, .pdf, image/jpeg, application/pdf" name="id_file"
                            id="id_file" onchange="validate_and_loadFile(event,this.id)" class="form-control">
                        <img id="id_file_view" width="150px" height="100px" border="4" hidden />
                    </div>

                    <div class="col-md-8">
                        <label class="form-label" for="r_notes"> ملاحظات </label>
                        <textarea name="r_notes" class="form-control"></textarea>
                    </div>

                </div>



                <div class="col-md-4">
                    <label class="form-label">تاريخ بداية العقد</label>
                    <div class="calendar-group" data-group="start" data-range-group="contract" data-validate="range">
                        <div class="field-row gregorian-row ">
                            <input type="text" class="gregorian-date" onchange="calculateDiff();" name="start_date"
                                id="start_date" placeholder="ميلادي" autocomplete="off">
                            <div class="ios-switch-container">
                                <span class="switch-label">هجري</span>
                                <label class="ios-switch">
                                    <input type="checkbox" class="calendar-switch">
                                    <span class="ios-slider"></span>
                                </label>
                            </div>
                        </div>

                        <div class="field-row hijri-row hidden">
                            <input type="text" class="hijri-date" name="start_dateh" placeholder="هجري"
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

                <div class="col-md-4  ">


                    <div class="row g-2">
                        <!-- السنة -->
                        <div class="col-md-4">
                            <label for="period_year" class="form-label">سنة</label>
                            <select name="period_year" id="period_year"  onchange="calculateEndDate()"
                                class="select2 form-select" data-allow-clear="true">
                                <option value="0" selected>0</option>
                                <!-- من 0 إلى 10 -->
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <!-- الشهر -->
                        <div class="col-md-4">
                            <label for="period_month" class="form-label">شهر</label>
                            <select name="period_month" id="period_month"  onchange="calculateEndDate()"
                                class="select2 form-select" data-allow-clear="true">
                                <option value="0" selected>0</option>
                                <!-- من 0 إلى 11 -->
                                <?php for ($i = 1; $i <= 11; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
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
                                <?php for ($i = 1; $i <= 30; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>


                </div>
                <!-- الحقل العقد نهاية -->
                <div class="col-md-4">
                    <label class="form-label">تاريخ نهاية العقد</label>
                    <div class="calendar-group" data-group="end" data-range-group="contract" data-validate="range">
                        <div class="field-row gregorian-row ">
                            <input type="text" class="gregorian-date " onchange="calculateDiff();" name="end_date"
                                 id="end_date" placeholder="ميلادي">
                            <div class="ios-switch-container">
                                <span class="switch-label">هجري</span>
                                <label class="ios-switch">
                                    <input type="checkbox" class="calendar-switch">
                                    <span class="ios-slider"></span>
                                </label>
                            </div>
                        </div>
                        <div class="field-row hijri-row hidden">
                            <input type="text"  class="hijri-date" name="end_dateh"
                                placeholder="هجري">
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
                    <label class="form-label" for="e_no"> رقم العقد الالكتروني <i class="fa fa-asterisk "
                            style="color: red" aria-hidden="true"></i></label>
                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                        onkeyup="return numberValidation(event)" id="e_no" name="e_no" class="form-control" />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="year_amount"> قيمة الإيجار السنوي <i class="fa fa-asterisk "
                            style="color: red" aria-hidden="true"></i></label>
                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                        onkeyup="return numberValidation(event)" id="year_amount" name="year_amount"
                        class="form-control" required />
                </div>


                <div class="col-md-4">
                    <label class="form-label" for="no_of_payments">عدد الدفعات <i class="fa fa-asterisk "
                            style="color: red" aria-hidden="true"></i></label>
                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                        onkeyup="return numberValidation(event)" id="no_of_payments" name="no_of_payments"
                        class="form-control" required />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="insurance_amount">قيمة التأمين <i class="fa fa-asterisk "
                            style="color: red" aria-hidden="true"></i></label>
                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                        onkeyup="return numberValidation(event)" id="insurance_amount" name="insurance_amount"
                        class="form-control" />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="services_amount">قيمة الخدمات <i class="fa fa-asterisk "
                            style="color: red" aria-hidden="true"></i></label>
                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                        onkeyup="return numberValidation(event)" id="services_amount" name="services_amount"
                        class="form-control" />
                </div>

                <div class="col-md-4">
                                                <label class="form-label" for="delay_fine">  غرامة التأخير في اليوم الواحد  <i
                                                        class="fa fa-asterisk " style="color: red"
                                                        aria-hidden="true"></i></label>
                                                <input type='text' onkeypress="return onlyNumbers(event)"
                                                    onkeyup="return numberValidation(event)" id="delay_fine"
                                                    name="delay_fine" class="form-control" />
                                            </div>

                <div class="col-md-8">
                    <label class="form-label" for="c_notes"> ملاحظات </label>
                    <textarea name="c_notes" class="form-control"></textarea>
                </div>

            </div>




        </fieldset>

        <div class="card-footer">
            <button type="submit" name="btn_add_unit" class="btn btn-primary "> حفظ
                &nbsp;
                <i class="fa-solid fa-floppy-disk"></i> </button>
            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
        </div>

    </form>
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="maincentermodal" tabindex="-1" aria-labelledby="maincentermodalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf

                <div class="modal-content">
                    <div class="modal-header  bg-primary">
                        <h5 class="modal-title bg-lighter text-white" id="maincentermodalLabel"> اضافة مركز رئيسي </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">


                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="name">اسم المركز الرئيسي <i
                                            class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" autocomplete="off" id="name" name="name"
                                        value="{{ old('name') }}" class="form-control" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="iban">حساب الايبان <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>

                                    <div class="input-group mb-3" dir="ltr">
                                        <span class="input-group-text" id="iban">SA</span>
                                        <input type="text" autocomplete="off" value="{{ old('iban') }}"
                                            class="form-control" id="iban" dir="ltr" name="iban"
                                            onkeypress="return onlyNumbers(event)"
                                            onkeyup="return numberValidation(event)" aria-describedby="iban">
                                    </div>

                                    @error('iban')
                                        <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="emp_id">الموظف المسئول </label>
                                    <select id="emp_id" name="emp_id" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">اختر </option>
                                        @foreach ($emps as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach

                                    </select>
                                </div>





                                <div class="col-md-6">
                                    <label for="file" class="form-label"> صورة </label>
                                    <input type="file" accept=".jpg, .jpeg, .pdf, image/jpeg, application/pdf"
                                        name="file" id="imgFile2" onchange="validate_and_loadFile(event,this.id)"
                                        class="form-control">
                                    <img id="imgFile2_view" width="150px" height="100px" border="4" hidden />
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="notes"> ملاحظات </label>
                                    <textarea id="notes" name="notes" class="form-control"></textarea>
                                </div>

                            </div>


                        </div>




                    </div>
                    <div class="modal-footer">
                        <hr>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                        <button type="submit" name="btn_addMainCenter" class="btn btn-primary">

                            حفظ البيانات </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="centermodal" tabindex="-1" aria-labelledby="centermodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="creat_new_center">
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="maincenter_id" name="maincenter_id">
                        <div class="container-xxl">
                            <div class="authentication-wrapper authentication-basic container-p-y">
                                <div class="authentication-inner py-4">
                                    <!-- Login -->
                                    <div class="card border">
                                        <div class="card-header">
                                            <h5 id="mctitle"> اضافة عمارة جديدة </h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="container-xxl">
                                                <div class="authentication-wrapper authentication-basic container-p-y">
                                                    <div class="authentication-inner py-4">
                                                        <!-- Login -->
                                                        <div class="card border">
                                                            <div class="card-body">

                                                                <div class="row g-3">
                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="center_name">اسم
                                                                            العمارة <i class="fa fa-asterisk "
                                                                                style="color: red"
                                                                                aria-hidden="true"></i></label>
                                                                        <input type="text" autocomplete="off"
                                                                            name="center_name" class="form-control"
                                                                            required />
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label"
                                                                            for="center_location">المنطقة <i
                                                                                class="fa fa-asterisk " style="color: red"
                                                                                aria-hidden="true"></i></label>
                                                                        <select id="center_location"
                                                                            name="center_location" required
                                                                            class="select2 form-select"
                                                                            data-allow-clear="true">
                                                                            <option value="">اختر</option>
                                                                            @foreach ($locations as $row)
                                                                                <option value="{{ $row->id }}">
                                                                                    {{ $row->name }}</option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="hainame">الحي
                                                                        </label>
                                                                        <input type="text" name="hainame"
                                                                            class="form-control" />

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="street">الشارع
                                                                        </label>
                                                                        <input type="text" autocomplete="off"
                                                                            name="street" class="form-control" />

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="Building_no">رقم
                                                                            العمارة </label>
                                                                        <input type="text" name="Building_no"
                                                                            class="form-control" />

                                                                    </div>



                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="sak_no"> الموقع
                                                                            على الخريطة </label>
                                                                        <input type="text" autocomplete="off"
                                                                            name="gps" class="form-control" />

                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="sak_no">رقم الصك
                                                                        </label>
                                                                        <input type="text" autocomplete="off"
                                                                            name="sak_no" class="form-control" />

                                                                    </div>


                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="electric_no"> حساب
                                                                            شركة الكهرباء <i class="fa fa-asterisk "
                                                                                style="color: red"
                                                                                aria-hidden="true"></i></label>
                                                                        <input type="text" id="electric_no"
                                                                            name="electric_no" class="form-control" />
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="woter_no"> حساب
                                                                            شركة المياة <i class="fa fa-asterisk "
                                                                                style="color: red"
                                                                                aria-hidden="true"></i></label>
                                                                        <input type="text" autocomplete="off"
                                                                            id="woter_no" name="woter_no"
                                                                            class="form-control" />
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="left_electric_no">
                                                                            حساب اخر للمصاعد
                                                                        </label>
                                                                        <input type="text" autocomplete="off"
                                                                            id="left_electric_no" name="left_electric_no"
                                                                            class="form-control" />
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="file" class="form-label">
                                                                            صورة</label>
                                                                        <input type="file"
                                                                            accept=".jpg, .jpeg, .pdf, image/jpeg, application/pdf"
                                                                            name="file" id="imgFile3"
                                                                            onchange="validate_and_loadFile(event,this.id)"
                                                                            class="form-control">
                                                                        <img id="imgFile3_view" width="150px"
                                                                            height="100px" border="4" hidden />


                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="othercontents" class="form-label">
                                                                            تحتوي على </label>
                                                                        <br>
                                                                        @foreach ($others as $row)
                                                                            <input type="checkbox" class="checkbox"
                                                                                name="othercontents[]"
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





                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                    </form>
                </div>

            </div>
        </div>
    </div>

    <input type="hidden" id="aurl" value="{{ $root }}/units/get_centers/">

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>

    <script>
        function show_renter() {
            const el = document.getElementById('current_renter_id');
            const selectedOption = el.options[el.selectedIndex];
            const data = selectedOption.getAttribute('data-row');

            if (data) {
                const row = JSON.parse(data);
                //   console.log(row.name); // 👈 هنا تطبع بيانات المستأجر كاملة

                $('#renter_div').hide();

            } else {
                $('#renter_div').show();
            }
        }
    </script>


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


        function fn_get_centers(id) {
            if (id != '' && id > 0) {
                $('#maincenter_id').val(id);
                var url = $('#aurl').val() + id;


                $.ajax({
                    url: url,
                    method: 'GET',
                    data: id,
                    dataType: 'text',
                    success: function(data) {
                        console.log(data);
                        $('#center_id').html(data);

                        $('#center_id').trigger('change');
                        $('#center_div').show();


                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error("AJAX error:", status, error);
                    }
                });
            } else {
                $('#maincentermodal').modal('show');
                $('#center_div').hide();
            }

        }

        function fn_show_add_center(id) {
            if (id == 0) {
                $('#centermodal').modal('show');
            } else {
                $('#centermodal').modal('hide');
            }
        }
    </script>


@endsection
