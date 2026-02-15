@extends('layouts.app')

@section('content')
    <style>
        .form-select {
            border-radius: .5rem;
        }

        .flash-red {
            animation: pulseRed 1.5s infinite;
        }

        @keyframes pulseRed {
            0% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
            }
            70% {
                box-shadow: 0 0 0 8px rgba(220, 53, 69, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
            }
        }

    </style>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة العقود </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('contracts.create') }}"><i
                        class="fa fa-plus"></i>&nbsp;
                    اضافة عقد جديد</a>
            </div>
        </div>
    </div>

    @session('success')
    <div class="alert alert-success" role="alert">
        {{ $value }}
    </div>
    @endsession

    <div class="card">
        <div class="card-datatable table-responsive pt-0">

            <div class="d-flex justify-content-end mb-3">
                <form method="GET" class="d-flex gap-2 align-items-center">
                    <i class="fa-solid fa-sliders text-muted"></i>

                    <select name="period_filter"
                            class="form-select form-select-sm border-0 shadow-sm bg-light"
                            style="width:220px"
                            onchange="this.form.submit()">
                        <option value="">جميع العقود</option>
                        <option value="lt1" {{ request('period_filter')=='lt1'?'selected':'' }}>أقل من سنة</option>
                        <option value="1y" {{ request('period_filter')=='1y'?'selected':'' }}>سنة</option>
                        <option value="1to2" {{ request('period_filter')=='1to2'?'selected':'' }}>أكثر من سنة وأقل من
                            سنتين
                        </option>
                        <option value="2y" {{ request('period_filter')=='2y'?'selected':'' }}>سنتين</option>
                        <option value="gt2" {{ request('period_filter')=='gt2'?'selected':'' }}>أكثر من سنتين</option>
                    </select>
                </form>
            </div>

            <div class="card-datatable table-responsive pt-0">
                <table class="table table-striped  display responsive nowrap FathyTable ">
                    <thead>
                    <tr>
                        <th class="  ">#</th>
                        <th> رقم العقد</th>
                        <th> المستأجر</th>
                        <th> بداية العقد</th>
                        <th> نهاية العقد</th>
                        <th> مدة العقد</th>
                        <th> الايجار السنوي</th>
                        <th> القيمة الاجمالية</th>
                        <th> عدد الدفعات</th>
                        <th> التأمين</th>
                        <th> الخدمات</th>
                        <th class="no-print">اجراءات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($contracts as $key => $row)
                        <tr id="contract{{$row->id}}">
                            <td>{{ ++$i }}</td>
                            <td> @if(is_numeric(trim($row->e_no)))
                                    {{ $row->e_no }}
                                @else
                                    <span class="badge bg-danger flash-red">
            <i class="fa-solid fa-triangle-exclamation me-1"></i>
            لا يوجد عقد
        </span>
                                @endif</td>
                            <td>{{ $row->renter->name }}</td>
                            <td>{{ $row->start_date }} م - {{ $row->start_dateh }} هـ</td>
                            <td>{{ $row->end_date }} م - {{ $row->end_dateh }} هـ</td>
                            <td> <?php
                                     $period = $row->contractPeriod();
                                     echo " {$period['years']} سنة , {$period['months']} شهر,  {$period['days']} يوم";

                                     ?></td>
                            <td>{{ number_format($row->year_amount, 2) }}

                                <span style="font-size: 23px;"
                                      class="icon-saudi_riyal_new"></span>
                            </td>
                            <td>
                                    <?php $total = $row->year_amount * $row->period_year + ($row->year_amount / 12) * $row->period_month + ($row->year_amount / 365) * $row->period_day;
                                    ?>
                                {{ number_format($row->getSumPayments()['allYearPayment'] , 2) }}

                                <span style="font-size: 23px;"
                                      class="icon-saudi_riyal_new"></span>
                            </td>

                            <td>{{ $row->no_of_payments }}</td>
                            <td>{{ number_format($row->insurance_amount, 2) }}

                                <span style="font-size: 23px;"
                                      class="icon-saudi_riyal_new"></span>
                            </td>

                            <td>{{ number_format($row->services_amount, 2) }}

                                <span style="font-size: 23px;"
                                      class="icon-saudi_riyal_new"></span>
                            </td>
                            <td class="no-print">


                                <a href="{{ route('contracts.edit', $row->id) }}" class="btn btn-sm btn-primary"><i
                                        class="fa-regular fa-pen-to-square pe-2"></i> التفاصيل</a>

                                <a href="javascript:void(0)"
                                   onclick="fn_delete_object({{ $row->id }}, 'contract', 'contract{{ $row->id }}')"
                                   class="btn btn-sm btn-danger delete-record">
                                    <i class="fa-solid fa-trash-can pe-2"></i> حذف
                                </a>


                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr>
                        <th class="  ">#</th>
                        <th> رقم العقد</th>
                        <th> المستأجر</th>
                        <th> بداية العقد</th>
                        <th> نهاية العقد</th>
                        <th> المدة باليوم</th>
                        <th> الايجار السنوي</th>
                        <th> القيمة الاجمالية</th>
                        <th> عدد الدفعات</th>
                        <th> التأمين</th>
                        <th> الخدمات</th>
                        <th class="no-print">اجراءات</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>


        @endsection

        @section('js')
            <script>

                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {

                        let filter = $('#contractPeriodFilter').val();
                        if (filter === 'all') return true;

                        // عمود مدة العقد (index = 5)
                        let periodText = data[5];

                        // استخراج القيم من النص العربي
                        let years = parseInt(periodText.match(/(\d+)\s*سنة/)?.[1] ?? 0);
                        let months = parseInt(periodText.match(/(\d+)\s*شهر/)?.[1] ?? 0);
                        let days = parseInt(periodText.match(/(\d+)\s*يوم/)?.[1] ?? 0);

                        // تحويل المدة إلى أشهر (تقريب عملي)
                        let totalMonths = (years * 12) + months + (days / 30);

                        switch (filter) {
                            case 'lt1':
                                return totalMonths < 12;

                            case '1y':
                                return totalMonths >= 12 && totalMonths < 13;

                            case '1to2':
                                return totalMonths > 12 && totalMonths < 24;

                            case '2y':
                                return totalMonths >= 24 && totalMonths < 25;

                            case 'gt2':
                                return totalMonths >= 24;
                        }

                        return true;
                    }
                );
                $('#contractPeriodFilter').on('change', function () {
                    $('.FathyTable').DataTable().draw();
                });

            </script>
@endsection
