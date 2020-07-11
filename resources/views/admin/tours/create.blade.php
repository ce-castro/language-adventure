@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendors/select2/js/select2.full.min.js') }}"></script>
@endsection

@section('title')
    Add a Tour
@endsection

@section('h1')
    Add a Tour
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/carts">Tours</a></li>
        <li class="active">Add a Tour</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-info-circle"
                                                                                 aria-hidden="true"></i> Tour Info</a>
                        </li>
                        <li class="disabled"><a href="#tab_2"><i class="fa fa-picture-o" aria-hidden="true"></i> Images</a>
                        </li>
                        <li class="disabled"><a href="#tab_3"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                Schedules</a></li>
                        <li class="disabled"><a href="#tab_4"><i class="fa fa-usd" aria-hidden="true"></i> Prices</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <form class="form-horizontal" method="post" action="{{ route('tours.store') }}">
                                {{ csrf_field() }}
                                <div class="box-body">

                                    <div class="form-group @if ($errors->has('name')) has-error @endif col-sm-6 required">
                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" placeholder="Name"
                                                   name="name" onchange="convert()" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('url')) has-error @endif col-sm-6 required">
                                        <label for="url" class="col-sm-2 control-label">URL</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="URL"
                                                   name="url" value="{{ old('url') }}">
                                            @if ($errors->has('url'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('url')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-group @if ($errors->has('category_id')) has-error @endif col-sm-6 required">
                                        <label for="category_id" class="col-sm-2 control-label">Category</label>
                                        <div class="col-sm-10">
                                            <select name="category_id" id="category_id" class="form-control select2" multiple="multiple">
                                                <option value="">Please select..</option>
                                                @foreach($listcategories as $category)
                                                    <option value="{{ $category->id }}"
                                                            @if($category->id == old('category_id')) selected @endif>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('category_id')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('sku')) has-error @endif col-sm-6">
                                        <label for="url" class="col-sm-2 control-label">SKU</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="sku" placeholder="SKU #"
                                                   name="sku" value="{{ old('sku') }}">
                                            @if ($errors->has('sku'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('sku')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('country_id')) has-error @endif col-sm-6 required">
                                        <label for="country_id" class="col-sm-2 control-label">Country</label>
                                        <div class="col-sm-10">
                                            <select name="country_id" id="country_id" class="form-control" multiple="multiple">
                                                <option value="">Please select..</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                            @if($country->id == old('country_id')) selected @endif>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('country_id'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('country_id')}}</span>
                                            @endif
                                        </div>
                                    </div>                                    
                                    <div class="form-group @if ($errors->has('recommended')) has-error @endif col-sm-6">
                                        <label for="recommended" class="col-sm-4 control-label">Show in Homepage</label>
                                        <div class="col-sm-6">
                                            <div class="checkbox icheck">
                                                <label><input type="checkbox" value="1" name="recommended"
                                                              @if (old('recommended') == 1) checked @endif></label>
                                            </div>
                                            @if ($errors->has('recommended'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('recommended')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group @if ($errors->has('desc_top')) has-error @endif col-sm-12">
                                        <label for="description" class="col-sm-1 control-label">Desc Top</label>
                                        <div class="col-sm-10">
                                            <textarea name="desc_top" id="desc_top"
                                                      class="form-control ckeditor">{{ old('desc_top') }}</textarea>
                                            @if ($errors->has('desc_top'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('desc_top')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('desc_bottom')) has-error @endif col-sm-12">
                                        <label for="desc_bottom" class="col-sm-1 control-label">Desc Bottom</label>
                                        <div class="col-sm-10">
                                            <textarea name="desc_bottom" id="desc_bottom"
                                                      class="form-control ckeditor">{{ old('desc_bottom') }}</textarea>
                                            @if ($errors->has('desc_bottom'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('desc_bottom')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('available')) has-error @endif col-sm-6">
                                        <label for="available" class="col-sm-2 control-label">Available</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="available"
                                                   placeholder="Available" name="available"
                                                   value="{{ old('available') }}">
                                            @if ($errors->has('available'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('available')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('duration')) has-error @endif col-sm-6">
                                        <label for="url" class="col-sm-2 control-label">Duration</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="duration" placeholder="Duration"
                                                   name="duration" value="{{ old('duration') }}">
                                            @if ($errors->has('duration'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('duration')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('includes')) has-error @endif col-sm-6">
                                        <label for="description" class="col-sm-2 control-label">Include</label>
                                        <div class="col-sm-10">
                                            <textarea name="includes" id="includes"
                                                      class="form-control ckeditor">{{ old('includes') }}</textarea>
                                            @if ($errors->has('includes'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('includes')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('does_not_include')) has-error @endif col-sm-6">
                                        <label for="does_not_include" class="col-sm-2 control-label">Don't Include</label>
                                        <div class="col-sm-10">
                                            <textarea name="does_not_include" id="does_not_include"
                                                      class="form-control ckeditor">{{ old('does_not_include') }}</textarea>
                                            @if ($errors->has('does_not_include'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('does_not_include')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('additional_info')) has-error @endif col-sm-12">
                                        <label for="additional_info" class="col-sm-1 control-label">Additional Info</label>
                                        <div class="col-sm-10">
                                            <textarea name="additional_info" id="additional_info" class="form-control ckeditor">{{ old('additional_info') }}</textarea>
                                            @if ($errors->has('additional_info'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('additional_info')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- <div class="form-group @if ($errors->has('how_to_get')) has-error @endif col-sm-6">
                                        <label for="url" class="col-sm-2 control-label">Map</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="how_to_get" placeholder="How To Get"
                                                   name="how_to_get" value="{{ old('how_to_get') }}">
                                            @if ($errors->has('how_to_get'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('how_to_get')}}</span>
                                            @endif
                                        </div>
                                    </div> --}}

                                    <div class="form-group @if ($errors->has('order')) has-error @endif col-sm-4">
                                        <label for="order" class="col-sm-3 control-label">Order:</label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" id="order" placeholder="Order"
                                                   name="order" value="{{ old('order') }}">
                                            @if ($errors->has('order'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('order')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-6">
                                        <label for="inputActive" class="col-sm-2 control-label">Active</label>
                                        <div class="col-sm-10">
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
                                    <a href="{{ route('tours.index') }}" class="btn btn-default btn-flat"><i
                                                class="fa fa-times-circle-o"
                                                aria-hidden="true"></i>&nbsp;&nbsp;Cancel</a>
                                    <button type="submit" class="btn btn-success pull-right btn-flat"><i
                                                class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Save and
                                        Continue
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(function () {
            $('.select2').select2();
            $("#country_id").select2({
                maximumSelectionLength: 1
            });
        });
        
    </script>
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
            // CKEDITOR.replace('.ckeditor');
            //CKEDITOR.replace('#desc_top', { toolbar: 'basic' });
        })
    </script>
    <script>
        function convert() {
            $("#url").val(slug($("#name").val()) + ".html");
        }
    </script>

@endsection