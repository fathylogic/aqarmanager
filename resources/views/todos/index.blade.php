@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border">
            <div class="card-header  "><h2 class="mb-3">📝 To-Do List</h2></div>

            <div class="card-body">
        {{-- إضافة مهمة --}}
        <form method="POST" action="{{ route('todos.store') }}" class="row g-2 mb-4">
            @csrf
            <div class="col-md-4">
                <input type="text" name="title" class="form-control" placeholder="عنوان المهمة" required>
            </div>
            <x-datepicker
                name_g="due_date"
                name_h="due_dateh"
                start_g=""
                col="4"
                label="x"
            />

            <div class="col-md-4">
                <button class="btn btn-primary w-100">➕ إضافة</button>
            </div>
        </form>

        {{-- قائمة المهام --}}
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>المهمة</th>
                <th>الاستحقاق</th>
                <th>الحالة</th>
                <th>إجراء</th>
            </tr>
            </thead>
            <tbody>
            @foreach($todos as $todo)
                <tr class="{{ $todo->is_done ? 'table-success' : '' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $todo->title }}</td>
                    <td>{{ $todo->due_date }}</td>
                    <td>
                        <form method="POST" action="{{ route('todos.update', $todo) }}">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm {{ $todo->is_done ? 'btn-success' : 'btn-warning' }}">
                                {{ $todo->is_done ? '✔ منتهية' : '⏳ قيد التنفيذ' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('todos.destroy', $todo) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">✖ حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
            </div>
        </div>

    </div>
@endsection
