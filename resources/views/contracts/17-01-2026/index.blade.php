@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة العقود </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('contracts.create') }}"><i class="fa fa-plus"></i>&nbsp;
                    اضافة عقد  جديد</a>
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
            <table class="table table-striped  display responsive nowrap FathyTable ">
                <thead>
                <tr>
                    <th class="  ">#</th>
                    <th> رقم العقد</th>
                    <th> المستأجر</th>
                    <th> بداية العقد</th>
                    <th> نهاية العقد</th>
                    <th>   مدة العقد</th>
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
                        <td>{{ $row->e_no }}</td>
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

    <script>

    </script>



@endsection
