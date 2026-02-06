@extends('layouts.app')

@section('content')
    <style>
        ul,
        #myUL {
            list-style-type: none;
        }

        #myUL {
            margin: 0;
            padding: 0;
        }

        .caret {
            cursor: pointer;
            -webkit-user-select: none;
            /* Safari 3.1+ */
            -moz-user-select: none;
            /* Firefox 2+ */
            -ms-user-select: none;
            /* IE 10+ */
            user-select: none;
        }

 .caret::before,
.caret-down.caret::before {
    content: "";
    display: inline-block;
    vertical-align: middle;
    margin-right: 8px;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #16a34a content-box;
    padding: 2px;
    box-sizing: border-box;
    background-position: center;
    background-repeat: no-repeat;
}

.caret::before {
    background-image:
        linear-gradient(#fff, #fff),
        linear-gradient(#fff, #fff);
    background-size: 14px 2px, 2px 14px;
}

.caret-down.caret::before {
    background-image: linear-gradient(#fff, #fff);
    background-size: 16px 3px;
}
#myUL li{
    margin: 22px 19px 0px 0px;
}
.nested li{
    margin: 5px 3px 0px 0px !important;
}

        .caret-down::before {
            /* -ms-transform: rotate(90deg);
            /* IE 9 */
            /* -webkit-transform: rotate(90deg); */
            /* Safari */
             /* transform: rotate(90deg); */
        }

        .nested {
            display: none;
        }

        .active {
            display: block;
        }
    </style>
    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة المراكز الرئيسية</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary me-sm-3 me-1" href="{{ route('maincenters.create') }}"><i
                        class="fa fa-plus"></i>&nbsp;
                    اضافة مركز رئيسي جديد</a>
            </div>

            <div class="card">
                <div class="row ">
                    <div class="col-md-8">
                        <ul id="myUL">

                            @foreach ($data as $key => $main)
                                <li><span class="caret h5" onclick="fn_hidediv()">{{ $main->name }}</span>
                                    <span class="badge bg-primary rounded-pill float-end "> عدد العماير :  {{ $main->centers->count() }}
                                    </span>
                                    <a href="{{ route('maincenters.show', $main->id) }}"
                                         class="btn btn-sm btn-warning">
                                        فتح
                                    </a>


                                    <ul class="nested">
                                        @if ($main->centers->count() > 0)
                                            @foreach ($main->centers as $center)
                                                <li>
                                                    <i class="fa fa-circle"></i>&nbsp;
                                                    <a href="{{ route('centers.show', $center->id) }}">
                                                        {{ $center->center_name }}
                                                    </a>

                                                </li>
                                            @endforeach
                                        @endif

                                        <li><a href="#" onclick="fn_creat_new_center({{ $main }}) ; "><i
                                                    class="fa fa-circle-plus"></i>&nbsp;<b> اضافة   عمارة جديدة  </b></a>
                                        </li>
                                    </ul>


                                </li>
                                <br>
                            @endforeach

                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>























    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="creat_new_center">
                    <form method="POST" action="{{ route('maincenters.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="maincenter_id" name="maincenter_id">
                        <div class="container-xxl">
                            <div class="authentication-wrapper authentication-basic container-p-y">
                                <div class="authentication-inner py-4">
                                    <!-- Login -->
                                    <div class="card border">
                                        <div class="card-header">
                                            <h5 id="mctitle"></h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="container-xxl">
                                                <div class="authentication-wrapper authentication-basic container-p-y">
                                                    <div class="authentication-inner py-4">
                                                        <!-- Login -->
                                                        <div class="card border">
                                                            <div class="card-body">

                                                                <div class="row g-3">
                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="center_name">اسم
                                                                            العمارة <i class="fa fa-asterisk "
                                                                                style="color: red"
                                                                                aria-hidden="true"></i></label>
                                                                        <input type="text" name="center_name"
                                                                            class="form-control" required />
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label"
                                                                            for="center_location">المنطقة <i
                                                                                class="fa fa-asterisk " style="color: red"
                                                                                aria-hidden="true"></i></label>
                                                                        <select id="center_location" name="center_location"
                                                                            required class="select2 form-select"
                                                                            data-allow-clear="true">
                                                                            <option value="">اختر</option>
                                                                            @foreach ($locations as $row)
                                                                                <option value="{{ $row->id }}">
                                                                                    {{ $row->name }}</option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="hainame">الحي
                                                                        </label>
                                                                        <input type="text" name="hainame"
                                                                            class="form-control" />

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="street">الشارع
                                                                        </label>
                                                                        <input type="text" name="street"
                                                                            class="form-control" />

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="Building_no">رقم
                                                                            العمارة </label>
                                                                        <input type="text" name="Building_no"
                                                                            class="form-control" />

                                                                    </div>



                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="sak_no"> الموقع
                                                                            على الخريطة </label>
                                                                        <input type="text" name="gps"
                                                                            class="form-control" />

                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="sak_no">رقم الصك
                                                                        </label>
                                                                        <input type="text" name="sak_no"
                                                                            class="form-control" />

                                                                    </div>


                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="electric_no"> حساب
                                                                            شركة الكهرباء <i class="fa fa-asterisk "
                                                                                style="color: red"
                                                                                aria-hidden="true"></i></label>
                                                                        <input type="text" id="electric_no"
                                                                            name="electric_no" class="form-control" />
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="woter_no"> حساب
                                                                            شركة المياة <i class="fa fa-asterisk "
                                                                                style="color: red"
                                                                                aria-hidden="true"></i></label>
                                                                        <input type="text" id="woter_no"
                                                                            name="woter_no" class="form-control" />
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label class="form-label" for="left_electric_no">
                                                                            حساب اخر للمصاعد
                                                                        </label>
                                                                        <input type="text" id="left_electric_no"
                                                                            name="left_electric_no"
                                                                            class="form-control" />
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="file" class="form-label">
                                                                            صورة</label>
                                                                        <input type="file" name="file"
                                                                            id="file" class="form-control">

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
                                                                        <label class="form-label" for="notes"> ملاحظات
                                                                        </label>
                                                                        <textarea id="notes" name="notes" class="form-control"></textarea>
                                                                    </div>

                                                                </div>





                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">الغاء </button>
                                            <button type="submit" name="btn_add_center"
                                                class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">

                                                <i class="fa-solid fa-floppy-disk pe-2"></i>
                                                حفظ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
            });
        }

        function fn_delete_center(id) {
            Swal.fire({
                title: "هل انت متأكد من انك تريد الحذف ?",
                text: "لا يمكنك استرجاعها مرة أخرى!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "إلغاء",
                confirmButtonText: "نعم,  احذف!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "./centers/destroy/" + id
                }
            });
        }

        function fn_hidediv() {


            // $('#objInfo').html('') ;
            $('#mctitle').html('');
            $('#maincenter_id').val('');

        }



        function fn_creat_new_center(row) {
           // console.log(row);


            $('#mctitle').html('المركز الرئيسي: ' + row['name']);
            $('#maincenter_id').val(row['id']);

            $('#exampleModal').modal('show');

        }
    </script>

@endsection
