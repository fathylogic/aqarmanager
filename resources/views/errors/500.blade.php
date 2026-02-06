@extends('errors.layout')

@section('code', '500')

@section('content')
    <h1>500</h1>
    <p>حدث خطأ غير متوقع في النظام</p>
    <p>يرجى المحاولة لاحقًا</p>

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
