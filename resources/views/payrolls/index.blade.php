@extends('layouts.app')

@section('content')
    <style>
        .table-responsive {
            overflow-x: auto;
        }
        .table th,
        .table td {
            white-space: nowrap;
            vertical-align: middle;
        }
        .table {
            table-layout: auto !important;
            width: max-content;
            min-width: 100%;
        }
        .table td .form-control {
            min-width: 90px;
            width: auto;
            display: inline-block;
        }
        .table td input[type="text"] {
            min-width: 90px;
        }
        .table td .btn {
            white-space: nowrap;
        }

        </style>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة رواتب الموظفين</h2>
            </div>
            <div class="card  mb-3">
                <div class="card-header bg-lightest border-1 border"><strong>مسير الرواتب   </strong>
                </div>
                <div class="card-body">

 <form method="POST" action="" enctype="multipart/form-data">
        @csrf
                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">الشهر</label>
                            <div class="input-group month-input">
                                <input type="text" class="form-control month-display"
                                       placeholder="اختر الشهر"
                                       readonly
                                       value="<?= date('m') ?>">
                                <input type="hidden" class="month-hidden"
                                       id="month"
                                       name="month"
                                       value="<?= date('m') ?>">
                                <button type="button"
                                        class="btn btn-outline-secondary month-open-btn">
                                    <i class="fas fa-calendar"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">السنة</label>
                            <div class="input-group year-input"
                                 data-min-year="2025"
                                 data-max-year="<?= date('Y') ?>">
                                <input type="text" class="form-control year-display"
                                       placeholder="اختر السنة"
                                       readonly
                                       value="<?= date('Y') ?>" >
                                <input type="hidden" class="year-hidden"
                                       id="year"
                                       name="year"
                                       value="<?= date('Y') ?>" >
                                <button type="button"
                                        class="btn btn-outline-secondary year-open-btn">
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <br>
                            <button type="submit" name="btn_add_payroll"
                                    class="btn btn-primary "><i class="fa-solid fa-floppy-disk fa-lg pe-2"></i>  عرض المسير
                            </button>
                            <button type="reset"
                                    class="btn btn-secondary me-sm-3 me-1 waves-effect waves-light"><i class="fa-solid fa-broom fa-lg pe-2"></i>
                                أفرغ الحقول
                            </button>
                        </div>

                    </div>
 </form>

                </div>

                <div class="row g-3">
                    @if(!empty($result))
                        <div class="col-12">
                            <form method="POST" action="{{ route('payrolls.store') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="salary_year_month" value="{{ $salary_year_month }}">
                                <h2>مسير رواتب شهر:
                                {{$salary_year_month}}
                                </h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered  responsive nowrap table-striped">
                                        <thead>
                                        <tr>
                                            <th>اسم الموظف</th>
                                            <th>الراتب الأساسي</th>

                                            <th> خصم بدل الاجازة</th>
                                            <th>سبب الحسم</th>
                                            <th>صافي الراتب</th>
                                            <th>الحالة</th>
                                            <th>تاريخ الصرف</th>


                                            <th class="no-print" >الإجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($result as $index => $employee)
                                            @php

                                                $deductions = $employee->deductions ?? 0;
                                                $netSalary = $employee->net_salary ?? ($employee->salary  - $deductions);
                                            @endphp
                                            <tr id="payroll{{$index}}" >
                                                <td>{{ $employee->name }}</td>
                                                <td>
                                                    <input type="text" name="employees[{{ $index }}][basic_salary]"
                                                           class="form-control  " style="width:90px!important; min-width: 90px!important;" value="{{ $employee->salary }}"
                                                           readonly>
                                                    <input type="hidden" name="employees[{{ $index }}][payrolle_id]"
                                                           value="{{ $employee->payrolle_id }}">
                                                    <input type="hidden" name="employees[{{ $index }}][emp_id]"
                                                           value="{{ $employee->emp_id }}">
                                                </td>



                                                <td>
                                                    <input type="text" style="width:90px!important; min-width: 90px!important;" autocomplete="off" readonly
                                                            name="employees[{{ $index }}][deductions]"
                                                           class="form-control deduction-input"
                                                           value="{{ $deductions }}" data-index="{{ $index }}">
                                                </td>
                                                <td>
                                                    <input type="text"
                                                           name="employees[{{ $index }}][deductions_purpose]"
                                                           class="form-control" style="width:90px!important; min-width: 90px!important;"
                                                           value="{{ $employee->deductions_purpose ?? '' }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="employees[{{ $index }}][net_salary]"
                                                           class="form-control net-salary"
                                                           value="{{ $netSalary }}" style="width:90px!important; min-width: 90px!important; "
                                                           data-salary="{{ $employee->salary }}"
                                                           data-index="{{ $index }}" readonly>
                                                </td>
                                                <td>
                                                    @if(empty($employee->payment_status) || $employee->payment_status == 0)
                                                        <span class="badge bg-warning">لم يتم الصرف</span>
                                                    @else
                                                        <span class="badge bg-success">تم الصرف</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $employee->p_date }}


                                                    </td>

                                                <td class="no-print" >
                                                    @if($employee->sarf_id>0)
                                                    <a href="{{ route('sarfs.show', $employee->sarf_id) }}"
                                                       target="_blank"
                                                       class="btn btn-sm btn-warning">
                                                        <i
                                                            class="fa-solid fa-circle-info pe-2"></i>
                                                        فتح
                                                    </a>
                                                    @endif
