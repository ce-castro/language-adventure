@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/square/blue.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('title')
    Add a Page
@endsection

@section('h1')
    Add a Page
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/pages">Pages</a></li>
        <li class="active">Add a Page</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Add a Page</h3>
                </div>

                <form class="form-horizontal" method="post" action="{{ route('pages.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">

                        <div class="form-group @if ($errors->has('title')) has-error @endif required col-sm-12">
                            <label for="title" class="col-sm-2 control-label">Page Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" placeholder="Page Title" name="title" onchange="convert()" value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('title')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('url')) has-error @endif required col-sm-12">
                            <label for="url" class="col-sm-2 control-label">URL</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="url" placeholder="URL" name="url" value="{{ old('url') }}">
                                @if ($errors->has('url'))
                                <span class="help-block"><i class="fa fa-times-circle-o"></i>{{ $errors->first('url')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('content')) has-error @endif required col-sm-12">
                            <label for="content" class="col-sm-2 control-label">Content</label>
                            <div class="col-sm-10">
                                <textarea name="content" id="content" class="form-control ckeditor">{{ old('content') }}</textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('content')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-12">
                            <label for="status" class="col-sm-2 control-label">Active</label>
                            <div class="col-sm-10">
                                <div class="checkbox icheck">
                                    <label><input type="checkbox" value="1" name="status" @if ( old('status') == 1) checked @endif></label>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('status')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr >
                            <h3>Meta Tags: </h3>
                        </div>

                        <div class="form-group @if ($errors->has('keywords')) has-error @endif col-sm-6">
                            <label for="keywords" class="col-sm-2 control-label">Keywords:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="keywords" placeholder="Keywords" name="keywords" value="{{ old('keywords') }}">
                                @if ($errors->has('keywords'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('keywords')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('image_og')) has-error @endif col-sm-6">
                            <label for="image_og" class="col-sm-2 control-label">Image OG</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image_og" name="image_og">
                                @if ($errors->has('image_og'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('image_og') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('description_html')) has-error @endif col-sm-6">
                            <label for="description_html" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description_html" id="description_html" class="form-control">{{ old('description_html') }}</textarea>
                                @if ($errors->has('description_html'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description_html')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ route('pages.index') }}" class="btn btn-default btn-flat"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right btn-flat"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Create</button>
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
        $(function () {
            CKEDITOR.replace('.ckeditor')
        })
    </script>
    <script>
        function convert(){
            $("#url").val(slug($("#title").val()) + ".html");
        }
    </script>
@endsection