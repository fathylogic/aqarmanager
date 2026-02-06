@extends('layouts.app')

@section('content')
    <style>
        .table-responsive {
            overflow-x: auto;
        }
        .table th,
        .table td {
            white-space: nowrap;
            vertical-align: middle;
        }
        .table {
            table-layout: auto !important;
            width: max-content;
            min-width: 100%;
        }
        .table td .form-control {
            min-width: 90px;
            width: auto;
            display: inline-block;
        }
        .table td input[type="text"] {
            min-width: 90px;
        }
        .table td .btn {
            white-space: nowrap;
        }

    </style>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>تقرير العهد</h2>
            </div>
            <div class="card  mb-3">

                <div class="card-body">

                    <form method="POST" target="_blank" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">

                                <x-datepicker
                                    name_g="from_date"
                                    name_h="from_dateh"
                                    start_g=""
                                    col="4"
                                    label="  من"
                                />

                            <x-datepicker
                                name_g="to_date"
                                name_h="to_dateh"
                                start_g=""
                                col="4"
                                label="  الى "
                            />


                            <div class="col-md-6" id="ohda_selection">
                                <label class="form-label">اختر العهدة</label>
                                <select class="form-select" name="ohda_id" id="ohda_id" required>
                                <option value="">-- اختر العهدة --</option>
                                    @foreach($ohdas as $ohda)
                                        <option value="{{ $ohda->id }}">{{ $ohda->purpose }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12">
                            <button type="submit" name="btn_rpt"
                                        class="btn btn-primary "><i class="fa-solid fa-floppy-disk fa-lg pe-2"></i>  عرض التقرير
                                </button>
                                <button type="reset"
                                        class="btn btn-secondary me-sm-3 me-1 waves-effect waves-light"><i class="fa-solid fa-broom fa-lg pe-2"></i>
                                    أفرغ الحقول
                                </button>
                            </div>

                        </div>
                    </form>

                </div>



            </div>
        </div>
    </div>




@endsection


