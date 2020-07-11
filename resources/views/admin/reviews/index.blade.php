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
    Reviews
@endsection

@section('h1')
    Reviews
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('reviews.index') }}">Reviews</a></li>
        <li class="active">View Pages</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <a href="{{ route('reviews.create') }}" class="btn btn-success btn-flat pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add a Review</a>
        </div>

        @include('admin.layouts.errors')

        <div class="box-body">
            <table id="data" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Tour</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Stars</th>
                    <th>Status</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reviews as $review)
                <tr>
                    <td>{{ $review->tours->name }}</td>
                    <td>{{ $review->name}}</td>
                    <td>{{ $review->country }}</td>
                    <td>{{ $review->stars }}</td>
                    <td>@if ($review->status == 1)
                            Active
                        @else
                            Inactive
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="/uploads/{{ $review->image }}" title="Preview" data-fancybox="gallery"><i class="fa fa-picture-o" aria-hidden="true" title="View Image"></i></a>
                    </td>
                    <td class="text-center"><a href="{{ route('reviews.edit', $review->id) }}" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                    <td class="text-center"><a href="{{ route('reviews.delete', $review->id) }}" title="Delete" onclick="return confirm('Delete {{ $review->title }}?');"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
                order: [[ 0, "asc" ]],
                "columns": [
                    null,
                    null,
                    { "width": "110px" },
                    { "width": "50px" },
                    { "width": "90px" },
                    { "width": "40px" },
                    { "width": "40px" },
                    { "width": "40px" }
                ]
            });
        })
    </script>
@endsection