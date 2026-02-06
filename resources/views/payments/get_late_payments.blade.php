@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>الدفعات المتأخرة أو باقي عليها اقل من 7 أيام </h2>
            </div>

        </div>
    </div>

    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession


    <div class="card mb-3">


        <div class="card-body">
            @if (!empty($payments_un_payed))
                <div class="card-datatable table-responsive pt-0">
                    <table class="table table-striped  display responsive nowrap FathyTable ">
                        <thead>
                        <tr>

                            <th>الدفعة</th>
                            <th>المستأجر</th>
                            <th>المركز الرئيسي</th>
                            <th>العمارة</th>
                            <th>رقم الوحدة</th>
                            <th>الجوال</th>
                            <th>موعد الدفع</th>
                            <th>الفترة المتبقية</th>
                            <th>المبلغ</th>
                            <th class="no-print">اجراءات</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($payments_un_payed as $key => $row)
                                <?php $days = dateDiff(today(), $row->p_date);
                                if ($days <= 0) {
                                    $class = 'table-danger';
                                } elseif ($days <= 7) {
                                    $class = 'table-warning';
                                } else {
                                    $class = '';
                                }

                                ?>
                            <tr >
                                <td>
                                    @if ($row->payment_no == 0)
                                        {{ $row->notes }} @else{{ $row->payment_no }}
                                    @endif
                                </td>
                                <td>{{ @$row->contract->renter->name }}</td>

                                <td>{{ @$row->maincenter->name }}</td>
                                <td>{{ @$row->center->center_name }}</td>
                                <td>{{ @$row->unit->unit_no }}</td>
                                <td>{{ @$row->contract->renter->mobile_no }}</td>
                                <td>

                                    {{ $row->p_date }} م - {{ $row->p_dateh }} هـ</td>
                                <td>{{ formatPaymentDiff($row->p_date) }}
                                </td>
                                <td>{{ $row->amount }} </td>



                                <td>




                                    <a href="#" onclick="fn_payement({{ $row }})"
                                       class="btn btn-sm btn-warning" alt="الدفع" alt="الدفع">
                                        <i class="fas fa-sack-dollar"></i>
                                    </a>

                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                        <tfoot>
                        <tr>

                            <th>الدفعة</th>
                            <th>المستأجر</th>
                            <th>المركز الرئيسي</th>
                            <th>العمارة</th>
                            <th>رقم الوحدة</th>
                            <th>الجوال</th>
                            <th>موعد الدفع</th>
                            <th>الفترة المتبقية</th>
                            <th>المبلغ</th>

                            <th class="no-print">اجراءات</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                لا يوجد
            @endif

        </div>


    </div>


    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="payment_id" id="payment_id">
                <input type="hidden" name="true_amount" id="true_amount">
                <input type="hidden" name="emp_name" id="emp_name">
                <input type="hidden" name="maincenter_id" value="">
                <input type="hidden" name="unit_id" value="">
                <input type="hidden" name="center_id" value="">

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
                                        @if($row->id == 5 ) {{'selected'}}@endif
                                        >{{ $row->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="notes"> ملاحظات </label>
                                <input type="text" id="payment_notes" name="notes" class="form-control"/>
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


        function fn_payement(row) {


            $('#renter_name').val(row['contract']['renter']['name']);
            $('#amount').val(row['maincenter_id']);
            $('#center_id').val(row['center_id']);
            $('#unit_id').val(row['unit_id']);
            $('#amount').val(row['amount']);
            $('#true_amount').val(row['amount']);
            $('#payment_notes').val(row['notes']);
            $('#payment_id').val(row['id']);
            $('#paymentModal').modal('show');




        }





    </script>




    <p class="text-unit text-primary"><small> </small></p>
@endsection
