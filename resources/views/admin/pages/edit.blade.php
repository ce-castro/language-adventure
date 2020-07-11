@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/fancybox/jquery.fancybox.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('title')
    Edit a Page
@endsection

@section('h1')
    Edit a Page
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('pages.index') }}">Pages</a></li>
        <li class="active">Edit a Page</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit a Page</h3>
                </div>

                <form class="form-horizontal" method="post" action="{{ route('pages.update', $page->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="box-body">

                        <div class="form-group @if ($errors->has('title')) has-error @endif required">
                            <label for="title" class="col-sm-2 control-label">Page Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" value="{{ $page->title }}" >
                                @if ($errors->has('title'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('title')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('url')) has-error @endif required">
                            <label for="url" class="col-sm-2 control-label">URL</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="url" name="url" value="{{ $page->url }}">
                                @if ($errors->has('url'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('url')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('content')) has-error @endif required col-sm-12">
                            <label for="content" class="col-sm-2 control-label">Content</label>
                            <div class="col-sm-10">
                                <textarea name="content" id="content" class="form-control ckeditor">{{ $page->content }}</textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('content')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-6">
                            <label for="inputActive" class="col-sm-4 control-label">Active</label>
                            <div class="col-sm-8">
                                <div class="checkbox icheck">
                                    <label><input type="checkbox" value="1" name="status" @if ($page->status == 1) checked @endif> </label>
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
                                <input type="text" class="form-control" id="keywords" placeholder="Keywords" name="keywords" value="{{ $page->keywords  }}">
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
                                <textarea name="description_html" id="description_html" class="form-control">{{ $page->description_html }}</textarea>
                                @if ($errors->has('description_html'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description_html')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ route('pages.index') }}" class="btn btn-default btn-flat"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right btn-flat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Update</button>
                        <a href="{{ route('pages.delete', $page->id) }}" class="btn btn-danger pull-right btn-flat" onclick="return confirm('Delete {{ $page->title_page }}?');"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Delete</a>
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
            //$("#url").val(slug($("#name").val())+".html");
        }
    </script>
@endsection