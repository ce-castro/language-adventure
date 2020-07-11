@extends('admin.layouts.iframe')

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
    Edit a Schedule
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit a Schedule</h3>
                </div>

                <form class="form-horizontal" method="post" action="{{ route('schedules.update', $schedule->id) }}" target="_parent">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="tour_id" value="{{ $schedule->tour_id }}">
                    <div class="box-body">
                        <div class="form-group @if ($errors->has('days')) has-error @endif col-sm-12 required">
                            <label for="days" class="col-sm-2 control-label">Days</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" multiple="multiple" data-placeholder="Select" style="width: 100%;" id="days" name="days[]">
                                    @foreach(explode(',', $schedule->days) as $day)
                                    <option value="0"  @if($day == 0) selected @endif>Everyday</option>
                                    @endforeach

                                    @foreach(explode(',', $schedule->days) as $day)
                                    <option value="1" @if($day == 1) selected @endif>Monday</option>
                                    @endforeach

                                    @foreach(explode(',', $schedule->days) as $day)
                                    <option value="2" @if($day == 2) selected @endif>Tuesday</option>
                                    @endforeach

                                    @foreach(explode(',', $schedule->days) as $day)
                                    <option value="3" @if($day == 3) selected @endif>Wednesday</option>
                                    @endforeach

                                    @foreach(explode(',', $schedule->days) as $day)
                                    <option value="4" @if($day == 4) selected @endif>Thursday</option>
                                    @endforeach

                                    @foreach(explode(',', $schedule->days) as $day)
                                    <option value="5" @if($day == 5) selected @endif>Friday</option>
                                    @endforeach

                                    @foreach(explode(',', $schedule->days) as $day)
                                    <option value="6" @if($day == 6) selected @endif>Saturday</option>
                                    @endforeach

                                    @foreach(explode(',', $schedule->days) as $day)
                                    <option value="7" @if($day == 7) selected @endif>Sunday</option>
                                    @endforeach

                                </select>

                                @if ($errors->has('days'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('days') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('start')) has-error @endif col-sm-12 required">
                            <label for="start" class="col-sm-2 control-label">Start Time</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="start" name="start" value="{{ $schedule->start }}">
                                @if ($errors->has('start'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('start') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('finish')) has-error @endif col-sm-12 required">
                            <label for="finish" class="col-sm-2 control-label">Finish Time</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="finish" name="finish" value="{{ $schedule->finish }}">
                                @if ($errors->has('finish'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('finish') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-10">
                            <label for="status" class="col-sm-4 control-label">Active</label>
                            <div class="col-sm-8">
                                <div class="checkbox icheck">
                                    <label><input type="checkbox" value="1" name="status" @if ($schedule->status == 1) checked @endif></label>
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
    <script>
        function convert(){
            //$("#url").val(slug($("#name").val())+".html");
        }
    </script>
@endsection