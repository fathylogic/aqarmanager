<?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>

<form method="POST" id="form_add_op" action="{{ route('sarfs.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="source_type_id" value="1">
    <input type="hidden" name="to_ohda_id" value="{{ $ohda->id }}">
    <input type="hidden" name="object_name" value="maincenters">
    <input type="hidden" name="object_id" value="{{ $maincenter->id }}">
    <input type="hidden" name="sarf_type_id" value="1">
    <input type="hidden" name="maincenter_id" value="{{ $maincenter->id }}">
    <input type="hidden" name="last_amount" value="{{ $ohda->raseed }}">
    <input type="hidden" name="current_tab" value="form-tabs-ohda">
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

                                </div>
                                <div class="col-md-9 border rounded float-start p-1 me-1 mb-1 h-100">


                                    <div class="form-check form-check-inline col-md-6 ohdafrom">
                                        وصية ابراهيم صدقي


                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 p-0 float-start mb-1">
                                <div
                                    class="col-md-2 border rounded text-center fw-bold bg-light float-start p-1 me-1 mb-1 h-100">
                                    يصرف
                                    الى العهدة
                                </div>
                                <div class="col-md-9 border rounded float-start p-1 me-1 mb-1 h-100">
                                    {{ $ohda->employee->name }}
                                    ({{ $ohda->purpose }})
                                </div>
                            </div>


                            <div class="col-md-11 border rounded       mb-1 ">
                                {{-- بيانات الصرف  --}}
                                <div class="row mb-2 m-2">

                                    <div class="col-md-4">
                                        <label class="form-label" for="amount"> المبلغ </label>
                                        <input type="text" id="amount" name="amount"
                                               onkeypress="return onlyNumbers(event)"
                                               onkeyup="return numberValidation(event)" required
                                               class="form-control"/>
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
                                            <option value="">اختر</option>
                                            @foreach ($payment_types as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>


                                    <div class="col-md-12">
                                        <label class="form-label" for="masder"> المصدر </label>

                                        <select id="masder" name="masder"
                                                class="select2 form-select" data-allow-clear="true">
                                            <option value="مبلغ مرحل (فائض من عهدة سابقة) ">مبلغ مرحل (فائض من عهدة
                                                سابقة)
                                            </option>
                                            <option value="بيع مواد">بيع مواد</option>
                                            <option value="مبلغ عهدة اضافي"> مبلغ عهدة اضافي</option>
                                            <option value="">أخرى توضح في البيان</option>

                                        </select>

                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label" for="s_desc"> البيان </label>
                                        <input type="text" id="s_desc" name="s_desc" value="" required
                                               class="form-control">

                                    </div>


                                    <div class="col-md-12">
                                        <label class="form-label" for="receved_by"> المستلم </label>
                                        <input type="text" id="receved_by" name="receved_by" value="" required
                                               class="form-control">

                                    </div>


                                </div>


                            </div>


                            <div class="col-md-4 text-unit">
                                <button type="submit" id="btn_add_ob"
                                        class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">
                                    حفظ &nbsp;
                                    <i class="fa-solid fa-floppy-disk"></i></button>
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

<script>


    document.getElementById('btn_add_ob').addEventListener('click', function (e) {
        // Prevent the default form submission
        e.preventDefault();

        // Get the form element
        const form = document.getElementById('form_add_op');

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

</script>
