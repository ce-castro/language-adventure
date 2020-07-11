@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/square/blue.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('title')
    Edit a Category
@endsection

@section('h1')
    Edit a Category
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('categories.index') }}">Categories</a></li>
        <li class="active">Edit a Category</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                @include('admin.layouts.errors')
                <form class="form-horizontal" method="post" action="{{ route('categories.update', $category->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="box-body">
                        <div class="form-group @if ($errors->has('name')) has-error @endif required">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $category->name }}" onchange="convert()">
                                @if ($errors->has('name'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('name')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('url')) has-error @endif required">
                            <label for="url" class="col-sm-2 control-label">URL</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="url" name="url"
                                       value="{{ $category->url }}">
                                @if ($errors->has('url'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('url')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('desc_top')) has-error @endif required">
                            <label for="desc_top" class="col-sm-2 control-label">Description Top</label>
                            <div class="col-sm-10">
                                <textarea name="desc_top" id="desc_top" class="form-control ckeditor">{{ $category->desc_top }}</textarea>
                                @if ($errors->has('desc_top'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('desc_top')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('desc_bottom')) has-error @endif required">
                            <label for="desc_bottom" class="col-sm-2 control-label">Description Bottom</label>
                            <div class="col-sm-10">
                                <textarea name="desc_bottom" id="desc_bottom" class="form-control ckeditor">{{ $category->desc_bottom }}</textarea>
                                @if ($errors->has('desc_bottom'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('desc_bottom')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-6">
                            <label for="inputActive" class="col-sm-4 control-label">Active</label>
                            <div class="col-sm-8">
                                <div class="checkbox icheck">
                                    <label><input type="checkbox" value="1" name="status"
                                                  @if ($category->status == 1) checked @endif> </label>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('status')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <h3>Meta Tags: </h3>
                        </div>

                        <div class="form-group @if ($errors->has('keywords')) has-error @endif col-sm-6">
                            <label for="keywords" class="col-sm-2 control-label">Keywords:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="keywords" placeholder="Keywords"
                                       name="keywords" value="{{ $category->keywords  }}">
                                @if ($errors->has('keywords'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('keywords')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('description_html')) has-error @endif col-sm-6">
                            <label for="description_html" class="col-sm-2 control-label">Description HTML</label>
                            <div class="col-sm-10">
                                <textarea name="description_html" id="description_html"
                                          class="form-control">{{ $category->description_html }}</textarea>
                                @if ($errors->has('description_html'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description_html')}}</span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <a href="{{ route('categories.index') }}" class="btn btn-default btn-flat"><i
                                    class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right btn-flat"><i
                                    class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Update
                        </button>
                        <a href="{{ route('categories.delete', $category->id) }}"
                           class="btn btn-danger pull-right btn-flat"
                           onclick="return confirm('Delete {{ $category->name }}?');"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Delete</a>
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
        function convert() {
            //$("#url").val(slug($("#name").val())+".html");
        }
    </script>
@endsection