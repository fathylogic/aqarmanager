@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة المستأجرين</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('renters.create') }}"><i class="fa fa-plus"></i>&nbsp;
                    اضافة مستأجر جديد</a>
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
                        <th>#</th>
                        <th> الاسم</th>
                        <th>رقم الهوية </th>
                        <th> الجوال </th>
                        <th> الجنسية </th>
                        <th> الوحدة </th>
                        <th class="no-print"> صورة الهوية </th>
                        <th class="no-print">اجراءات</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $key => $renter)
                        <tr id="renter{{$renter->id}}">
                            <td>{{ ++$i }}</td>
                            <td>{{ $renter->name }}</td>
                            <td>{{ $renter->id_no }}</td>

                            <td>{{ $renter->mobile_no }}</td>
                            <td>{{ $renter->nat->name }}</td>
                            <td>{{ @$renter->contracts[0]->unit->unitType->name }} - {{ @$renter->contracts[0]->center->center_name }}</td>
                            <td class="no-print">
                                <a href="#exampleModal{{ $renter->id }}" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $renter->id }}">
                                    <i class="fa-solid fa-address-card fa-2xl"></i>
                                </a>
                                <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="exampleModal{{ $renter->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"> صورة الهوية</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img class="d-block" src="<?= asset('storage/' . $renter->img) ?>"
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


                                <a href="{{ route('renters.show', $renter->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-circle-info pe-2"></i> فتح
                                </a>
                                <a href="{{ route('renters.edit', $renter->id) }}" class="btn btn-sm btn-primary"><i
                                        class="fa-regular fa-pen-to-square pe-2"></i> تعديل</a>

                                <a href="javascript:void(0)"
                                   onclick="fn_delete_object({{ $renter->id }}, 'renter', 'renter{{ $renter->id }}')"
                                   class="btn btn-sm btn-danger delete-record">
                                    <i class="fa-solid fa-trash-can pe-2"></i> حذف
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th>#</th>
                        <th> الاسم</th>
                        <th>رقم الهوية </th>
                        <th> الجوال </th>
                        <th> الجنسية </th>
                         <th> الوحدة </th>
                        <th class="no-print"> صورة الهوية </th>
                        <th class="no-print">اجراءات</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <script>
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
                    window.location.href = "./renters/destroy/" + id
                }
            });
        }
    </script>




@endsection
