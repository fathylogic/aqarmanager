@extends('errors.layout')

@section('code', '404')

@section('content')
    <h1>404</h1>
    <p>الصفحة التي تحاول الوصول إليها غير موجودة</p>

    <div class="d-flex justify-content-center gap-3">
        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : url('/') }}"
           class="btn btn-outline-secondary">
            ⬅ رجوع
        </a>
&nbsp;&nbsp;&nbsp;

        <a href="{{ url('/') }}" class="btn btn-primary">
            🏠 الصفحة الرئيسية
        </a>
    </div>
@endsection
