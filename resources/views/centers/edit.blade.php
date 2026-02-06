@extends('layouts.app')

@section('content')




<form method="POST" action="{{ route('centers.update',$center->id) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $center->id }}">
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Login -->
          <div class="card border">
            <div class="card-body">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="center_name">اسم العمارة
                            <i class="fa fa-asterisk " style="color: red"
                               aria-hidden="true"></i></label>
                        <input type="text" name="center_name"
                               value="{{ $center->center_name }}" class="form-control"
                               required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="center_location">المنطقة <i
                                class="fa fa-asterisk " style="color: red"
                                aria-hidden="true"></i></label>
                        <select id="center_location" name="center_location" required
                                class="select2 form-select" data-allow-clear="true">
                            <option value="">اختر</option>
                            @foreach ($locations as $row)
                                <option value="{{ $row->id }}"
                                @if ($center->center_location == $row->id) {{ 'selected' }} @endif>
                                    {{ $row->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="hainame">الحي </label>
                        <input type="text" name="hainame" value="{{ $center->hainame }}"
                               class="form-control" />

                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="street">الشارع
                        </label>
                        <input type="text" name="street" value="{{ $center->street }}"
                               class="form-control" />

                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="Building_no">رقم
                            العمارة </label>
                        <input type="text" name="Building_no"
                               value="{{ $center->Building_no }}" class="form-control" />

                    </div>



                    <div class="col-md-6">
                        <label class="form-label" for="sak_no"> الموقع على
                            الخريطة </label>
                        <input type="text" name="gps" value="{{ $center->gps }}"
                               class="form-control" />
                        <a href='{{ $center->gps }}'
                           target='_blank'>{{ $center->gps }}</a>

                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="sak_no">رقم الصك
                        </label>
                        <input type="text" name="sak_no" value="{{ $center->sak_no }}"
                               class="form-control" />

                    </div>


                    <div class="col-md-6">
                        <label class="form-label" for="electric_no"> حساب شركة
                            الكهرباء <i class="fa fa-asterisk " style="color: red"
                                        aria-hidden="true"></i></label>
                        <input type="text" id="electric_no" name="electric_no"
                               value="{{ $center->electric_no }}" class="form-control" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="woter_no"> حساب شركة
                            المياة <i class="fa fa-asterisk " style="color: red"
                                      aria-hidden="true"></i></label>
                        <input type="text" id="woter_no" name="woter_no"
                               value="{{ $center->woter_no }}" class="form-control" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="left_electric_no"> حساب
                            اخر للمصاعد
                        </label>
                        <input type="text" id="left_electric_no"
                               name="left_electric_no"
                               value="{{ $center->left_electric_no }}"
                               class="form-control" />
                    </div>
                    <div class="col-md-6">
                        <label for="file" class="form-label"> صورة</label>
                        <input type="file"
                               accept=".jpg, .jpeg, .pdf, image/jpeg, application/pdf"
                               name="file" id="imgFile"
                               onchange="validate_and_loadFile(event,this.id)"
                               class="form-control">
                        <img id="imgFile_view" width="150px" height="100px"
                             border="4" hidden />
                    </div>
                    <div class="col-md-12">
                        <label for="othercontents" class="form-label">
                            تحتوي على </label>
                        <br>
                        <?php $arr = explode(',', $center->othercontents);
                        ?>
                        @foreach ($others as $row)
                            <input type="checkbox" class="checkbox"
                                   @if (in_array($row->id, $arr)) {{ 'checked' }} @endif
                                   name="othercontents[]" value="{{ $row->id }}">
                            {{ $row->name }}

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @endforeach

                    </div>


                    <div class="col-md-12">
                        <label class="form-label" for="notes"> ملاحظات
                        </label>
                        <textarea id="notes" name="notes" class="form-control">{{ $center->notes }}</textarea>
                    </div>

                </div>


                        <div class="pt-4">
                          <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light"><i class="fa-solid fa-floppy-disk pe-2"></i> حفظ</button>
                          <a class="btn btn-label-secondary waves-effect" href="{{ route('centers.index') }}"><i class="fa-solid fa-xmark pe-2"></i> الغاء</a>

                        </div>

   <!--   <div class="mb-3">


      <div class="col-md-6 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">حفظ  <i class="fa-solid fa-floppy-disk"></i> </button>
        </div>
    </div>-->
</div>
</div>
</div>
</div>
</div>
</form>


@endsection
