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

    <form method="POST" action="{{ route('contracts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="container-xxl">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner py-4">
                    <!-- Login -->
                    <div class="card border">
                        <div class="card-body">


                            <div class="row g-3">

                                <div class="col-md-3">
                                    <label class="form-label" for="e_no"> رقم العقد الالكتروني <i
                                            class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" autocomplete="off" maxlength="20"
                                             id="e_no" name="e_no"
                                           class="form-control"/>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="renter_id"> المستأجر </label>
                                    <select id="renter_id" name="renter_id" required
                                            class="select2 form-select" data-allow-clear="true">
                                        <option value="">اختر</option>

                                        @foreach ($renters as $row)
                                            <option value="{{ $row->id }}" data-row='@json($row)'>
                                                {{ $row->name }} - ( {{ @$row->nat->name }} ) - {{ @$row->mobile_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="file" class="form-label"> صورة العقد </label>
                                    <input type="file" name="file" id="file" class="form-control">

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="electric_no"> حسابات  الكهرباء <i class="fa fa-asterisk "
                                                                                                  style="color: red" aria-hidden="true"></i></label>

                                    <textarea id="electric_no" name="electric_no" class="form-control"></textarea>

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="water_no"> حسابات  المياه <i class="fa fa-asterisk "
                                                                                                  style="color: red" aria-hidden="true"></i></label>

                                    <textarea id="water_no" name="water_no" class="form-control"></textarea>

                                </div>

                                <div class="col-md-3">
                                    <label class="form-label" for="segel_togary">
                                        رقم   السجل التجاري
                                    </label>
                                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)"  id="segel_togary" name="segel_togary"
                                           class="form-control"/>
                                </div>

                                <div class="col-md-9">
                                    <label class="form-label" for="c_notes"> ملاحظات العقد </label>
                                    <textarea name="c_notes" class="form-control"></textarea>
                                </div>


                                <div class="col-md-4">
                                    <label class="form-label" for="maincenter_id"> المركز الرئيسي <i
                                            class="fa fa-asterisk " style="color: red"
                                            aria-hidden="true"></i></label>
                                    <select name="maincenter_id" onchange="fn_get_centers(this.value)"
                                            required class="select2 form-select" data-allow-clear="true">
                                        <option value="">اختر</option>

                                        @foreach ($maincenters as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-4" id="center_div">
                                    <label class="form-label" for="center_id"> العمارة <i
                                            class="fa fa-asterisk " style="color: red"
                                            aria-hidden="true"></i></label>
                                    <select id="center_id" name="center_id"
                                            onchange="fn_get_units(this.value)" required
                                            class="select2 form-select" data-allow-clear="true">


                                    </select>
                                </div>

                                <div class="col-md-4" id="unit_div">
                                    <label class="form-label" for="unit_id"> الوحدة <i
                                            class="fa fa-asterisk " style="color: red"
                                            aria-hidden="true"></i></label>
                                    <select id="unit_id" name="unit_id"
                                            class="select2 form-select" data-allow-clear="true">

                                    </select>
                                </div>
                                <x-datepicker
                                    name_g="start_date"
                                    name_h="start_dateh"
                                    start_g=""
                                    col="6"
                                    label="بداية العقد"
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
                                                <option value="<?= $i ?>"><?= $i ?></option>
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
                                                <?php for ($i = 1;
                                                           $i <= 30;
                                                           $i++): ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <!-- الحقل العقد نهاية -->

                                <x-datepicker
                                    name_g="end_date"
                                    name_h="end_dateh"
                                    start_g=""
                                    col="6"
                                    label="نهاية العقد"
                                />



                                <div class="col-md-3">
                                    <label class="form-label" for="year_amount"> قيمة دفعة الإيجار السنوي <i
                                            class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" onfocus="calculateDiff();"
                                           id="year_amount" name="year_amount"
                                           class="form-control" required/>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="total_amount"> اجمالي قيمة العقد       <i
                                            class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" onfocus="calculateDiff();"
                                           id="total_amount" name="total_amount"
                                           class="form-control" required/>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label" for="delay_fine"> غرامة التأخير في اليوم الواحد </label>
                                    <input type='text' onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" id="delay_fine"
                                           name="delay_fine" class="form-control"/>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label" for="start_payment_amount"> الدفعة المقدمة (العربون)           </label>
                                    <input type='text' onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" id="start_payment_amount"
                                           name="start_payment_amount" class="form-control"/>
                                    <span class="form-note">
                                    سيضاف كدفعة منفصلة وتخصم من الدفعة الاولى
                                        </span>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label" for="no_of_payments">عدد الدفعات في السنة الواحدة <i
                                            class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" id="no_of_payments"
                                           name="no_of_payments"
                                           class="form-control" required/>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="no_of_all_payments">عدد جميع الدفعات الايجارية <i
                                            class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)" id="no_of_all_payments"
                                           name="no_of_all_payments"
                                           class="form-control" required/>
                                </div>

                                <div class="card mt-3">
                                    <div class="card-header bg-light">
                                        <strong>البنود الإضافية</strong>
                                    </div>
                                    <div class="card-body">

                                        <!-- الخدمات -->
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-3">
                                                <label>أجرة الخدمات  (سنوي)</label>
                                                <input  type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                                        onkeyup="return numberValidation(event)" id="services_amount"  name="services_amount" value="0" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label>طريقة التحصيل</label>
                                                <select id="services_collect"  name="services_collect" class="form-select">
                                                    <option value="first">كاملة مع أول دفعة سنوية</option>
                                                    <option value="split">مقسمة على الدفعات</option>
                                                    <option value="payment">دفعة مستقلة</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>تضاف لإجمالي العقد؟</label>
                                                <select id="services_add_total" class="form-select">

                                                    <option value="0" selected >لا</option>
                                                    <option value="1" >نعم</option>

                                                </select>
                                            </div>
                                        </div>

                                        <hr>

                                        <!-- الكهرباء -->
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-3">
                                                <label>أجرة الكهرباء (سنوي)</label>
                                                <input  type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                                        onkeyup="return numberValidation(event)" id="electricity_amount"  name="electricity_amount" value="0" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label>طريقة التحصيل</label>
                                                <select id="electricity_collect" name="electricity_collect" class="form-select">
                                                    <option value="first">كاملة مع أول دفعة سنوية</option>
                                                    <option value="split">مقسمة على الدفعات</option>
                                                    <option value="payment">دفعة مستقلة</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>تضاف لإجمالي العقد؟</label>
                                                <select id="electricity_add_total" name="electricity_add_total" class="form-select">
                                                    <option value="0" selected >لا</option>
                                                    <option value="1" >نعم</option>
                                                </select>
                                            </div>
                                        </div>

                                        <hr>

                                        <!-- المياه -->
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-3">
                                                <label>أجرة المياه (سنوي)</label>
                                                <input  type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                                        onkeyup="return numberValidation(event)" id="water_amount" name="water_amount" value="0" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label>طريقة التحصيل</label>
                                                <select id="water_collect" name="water_collect" class="form-select">
                                                    <option value="first">كاملة مع أول دفعة سنوية</option>
                                                    <option value="split">مقسمة على الدفعات</option>
                                                    <option value="payment">دفعة مستقلة</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>تضاف لإجمالي العقد؟</label>
                                                <select id="water_add_total" name="water_add_total" class="form-select">
                                                    <option value="0" selected >لا</option>
                                                    <option value="1" >نعم</option>
                                                </select>
                                            </div>
                                        </div>

                                        <hr>

                                        <!-- التأمين -->
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-3">
                                                <label>مبلغ التأمين</label>
                                                <input  type="text" autocomplete="off" onkeypress="return onlyNumbers(event)"
                                                        onkeyup="return numberValidation(event)" id="insurance_amount"  name="insurance_amount" value="0" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label>طريقة التعامل</label>
                                                <input type="hidden" name="insurance_mode" value="none">
                                                 <br>
                                                <p>يذكر فقط في العقد</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-12 text-center">
                                    <button type="button" onclick="generatePayments()" class="btn btn-success px-5">عرض
                                        الدفعات
                                    </button>
                                </div>

                                <div id="payments_table_container" style="display:none;">
                                    <table class="table table-bordered text-center">
                                        <thead class="">
                                        <tr>
                                            <th>رقم الدفعة</th>
                                            <th>تاريخ الاستحقاق</th>

                                            <th> البيان</th>
                                            <th>قيمة الدفعة</th>
                                            <th>إجراء</th>

                                        </tr>
                                        </thead>
                                        <tbody id="payments_body">
                                        <!-- سيتم توليد الصفوف هنا -->
                                        </tbody>
                                        <tfoot>
                                        <tr class="">
                                            <th colspan="2" class="yes">اجمالي قيمة العقد يجب أن يكون :
                                                <span id="span_total_amount">0.00</span>
                                                <input type="hidden" class="form-control" name="total_amount"
                                                       id="total_amount_input">
                                            </th>
                                            <th>اجمالي الدفعات</th>
                                            <td class="yes" id="total_sum">0.00</td>
                                        </tr>
                                        </tfoot>
                                    </table>

                                    <div class="mt-3 text-end">
                                        <button type="button"
                                                class="btn btn-success"
                                                onclick="addEmptyPaymentRow()">
                                            ➕ إضافة دفعة
                                        </button>
                                    </div>

                                </div>

                            </div>


                            <div class="mb-3">


                                <div class="card-footer">
                                    <button type="submit" id="btn_save_contract" name="btn_save_contract" disabled
                                            class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">
                                        حفظ &nbsp; <i class="fa-solid fa-floppy-disk"></i></button>
                                    <button type="reset"
                                            class="btn btn-warning me-sm-3 me-1 waves-effect waves-light">تراجع
                                    </button>

                                    <a href="{{ route('contracts.index') }}" class="btn btn-info me-sm-3 me-1 waves-effect waves-light"   >
                                        العودة الى العقود
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <input type="hidden" id="countUpdate" value="0">
    <input type="hidden" id="aurl" value="{{ $root }}/units/get_center2/">
    <input type="hidden" id="aurl2" value="{{ $root }}/units/get_units/">

@endsection

@section('js')

    <script>



        function generatePayments() {




            const startDateVal = document.getElementById('start_date').value;
            const endDateVal = document.getElementById('end_date').value;
            const yearAmount = parseFloat(document.getElementById('year_amount').value);
            const noOfPayments = parseInt(document.getElementById('no_of_payments').value);
            const no_of_all_payments = parseInt(document.getElementById('no_of_all_payments').value);


            // ================================
// تجهيز تأثير البنود الإضافية
// ================================

            let servicesYear = parseFloat($('#services_amount').val()) || 0;
            let electricityYear = parseFloat($('#electricity_amount').val()) || 0;
            let waterYear = parseFloat($('#water_amount').val()) || 0;

            let servicesMode = $('#services_collect').val();
            let electricityMode = $('#electricity_collect').val();
            let waterMode = $('#water_collect').val();

            let servicesAddTotal = document.getElementById('services_add_total').value ;
            let electricityAddTotal =  document.getElementById('electricity_add_total').value ;
            let waterAddTotal = document.getElementById('water_add_total').value ;



            let insuranceMode = $('#insurance_mode').val();

            let extraPerPayment = 0;
            let extraOnFirstPayment = 0;

            [
                {amount: servicesYear, mode: servicesMode},
                {amount: electricityYear, mode: electricityMode},
                {amount: waterYear, mode: waterMode},
            ].forEach(item => {
                if (item.amount <= 0) return;

                if (item.mode === 'first') {
                    extraOnFirstPayment += parseFloat(item.amount);
                } else if (item.mode==='split'){
                    extraPerPayment += parseFloat(item.amount / noOfPayments);
                }
            });





            let total_amount = parseInt(document.getElementById('total_amount').value);

            let differenceInDays = 0
            if (!startDateVal || !endDateVal || isNaN(yearAmount) || isNaN(noOfPayments)|| isNaN(total_amount)|| isNaN(no_of_all_payments)) {
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

            const servicesAmount = parseFloat(document.getElementById('services_amount').value) || 0;
            const insuranceAmount = parseFloat(document.getElementById('insurance_amount').value) || 0;
            const startPaymentAmount = parseFloat(document.getElementById('start_payment_amount').value) || 0;
            let extraAddTotal  =  0  ;

            console.log(servicesAddTotal , servicesYear ) ;
            if (servicesAddTotal == 1) {
                extraAddTotal += servicesYear * years ;
            }
            console.log(extraAddTotal , years ) ;

            if (electricityAddTotal == 1) {
                extraAddTotal += electricityYear * years ;
            }
            if(waterAddTotal == 1 )
            {
                extraAddTotal += waterYear * years ;
            }

console.log(extraAddTotal , total_amount ) ;
             total_amount +=  extraAddTotal ;
            $('#total_amount').val(total_amount) ;

            const daysBetweenPayments = Math.floor(365 / noOfPayments);
            const singlePaymentAmount = (yearAmount / noOfPayments);
            const dayAmount = (yearAmount / 365);
            const totalAmount = total_amount;

            let sumAmount = 0.00;
            let currentPaymentDate = new Date(start);
            let lastPaymentDate = new Date(start);




            const body = document.getElementById('payments_body');
            body.innerHTML = '';


            let x = 1;
            if (startPaymentAmount > 0) {
                const row = document.createElement('tr');
                // Use local date instead of ISO to avoid timezone shifts
                const y = currentPaymentDate.getFullYear();
                const m = String(currentPaymentDate.getMonth() + 1).padStart(2, '0');
                const d = String(currentPaymentDate.getDate()).padStart(2, '0');
                const dateStr = `${y}-${m}-${d}`;


                row.innerHTML = `
            <td>${x}</td>
            <td>

                     <x-datepicker
                            name_g="payment_dates[]"
                            name_h="payment_datesh[]"
                            start_g="${dateStr}"
                            col="12"
                            label="x"
                        />



            </td>
            <td><input type="text"  name="payment_note[]" class="form-control" value="الدفعة المقدمة (العربون)"></td>
            <td><input type="text" lang="en" name="payment_amounts[]" class="form-control  payment-input "
                       value="${startPaymentAmount}"  oninput="updateTotal()" >
                        <input type="hidden" lang="en" name="payment_for[]" class="form-control "
                       value="5" >

                </td>
<td class="text-center">
    <button type="button"
            class="btn btn-sm btn-danger"
            onclick="removePaymentRow(this)">
        ✖
    </button>
</td>

        `;
                sumAmount +=  parseFloat(startPaymentAmount) ;
                body.appendChild(row);
                x++;
            }

            if (insuranceAmount > 0 && insuranceMode=='payment') {
                const row = document.createElement('tr');
                // Use local date instead of ISO to avoid timezone shifts
                const y = currentPaymentDate.getFullYear();
                const m = String(currentPaymentDate.getMonth() + 1).padStart(2, '0');
                const d = String(currentPaymentDate.getDate()).padStart(2, '0');
                const dateStr = `${y}-${m}-${d}`;


                row.innerHTML = `
            <td>${x}</td>
            <td>

                     <x-datepicker
                            name_g="payment_dates[]"
                            name_h="payment_datesh[]"
                            start_g="${dateStr}"
                            col="12"
                            label="x"
                        />



            </td>
            <td><input type="text"  name="payment_note[]" class="form-control" value="مبلغ التأمين "></td>
            <td><input type="text" lang="en" name="payment_amounts[]" class="form-control payment-insurance"
                       value="${insuranceAmount}" >
                        <input type="hidden" lang="en" name="payment_for[]" class="form-control "
                       value="2" >

                </td>
<td class="text-center">
    <button type="button"
            class="btn btn-sm btn-danger"
            onclick="removePaymentRow(this)">
        ✖
    </button>
</td>

        `;

                body.appendChild(row);
                x++;
            }
            let countPayments = 0  ;
            let yy = Math.floor(no_of_all_payments / noOfPayments) ;
            for (let i = 1; i <= yy; i++) {
                if (servicesAmount > 0 && servicesMode=='payment') {
                    const row = document.createElement('tr');
                    // Use local date instead of ISO to avoid timezone shifts
                    const y = currentPaymentDate.getFullYear();
                    const m = String(currentPaymentDate.getMonth() + 1).padStart(2, '0');
                    const d = String(currentPaymentDate.getDate()).padStart(2, '0');
                    const dateStr = `${y}-${m}-${d}`;


                    row.innerHTML = `
            <td>${x}</td>
            <td>

<x-datepicker
                            name_g="payment_dates[]"
                            name_h="payment_datesh[]"
                            start_g="${dateStr}"
                            col="12"
                            label="x"

                        />

</td>
            <td><input type="text"  name="payment_note[]" class="form-control" value=" قيمة الخدمات    "></td>
            <td><input type="text" lang="en" name="payment_amounts[]" class="form-control payment-services"
                       value="${servicesAmount}" >
<input type="hidden" lang="en" name="payment_for[]" class="form-control "
                       value="3" >

</td>
<td class="text-center">
    <button type="button"
            class="btn btn-sm btn-danger"
            onclick="removePaymentRow(this)">
        ✖
    </button>
</td>

        `;

                    body.appendChild(row);
                    x++;
                }

                if (electricityYear > 0 && electricityMode =='payment') {
                    const row = document.createElement('tr');
                    // Use local date instead of ISO to avoid timezone shifts
                    const y = currentPaymentDate.getFullYear();
                    const m = String(currentPaymentDate.getMonth() + 1).padStart(2, '0');
                    const d = String(currentPaymentDate.getDate()).padStart(2, '0');
                    const dateStr = `${y}-${m}-${d}`;


                    row.innerHTML = `
            <td>${x}</td>
            <td>

<x-datepicker
                            name_g="payment_dates[]"
                            name_h="payment_datesh[]"
                            start_g="${dateStr}"
                            col="12"
                            label="x"

                        />

</td>
            <td><input type="text"  name="payment_note[]" class="form-control" value=" أجرة الكهرباء       "></td>
            <td><input type="text" lang="en" name="payment_amounts[]" class="form-control payment-services"
                       value="${electricityYear}" >
<input type="hidden" lang="en" name="payment_for[]" class="form-control "
                       value="3" >

</td>
<td class="text-center">
    <button type="button"
            class="btn btn-sm btn-danger"
            onclick="removePaymentRow(this)">
        ✖
    </button>
</td>

        `;

                    body.appendChild(row);
                    x++;
                }


                if (waterYear  > 0 && waterMode =='payment') {
                    const row = document.createElement('tr');
                    // Use local date instead of ISO to avoid timezone shifts
                    const y = currentPaymentDate.getFullYear();
                    const m = String(currentPaymentDate.getMonth() + 1).padStart(2, '0');
                    const d = String(currentPaymentDate.getDate()).padStart(2, '0');
                    const dateStr = `${y}-${m}-${d}`;


                    row.innerHTML = `
            <td>${x}</td>
            <td>

<x-datepicker
                            name_g="payment_dates[]"
                            name_h="payment_datesh[]"
                            start_g="${dateStr}"
                            col="12"
                            label="x"

                        />

</td>
            <td><input type="text"  name="payment_note[]" class="form-control" value="  أجرة المياه      "></td>
            <td><input type="text" lang="en" name="payment_amounts[]" class="form-control payment-services"
                       value="${waterYear }" >
<input type="hidden" lang="en" name="payment_for[]" class="form-control "
                       value="3" >

</td>
<td class="text-center">
    <button type="button"
            class="btn btn-sm btn-danger"
            onclick="removePaymentRow(this)">
        ✖
    </button>
</td>

        `;

                    body.appendChild(row);
                    x++;
                }


                let startPaymentDone = 0  ;
                for (let j = 1; j <= noOfPayments && countPayments <= no_of_all_payments ; j++) {
                    if(parseFloat(sumAmount)>= parseFloat(totalAmount) || (parseFloat(sumAmount)+parseFloat(singlePaymentAmount)) > parseFloat(totalAmount))
                        break ;

                    const row = document.createElement('tr');
                    // Use local date instead of ISO to avoid timezone shifts
                    const y = currentPaymentDate.getFullYear();
                    const m = String(currentPaymentDate.getMonth() + 1).padStart(2, '0');
                    const d = String(currentPaymentDate.getDate()).padStart(2, '0');
                    const dateStr = `${y}-${m}-${d}`;

                    let paymentValue = parseFloat(singlePaymentAmount + extraPerPayment);

                    if (j == 1) {
                        paymentValue += parseFloat(extraOnFirstPayment);
                    }
                    // else
                    // {
                    //     paymentValue += parseFloat(extraPerPayment);
                    // }

                    if (i==1 && startPaymentAmount > 0 && startPaymentDone == 0  )
                    {
                        paymentValue = parseFloat(singlePaymentAmount) - parseFloat(startPaymentAmount) ;
                        startPaymentDone = 1 ;
                    }

                    row.innerHTML = `
            <td>${x}</td>
            <td>

<x-datepicker
                            name_g="payment_dates[]"
                            name_h="payment_datesh[]"
                            start_g="${dateStr}"
                            col="12"
label="x"
                        />
</td>
            <td><input type="text"  name="payment_note[]" class="form-control" value=" دفعة ايجار       "></td>
            <td><input type="text" lang="en" name="payment_amounts[]" class="form-control payment-input"
                       value="${paymentValue}" oninput="updateTotal()">
 <input type="hidden" lang="en" name="payment_for[]" class="form-control "
                       value="1" >
</td>
<td class="text-center">
    <button type="button"
            class="btn btn-sm btn-danger"
            onclick="removePaymentRow(this)">
        ✖
    </button>
</td>

        `;
                    sumAmount += parseFloat(paymentValue);
                    paymentValue = singlePaymentAmount ;
                    body.appendChild(row);

                    currentPaymentDate.setDate(currentPaymentDate.getDate() + daysBetweenPayments);
                    countPayments++ ;
                    x++;

                }


            }
           // console.log(parseFloat(sumAmount) ,parseFloat(totalAmount) );
            if(parseFloat(sumAmount) < parseFloat(totalAmount))
            {
                let lastValue = parseFloat(totalAmount) - parseFloat(sumAmount)  ;
                const row = document.createElement('tr');
                // Use local date instead of ISO to avoid timezone shifts
                const y = currentPaymentDate.getFullYear();
                const m = String(currentPaymentDate.getMonth() + 1).padStart(2, '0');
                const d = String(currentPaymentDate.getDate()).padStart(2, '0');
                const dateStr = `${y}-${m}-${d}`;

                let paymentValue = lastValue ;



                row.innerHTML = `
            <td>${x}</td>
            <td>

<x-datepicker
                            name_g="payment_dates[]"
                            name_h="payment_datesh[]"
                            start_g="${dateStr}"
                            col="12"
label="x"
                        />
</td>
            <td><input type="text"  name="payment_note[]" class="form-control" value=" دفعة ايجار       "></td>
            <td><input type="text" lang="en" name="payment_amounts[]" class="form-control payment-input"
                       value="${paymentValue}" oninput="updateTotal()">
 <input type="hidden" lang="en" name="payment_for[]" class="form-control "
                       value="1" >
</td>
<td class="text-center">
    <button type="button"
            class="btn btn-sm btn-danger"
            onclick="removePaymentRow(this)">
        ✖
    </button>
</td>

        `;
                sumAmount += parseFloat(paymentValue);

                body.appendChild(row);

                currentPaymentDate.setDate(currentPaymentDate.getDate() + daysBetweenPayments);
                countPayments++ ;
                x++;
            }

            document.getElementById('payments_table_container').style.display = 'block';
            $('#payments_body .calendar-switch-hijri').on('change', function () {
            });

            const safeAmount = parseFloat(totalAmount) || 0;
            const formattedAmount = safeAmount;

            $('#span_total_amount').html(formattedAmount);
            $('#total_amount_input').val(formattedAmount);

            updateTotal();

        }


        function removePaymentRow(btn) {
            const row = btn.closest('tr');
            if (!row) return;

            row.remove();
            updateTotal(); // تحديث الإجمالي بعد الحذف
        }

        function addEmptyPaymentRow() {
            const body = document.getElementById('payments_body');
            const x = body.children.length + 1;

            const today = new Date();
            const y = today.getFullYear();
            const m = String(today.getMonth() + 1).padStart(2, '0');
            const d = String(today.getDate()).padStart(2, '0');
            const dateStr = `${y}-${m}-${d}`;

            const row = document.createElement('tr');

            row.innerHTML = `
        <td>${x}</td>

        <td>
            <x-datepicker
                name_g="payment_dates[]"
                name_h="payment_datesh[]"
                start_g="${dateStr}"
                col="12"
                label="x"
            />
        </td>

        <td>
            <input type="text"
                   name="payment_note[]"
                   class="form-control"
                   placeholder="وصف الدفعة">
        </td>

        <td>
            <input type="text"
                   lang="en"
                   name="payment_amounts[]"
                   class="form-control payment-input"
                   value=""
                   oninput="updateTotal()">

            <input type="hidden"
                   name="payment_for[]"
                   value="1">
        </td>

        <td class="text-center">
            <button type="button"
                    class="btn btn-sm btn-danger"
                    onclick="removePaymentRow(this)">
                ✖
            </button>
        </td>
    `;

            body.appendChild(row);
        }






        function updateTotal() {
            let total = 0;
            const inputs = document.querySelectorAll('.payment-input');

            inputs.forEach(input => {
                total += parseFloat(input.value) || 0;
            });

            // Format the total once
            const formattedTotal = total;

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


        {{--function checkIfRecordedBefor(e_no) {--}}

        {{--    const input = document.getElementById('e_no');--}}
        {{--    const trimmed = (e_no || '').trim();--}}

        {{--    if (!trimmed) {--}}
        {{--        input.value = '';--}}
        {{--        return;--}}
        {{--    }--}}

        {{--    const urlTemplate = "{{ route('contracts.check_e_no', ['e_no' => ':e_no']) }}";--}}
        {{--    const requestUrl = urlTemplate.replace(':e_no', encodeURIComponent(trimmed));--}}


        {{--    input.dataset.loading = '1';--}}
        {{--    input.classList.add('is-loading');--}}

        {{--    $.ajax({--}}
        {{--        url: requestUrl,--}}
        {{--        method: 'GET',--}}
        {{--        dataType: 'json',--}}
        {{--        cache: false,--}}
        {{--    }).done(function (response) {--}}

        {{--        if (response) {--}}
        {{--            Swal.fire({--}}
        {{--                icon: 'error',--}}
        {{--                title: 'خطأ في رقم العقد',--}}
        {{--                text: 'هذا الرقم مسجل من قبل ',--}}
        {{--            });--}}
        {{--            input.value = '';--}}
        {{--            input.focus();--}}

        {{--        }--}}
        {{--    }).fail(function () {--}}
        {{--        Swal.fire({--}}
        {{--            icon: 'error',--}}
        {{--            title: 'خطأ في الاتصال',--}}
        {{--            text: 'تعذر التحقق من رقم العقد. حاول مجدداً.',--}}
        {{--        });--}}
        {{--        input.focus();--}}
        {{--    }).always(function () {--}}

        {{--    });--}}
        {{--}--}}
    </script>
@endsection
