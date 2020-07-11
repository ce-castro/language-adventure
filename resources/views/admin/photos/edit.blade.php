@extends('admin.layouts.iframe')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/square/blue.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('title')
    Edit a Picture
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit a Picture</h3>
                </div>

                <form class="form-horizontal" method="post" action="{{ route('photos.update', $photo->id) }}" target="_parent" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="tour_id" value="{{ $photo->tour_id }}">
                    <div class="box-body">
                        <div class="form-group @if ($errors->has('type_id')) has-error @endif col-sm-12 required">
                            <label for="category_id" class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-10">
                                <select name="type_id" id="type_id" class="form-control">
                                    <option value="">Please select..</option>
                                    <option value="1" @if($photo->type_id == 1) selected @endif>Main</option>
                                    <option value="2" @if($photo->type_id == 2) selected @endif>Category</option>
                                    <option value="3" @if($photo->type_id == 3) selected @endif>Gallery</option>
                                    <option value="4" @if($photo->type_id == 4) selected @endif>Facebook OG</option>
                                </select>
                                @if ($errors->has('type_id'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('type_id')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('title')) has-error @endif col-sm-12 required">
                            <label for="title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" value="{{ $photo->title }}">
                                @if ($errors->has('title'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('image')) has-error @endif col-sm-12">
                            <label for="image" class="col-sm-2 control-label">Photo</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image" name="image">
                                @if ($errors->has('image'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('description')) has-error @endif col-sm-12">
                            <label for="description" class="col-sm-2 control-label">Alt. Text</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="description" class="form-control" style="height: 80px !important;">{{ $photo->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-6">
                            <label for="status" class="col-sm-4 control-label">Active</label>
                            <div class="col-sm-8">
                                <div class="checkbox icheck">
                                    <label><input type="checkbox" value="1" name="status" @if ($photo->status == 1) checked @endif></label>
                                </div>
                                @if ($errors->has('status'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('status') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('title')) has-error @endif col-sm-6">
                            <label for="order" class="col-sm-2 control-label">Order</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="order" name="order" value="{{ $photo->order }}">
                                @if ($errors->has('order'))
                                    <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('order') }}</span>
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