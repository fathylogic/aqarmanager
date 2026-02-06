@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>إدارة المستخدمين</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success mb-2" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> اضافة مستخدم
                    جديد</a>
            </div>
        </div>
    </div>

    @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
    @endsession

    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            {{-- <table class="datatables-basic table">
    <thead>
                   <tr>
       <th>#</th>
       <th>الاسم</th>
       <th>البريد الالكتروني</th>
       <th>نوع المستخدم</th>
       <th width="280px">اجراءات</th>
   </tr>
                  </thead>
                  <tbody>

   @foreach ($data as $key => $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          @if ($user->is_admin)

               <label class="badge bg-success">مدير</label>

          @endif
        </td>
        <td>
             <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}"><i class="fa-solid fa-list"></i> عرض</a>
             <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i class="fa-solid fa-pen-to-square"></i> تعديل</a>
             <a class="btn btn-primary btn-sm" href="{{ route('salahyat',$user->id) }}"><i class="fa-solid fa-pen-to-square"></i> صلاحيات</a>
              <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                  @csrf
                  @method('DELETE')

                  <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> حذف</button>
              </form>
        </td>
    </tr>
</tbody>
 @endforeach
</table>
 --}}



            <table class="table table-striped  display responsive nowrap FathyTable ">
                <thead>
                    <tr>

                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد</th>
                        <th>نوع المستخدم</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                        <tr>

                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->is_admin)
                                    <label class="badge bg-success">مدير</label>
                                @endif
                            </td>

                            <td>

                                <a href="{{ route('users.edit', $user->id) }}" ><i
                                        class="fa-solid fa-circle-info"></i> تعديل</a>

                                <a href="{{ route('users.destroy', $user->id) }}"
                                    class=" text-danger delete-record"><i class="fa-solid fa-trash-can"></i>
                                    حذف</a>

                            </td>

                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد</th>
                        <th>نوع المستخدم</th>
                        <th>إجراءات</th>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>


    <script>
        


    @endsection
