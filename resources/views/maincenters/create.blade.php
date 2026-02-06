@extends('layouts.app')

@section('content')

   <?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>


    <form method="POST" action="{{ route('maincenters.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="container-xxl">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner py-4">
                    <!-- Login -->
                    <div class="card border">
                        <div class="card-body">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="name">اسم المركز الرئيسي <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        class="form-control" required />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="iban">حساب الايبان <i class="fa fa-asterisk "
                                            style="color: red" aria-hidden="true"></i></label>
                                    
                                   <div class="input-group mb-3" dir="ltr">
                                        <span class="input-group-text" id="iban">SA</span>
                                        <input type="text"   value="{{ old('iban') }}" class="form-control" id="iban" dir="ltr"
                                            name="iban" onkeypress="return onlyNumbers(event)" onkeyup="return numberValidation(event)" aria-describedby="iban">
                                    </div>
                                  
                                        @error('iban')
                                        <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="emp_id">الموظف المسئول </label>
                                    <select id="emp_id" name="emp_id" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">اختر </option>
                                        @foreach ($emps as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach

                                    </select>
                                </div>





                                <div class="col-md-6">
                                    <label for="file" class="form-label"> صورة </label>
                                    <input type="file" name="file" id="file" class="form-control">

                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="notes"> ملاحظات </label>
                                    <textarea id="notes" name="notes" class="form-control"></textarea>
                                </div>

                            </div>


                            <div class="mb-3">
                                <div class="pt-4">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"><i
                                            class="fa-solid fa-floppy-disk pe-2"></i> حفظ</button>
                                    <a class="btn btn-label-secondary waves-effect"
                                        href="{{ route('maincenters.index') }}"><i class="fa-solid fa-xmark pe-2"></i>
                                        الغاء</a>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <p class="text-center text-primary"><small>أوقاف إبراهيم صدقي محمد سعيد أفندي</small></p>
@endsection
