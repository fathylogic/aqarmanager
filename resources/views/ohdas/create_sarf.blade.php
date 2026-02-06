<?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>

<form method="POST" id="form_add_sarf_op" action="{{ route('sarfs.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="source_type_id" value="2">
    <input type="hidden" name="from_ohda_id" value="{{ $ohda->id }}">
    <input type="hidden" name="object_name" value="ohdas">
    <input type="hidden" name="object_id" value="{{ $ohda->id }}">
    <input type="hidden" name="last_amount" value="{{ $ohda->raseed }}">
    <input type="hidden"   name="current_tab" value="form-tabs-ohda">
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Login -->
                <div class="card border">
                    <div class="card-body">
                        <div class="row">




                            <div class="col-md-12 p-0 float-start mb-1">
                                <div
                                    class="col-md-2 border rounded text-center fw-bold bg-light float-start p-1 me-1 mb-1 h-100">
                                    يصرف من
                                    العهدة
                                </div>
                                <div class="col-md-9 border rounded float-start p-1 me-1 mb-1 h-100">


                                    <div class="form-check form-check-inline col-md-6 ohdafrom">

                                        {{ $ohda->employee->name }}
                                        ({{ $ohda->purpose }})

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 p-0 float-start mb-1">
                                <div
                                    class="col-md-2 border rounded text-center fw-bold bg-light float-start p-1 me-1 mb-1 h-100">
                                    نوع الصرف
                                    (إلى)
                                </div>
                                <div class="col-md-9 border rounded float-start p-1 me-1 mb-1 h-100">
                                    @foreach ($sarfTypes as $row)
                                        <div class="form-check col-md-2 form-check-inline">
                                            @if ($row->id != 1)
                                                <input class="form-check-input" type="radio" required
                                                    name="sarf_type_id" onclick="fn_setSarfType();"
                                                    value="{{ $row->id }} ">
                                                <label class="form-check-label"> {{ $row->name }} </label>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-11 border rounded      sarftype2" style="display: none">
                                {{-- مستفيدين --}}
                                <div class="row ">
                                    <div class="col-md-12 p-0 float-start mb-1">
                                        <div class="col-md-3   text-center fw-bold bg-lighter float-start    ">
                                            اختر المستفيد:
                                        </div>
                                        <div class="col-md-8   float-start    ">
                                            <select name="recipient_id" class="select2 form-select w-100  "
                                                data-allow-clear="true">
                                                <option value="">اختر </option>
                                                @foreach ($recipients as $row)
                                                    <option value="{{ $row->id }}">{{ $row->name }}

                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-11 border rounded       sarftype3" style="display: none">
                                {{-- رواتب موظفين --}}
                                <div class="row ">
                                    <div class="col-md-12 p-0 float-start mb-1">
                                        <div class="col-md-3   text-center fw-bold bg-lighter float-start    ">
                                            اختر بيان الراتب :
                                        </div>
                                        <div class="col-md-8   float-start    ">
                                            <select name="pay_role_id" id="pay_role_id"
                                                onchange="fn_set_amount(this.options[this.selectedIndex].getAttribute('data-amount'))"
                                                class="select2 form-select w-100 " data-allow-clear="true">
                                                <option value="">اختر </option>
                                                @foreach ($payrolls as $row)
                                                    <option value="{{ $row->id }}"
                                                        data-amount="{{ $row->net_salary }}">
                                                        {{ $row->employee->name }} :
                                                        راتب شهر ({{ $row->salary_year_month }})
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                           <div class="col-md-11 border rounded       mb-1 sarftype4" style="display: none">
                                    {{-- خدمات --}}
                                     <div class="row m-2">
                                     <div class="col-md-4">
                                            <label class="form-label" for="service_type_id">  نوع الخدمة </label>

                                            <select id="service_type_id"  name="service_type_id"
                                                class="select2 form-select" data-allow-clear="true">
                                                <option value="">اختر </option>
                                                @foreach ($serviceTypes as $row)
                                                    <option value="{{ $row->id }}">{{ $row->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label" for="center_id">    المركز الربحي </label>

                                            <select id="center_id"  name="center_id" onchange="fn_get_units(this.value)"
                                                class="select2 form-select" data-allow-clear="true">
                                                <option value="">اختر </option>
                                                @foreach ($centers as $row)
                                                    <option value="{{ $row->id }}">{{ $row->center_name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>

                                         <div class="col-md-8" id="uint_div" style="display: none">
                                            <label class="form-label" for="unit_id">    الشفة   </label>

                                            <select id="unit_id"   name="unit_id"
                                                class="select2 form-select" data-allow-clear="true">


                                            </select>

                                        </div>
                                     </div>

                                </div>

                            <div class="col-md-11 border rounded       mb-1 ">
                                {{-- بيانات الصرف  --}}
                                <div class="row mb-2 m-2">

                                    <div class="col-md-4">
                                        <label class="form-label" for="amount"> المبلغ </label>
                                        <input type="text" id="amount" onkeypress="return onlyNumbers(event)" onkeyup="return numberValidation(event)" name="amount" required
                                            class="form-control" />
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label"> تاريخ الدفع </label>
                                        <div class="calendar-group" data-group="pdate">
                                            <div class="field-row gregorian-row ">
                                                <input type="text" class="gregorian-date" name="p_date"
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
                                                <input type="text" class="hijri-date" name="p_dateh"
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
                                        <label class="form-label" for="payment_type"> طريقة الدفع </label>

                                        <select id="payment_type" required name="payment_type"
                                            class="select2 form-select" data-allow-clear="true">
                                            <option value="">اختر </option>
                                            @foreach ($payment_types as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label" for="s_desc"> البيان </label>
                                        <input type="text" id="s_desc" name="s_desc" value="" required
                                            class="form-control">

                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="receved_by"> المستلم </label>
                                        <input type="text" id="receved_by" name="receved_by" value=""
                                            required class="form-control">

                                    </div>
                                     <div class="col-md-6">
                                                            <label for="file" class="form-label"> صورة
                                                            </label>
                                                            <input type="file" accept=".jpg, .jpeg, .pdf, image/jpeg, application/pdf" id="imgFile" onchange="validate_and_loadFile(event,this.id)" name="file"
                                                                class="form-control">
                                                            <img id="imgFile_view" width="150px" height="100px" border="4" hidden  />
                                                        </div>





                                </div>



                            </div>







                            <div class="col-md-4 text-unit">
                                <button type="submit" id="btn_add_sarf_op" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">
                                    حفظ &nbsp;
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


 <input type="hidden" id="aurl" value="{{ $root }}/sarfs/get_units/">


    <p class="text-unit text-primary"><small> </small></p>


    <script>


document.getElementById('btn_add_sarf_op').addEventListener('click', function (e) {
    // Prevent the default form submission
    e.preventDefault();

    // Get the form element
    const form = document.getElementById('form_add_sarf_op');

    // Optional: Check built-in HTML form validation
    if (!form.checkValidity()) {
        form.reportValidity(); // Show native validation messages
        return; // Stop here if validation fails
    }


    Swal.fire({
        title: 'هل أنت متأكد?',
        text: "انك تريد الاضافة!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: ' إلغاء  ',
        confirmButtonText: 'نعم!'
    }).then((result) => {
        // If the user clicks "Yes, submit it!"
        if (result.isConfirmed) {
            // Programmatically submit the form
            form.submit();
        }
    });
});



        function fn_get_units(id)
        {
            if(id!=''&&id>0)
            {
            var url = $('#aurl').val()+id;


            $.ajax({
                    url: url,
                    method: 'GET',
                    data:id,
                    dataType: 'text',
                    success: function(data) {
                        console.log(data) ;
                         $('#unit_id').html(data);

                         $('#unit_id').trigger('change') ;
                        $('#uint_div').show() ;


                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error("AJAX error:", status, error);
                    }
                });
            }else
             $('#uint_div').hide() ;

        }


        function fn_set_amount(amount) {

            $("#amount").val(amount);
        }

        function fn_setSorceType() {
            var selectedsource_type = $("input[name='source_type_id']:checked").val();
            if (selectedsource_type == 2)
                $(".ohdafrom").show();
            else
                $(".ohdafrom").hide();
        }

        function fn_setSarfType() {
            var selected_type = $("input[name='sarf_type_id']:checked").val();

            $(".sarftype1").hide();
            $(".sarftype2").hide();
            $(".sarftype3").hide();
            $(".sarftype4").hide();
            $(".sarftype" + selected_type).show();


        }
    </script>
