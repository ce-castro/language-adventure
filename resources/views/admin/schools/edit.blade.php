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

                                    <div class="form-group @if ($errors->has('reg_email')) has-error @endif required col-sm-12">
                                        <label for="reg_email" class="col-sm-2 control-label">E-Mail</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="reg_email" placeholder="E-Mail" name="reg_email" value="{{ $school->reg_email }}">
                                            @if ($errors->has('reg_email'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('reg_email')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('reg_phone')) has-error @endif required col-sm-12">
                                        <label for="reg_phone" class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="reg_phone" placeholder="Phone" name="reg_phone" value="{{ $school->reg_phone }}">
                                            @if ($errors->has('city'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('reg_phone')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('reg_fax')) has-error @endif required col-sm-12">
                                        <label for="reg_fax" class="col-sm-2 control-label">Fax</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="reg_fax" placeholder="Fax" name="reg_fax" value="{{ $school->reg_fax }}">
                                            @if ($errors->has('reg_fax'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('reg_fax')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('reg_skype')) has-error @endif required col-sm-12">
                                        <label for="reg_skype" class="col-sm-2 control-label">Skype</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="reg_skype" placeholder="Skype" name="reg_skype" value="{{ $school->reg_skype }}">
                                            @if ($errors->has('reg_skype'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('reg_skype')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <hr>
                                        <h2>Director</h2>
                                    </div>
                                    <div class="form-group @if ($errors->has('director_first_name')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">First Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="director_first_name" placeholder="First Name" name="director_first_name" value="{{ $school->director_first_name }}">
                                            @if ($errors->has('director_first_name'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('director_first_name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('director_last_name')) has-error @endif required col-sm-12">
                                        <label for="director_last_name" class="col-sm-2 control-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="director_last_name" placeholder="Last Name" name="director_last_name" value="{{ $school->director_last_name }}">
                                            @if ($errors->has('director_last_name'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('director_last_name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('director_position')) has-error @endif required col-sm-12">
                                        <label for="director_position" class="col-sm-2 control-label">Position</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="director_position" placeholder="Position" name="director_position" value="{{ $school->director_position }}">
                                            @if ($errors->has('director_position'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('director_position')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('director_email')) has-error @endif required col-sm-12">
                                        <label for="director_email" class="col-sm-2 control-label">E-Mail</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="director_email" placeholder="E-Mail" name="director_email" value="{{ $school->director_email }}">
                                            @if ($errors->has('director_email'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('director_email')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('director_phone')) has-error @endif required col-sm-12">
                                        <label for="city" class="col-sm-2 control-label">Phone Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="director_phone" placeholder="Phone Number" name="director_phone" value="{{ $school->director_phone }}">
                                            @if ($errors->has('director_phone'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('director_phone')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('director_fax')) has-error @endif required col-sm-12">
                                        <label for="director_fax" class="col-sm-2 control-label">Fax</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="director_fax" placeholder="City" name="director_fax" value="{{ $school->director_fax }}">
                                            @if ($errors->has('director_fax'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('director_fax')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('director_skype')) has-error @endif required col-sm-12">
                                        <label for="director_skype" class="col-sm-2 control-label">Skype</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="director_skype" placeholder="Skype" name="director_skype" value="{{ $school->director_skype }}">
                                            @if ($errors->has('director_skype'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('director_skype')}}</span>
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
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane @if (Request::route('tab') == "tab_2") active @endif" id="tab_2">
                            <form class="form-horizontal" method="post" action="">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <div class="box-body">
                                    <div class="form-group col-sm-12">
                                        <hr>
                                        <h2>School Overview</h2>
                                    </div>
                                    <div class="form-group @if ($errors->has('year')) has-error @endif required col-sm-12">
                                        <label for="year" class="col-sm-2 control-label">Year school opened</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="year" placeholder="Year" name="year" value="{{ $school->year }}">
                                            @if ($errors->has('year'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('year')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('classrooms')) has-error @endif required col-sm-12">
                                        <label for="classrooms" class="col-sm-2 control-label">Number of Classrooms</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="classrooms" placeholder="Number of Classrooms" name="classrooms" value="{{ $school->classrooms }}">
                                            @if ($errors->has('classrooms'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('classrooms')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('students_taught')) has-error @endif required col-sm-12">
                                        <label for="students_taught" class="col-sm-2 control-label">Number of student weeks taught last year</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="students_taught" name="students_taught"  value="{{ $school->students_taught }}">
                                            @if ($errors->has('students_taught'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('students_taught')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('credits')) has-error @endif required col-sm-12">
                                        <label for="credits" class="col-sm-2 control-label">Enter any accrediting body that accredits your school</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="credits" placeholder="Credits" name="credits"  value="{{ $school->credits }}">
                                            @if ($errors->has('credits'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('credits')}}</span>
                                            @endif
                                            Can't find your accreditation? <a href="#">Add it here</a>
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('languages')) has-error @endif required col-sm-12">
                                        <label for="languages" class="col-sm-2 control-label">Enter all languages you teach</label>
                                        <div class="col-sm-10">
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('facilities')) has-error @endif required col-sm-12">
                                        <label for="name" class="col-sm-2 control-label">School facilities</label>
                                        <div class="col-sm-10">

                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('name')) has-error @endif required col-sm-12">
                                        <label for="name" class="col-sm-2 control-label">Teacher qualifications</label>
                                        <div class="col-sm-10">
                                            What proportion of your teachers are native speakers?
                                            <select name="native" id="native" class="form-control">
                                                <option value="All">All</option>
                                            </select>
                                            <br>
                                            What proportion of your teachers have a language teaching certification?
                                            <select name="native" id="native" class="form-control">
                                                <option value="All">All</option>
                                            </select>
                                            <br>
                                            How many teachers have an university degree?
                                            <select name="native" id="native" class="form-control">
                                                <option value="All">All</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('certification')) has-error @endif required col-sm-12">
                                        <label for="certification" class="col-sm-2 control-label">Does your school provide certificate of completion</label>
                                        <div class="col-sm-10">
                                            <div class="radio">
                                                <input type="radio" name="certification" id="certification" value="Yes" checked>
                                                Yes
                                            </div>
                                            <div class="radio">
                                                <input type="radio" name="certification" id="certification" value="No" style="margin-left: 20px !important">
                                                No
                                            </div>
                                            @if ($errors->has('certification'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('certification_sample')) has-error @endif required col-sm-12">
                                        <label for="certification_sample" class="col-sm-2 control-label">Upload a sample certificate of completion</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="certification_sample" name="certification_sample">
                                            @if ($errors->has('certification_sample'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('certification_sample')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('placement_type')) has-error @endif required col-sm-12">
                                        <label for="name" class="col-sm-2 control-label">Placement testing
                                        <span style="font-size: 10px">Check all that apply</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="checkbox icheck">
                                                <label><input type="checkbox" value="1" name="status">  Conducted on the first day of classes</label>
                                            </div>
                                            <div class="checkbox icheck">
                                                <label><input type="checkbox" value="1" name="status">  Conducted before arrival</label>
                                            </div>
                                            @if ($errors->has('placement_type'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('placement_type')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('placement_test')) has-error @endif required col-sm-12">
                                        <label for="certification_sample" class="col-sm-2 control-label">Upload a sample test</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="placement_test" name="placement_test">
                                            @if ($errors->has('placement_test'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('placement_test')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('placement_link')) has-error @endif required col-sm-12">
                                        <label for="placement_link" class="col-sm-2 control-label">...or enter a link to your online placement test</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="placement_link" placeholder="Placement Link" name="placement_link"  value="{{ $school->placement_link }}">
                                            @if ($errors->has('placement_link'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('placement_link')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('universities_pathway')) has-error @endif required col-sm-12">
                                        <label for="name" class="col-sm-2 control-label">Enter any universities you have pathway programs with</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="universities_pathway" placeholder="Start typing university or location" name="universities_pathway"  value="{{ $school->universities_pathway }}">
                                            @if ($errors->has('universities_pathway'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('universities_pathway')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <hr>
                                        <h2>Course and Student body defaults </h2>
                                    </div>

                                    <div class="form-group @if ($errors->has('name')) has-error @endif required col-sm-12">
                                        <label for="name" class="col-sm-2 control-label">Class Size</label>
                                        <div class="col-sm-4">
                                            Maximum class size
                                            <input type="number" class="form-control" id="class_max" placeholder="Maximun class size" name="class_max"  value="{{ $school->class_max }}">
                                            @if ($errors->has('class_max'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('class_max')}}</span>
                                            @endif
                                            Average class size
                                            <input type="number" class="form-control" id="class_average" placeholder="Average Size" name="class_average"  value="{{ $school->class_average }}">
                                            @if ($errors->has('class_average'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('class_average')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('student_age_min')) has-error @endif required col-sm-12">
                                        <label for="name" class="col-sm-2 control-label">Student Age</label>
                                        <div class="col-sm-4">
                                            Minimum student age
                                            <input type="number" class="form-control" id="student_age_min" placeholder="Minimum student age" name="student_age_min"  value="{{ $school->student_age_min }}">
                                            @if ($errors->has('student_age_min'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('student_age_min')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-sm-4">
                                            Maximum student age
                                            <input type="number" class="form-control" id="student_age_max" placeholder="Maximum Student Age" name="student_age_max"  value="{{ $school->student_age_max }}">
                                            @if ($errors->has('student_age_max'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('student_age_max')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-sm-4 col-sm-offset-2" style="margin-top: 20px">
                                            Average student age
                                            <input type="number" class="form-control" id="student_age_avg_summer" placeholder="Average student age" name="student_age_avg_summer"  value="{{ $school->student_age_avg }}">
                                            @if ($errors->has('student_age_avg_summer'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('student_age_avg_summer')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-sm-4" style="margin-top: 20px">
                                            Average student age (in summer)
                                            <input type="text" class="form-control" id="student_age_avg_summer" placeholder="Average student age (in summer)" name="student_age_avg_summer"  value="{{ $school->student_age_avg_summer }}">
                                            @if ($errors->has('student_age_avg_summer'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('student_age_avg_summer')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group @if ($errors->has('country')) has-error @endif required col-sm-12">
                                        <label for="name" class="col-sm-2 control-label">Student nationality</label>
                                        <div class="col-sm-4">
                                            <select name="student_country" id="student_country" class="form-control">
                                                <option value="">Please choose...</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="student_percentage" class="form-control" id="student_percentage" placeholder="%" name="student_percentage"  value="{{ $school->student_percentage }}">
                                        </div>
                                    </div>
                                    <div class="form-group @if ($errors->has('mins_lesson')) has-error @endif required col-sm-12">
                                        <label for="mins_lesson" class="col-sm-2 control-label">Minutes per lesson</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="mins_lesson" name="mins_lesson"  value="{{ $school->mins_lesson }}">
                                            @if ($errors->has('mins_lesson'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('mins_lesson')}}</span>
                                            @endif
                                        </div>
                                    </div>
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
