@extends('layouts.app')

@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> يوجد خطأ في بيانات الادخال.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <form method="POST" action="{{ route('ohdas.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card border">


            <div class="card-body">

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="emp_id">الموظف المسئول <i class="fa fa-asterisk "
                                                                                 style="color: red"
                                                                                 aria-hidden="true"></i></label>
                        <select id="emp_id" name="emp_id" required class="select2 form-select"
                                data-allow-clear="true">
                            <option value="">اختر</option>
                            @foreach ($emps as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="purpose"> البيــــــان <i class="fa fa-asterisk "
                                                                                 style="color: red"
                                                                                 aria-hidden="true"></i></label>
                        <input type="text" id="purpose" name="purpose" required class="form-control"/>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="raseed"> مبلغ العهدة <i class="fa fa-asterisk "
                                                                               style="color: red"
                                                                               aria-hidden="true"></i></label>
                        <input type="text" value="0" id="raseed" name="raseed" required
                               class="form-control"/>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="masder"> مصدر مبلغ العهدة </label>
                        <input type="text" id="masder" name="masder" required
                               class="form-control"/>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="esm_elmohawel"> اسم المحول </label>
                        <input type="text" id="esm_elmohawel" name="esm_elmohawel"
                               required class="form-control"/>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label"> تاريخ التحويل </label>
                        <div class="calendar-group" data-group="tdate">
                            <div class="field-row gregorian-row ">
                                <input type="text" class="gregorian-date" name="t_date"
                                       placeholder="ميلادي" autocomplete="off">
                                <div class="ios-switch-container">
                                    <span class="switch-label">هجري</span>
                                    <label class="ios-switch">
                                        <input type="checkbox" class="calendar-switch">
                                        <span class="ios-slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="field-row hijri-row hidden">
                                <input type="text" class="hijri-date" name="t_dateh"
                                       placeholder="هجري" autocomplete="off">
                                <div class="ios-switch-container">
                                    <span class="switch-label-hijri">ميلادي</span>
                                    <label class="ios-switch">
                                        <input type="checkbox" class="calendar-switch-hijri"
                                               checked>
                                        <span class="ios-slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="payment_type"> نوع الدفع </label>

                        <select id="payment_type" required name="payment_type"
                                class="select2 form-select" data-allow-clear="true">
                            <option value="">اختر</option>
                            @foreach ($payment_types as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="hewala_no"> رقم الحوالة </label>
                        <input type="text" id="hewala_no" name="hewala_no" 
                               onkeypress="return onlyNumbers(event)"
                               onkeyup="return numberValidation(event)"
                               class="form-control"/>
                    </div>

                </div>


            </div>

            <div class="card-footer">



                <button type="submit" name="btn_add_ohda"
                        class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">

                    <i class="fa-solid fa-floppy-disk pe-2"></i>
                    حفظ
                </button>

                <button type="reset"
                        class="btn btn-warning me-sm-3 me-1 waves-effect waves-light">تراجع
                </button>
            </div>
        </div>
    </form>



    <p class="text-employee text-primary"><small> </small></p>
@endsection
