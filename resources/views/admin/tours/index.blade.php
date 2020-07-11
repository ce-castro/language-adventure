@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/datatables/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/datatables/datatables.min.js') }}"></script>
@endsection

@section('title')
    Tours
@endsection

@section('h1')
    Tours
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('tours.index') }}">Tours</a></li>
        <li class="active">View Tours</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <a href="{{ route('tours.create') }}" class="btn btn-success btn-flat pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add a Tour</a>
        </div>

        @include('admin.layouts.errors')

        <div class="box-body">
            <table id="data" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Tour</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>

                @foreach($tours as $tour)
                <tr>
                    <td>{{ $tour->name }}</td>
                    <td>
                        @foreach ($tour->categories as $category)
                            @if($loop->last)
                                {{ $category->name }}
                            @else
                                {{ $category->name }},
                            @endif
                        @endforeach
                    </td>
                    <td>@if ($tour->status == 1)
                            Active
                        @else
                            Inactive
                        @endif
                    </td>
                    <td><a href="{{ route('tours.edit', [$tour->id, 'tab_1']) }}" title="Edit {{ $tour->name }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                    <td><a href="{{ route('tours.delete', $tour->id) }}" title="Delete {{ $tour->name }}" onclick="return confirm('Delete {{ $tour->name }}?');"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
                order: [[ 0, "asc" ]],
                "columns": [
                    null,
                    { "width": "200px" },
                    { "width": "40px" },
                    { "width": "40px" },
                    { "width": "40px" }
                ]
            });
        })
    </script>
@endsection