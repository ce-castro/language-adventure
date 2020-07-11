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
    Add a Review
@endsection

@section('h1')
    Add a Review
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/reviews">Reviews</a></li>
        <li class="active">Add a Review</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Add a Review</h3>
                </div>

                <form class="form-horizontal" method="post" action="{{ route('reviews.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">

                        <div class="form-group @if ($errors->has('tour_id')) has-error @endif required col-sm-12">
                            <label for="tour" class="col-sm-2 control-label">Tour</label>
                            <div class="col-sm-10">
                                <select name="tour_id" id="tour_id" class="form-control select2">
                                    <option value="">Please select..</option>
                                    @foreach($tours as $tour)
                                        <option value="{{ $tour->id }}" @if($tour->id == old('tour_id')) selected @endif>{{ $tour->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('tour_id'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('tour_id')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('name')) has-error @endif required col-sm-12">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" placeholder="Customer Name" name="name"  value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('name')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('stars')) has-error @endif required col-sm-5">
                            <label for="stars" class="col-sm-5 control-label">Stars</label>
                            <div class="col-sm-7">
                                <input type="number" step="1" max="5" min="0" class="form-control" id="stars" placeholder="Stars" name="stars" value="{{ old('stars') }}">
                                @if ($errors->has('stars'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i>{{ $errors->first('stars')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('country')) has-error @endif required col-sm-7">
                            <label for="country" class="col-sm-2 control-label">Country</label>
                            <div class="col-sm-10">
                                <select name="country" id="country" class="form-control select2">
                                    <option value="">Please select..</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->name }}"
                                                @if($country->name == old('country')) selected @endif>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country'))
                                <span class="help-block"><i class="fa fa-times-circle-o"></i>{{ $errors->first('country')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('review')) has-error @endif required col-sm-12">
                            <label for="review" class="col-sm-2 control-label">Review</label>
                            <div class="col-sm-10">
                                <textarea name="review" id="review" class="form-control ckeditor">{{ old('review') }}</textarea>
                                @if ($errors->has('review'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('review')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('image')) has-error @endif col-sm-12">
                            <label for="image" class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image" name="image">
                                @if ($errors->has('image'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('image') }}</span>
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

                    </div>

                    <div class="box-footer">
                        <a href="{{ route('reviews.index') }}" class="btn btn-default btn-flat"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</a>
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
            $('.select2').select2();
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
@endsection