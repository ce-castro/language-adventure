@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/square/blue.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('title')
    Add a Category
@endsection

@section('h1')
    Add a Category
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/carts">Categories</a></li>
        <li class="active">Add a Category</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <form class="form-horizontal" method="post" action="{{ route('categories.store') }}"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">

                        <div class="form-group @if ($errors->has('name')) has-error @endif required col-sm-12">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                       onchange="convert()" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('name')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('url')) has-error @endif required col-sm-12">
                            <label for="url" class="col-sm-2 control-label">URL</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="url" placeholder="URL" name="url"
                                       value="{{ old('url') }}">
                                @if ($errors->has('url'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('url')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('desc_top')) has-error @endif required col-sm-12">
                            <label for="desc_top" class="col-sm-2 control-label">Description Top</label>
                            <div class="col-sm-10">
                                <textarea name="desc_top" id="desc_top"
                                          class="form-control ckeditor">{{ old('desc_top') }}</textarea>
                                @if ($errors->has('desc_top'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('desc_top')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('desc_bottom')) has-error @endif required col-sm-12">
                            <label for="desc_bottom" class="col-sm-2 control-label">Description Bottom</label>
                            <div class="col-sm-10">
                                <textarea name="desc_bottom" id="desc_bottom" class="form-control ckeditor">{{ old('desc_bottom') }}</textarea>
                                @if ($errors->has('desc_bottom'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('desc_bottom')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-6">
                            <label for="status" class="col-sm-4 control-label">Active</label>
                            <div class="col-sm-8">
                                <div class="checkbox icheck">
                                    <label><input type="checkbox" value="1" name="status"
                                                  @if ( old('status') == 1) checked @endif></label>
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
                                       name="keywords" value="{{ old('keywords') }}">
                                @if ($errors->has('keywords'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('keywords')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('description_html')) has-error @endif col-sm-6">
                            <label for="description_html" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description_html" id="description_html"
                                          class="form-control">{{ old('description_html') }}</textarea>
                                @if ($errors->has('description_html'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description_html')}}</span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <a href="{{ route('categories.index') }}" class="btn btn-default btn-flat"><i
                                    class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</a>
                        <button type="submit" class="btn btn-success pull-right btn-flat"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Save
                        </button>
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
            CKEDITOR.replace('.ckeditor');
        })
    </script>
@endsection