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
    Schools
@endsection

@section('h1')
    Schools
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/schools"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('schools.index') }}">School Info</a></li>
        <li class="active">View School</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        @if (Auth::user()->role_id == 1)
        <div class="box-header">
            <a href="{{ route('schools.create') }}" class="btn btn-success btn-flat pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add an New School</a>
        </div>
        @endif

        @include('admin.layouts.errors')

            <div class="box-body">
                <table id="data" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Status</th>
                        <th style="width: 45px">Edit</th>
                        @if (Auth::user()->role_id == 1)
                        <th style="width: 45px">Delete</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($schools as $school)
                        <tr>
                            <td>{{ $school->name }}</td>
                            <td>{{ $school->country['name'] }}</td>
                            <td>{{ $school->city }}</td>
                            <td>@if ($school->status == 1)
                                    Published
                                @else
                                    Draft
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('schools.edit', [$school->id, 'tab_1']) }}" title="Edit {{ $school->name }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </td>
                            @if (Auth::user()->role_id == 1)
                            <td class="text-center">
                                <a href="{{ route('schools.delete', $school->id) }}" title="Delete {{ $school->name }}" onclick="return confirm('Delete {{ $school->name }}?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

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
                    null,
                    null,
                    { "width": "40px" },
                    { "width": "40px" }
                ]
            });
        })
    </script>
    <script>
        $(".fancy1").fancybox({
            iframe : {
                css : {
                    width : '800px',
                    height : '515px'
                }
            }
        });
        $(".fancy2").fancybox({
            iframe : {
                css : {
                    width : '800px',
                    height : '390px'
                }
            }
        });
    </script>
@endsection
