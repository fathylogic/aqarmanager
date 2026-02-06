@extends('errors.layout')

@section('code', $exception->getStatusCode())

@section('content')
    <h1>{{ $exception->getStatusCode() }}</h1>
    <p>{{ $exception->getMessage() ?: 'حدث خطأ غير متوقع' }}</p>

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
