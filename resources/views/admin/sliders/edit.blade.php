@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/square/blue.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
@endsection

@section('title')
    Edit a Slider Image
@endsection

@section('h1')
    Edit an Slider Image
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('sliders.index') }}">Image Slider</a></li>
        <li class="active">Edit a Slider Image</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <form class="form-horizontal" method="post" action="{{ route('sliders.update', $slider->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="box-body">
                        <div class="form-group @if ($errors->has('title')) has-error @endif col-sm-12 required">
                            <label for="title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" value="{{ $slider->title }}">
                                @if ($errors->has('title'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('image')) has-error @endif col-sm-12">
                            <label for="image" class="col-sm-2 control-label">Photo</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image" name="image">
                                @if ($errors->has('image'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('url')) has-error @endif col-sm-12">
                            <label for="url" class="col-sm-2 control-label">URL</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="url" name="url" value="{{ $slider->url }}">
                                @if ($errors->has('url'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('url') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('order')) has-error @endif col-sm-6 required">
                            <label for="order" class="col-sm-4 control-label">Order</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="order" name="order" value="{{ $slider->order }}">
                                @if ($errors->has('order'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('order') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-6">
                            <label for="status" class="col-sm-4 control-label">Active</label>
                            <div class="col-sm-8">
                                <div class="checkbox icheck">
                                    <label><input type="checkbox" value="1" name="status" @if ($slider->status == 1) checked @endif id="status"></label>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('status') }}</span>
                                @endif
                            </div>
                        </div>


                    </div>
                    <div class="box-footer">
                        <a href="{{ route('sliders.index') }}" class="btn btn-default btn-flat"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right btn-flat"><i class="fa fa-plus-circle" aria-hidden="true"></i> Update</button>
                        <a href="{{ route('sliders.delete', $slider->id) }}" class="btn btn-danger pull-right btn-flat" onclick="return confirm('Delete {{ $slider->name }}?');"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Delete</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '10%' // optional
            });
        });
    </script>
    <script>
        function convert(){
            //$("#url").val(slug($("#name").val())+".html");
        }
    </script>
@endsection