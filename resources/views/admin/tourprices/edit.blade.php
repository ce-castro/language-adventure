@extends('admin.layouts.iframe')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/square/blue.css') }}">
    <style type="text/css">
        .form-group.required .control-label::after {
            top: 2px !important;
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
@endsection

@section('title')
    Edit a Tour Price
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit a Tour Price</h3>
                </div>

                <form class="form-horizontal" method="post" action="{{ route('tourprices.update', $tourprice->id) }}" target="_parent">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="tour_id" value="{{ $tourprice->tour_id }}">
                    <div class="box-body">

                        <div class="form-group @if ($errors->has('adult_retail')) has-error @endif col-xs-12 required">
                            <label for="adult_retail" class="col-xs-4 control-label">Adult Retail</label>
                            <div class="col-xs-4">
                                <div class='input-group date clock'>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-usd"></span>
                                                        </span>
                                    <input type='text' class="form-control" id="adult_retail" name="adult_retail" value="{{ $tourprice->adult_retail }}"/>

                                </div>
                                @if ($errors->has('adult_retail'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('adult_retail') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('adult_discount')) has-error @endif col-xs-12 required">
                            <label for="adult_discount" class="col-xs-4 control-label">Adult Discount</label>
                            <div class="col-xs-4">
                                <div class='input-group date clock'>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-usd"></span>
                                                        </span>
                                    <input type='text' class="form-control" id="adult_discount" name="adult_discount" value="{{ $tourprice->adult_discount }}"/>

                                </div>
                                @if ($errors->has('adult_discount'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('adult_discount') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('child_retail')) has-error @endif col-xs-12 required">
                            <label for="child_retail" class="col-xs-4 control-label">Child Retail</label>
                            <div class="col-xs-4">
                                <div class='input-group date clock'>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-usd"></span>
                                                        </span>
                                    <input type='text' class="form-control" id="child_retail" name="child_retail" value="{{ $tourprice->child_retail }}"/>

                                </div>
                                @if ($errors->has('child_retail'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('child_retail') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('child_discount')) has-error @endif col-xs-12 required">
                            <label for="child_discount" class="col-xs-4 control-label">Child Discount</label>
                            <div class="col-xs-4">
                                <div class='input-group date clock'>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-usd"></span>
                                                        </span>
                                    <input type='text' class="form-control" id="child_discount" name="child_discount" value="{{ $tourprice->child_discount }}"/>

                                </div>
                                @if ($errors->has('child_discount'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('child_discount') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('status')) has-error @endif col-xs-12">
                            <label for="status" class="col-xs-4 control-label">Active</label>
                            <div class="col-xs-4">
                                <div class="checkbox icheck">
                                    <label><input type="checkbox" value="1" name="status" @if ($tourprice->status == 1) checked @endif></label>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('status') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <a href="javascript:parent.jQuery.fancybox.getInstance().close();" class="btn btn-default btn-flat"><i class="fa fa-times-circle-o" aria-hidden="true" onclick=""></i>&nbsp;&nbsp;Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right btn-flat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Update</button>
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