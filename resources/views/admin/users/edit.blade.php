@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/square/blue.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
@endsection

@section('title')
    Edit a User
@endsection

@section('h1')
    Edit a User
@endsection

@section('bread')
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin/users">User</a></li>
        <li class="active">Edit a User</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit a User</h3>
                </div>

                <form class="form-horizontal" method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="box-body">

                        @if (Auth::user()->role_id == 1)
                        <div class="form-group @if ($errors->has('role_id')) has-error @endif">
                            <label for="role_id" class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-10">
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value="">Please select..</option>
                                    @foreach($listroles as $rol)
                                        <option value="{{ $rol->id }}" @if($rol->id == $user->role_id) selected @endif>{{ $rol->role }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role_id'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('cart')}}</span>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            <label for="inputName" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" value="{{ $user->name }}">
                                @if ($errors->has('name'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('name')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('last_name')) has-error @endif">
                            <label for="inputLast" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputLast" placeholder="Last Name" name="last_name" value="{{ $user->last_name }}">
                                @if ($errors->has('last_name'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('last_name')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('password')) has-error @endif">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('password')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="col-sm-2 control-label">Password confirmation</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>

                        @if (Auth::user()->role_id == 1)
                        <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-6">
                            <label for="inputActive" class="col-sm-4 control-label">Active</label>
                            <div class="col-sm-8">
                                <div class="checkbox icheck">
                                    <label><input type="checkbox" value="1" name="status" @if ($user->status == 1) checked @endif> </label>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('status')}}</span>
                                @endif
                            </div>
                        </div>
                        @endif

                    </div>

                    <div class="box-footer">
                        <a href="{{ route('users.index') }}" class="btn btn-default btn-flat"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right btn-flat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Update</button>
                        @if (Auth::user()->role_id == 1)
                        <a href="{{ route('users.delete', $user->id) }}" class="btn btn-danger pull-right btn-flat" onclick="return confirm('Delete {{ $user->name }}');"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Delete</a>
                        @endif

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
@endsection
