@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/datatables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/datatables/datatables.min.js') }}"></script>
@endsection

@section('title')
    Users
@endsection

@section('h1')
    Users
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/users">Users</a></li>
        <li class="active">View Users</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        @if (Auth::user()->role_id == 1)
        <div class="box-header">
            <a href="{{ route('users.create') }}" class="btn btn-success btn-flat pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add a User</a>
        </div>
        @endif

        @include('admin.layouts.errors')

        <div class="box-body">
            <table id="data" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Last</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Edit</th>
                    @if (Auth::user()->role_id == 1)
                    <th>Delete</th>
                    @endif
                </tr>
                </thead>

                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->role }}</td>
                    <td><a href="{{ route('users.edit', $user->id) }}" title="Edit {{ $user->name }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                    @if (Auth::user()->role_id == 1)
                    <td><a href="{{ route('users.delete', $user->id) }}" title="Delete {{ $user->name }}" onclick="return confirm('Are you sure?');"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    @endif
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#data').DataTable({
                stateSave: true,
                order: [[ 1, "asc" ]],
                "columns": [
                    null,
                    null,
                    null,
                    null,
                    { "width": "40px" },
                    { "width": "40px" }
                ]
            });
        })
    </script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection
