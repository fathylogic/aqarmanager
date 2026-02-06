@extends('errors.layout')

@section('code', '419')

@section('content')
    <h1>419</h1>
    <p>انتهت صلاحية الجلسة</p>
    <p>يرجى تحديث الصفحة وإعادة المحاولة</p>

    <div class="d-flex justify-content-center gap-3">
        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : url('/') }}"
           class="btn btn-outline-secondary">
            ⬅ رجوع
        </a>


        <a href="{{ url('/') }}" class="btn btn-primary">
            🏠 الصفحة الرئيسية
        </a>
    </div>
@endsection
