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
    <?php $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; ?>

    <form method="POST" action="{{ route('sarfs.update',$sarf->id) }}" enctype="multipart/form-data">
        @csrf
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

                                        <div class="form-check col-md-2 form-check-inline">
                                            <input   type="hidden" required name="source_type_id" value="2">
                                            <input class="form-check-input" type="hidden" required name="sarf_type_id"  value="4">
                                            <label class="form-check-label" for="inlineRadio2"> العهد المالية </label>
                                        </div>
                                        <div class="form-check form-check-inline col-md-6 ohdafrom" >

                                            <select id="from_ohda_id" name="from_ohda_id"
                                                    class="select2 form-select w-100 ohdafrom" data-allow-clear="true">
                                                <option value="">اختر </option>
                                                @foreach ($ohdas as $row)
                                                    <option value="{{ $row->id }}" @if($sarf->from_ohda_id == $row->id) {{'selected'}}@endif >{{ $row->employee->name }}
                                                        ({{ $row->purpose }})
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>





                                <div class="col-md-11 border rounded       mb-1 sarftype4" >
                                    {{-- خدمات --}}
                                    <div class="row m-2">
                                        <div class="col-md-4">
                                            <label class="form-label" for="service_type_id">  نوع الخدمة </label>

                                            <select id="service_type_id"  required name="service_type_id"
                                                    class="select2 form-select" data-allow-clear="true">
                                                <option value="">اختر </option>
                                                @foreach ($serviceTypes as $row)
                                                    <option value="{{ $row->id }}"  @if($sarf->service_type_id == $row->id) {{'selected'}}@endif >{{ $row->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="center_id">    المركز الربحي </label>

                                            <select id="center_id" required  name="center_id" onchange="fn_get_units(this.value)"
                                                    class="select2 form-select" data-allow-clear="true">
                                                <option value="">اختر </option>
                                                @foreach ($centers as $row)
                                                    <option value="{{ $row->id }}" @if($sarf->center_id == $row->id) {{'selected'}}@endif >{{ $row->center_name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="col-md-4" id="uint_div" style="display: none">
                                            <label class="form-label" for="unit_id">    الشفة   </label>

                                            <select id="unit_id"   name="unit_id"
                                                    class="select2 form-select" data-allow-clear="true">


                                            </select>

                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-11 border rounded       mb-1 ">
                                    {{-- بيانات الصرف  --}}
                                    <div class="row mb-2 m-2" >

                                        <div class="col-md-4">
                                            <label class="form-label" for="amount"> المبلغ </label>
                                            <input type="text" id="amount" value="{{$sarf->amount}}" name="amount" required
                                                   class="form-control" />
                                        </div>

                                        <x-datepicker
                                            name_g="p_date"
                                            name_h="p_dateh"
                                            start_g="{{$sarf->p_date}}"
                                            start_h=""
                                            col="4"
                                            label=" الدفع"
                                        />





                                        <div class="col-md-4">
                                            <label class="form-label" for="payment_type"> طريقة الدفع </label>

                                            <select id="payment_type" required name="payment_type"
                                                    class="select2 form-select" data-allow-clear="true">
                                                <option value="">اختر </option>
                                                @foreach ($payment_types as $row)
                                                    <option value="{{ $row->id }}"   @if($sarf->payment_type == $row->id) {{'selected'}}@endif  >{{ $row->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="s_desc"> البيان </label>
                                            <input type="text" id="s_desc" name="s_desc" value="{{$sarf->s_desc}}" required
                                                   class="form-control">

                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="receved_by"> المستلم </label>
                                            <input type="text" id="receved_by" name="receved_by" value="{{$sarf->receved_by}}" required
                                                   class="form-control">

                                        </div>


                                        <div class="col-md-6">
                                            <label for="file" class="form-label"> صورة الفاتورة </label>
                                            <input type="file" accept=".jpg, .jpeg, .pdf, image/jpeg, application/pdf" name="file"
                                                   id="imgFile" onchange="validate_and_loadFile(event,this.id)" class="form-control">

                                        </div>
                                        <div class="col-md-6">
                                            <img id="imgFile_view" width="150px" height="100px" border="4" hidden />
                                        </div>
                                        @if($sarf->img!='')
                                            <div class="col-md-12">
                                                <br><br>
                                     <span class="align-middle ms-1">
                                                        <a   href="<?= asset('storage/' . $sarf->img) ?>" target="_blank" class="btn btn-sm btn-primary"><i
                                                                class="fa-regular fa fa-eye pe-2"></i>
                                                            عرض الفاتورة </a></span>



                                            </div>
                                        @endif


                                    </div>



                                </div>







                                <div class="col-md-4 text-unit">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">
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







    </script>
@endsection
