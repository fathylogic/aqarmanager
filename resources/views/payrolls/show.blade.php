@extends('layouts.app')

@section('content')
    



    <div class="row">
        <div class="col">
            <div class="card  mb-3">
                <div class="card-header bg-light">
                    <strong>{{ $employee->name }} </strong>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 float-end">
                            <div>
                                @if ($employee->img != '')
                                    <a href="<?= asset('storage/' . $employee->img) ?>" target="_blank">
                                        <img src="<?= asset('storage/' . $employee->img) ?>" class="w-100" />
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

                                        رقم الهوية
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $employee->id_no }} </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        الجوال
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $employee->mobile_no }}
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        الجنسية
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $employee->nationality }}
                                    </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        المهنة
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $employee->job }} </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        الراتب
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ $employee->salary }} </div>
                                </div>
                                <div class="col-md-6 p-0 float-start mb-1">
                                    <div
                                        class="col-md-4 border rounded text-center fw-bold bg-lighter float-start p-1 me-1 mb-1 h-100">
                                        الحساب البنكي
                                    </div>
                                    <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">
                                        {{ @$employee->iban }}
                                    </div>
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
                                            data-bs-target="#form-tabs-units" role="tab" aria-selected="true">
                                            كشف الرواتب
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-sarf"
                                            role="tab" aria-selected="false">
                                            الأجازات
                                            

                                        </button>
                                    </li>

                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="form-tabs-units" role="tabpanel">

                                    بيانات كشف الرواتب

                                </div>
                                <div class="tab-pane fade" id="form-tabs-sarf" role="tabpanel">



                                    <a href="#collapseContract" data-bs-toggle="collapse" data-bs-target="#collapseContract">
                                    <i class="fa fa-plus " aria-hidden="true"></i>
                                    تسجيل أجازة     
                                </a>


                                <div class="collapse" id="collapseContract">
                                    <form method="POST" action="" enctype="multipart/form-data">
                                        @csrf
                                         
                                        <input type="hidden" name="emp_id" value="{{ $employee->id }}">
                                        <div class="card card-body">


                                            <div class="row g-3">
                                                

                                                <div class="col-md-4">
                                                        <label class="form-label">تاريخ بداية الأجازة </label>
                                                        <div class="calendar-group" data-group="start"
                                                            data-range-group="vacation" data-validate="range">
                                                            <div class="field-row gregorian-row ">
                                                                <input type="text" class="gregorian-date"
                                                                    name="start_date" placeholder="ميلادي"
                                                                    autocomplete="off">
                                                                <div class="ios-switch-container">
                                                                    <span class="switch-label">هجري</span>
                                                                    <label class="ios-switch">
                                                                        <input type="checkbox" class="calendar-switch">
                                                                        <span class="ios-slider"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="field-row hijri-row hidden">
                                                                <input type="text" class="hijri-date"
                                                                    name="start_dateh" placeholder="هجري"
                                                                    autocomplete="off">
                                                                <div class="ios-switch-container">
                                                                    <span class="switch-label-hijri">ميلادي</span>
                                                                    <label class="ios-switch">
                                                                        <input type="checkbox"
                                                                            class="calendar-switch-hijri" checked>
                                                                        <span class="ios-slider"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- الحقل العقد نهاية -->
                                                    <div class="col-md-4">
                                                        <label class="form-label">تاريخ نهاية الأجازة </label>
                                                        <div class="calendar-group" data-group="end"
                                                            data-range-group="vacation" data-validate="range">
                                                            <div class="field-row gregorian-row ">
                                                                <input type="text" class="gregorian-date "
                                                                    name="end_date" placeholder="ميلادي">
                                                                <div class="ios-switch-container">
                                                                    <span class="switch-label">هجري</span>
                                                                    <label class="ios-switch">
                                                                        <input type="checkbox" class="calendar-switch">
                                                                        <span class="ios-slider"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="field-row hijri-row hidden">
                                                                <input type="text" class="hijri-date" name="end_dateh"
                                                                    placeholder="هجري">
                                                                <div class="ios-switch-container">
                                                                    <span class="switch-label-hijri">ميلادي</span>
                                                                    <label class="ios-switch">
                                                                        <input type="checkbox"
                                                                            class="calendar-switch-hijri" checked>
                                                                        <span class="ios-slider"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                

                                               
                                                
                                                

                                                <div class="col-md-8">
                                                    <label class="form-label" for="notes"> ملاحظات </label>
                                                    <textarea id="notes" name="notes" class="form-control"></textarea>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" name="btn_add_vacation" class="btn btn-primary "> حفظ
                                                &nbsp;
                                                <i class="fa-solid fa-floppy-disk"></i> </button>
                                            <button type="reset" class="btn btn-secondary"
                                                data-bs-dismiss="modal">الغاء</button>
                                        </div>
                                    </form>
                                </div>
                                <hr class="my-1" />









                                  @if (!empty($employee->vacations))
                                                <div class="card-datatable table-responsive pt-0">
                                                    <table class="table table-striped  display responsive nowrap FathyTable ">
                                                        <thead>
                                                            <tr>

                                                                <th> من تاريخ </th>
                                                                <th> الى تاريخ </th>

                                                                <th> عدد الايام </th>
                                                               <th class="no-print">اجراءات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($employee->vacations as $key => $row)
                                                                <tr>

                                                                    <td>{{ $row->start_date }} م - {{ $row->start_dateh }}
                                                                        هـ
                                                                    </td>
                                                                    <td>{{ $row->end_date }} م - {{ $row->end_dateh }} هـ
                                                                    </td>
                                                                    <td>{{ $row->no_of_days }}</td>


                                                                    <td class="no-print">

                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>

                                                        <tfoot>
                                                            <tr>
                                                                <th> من تاريخ </th>
                                                                <th> الى تاريخ </th>
                                                                <th> عدد الايام </th>
                                                               <th class="no-print">اجراءات</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            @else
                                                لا يوجد عمليات
                                            @endif
                                </div>

                            </div>
                        </div>

                    </div>


                </div>
            </div>


        </div>
    </div>
@endsection
