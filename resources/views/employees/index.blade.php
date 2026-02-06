@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة الموظفين</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('employees.create') }}"><i class="fa fa-plus"></i>&nbsp;
                    اضافة موظف جديد</a>
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
                        <th> نوع الموظف </th>
                        <th> حالة الموظف </th>
                        <th> المركز الرئيسي </th>
                        <th> العمارة </th>
                       <th class="no-print"> صورة الهوية </th>
                        <th class="no-print">اجراءات</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $key => $employee)
                        <tr id="employee{{$employee->id}}">
                            <td>{{ ++$i }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->id_no }}</td>

                            <td>{{ $employee->mobile_no }}</td>
                            <td>{{ @$employee->nat->name }}</td>
                            <td>{{ @$employee->employeeType->name }}</td>
                            <td>{{ @$employee->employeeStatus->name }}</td>
                            <td>{{ @$employee->maincenter->name }}</td>
                            <td>{{ @$employee->center->center_name }}</td>
                            <td class="no-print">
                                <a href="#exampleModal{{ $employee->id }}" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $employee->id }}">
                                     <i class="fa-solid fa-address-card fa-2xl"></i>
                                </a>
                                <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="exampleModal{{ $employee->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"> صورة الهوية</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img class="d-block" src="<?= asset('storage/' . $employee->img) ?>"
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


                                <a href="{{ route('employees.show', $employee->id) }}"class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-circle-info pe-2"></i> فتح
                                </a>
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-primary"><i
                                        class="fa-regular fa-pen-to-square pe-2"></i> تعديل</a></li>
                                <a href="javascript:void(0)"
                                   onclick="fn_delete_object({{ $employee->id }}, 'employee', 'employee{{ $employee->id }}')"
                                   class="btn btn-sm btn-danger delete-record">
                                    <i class="fa-solid fa-trash-can pe-2"></i> حذف
                                </a>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <th>#</th>
                        <th> الاسم</th>
                        <th>رقم الهوية </th>
                        <th> الجوال </th>
                        <th> الجنسية </th>
                        <th> نوع الموظف </th>
                        <th> حالة الموظف </th>
                        <th> المركز الرئيسي </th>
                        <th> العمارة </th>
                       <th class="no-print"> صورة الهوية </th>
                        <th class="no-print">اجراءات</th>
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
                    window.location.href = "./employees/destroy/" + id
                }
            });
        }
    </script>




    <p class="text-employee text-primary"><small> </small></p>
@endsection
