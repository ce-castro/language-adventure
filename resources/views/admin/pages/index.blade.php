@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/fancybox/jquery.fancybox.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/fancybox/jquery.fancybox.min.js') }}"></script>
@endsection

@section('title')
    Pages
@endsection

@section('h1')
    Pages
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('pages.index') }}">Pages</a></li>
        <li class="active">View Pages</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <a href="{{ route('pages.create') }}" class="btn btn-success btn-flat pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add a Page</a>
        </div>

        @include('admin.layouts.errors')

        <div class="box-body">
            <table id="data" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Page</th>
                    <th>URL</th>
                    <th>Status</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pages as $page)
                <tr>
                    <td>{{ $page->title}}</td>
                    <td>{{ $page->url }}</td>
                    <td>@if ($page->status == 1)
                            Active
                        @else
                            Inactive
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="/uploads/{{ $page->image_og }}" title="Preview {{ $page->title }}" data-fancybox="gallery"><i class="fa fa-picture-o" aria-hidden="true" title="View OG Image"></i></a>
                    </td>
                    <td class="text-center"><a href="{{ route('pages.edit', $page->id) }}" title="Edit {{ $page->title }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                    <td class="text-center"><a href="{{ route('pages.delete', $page->id) }}" title="Delete {{ $page->title }}" onclick="return confirm('Delete {{ $page->title }}?');"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
                @endforeach
                </tbody>
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
                    { "width": "40px" },
                    { "width": "40px" },
                    { "width": "40px" }
                ]
            });
        })
    </script>
@endsection