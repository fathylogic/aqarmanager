@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة المصروفات</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('sarfs.create') }}"><i class="fa fa-plus"></i>&nbsp;
                    اضافة صرف جديد</a>
            </div>
        </div>
    </div>

    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession



    <div class="card mb-3">

        <hr class="my-1" />
        @if (!empty($sarfs))
            <div class="card-datatable table-responsive pt-0">
                <table class="table table-striped  display responsive nowrap FathyTable ">
                    <thead>
                        <tr>

                            <th> من </th>
                            <th>وجه الصرف </th>
                            <th> المستلم </th>
                            <th> المبلغ </th>
                            <th> البيان </th>
                            <th> التاريخ </th>
                            <th class="no-print"> صورة </th>
                            <th class="no-print">اجراءات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($sarfs as $key => $row)
                            <tr id="sarf{{$row->id}}">

                                <td>{{ $row->sourceType->name }}
                                    @if ($row->from_ohda_id != '')
                                        ({{ $row->fromOhda->employee->name }})
                                    @endif

                                </td>
                                <td>{{ $row->sarfType->name }}


                                    @if ($row->to_ohda_id != '')
                                        ({{ $row->toOhda->employee->name }})
                                    @elseif ($row->pay_role_id != '')
                                        ({{ $row->payrool->employee->name }})
                                    @elseif ($row->recipient_id != '')
                                        ({{ $row->recipient->name }})
                                    @elseif ($row->service_type_id != '')
                                        ({{ $row->serviceType->name }})
                                    @endif


                                </td>
                                <td>{{ $row->receved_by }}</td>
                                <td>{{ $row->amount }}
                                    - ({{ $row->paymentType->name }})

                                </td>
                                <td>

                                    {{ $row->s_desc }}
                                </td>
                                <td>

                                    {{ $row->p_date }} - {{ $row->p_dateh }}

                                </td>

                                <td class="no-print">
                                    @if($row->img!='')
                                    <a href="#exampleModal{{ $row->id }}" data-bs-toggle="modal"
                                       data-bs-target="#exampleModal{{ $row->id }}">
                                        <i class="fa fa-eye " aria-hidden="true"></i>
                                    </a>
                                    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="exampleModal{{ $row->id }}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"> صورة </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img class="d-block" src="<?= asset('storage/' . $row->img) ?>"
                                                         width="100%">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">اغلاق</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>

                                <td>


@if($row->sarf_type_id == 4 )
                                        <a href="{{ route('sarfs.edit', $row->id) }}"
                                           class="btn btn-sm btn-primary"><i
                                                class="fa-regular fa-pen-to-square pe-2"></i> تعديل</a>
                                    @endif


                                    <a href="{{ route('sarfs.show',$row->id) }}" class="btn btn-sm btn-warning"><i
                                                        class="fa-solid fa-circle-info pe-2"></i>
                                                     التفاصيل</a>
                                    <a href="{{ route('sarfs.print',$row->id) }}"   target="_blank"
                                         class="btn btn-sm btn-secondary" alt="طباعة" alt="طباعة">
                                        <i class="fa-solid fa-print pe-2"></i>طباعة
                                    </a>
                                    <a href="javascript:void(0)"
                                       onclick="fn_delete_object({{ $row->id }}, 'sarf', 'sarf{{ $row->id }}')"
                                       class="btn btn-sm btn-danger delete-record">
                                        <i class="fa-solid fa-trash-can pe-2"></i> حذف
                                    </a>



                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th> من </th>
                            <th>وجه الصرف </th>
                            <th> المستلم </th>
                            <th> المبلغ </th>
                            <th> البيان </th>
                            <th> التاريخ </th>
                            <th class="no-print"> صورة </th>
                            <th class="no-print">اجراءات</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @else
            لا يوجد
        @endif





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






        function fn_delete_center(id) {
            Swal.fire({
                title: "هل انت متأكد من انك تريد الحذف ?",
                text: "لا يمكنك استرجاعها مرة أخرى!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "إلغاء",
                confirmButtonText: "نعم,  احذف!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "./payments/destroy/" + id
                }
            });
        }





    </script>





@endsection
