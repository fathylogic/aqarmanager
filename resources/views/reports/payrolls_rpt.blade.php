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
                <h2>تقرير رواتب الموظفين</h2>
            </div>
            <div class="card  mb-3">

                <div class="card-body">

                    <form method="POST" target="_blank" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">

                                <label class="form-label"><strong>
                                    نوع التقرير
                                    </strong>
                                </label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="report_type"
                                               id="report_type_year" value="year" checked>
                                        <label class="form-check-label" for="report_type_year">
                                            تقرير السنة كاملة
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="report_type"
                                               id="report_type_month" value="month">
                                        <label class="form-check-label" for="report_type_month">
                                            تقرير شهر محدد
                                        </label>
                                    </div>
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
                                           value="<?= date('Y') ?>">
                                    <input type="hidden" class="year-hidden"
                                           id="year"
                                           name="year"
                                           value="<?= date('Y') ?>">
                                    <button type="button"
                                            class="btn btn-outline-secondary year-open-btn">
                                        <i class="fas fa-calendar-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4" id="month_selection" style="display: none;">
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

                            <div class="col-md-12">
                                <label class="form-label">الموظفين</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="employee_filter"
                                               id="employee_filter_all" value="all" checked>
                                        <label class="form-check-label" for="employee_filter_all">
                                            جميع الموظفين
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="employee_filter"
                                               id="employee_filter_specific" value="specific">
                                        <label class="form-check-label" for="employee_filter_specific">
                                            موظف محدد
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" id="employee_selection" style="display: none;">
                                <label class="form-label">اختر الموظف</label>
                                <select class="form-select" name="emp_id" id="emp_id">
                                    <option value="">-- اختر الموظف --</option>
                                    @foreach($emps as $emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                            <button type="submit" name="btn_rpt"
                                        class="btn btn-primary "><i class="fa-solid fa-floppy-disk fa-lg pe-2"></i>  عرض التقرير
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

                    @endif


                </div>

            </div>
        </div>
    </div>




@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle month selection based on report type
        const reportTypeRadios = document.querySelectorAll('input[name="report_type"]');
        const monthSelection = document.getElementById('month_selection');

        reportTypeRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === 'month') {
                    monthSelection.style.display = 'block';
                } else {
                    monthSelection.style.display = 'none';
                }
            });
        });

        // Toggle employee selection based on employee filter
        const employeeFilterRadios = document.querySelectorAll('input[name="employee_filter"]');
        const employeeSelection = document.getElementById('employee_selection');

        employeeFilterRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value === 'specific') {
                    employeeSelection.style.display = 'block';
                } else {
                    employeeSelection.style.display = 'none';
                }
            });
        });
    });
</script>


