@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
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
                        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i> Tour Info</a></li>
                        <li class="disabled"><a href="#tab_2"><i class="fa fa-picture-o" aria-hidden="true"></i> Images</a></li>
                        <li class="disabled"><a href="#tab_3"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Schedules</a></li>
                        <li class="disabled"><a href="#tab_4"><i class="fa fa-usd" aria-hidden="true"></i> Prices</a></li>
                        <li class="disabled"><a href="#tab_5"><i class="fa fa-question-circle" aria-hidden="true"></i> FAQs</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <form class="form-horizontal" method="post" action="{{ route('tours.store') }}">
                                {{ csrf_field() }}
                                <div class="box-body">

                                    <div class="form-group @if ($errors->has('name')) has-error @endif col-sm-6 required">
                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" onchange="convert()" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('url')) has-error @endif col-sm-6 required">
                                        <label for="url" class="col-sm-2 control-label">URL</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="URL" name="url" value="{{ old('url') }}">
                                            @if ($errors->has('url'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('url')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('category_id')) has-error @endif col-sm-6 required">
                                        <label for="category_id" class="col-sm-2 control-label">Category</label>
                                        <div class="col-sm-10">
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Please select..</option>
                                                @foreach($listcategories as $category)
                                                    <option value="{{ $category->id }}" @if($category->id == old('category_id')) selected @endif>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('category_id')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('sub_category_id')) has-error @endif col-sm-6">
                                        <label for="sub_category_id" class="col-sm-2 control-label">Sub Cat</label>
                                        <div class="col-sm-10">
                                            <select name="sub_category_id" id="sub_category_id" class="form-control">
                                                <option value="">Please select..</option>
                                                @foreach($listsub as $sub)
                                                    <option value="{{ $sub->id }}" @if($sub->id == old('sub_category_id')) selected @endif>{{ $sub->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('sub_category_id'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('sub_category_id')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('sku')) has-error @endif col-sm-6 required">
                                        <label for="url" class="col-sm-2 control-label">SKU</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="sku" placeholder="SKU #" name="sku" value="{{ old('sku') }}">
                                            @if ($errors->has('sku'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('sku')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('runs')) has-error @endif col-sm-6">
                                        <label for="runs" class="col-sm-2 control-label">Runs</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="runs" placeholder="Runs" name="runs" value="{{ old('runs') }}">
                                            @if ($errors->has('runs'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('runs')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('duration')) has-error @endif col-sm-6">
                                        <label for="duration" class="col-sm-2 control-label">Duration</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="duration" placeholder="Duration" name="duration" value="{{ old('duration') }}">
                                            @if ($errors->has('duration'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('duration')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                <div class="form-group @if ($errors->has('departs')) has-error @endif col-sm-6">
                                    <label for="departs" class="col-sm-2 control-label">Departs</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="departs" placeholder="Departs" name="departs" value="{{ old('departs') }}">
                                        @if ($errors->has('departs'))
                                            <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('departs')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group @if ($errors->has('orden')) has-error @endif col-sm-6 required">
                                    <label for="orden" class="col-sm-2 control-label">Order:</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="orden" placeholder="Order" name="orden" value="{{ old('orden') }}">
                                        @if ($errors->has('orden'))
                                            <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('orden')}}</span>
                                        @endif
                                    </div>
                                </div>

                                    <div class="form-group @if ($errors->has('kids_age')) has-error @endif col-sm-6">
                                        <label for="kids_age" class="col-sm-2 control-label">Kids Age:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="kids_age" placeholder="Kids age" name="kids_age" value="{{ old('kids_age') }}">
                                            @if ($errors->has('kids_age'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('kids_age')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                <div class="form-group @if ($errors->has('includes')) has-error @endif col-sm-6 required">
                                    <label for="description" class="col-sm-2 control-label">Includes</label>
                                    <div class="col-sm-10">
                                        <textarea name="includes" id="includes" class="form-control ckeditor">{{ old('includes') }}</textarea>
                                        @if ($errors->has('includes'))
                                            <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('includes')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group @if ($errors->has('dont_forget')) has-error @endif col-sm-6">
                                    <label for="dont_forget" class="col-sm-2 control-label">Don't Forget</label>
                                    <div class="col-sm-10">
                                        <textarea name="dont_forget" id="dont_forget" class="form-control ckeditor">{{ old('dont_forget') }}</textarea>
                                        @if ($errors->has('dont_forget'))
                                            <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('dont_forget')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group @if ($errors->has('description')) has-error @endif col-sm-12">
                                    <label for="description" class="col-sm-1 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" id="description" class="form-control ckeditor">{{ old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description')}}</span>
                                        @endif
                                    </div>
                                </div>

                                    <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-6">
                                        <label for="inputActive" class="col-sm-2 control-label">Active</label>
                                        <div class="col-sm-10">
                                            <div class="checkbox icheck">
                                                <label><input type="checkbox" value="1" name="status" @if ( old('status') == 1) checked @endif></label>
                                            </div>
                                            @if ($errors->has('status'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('status')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group @if ($errors->has('hot_deal')) has-error @endif col-sm-6">
                                        <label for="hot_deal" class="col-sm-2 control-label">Hot Deal</label>
                                        <div class="col-sm-10">
                                            <div class="checkbox icheck">
                                                <label><input type="checkbox" value="1" name="hot_deal" @if (old('hot_deal') == 1) checked @endif></label>
                                            </div>
                                            @if ($errors->has('hot_deal'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('hot_deal')}}</span>
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

                                    <div class="form-group @if ($errors->has('title_og')) has-error @endif col-sm-6">
                                        <label for="title_og" class="col-sm-2 control-label">OG Title:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="title_og" placeholder="OG Title" name="title_og" value="{{ old('title_og') }}">
                                            @if ($errors->has('title_og'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('title_og')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('description_tag')) has-error @endif col-sm-6">
                                        <label for="description_tag" class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description_tag" id="description_tag" class="form-control">{{ old('description_tag') }}</textarea>
                                            @if ($errors->has('description_tag'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description_tag')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('description_og')) has-error @endif col-sm-6">
                                        <label for="description_og" class="col-sm-2 control-label">OG Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description_og" id="description_og" class="form-control">{{ old('description_og') }}</textarea>
                                            @if ($errors->has('description_og'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description_og')}}</span>
                                            @endif
                                        </div>
                                    </div>

                            </div>
                                <div class="box-footer">
                                    <a href="{{ route('tours.index') }}" class="btn btn-default btn-flat"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</a>
                                    <button type="submit" class="btn btn-success pull-right btn-flat"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Save and Continue
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
        });
        $(document).ready(function() {
            $("#category_id").change(function() {
                $("#sub_category_id").children('option:not(:first)').remove();

                var el = $(this) ;
                @foreach($listcategories as $category)
                if(el.val() === "{{ $category->id }}" ) {
                    <?php echo \App\Http\Controllers\SubCategoryController::getSubs($category->id); ?>
                }
                @endforeach
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
            CKEDITOR.replace('.ckeditor')
        })
    </script>
    <script>
        function convert() {
            $("#url").val(slug($("#name").val()) + ".html");
        }
    </script>

@endsection