@extends('layouts.app')

@section('content')


   
        
    <?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>
    <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="container-xxl">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner py-4">
                    <!-- Login -->
                    <div class="card border">
                        <div class="card-body">

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="name">الاسم <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="name" name="name" class="form-control" required />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="id_no"> رقم الهوية <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="id_no" name="id_no" class="form-control" />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="nationality"> الجنسية <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <select id="nationality" required name="nationality" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">اختر </option>
                                        @foreach ($nationalities as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="mobile_no"> رقم الجوال <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="mobile_no" name="mobile_no" class="form-control" />
                                </div>
                                <div class="col-md-4">

                                    <label class="form-label" for="iban"> الحساب البنكي (IBAN) <i
                                            class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                                    <div class="input-group mb-3" dir="ltr">
                                        <span class="input-group-text" id="iban">SA</span>
                                        <input type="text" class="form-control" id="iban" dir="ltr"
                                            name="iban" onkeypress="return onlyNumbers(event)"
                                            onkeyup="return numberValidation(event)" aria-describedby="iban">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="job"> الوظيفة <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="job" name="job" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="maincenter_id"> المركز الرئيسي </label>
                                    <select id="maincenter_id" name="maincenter_id" class="select2 form-select"
                                        onchange="fn_get_centers(this.value)" data-allow-clear="true">
                                        <option value="">غير محدد</option>
                                        @foreach ($maincenters as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="center_id"> العمارة </label>
                                    <select id="center_id" name="center_id" class="select2 form-select"
                                        data-allow-clear="true">

                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="emp_type"> نوع الموظف </label>
                                    <select id="emp_type" name="emp_type" onchange="fn_setDates(this.value);"
                                        class="select2 form-select" data-allow-clear="true">

                                        @foreach ($empTypes as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="row g-3" id="temp_emp" style="display: none">



                                    <!--   الحقل العقد بدايه -->
                                    <div class="col-md-4">
                                        <label class="form-label">تاريخ البداية</label>
                                        <div class="calendar-group" data-group="start" data-range-group="contract"
                                            data-validate="range">
                                            <div class="field-row gregorian-row ">
                                                <input type="text" class="gregorian-date" name="start_date"
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
                                                <input type="text" class="hijri-date" name="start_dateh"
                                                    placeholder="هجري" autocomplete="off">
                                                <div class="ios-switch-container">
                                                    <span class="switch-label-hijri">ميلادي</span>
                                                    <label class="ios-switch">
                                                        <input type="checkbox" class="calendar-switch-hijri" checked>
                                                        <span class="ios-slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- الحقل العقد نهاية -->
                                    <div class="col-md-4">
                                        <label class="form-label">تاريخ النهاية </label>
                                        <div class="calendar-group" data-group="end" data-range-group="contract"
                                            data-validate="range">
                                            <div class="field-row gregorian-row ">
                                                <input type="text" class="gregorian-date " name="end_date"
                                                    placeholder="ميلادي">
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
                                                        <input type="checkbox" class="calendar-switch-hijri" checked>
                                                        <span class="ios-slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>











                                </div>



                                <div class="col-md-4">
                                    <label class="form-label" for="emp_status"> حالة الموظف </label>
                                    <select id="emp_status" name="emp_status" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">غير محدد</option>
                                        @foreach ($empStatus as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label"> تاريخ الالتحاق</label>
                                    <div class="calendar-group" data-group="joindate">
                                        <div class="field-row gregorian-row ">
                                            <input type="text" class="gregorian-date" name="join_date"
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
                                            <input type="text" class="hijri-date" name="join_dateh"
                                                placeholder="هجري" autocomplete="off">
                                            <div class="ios-switch-container">
                                                <span class="switch-label-hijri">ميلادي</span>
                                                <label class="ios-switch">
                                                    <input type="checkbox" class="calendar-switch-hijri" checked>
                                                    <span class="ios-slider"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label class="form-label" for="salary"> المرتب <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="salary" required name="salary" class="form-control" />
                                </div>

                                <div class="col-md-4 cal_con">
                                    <label class="form-label">تاريخ الميلاد </label>

                                    <div class="calendar-group" data-group="joindate">
                                        <div class="field-row gregorian-row ">
                                            <input type="text" class="gregorian-date" name="birthday"
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
                                            <input type="text" class="hijri-date" name="birthdayh" placeholder="هجري"
                                                autocomplete="off">
                                            <div class="ios-switch-container">
                                                <span class="switch-label-hijri">ميلادي</span>
                                                <label class="ios-switch">
                                                    <input type="checkbox" class="calendar-switch-hijri" checked>
                                                    <span class="ios-slider"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                </div>




                                <div class="col-md-4">
                                    <label for="file" class="form-label"> صورة الهوية</label>
                                    <input type="file" name="file" id="file" class="form-control">

                                </div>


                                <div class="col-md-4">
                                    <label class="form-label" for="notes"> ملاحظات </label>
                                    <textarea id="notes" name="notes" class="form-control"></textarea>
                                </div>

                            </div>


                            <div class="mb-3">


                                <div class="col-md-4 text-employee">
                                    <button type="submit"
                                        class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">حفظ
                                        <i class="fa-solid fa-floppy-disk"></i> </button>

                                    <button type="reset"
                                        class="btn btn-warning me-sm-3 me-1 waves-effect waves-light">تراجع
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <input type="hidden" id="aurl" value="{{ $root }}/employees/get_centers/">
    <script>
        function fn_setDates(id) {
            if (id != 1)

                $('#temp_emp').show();

            else
                $('#temp_emp').hide();

        }

        function fn_get_centers(id) {
            if (id != '' && id > 0) {
                var url = $('#aurl').val() + id;


                $.ajax({
                    url: url,
                    method: 'GET',
                    data: id,
                    dataType: 'text',
                    success: function(data) {

                        $('#center_id').html(data);

                        $('#center_id').trigger('change');



                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error("AJAX error:", status, error);
                    }
                });
            } else
                $('#uint_div').hide();

        }
     
      
    </script>
@endsection
