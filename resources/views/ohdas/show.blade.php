@extends('layouts.app')

@section('content')





    <div class="row">
        <div class="col">
            <div class="card  mb-3">

                <div class="card-body">

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
                                                <div class="pull-right">
                                                    <a class="btn btn-primary me-sm-3 me-1" href="{{ route('sarfs.create', ['ohda_id' => $ohda->id]) }}"><i class="fa fa-plus"></i>&nbsp;
                                                        اضافة صرف جديد</a>
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
                                                    {{--                                                    <li class="nav-item">--}}
                                                    {{--                                                        <button class="nav-link " data-bs-toggle="tab"--}}
                                                    {{--                                                                data-bs-target="#form-tabs-ohda_sarf{{ $ohda->id }}"--}}
                                                    {{--                                                                role="tab" aria-selected="true">--}}
                                                    {{--                                                            صرف أموال--}}
                                                    {{--                                                        </button>--}}
                                                    {{--                                                    </li>--}}


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
                                                                        <?php

                                                                        $ser = '(' . str_pad(@$op->sarf->sereal, 4, '0', STR_PAD_LEFT) . ')' . @$op->sarf->year_m . '-' . @$op->sarf->year_h;
                                                                        $date = @$op->sarf->p_dateh . 'هـ' . @$op->sarf->p_date;

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

                                                                                <a href="javascript:void(0);"
                                                                                   onclick="fn_delete_object({{ $op->id }}, 'operation', 'operation{{ $op->id }}')"
                                                                                   class="btn btn-sm btn-danger delete-record">
                                                                                    <i class="fa-solid fa-trash-can pe-2"></i>
                                                                                    حذف
                                                                                </a>

                                                                                @if(@$op->sarf->sarf_type_id == 4 )
                                                                                <a href="{{ route('sarfs.edit', $op->sarf_id) }}"
                                                                                   class="btn btn-sm btn-primary"><i
                                                                                        class="fa-regular fa-pen-to-square pe-2"></i>
                                                                                    تعديل</a>
                                                                                @endif
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
                                                    @include('ohdas.add_to_ohda')
                                                </div>

                                                {{--                                                <div class="tab-pane fade  "--}}
                                                {{--                                                     id="form-tabs-ohda_sarf{{ $ohda->id }}"--}}
                                                {{--                                                     role="tabpanel">--}}

                                                {{--                                                    @include('maincenters.create_sarf')--}}

                                                {{--                                                </div>--}}


                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>


                        </div>
                    </div>


                </div>
            </div>


        </div>
    </div>


@endsection