@if($employee->payrolle_id > 0 )
                                                    <a href="javascript:void(0)"
                                                       onclick="fn_delete_object({{ $employee->payrolle_id }}, 'payroll', 'payroll{{$index}}')"
                                                       class="btn btn-sm btn-danger delete-record">
                                                        <i class="fa-solid fa-trash-can pe-2"></i>
                                                        حذف
                                                    </a>
                                                    @endif


                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row p-3">
                                <div class="col-md-3">
                                    <label class="form-label" for="payment_type"> طريقة الدفع </label>

                                    <select id="payment_type" required name="payment_type" class="select2 form-select"
                                            data-allow-clear="true">
                                        <option value="">اختر</option>
                                        @foreach ($payment_types as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>
                                    <x-datepicker
                                        name_g="p_date"
                                        name_h="p_dateh"
                                        start_g="{{date('Y/m/d')}}"
                                        col="3"
                                        label="تاريخ الصرف"
                                    />

                                <div class="col-md-6">
                                    <label class="form-label" for="payment_type"> الصرف من العهدة </label>

                                    <select id="from_ohda_id" name="from_ohda_id" required class="select2 form-select w-100 ohdafrom"
                                            data-allow-clear="true">
                                        <option value="">اختر</option>
                                        @foreach ($ohdas as $row)
                                            <option value="{{ $row->id }}">{{ @$row->employee->name }}
                                                ({{ $row->purpose }})
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                </div>
                                <div class="mt-3 p-4">
                                    <button type="submit" name="btn_save_payrolls" class="btn btn-success">
                                        <i class="fa-solid fa-floppy-disk fa-lg pe-2"></i>حفظ المسير
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif


                </div>

            </div>
        </div>
    </div>




@endsection


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.allowance-input').forEach(function (input) {

                input.addEventListener('input', function () {

                    const index = this.dataset.index;

                    const netSalaryInput = document.querySelector(
                        '.net-salary[data-index="' + index + '"]'
                    );

                    if (!netSalaryInput) return;

                    const baseSalary = parseFloat(netSalaryInput.dataset.salary) || 0;
                    const allowance  = parseFloat(this.value) || 0;

                    const deductionInput = document.querySelector(
                        '.deduction-input[data-index="' + index + '"]'
                    );

                    const deduction = parseFloat(deductionInput?.value) || 0;

                    netSalaryInput.value = (baseSalary + allowance - deduction).toFixed(2);
                });

            });

        });
    </script>


