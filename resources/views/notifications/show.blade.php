@extends('layouts.app')

@section('content')






    <div class="row">
        <div class="col">
            <div class="card  mb-3">
                <div class="card-header bg-lighter"><strong>{{ $center->location->name }} /
                        {{ $center->center_name }}</strong>
                </div>
                <div class="card-body">

                    <div class="col-md-3 float-end">
                        <div>
                            @if ($center->img != '')
                                <a href="<?= asset('storage/' . $center->img) ?>" target="_blank">
                                    <img src="<?= asset('storage/' . $center->img) ?>" class="w-100" />
                                </a>
                            @else
                                <?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>
                                <img class=" float-end" style="width: 125px ; height: 125px;"
                                    src="{{ $root }}/assets/img/branding/sedqilogo1.png">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9 float-start">
                        <div class="row">
                            <div class="col-md-6 p-0 float-start mb-1">
                                <div
                                    class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                    عدد الوحدات
                                </div>
                                <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100"> 45
                                </div>
                            </div>
                            <div class="col-md-6 p-0 float-start mb-1">
                                <div
                                    class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                    حساب المياة
                                </div>
                                <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                    {{ $center->woter_no }} </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 p-0 float-start mb-1">
                                <div
                                    class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                    حساب الكهرباء
                                </div>
                                <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                    {{ $center->electric_no }}
                                </div>
                            </div>
                            <div class="col-md-6 p-0 float-start mb-1">
                                <div
                                    class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                    حساب المصعد
                                </div>
                                <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                    {{ $center->left_electric_no }}
                                </div>
                            </div>
                            <div class="col-md-6 p-0 float-start mb-1">
                                <div
                                    class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                    ملاحظات
                                </div>
                                <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100"> {{ $center->notes }}
                                </div>
                            </div>
                        </div>







                    </div>











                </div>
            </div>


            <div class="card mb-3">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-units"
                                role="tab" aria-selected="true">
                                الوحدات
                            </button>
                        </li>
                        
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="form-tabs-units" role="tabpanel">
                        @if (!empty($units))
                            <div class="card-datatable table-responsive pt-0">
                                <table class="table table-striped  display responsive nowrap FathyTable ">
                                    <thead>
                                        <tr>
                                            <th>#</th>

                                            <th> نوع الوحدة </th>
                                            <th> الدور </th>
                                            <th> رقم الوحدة </th>
                                            <th> حساب الكهرباء </th>
                                            <th> المستأجر الحالي </th>
                                            <th> صورة </th>
                                            <th width="280px">اجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($units as $key => $unit)
                                            <tr>
                                                <td>{{ ++$i }}</td>

                                                <td>{{ $unit->unitType->name }}</td>
                                                <td>{{ $unit->floor_no }}</td>

                                                <td>{{ $unit->unit_no }}</td>
                                                <td>{{ $unit->electric_no }}</td>
                                                <td>{{ @$unit->renter->name }}</td>
                                                <td>
                                                    <a href="#exampleModal{{ $unit->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $unit->id }}">
                                                        <i class="fa fa-eye " aria-hidden="true"></i>
                                                    </a>
                                                    <div class="modal fade" id="exampleModal{{ $unit->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"> صورة </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img class="d-block"
                                                                        src="<?= asset('storage/' . $unit->img) ?>"
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


                                                <td>


                                                    <a href="{{ route('units.show', $unit->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        فتح
                                                    </a>
                                                    <a href="{{ route('units.edit', $unit->id) }}"><i
                                                            class="fa-solid fa-circle-info"></i> تعديل</a></li>


                                                </td>

                                            </tr>

                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>

                                            <th> نوع الوحدة </th>
                                            <th> الدور </th>
                                            <th> رقم الوحدة </th>
                                            <th> حساب الكهرباء </th>
                                            <th> المستأجر الحالي </th>
                                            <th> صورة </th>
                                            <th>اجراءات</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif

                    </div>
                   
                </div>
            </div>
        </div>
    </div>






@endsection
