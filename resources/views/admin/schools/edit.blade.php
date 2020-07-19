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
    Edit a Tour
@endsection

@section('h1')
    Edit a Tour
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/school">School</a></li>
        <li class="active">Edit a School</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li @if (Request::route('tab') == "tab_1") class="active" @endif><a href="#tab_1" data-toggle="tab"><i class="fa fa-globe" aria-hidden="true"></i> Location</a></li>
                        <li @if (Request::route('tab') == "tab_2") class="active" @endif><a href="#tab_2" data-toggle="tab"><i class="fa fa-address-book-o" aria-hidden="true"></i> Overview</a></li>
                    </ul>
                    <div class="tab-content" id="tabs">
                        @include('admin.layouts.errors')
                        <div class="tab-pane @if (Request::route('tab') == "tab_1") active @endif" id="tab_1">
                            <form class="form-horizontal" method="post" action="{{ route('schools.update', $school->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <div class="box-body">
                                    <div class="form-group @if ($errors->has('name')) has-error @endif required col-sm-12">
                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" onchange="convert()" value="{{ $school->name }}">
                                            @if ($errors->has('name'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('abbreviation')) has-error @endif required col-sm-12">
                                        <label for="abbreviation" class="col-sm-2 control-label">Abbreviation</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="abbreviation" placeholder="Abbreviation" name="abbreviation" value="{{ $school->abbreviation }}">
                                            @if ($errors->has('abbreviation'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('abbreviation')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('country_id')) has-error @endif col-sm-12 required">
                                        <label for="country_id" class="col-sm-2 control-label">Country</label>
                                        <div class="col-sm-10">
                                            <select name="country_id" id="country_id" class="form-control"  multiple="multiple">
                                                <option value="">Please select..</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}" @if($country->id == $school->country_id) selected @endif >
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('country_id'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('country_id')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('city')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">City</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="city" placeholder="City" name="city" value="{{ $school->city }}">
                                            @if ($errors->has('city'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('city')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('location_name')) has-error @endif required col-sm-12">
                                        <label for="location_name" class="col-sm-2 control-label">Location Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="location_name" placeholder="Location Name" name="location_name" value="{{ $school->location_name }}">
                                            @if ($errors->has('location_name'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('location_name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('location_school')) has-error @endif required col-sm-12">
                                        <label for="location_school" class="col-sm-2 control-label">Location School</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="location_school" placeholder="Location School" name="location_school" value="{{ $school->location_school }}">
                                            @if ($errors->has('location_school'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('location_school')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('specific_street')) has-error @endif required col-sm-12">
                                        <label for="specific_street" class="col-sm-2 control-label">Specific Street</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="specific_street" placeholder="Specific Street" name="specific_street" value="{{ $school->specific_street }}">
                                            @if ($errors->has('specific_street'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('specific_street')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('specific_city')) has-error @endif required col-sm-12">
                                        <label for="specific_city" class="col-sm-2 control-label">Specific City</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="specific_city" placeholder="Specific City" name="specific_city" value="{{ $school->specific_city }}">
                                            @if ($errors->has('specific_city'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('specific_city')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('specific_state')) has-error @endif required col-sm-12">
                                        <label for="specific_state" class="col-sm-2 control-label">Specific State</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="specific_state" placeholder="Specific State" name="specific_state" value="{{ $school->specific_state }}">
                                            @if ($errors->has('specific_state'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('specific_state')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('specific_zip')) has-error @endif required col-sm-12">
                                        <label for="specific_zip" class="col-sm-2 control-label">Specific Zip</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="specific_zip" placeholder="Specific Zip" name="specific_zip" value="{{ $school->specific_zip }}">
                                            @if ($errors->has('specific_zip'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('specific_zip')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('location_description')) has-error @endif required col-sm-12">
                                        <label for="location_description" class="col-sm-2 control-label">Location Description</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="location_description" placeholder="Location Description" name="location_description" value="{{ $school->location_description }}">
                                            @if ($errors->has('location_description'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('location_description')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <hr>
                                        <h2>Registrant</h2>
                                    </div>
                                    <div class="form-group @if ($errors->has('reg_first_name')) has-error @endif required col-sm-12">
                                        <label for="reg_first_name" class="col-sm-2 control-label">First Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="reg_first_name" placeholder="First Name" name="reg_first_name" value="{{ $school->reg_first_name }}">
                                            @if ($errors->has('reg_first_name'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('reg_first_name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('reg_last_name')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="reg_last_name" placeholder="Last Name" name="reg_last_name" value="{{ $school->reg_last_name }}">
                                            @if ($errors->has('reg_last_name'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('reg_last_name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('reg_position')) has-error @endif required col-sm-12">
                                        <label for="reg_position" class="col-sm-2 control-label">Position</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="reg_position" placeholder="Position" name="reg_position" value="{{ $school->reg_position }}">
                                            @if ($errors->has('reg_position'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('reg_position')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('city')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">E-Mail</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="City" name="city" value="{{ $school->city }}">
                                            @if ($errors->has('city'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('city')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('city')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="City" name="city" value="{{ $school->city }}">
                                            @if ($errors->has('city'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('city')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('city')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">Fax</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="City" name="city" value="{{ $school->city }}">
                                            @if ($errors->has('city'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('city')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('city')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">Skype</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="City" name="city" value="{{ $school->city }}">
                                            @if ($errors->has('city'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('city')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <hr>
                                        <h2>Director</h2>
                                    </div>
                                    <div class="form-group @if ($errors->has('city')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">First Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="City" name="city" value="{{ $school->city }}">
                                            @if ($errors->has('city'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('city')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('city')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="City" name="city" value="{{ $school->city }}">
                                            @if ($errors->has('city'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('city')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('city')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">Position</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="City" name="city" value="{{ $school->city }}">
                                            @if ($errors->has('city'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('city')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('city')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">E-Mail</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="City" name="city" value="{{ $school->city }}">
                                            @if ($errors->has('city'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('city')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('city')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">Phone Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="City" name="city" value="{{ $school->city }}">
                                            @if ($errors->has('city'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('city')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('city')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">Fax</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="City" name="city" value="{{ $school->city }}">
                                            @if ($errors->has('city'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('city')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('city')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">Skype</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="City" name="city" value="{{ $school->city }}">
                                            @if ($errors->has('city'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('city')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-12">
                                        <label for="status" class="col-sm-2 control-label">Draft</label>
                                        <div class="col-sm-10">
                                            <div class="checkbox icheck">
                                                <label><input type="checkbox" value="1" name="status" @if ($school->status == 1) checked @endif></label>
                                            </div>
                                            @if ($errors->has('status'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('status')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="box-footer">
                                    <a href="{{ route('schools.index') }}" class="btn btn-default btn-flat"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</a>
                                    <button type="submit" class="btn btn-primary pull-right btn-flat"><i class="fa fa-plus-circle" aria-hidden="true"></i> Update</button>
                                    <a href="{{ route('schools.delete', $school->id) }}" class="btn btn-danger pull-right btn-flat" onclick="return confirm('Delete {{ $school->name }}?');"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Delete</a>
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
            $("#user_id").select2({
                maximumSelectionLength: 1
            });
        });
    </script>
    <script>
        function convert(){
            //$("#url").val(slug($("#name").val())+".html");
        }
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
@endsection
