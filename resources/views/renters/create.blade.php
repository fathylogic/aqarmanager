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

    <form method="POST" action="{{ route('renters.store') }}" enctype="multipart/form-data">
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
                                    <label class="form-label" for="id_type"> نوع الهوية <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>

                                    <select id="id_type" name="id_type" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">اختر </option>
                                        @foreach ($id_types as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach

                                    </select>
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
                                    <label class="form-label" for="mobile_no"> رقم الجوال <i
                                            class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                                    <input type="text"
                                           id="mobile_no"
                                           name="mobile_no"
                                           class="form-control"
                                           maxlength="10"
                                           pattern="05[0-9]{8}"
                                           placeholder="05XXXXXXXX"
                                           required
                                           onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="other_no	"> رقم اخر للتواصل </label>
                                    <input type="text" id="other_no" name="other_no" class="form-control"
                                           maxlength="10"
                                           pattern="05[0-9]{8}"
                                           placeholder="05XXXXXXXX"
                                    />
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">جهات الاتصال</label>

                                    <div id="contacts-wrapper">
                                        <!-- rows will be added here -->
                                    </div>

                                    <button type="button" class="btn btn-success mt-2" id="add-contact">
                                        <i class="fa fa-plus"></i> إضافة جهة اتصال
                                    </button>
                                </div>



                                <div class="col-md-4">
                                    <label class="form-label" for="employer"> جهة العمل </label>
                                    <input type="text" id="employer" name="employer" class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="work_no"> رقم جهة العمل </label>
                                    <input type="text" id="work_no" name="work_no" class="form-control"
                                           maxlength="10"
                                           pattern="05[0-9]{8}"
                                           placeholder="05XXXXXXXX"
                                           onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)"
                                    />
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="work_letter"> خطاب جهة العمل </label>
                                    <input type="file" name="work_letter" id="work_letter" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="file" class="form-label"> صورة الهوية</label>
                                    <input type="file" name="file" id="file" class="form-control">

                                </div>

                                <div class="col-md-8">
                                    <label class="form-label" for="notes"> ملاحظات </label>
                                    <textarea id="notes" name="notes" class="form-control"></textarea>
                                </div>

                            </div>


                            <div class="mb-3">


                                <div class="col-md-6 text-renter">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">
                                        حفظ &nbsp; <i class="fa-solid fa-floppy-disk"></i> </button>
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
        let contactIndex = 0;

        document.getElementById('add-contact').addEventListener('click', function () {

            let row = `
        <div class="row g-2 align-items-center mb-2 contact-row">
            <div class="col-md-4">
                <input type="text" name="contact_name[]" class="form-control" placeholder="اسم جهة الاتصال" required>
            </div>
            <div class="col-md-4">
                <input type="text"
 onkeypress="return onlyNumbers(event)"
                                           onkeyup="return numberValidation(event)"
 maxlength="10"
                                           pattern="05[0-9]{8}"

name="contact_no[]" class="form-control" placeholder="رقم التواصل" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-contact">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>`;

            document.getElementById('contacts-wrapper').insertAdjacentHTML('beforeend', row);
        });

        document.addEventListener('click', function (e) {
            if (e.target.closest('.remove-contact')) {
                e.target.closest('.contact-row').remove();
            }
        });
    </script>
@endsection
