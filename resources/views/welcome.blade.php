@extends('layout.master')

@section('content')
    <div class="container mt-4">
        <a href="{{route('users.add')}}" class="btn btn-primary" ">
            إضافة مستخدم</a>
        <table class="table table-hover mt-2">
            <thead>
                <th>
                    #
                </th>

                <th>
                    الاسم
                </th>
                <th>
                    البريد الالكتروني
                </th>
                <th>
                    التخصص
                </th>
                <th>
                    الصوره
                </th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @if ($user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>IT</td>
                            <td>
                                @if ($user->image)
                                    <img src="{{ $user->image }}" alt="image" class="rounded-circle"
                                        style="width:60px; height:60px; object-fit:cover;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                               <td> <a href="{{route('users.update.view',$user->id)}}" class="btn btn-primary ">
                             تعديل</a>
                            <a href="{{route('users.delete',$user->id)}}" class="btn btn-danger">
                             حذف</a></</td>
                        </tr>
                    @else
                        <span class="text-muted">No Users</span>
                    @endif
                @endforeach


            </tbody>

        </table>
    </div>

@endsection
