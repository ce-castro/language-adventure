@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/datatables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/datatables/datatables.min.js') }}"></script>
@endsection

@section('title')
    Categories
@endsection

@section('h1')
    Categories
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('categories.index') }}">Categories</a></li>
        <li class="active">View Categories</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <a href="{{ route('categories.create') }}" class="btn btn-success btn-flat pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add a Category</a>
        </div>

        @include('admin.layouts.errors')

        <div class="box-body">
            <table id="data" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>

                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>@if ($category->status == 1)
                            Active
                        @else
                            Inactive
                        @endif
                    </td>
                    <td><a href="{{ route('categories.edit', [$category->id, 'tab_1']) }}" title="Edit {{ $category->name }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                    <td><a href="{{ route('categories.delete', $category->id) }}" title="Delete {{ $category->name }}" onclick="return confirm('Delete {{ $category->name }}?');"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
                    { "width": "40px" },
                    { "width": "40px" }
                ]
            });
        })
    </script>
@endsection