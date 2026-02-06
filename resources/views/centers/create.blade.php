@extends('layouts.app')

@section('content')


  

<form method="POST" action="{{ route('centers.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Login -->
          <div class="card border">
            <div class="card-body">

<div class="row g-3">
                          <div class="col-md-6">
                            <label class="form-label" for="center_name">اسم العمارة   <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="center_name" name="center_name" class="form-control" required   />
                          </div>
                          <div class="col-md-6">
                             <label class="form-label" for="center_location">المنطقة <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <select id="center_location" name="center_location" required class="select2 form-select" data-allow-clear="true">
                              <option value="">اختر</option>
                               @foreach ($locations as $row)
                                 <option value="{{ $row->id }}">{{ $row->name }}</option>
                               @endforeach

                            </select>
                          </div>




                          <div class="col-md-6">
                            <label class="form-label" for="electric_no">  حساب شركة الكهرباء   <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="electric_no" name="electric_no"  class="form-control"   />
                          </div>

                          <div class="col-md-6">
                            <label class="form-label" for="woter_no">  حساب شركة المياة   <i class="fa fa-asterisk " style="color: red" aria-hidden="true"></i></label>
                            <input type="text" id="woter_no" name="woter_no"  class="form-control"   />
                          </div>

                           <div class="col-md-6">
                            <label class="form-label" for="left_electric_no">  حساب   اخر للمصاعد    </label>
                            <input type="text" id="left_electric_no" name="left_electric_no" class="form-control"   />
                          </div>
                             <div class="col-md-6">
                          <label for="file" class="form-label">   صورة</label>
            <input type="file" name="file" id="file" class="form-control" >

                          </div>
                          <div class="col-md-6">
                                                                        <label for="othercontents" class="form-label">
                                                                            تحتوي على </label>
                                                                         <br>
                                                                          @foreach ($others as $row)
                                                                                 <input type="checkbox" class="checkbox" name="othercontents[]" value="{{ $row->id }}">
                                                                                 {{ $row->name }}

                                                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            @endforeach

                                                                    </div>
 

                            <div class="col-md-12">
                            <label class="form-label" for="notes">       ملاحظات      </label>
                            <textarea   id="notes" name="notes" class="form-control"  ></textarea>
                          </div>

                        </div>


    <div class="mb-3">


        <div class="col-md-6 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">حفظ  <i class="fa-solid fa-floppy-disk"></i> </button>

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


@endsection
