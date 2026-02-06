@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border">
            <div class="card-header  "><h2 class="mb-3">📝 قائمة المهام</h2></div>

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
                        <th>تاريخ تنفيذ المهمة</th>
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
                            <td class="d-flex gap-1">
                                <button
                                    class="btn btn-sm btn-info"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editTodoModal"
                                    data-id="{{ $todo->id }}"
                                    data-title="{{ $todo->title }}"
                                    data-date="{{ $todo->due_date }}"
                                >
                                    ✏ تعديل
                                </button>

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




    <!-- Edit Todo Modal -->
    <div class="modal fade" id="editTodoModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" id="editTodoForm" class="modal-content">
                @csrf
                @method('PATCH')

                <div class="modal-header">
                    <h5 class="modal-title">✏ تعديل المهمة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">عنوان المهمة</label>
                        <input type="text" name="title" id="edit_title" class="form-control" required>
                    </div>

                    <x-datepicker
                        name_g="edit_due_date"
                        name_h="edit_due_dateh"
                        start_id_g="edit_due_date"
                        start_g=""
                        col="12"
                        label="المهمة"
                    />
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">💾 حفظ</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editModal = document.getElementById('editTodoModal');

            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                const id    = button.getAttribute('data-id');
                const title = button.getAttribute('data-title');
                const date  = button.getAttribute('data-date');

                document.getElementById('edit_title').value = title;
                document.getElementById('edit_due_date').value = date;

                document.getElementById('editTodoForm').action =
                    `/todos/${id}`;
            });
        });
    </script>

@endsection
