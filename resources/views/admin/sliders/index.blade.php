<?php
function bytesToHuman($bytes){
    $units = ['B', 'KB', 'MB'];

    for ($i = 0; $bytes > 1024; $i++) {
        $bytes /= 1024;
    }

    return round($bytes, 2) . ' ' . $units[$i];
}
?>
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
    Home Sliders
@endsection

@section('h1')
    Home Sliders
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('sliders.index') }}">Sub Slider</a></li>
        <li class="active">View Slider</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <a href="{{ route('sliders.create') }}" class="btn btn-success btn-flat pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add an Image Slider</a>
        </div>

        @include('admin.layouts.errors')

            <div class="box-body">
                <table id="data" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Dimension</th>
                        <th>Size</th>
                        <th>Status</th>
                        <th style="width: 45px">Edit</th>
                        <th style="width: 45px">View</th>
                        <th style="width: 45px">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sliders as $slider)
                        <?php
                        $filename = "http://".$_SERVER['SERVER_NAME']."/uploads/".$slider->image;
                        /*echo $filename;
                        if (file_exists($filename)){*/
                            //echo "Entra";
                            $size = getimagesize($filename);
                        /*} else{
                            $size[0]="0"; $size[1]="0";
                        }*/

                        ?>
                        <tr>
                            <td>{{ $slider->title }}</td>
                            <td>
                                <?php echo $size[0]; ?>px by <?php echo $size[1]; ?>px
                            </td>
                            <td><?php echo bytesToHuman($slider->size); ?></td>
                            <td>@if ($slider->status == 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('sliders.edit', $slider->id) }}" title="Edit {{ $slider->title }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo $filename; ?>" title="Preview {{ $slider->title }}" data-fancybox="gallery" data-caption="<strong>{{ $slider->title }}</strong> <br >{{ $slider->description }}"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('sliders.delete', $slider->id) }}" title="Delete {{ $slider->title }}" onclick="return confirm('Delete {{ $slider->title }}?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
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