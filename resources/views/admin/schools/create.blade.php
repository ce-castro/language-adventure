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
    Add a School
@endsection

@section('h1')
    Add a School
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/school">School</a></li>
        <li class="active">Add a School</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <form class="form-horizontal" method="post" action="{{ route('schools.store') }}"
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

                        <div class="form-group @if ($errors->has('city')) has-error @endif required col-sm-12">
                            <label for="city" class="col-sm-2 control-label">City</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="url" placeholder="City" name="city"
                                       value="{{ old('city') }}">
                                @if ($errors->has('city'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('city')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('country_id')) has-error @endif col-sm-12 required">
                            <label for="country_id" class="col-sm-2 control-label">Country</label>
                            <div class="col-sm-10">
                                <select name="country_id" id="country_id" class="form-control" multiple="multiple">
                                    <option value="">Please select..</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}"  @if($country->id == old('country_id')) selected @endif>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country_id'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('country_id')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('user_id')) has-error @endif required col-sm-12">
                            <label for="user_id" class="col-sm-2 control-label">User</label>
                            <div class="col-sm-10">
                                <select name="user_id" id="user_id" class="form-control" multiple="multiple">
                                    <option value="">Please select..</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if($user->id == old('user_id')) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('user_id'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('user_id')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-12">
                            <label for="status" class="col-sm-2 control-label">Draft</label>
                            <div class="col-sm-10">
                                <div class="checkbox icheck">
                                    <label><input type="checkbox" value="1" name="status"  @if ( old('status') == 1) checked @endif></label>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('status')}}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <a href="{{ route('schools.index') }}" class="btn btn-default btn-flat"><i
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
            $('.select2').select2();
            $("#country_id").select2({
                maximumSelectionLength: 1
            });
            $("#user_id").select2({
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
            CKEDITOR.replace('.ckeditor');
        })
    </script>
@endsection
