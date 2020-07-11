<?php
function bytesToHuman($bytes){
    $units = ['B', 'KB', 'MB'];

    for ($i = 0; $bytes > 1024; $i++) {
        $bytes /= 1024;
    }

    return round($bytes, 2) . ' ' . $units[$i];
}
?>

@extends('admin.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('vendors/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/fancybox/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <style type="text/css">
        .input_fields_wrap .nuestros{
            margin-top: 15px;
        }
        .input_fields_wrap{
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendors/fancybox/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('vendors/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datetimepicker/js/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
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
        <li><a href="{{ route('tours.index') }}">Categories</a></li>
        <li class="active">Edit a Tour</li>
    </ol>
@endsection

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="box box-info">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li @if (Request::route('tab') == "tab_1") class="active" @endif><a href="#tab_1" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i> Tour Info</a></li>
                        <li @if (Request::route('tab') == "tab_2") class="active" @endif><a href="#tab_2" data-toggle="tab"><i class="fa fa-picture-o" aria-hidden="true"></i> Images</a></li>
                        <li @if (Request::route('tab') == "tab_3") class="active" @endif><a href="#tab_3" data-toggle="tab"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Schedules</a></li>
                        <li @if (Request::route('tab') == "tab_4") class="active" @endif><a href="#tab_4" data-toggle="tab"><i class="fa fa-usd" aria-hidden="true"></i> Prices</a></li>
                        <li @if (Request::route('tab') == "tab_5") class="active" @endif><a href="#tab_5" data-toggle="tab"><i class="fa fa-question-circle" aria-hidden="true"></i> FAQs</a></li>
                    </ul>

                    <div class="tab-content" id="tabs">

                        @include('admin.layouts.errors')

                        <div class="tab-pane @if (Request::route('tab') == "tab_1") active @endif" id="tab_1">
                            <form class="form-horizontal" method="post" action="{{ route('tours.update', $tour->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <div class="box-body">

                                    <div class="form-group @if ($errors->has('name')) has-error @endif col-sm-6 required">
                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" onchange="convert()" value="{{ $tour->name }}">
                                            @if ($errors->has('name'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('url')) has-error @endif col-sm-6 required">
                                        <label for="url" class="col-sm-2 control-label">URL</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="URL" name="url" value="{{ $tour->url }}">
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
                                                    <option value="{{ $category->id }}" @if($category->id == $tour->category_id) selected @endif>{{ $category->name }}</option>
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
                                                    <option value="{{ $sub->id }}" @if($sub->id == $tour->sub_category_id) selected @endif>{{ $sub->title }}</option>
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
                                            <input type="text" class="form-control" id="sku" placeholder="SKU #" name="sku" value="{{ $tour->sku }}">
                                            @if ($errors->has('sku'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('sku')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('runs')) has-error @endif col-sm-6">
                                        <label for="runs" class="col-sm-2 control-label">Runs</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="runs" placeholder="Runs" name="runs" value="{{ $tour->runs }}">
                                            @if ($errors->has('runs'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('runs')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('duration')) has-error @endif col-sm-6">
                                        <label for="duration" class="col-sm-2 control-label">Duration</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="duration" placeholder="Duration" name="duration" value="{{ $tour->duration }}">
                                            @if ($errors->has('duration'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('duration')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('departs')) has-error @endif col-sm-6">
                                        <label for="departs" class="col-sm-2 control-label">Departs</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="departs" placeholder="Departs" name="departs" value="{{ $tour->departs }}">
                                            @if ($errors->has('departs'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('departs')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('orden')) has-error @endif col-sm-6 required">
                                        <label for="orden" class="col-sm-2 control-label">Order</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="orden" placeholder="Order" name="orden" value="{{ $tour->orden }}">
                                            @if ($errors->has('orden'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('orden')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('kids_age')) has-error @endif col-sm-6">
                                        <label for="kids_age" class="col-sm-2 control-label">Kids Age:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="kids_age" placeholder="Kids age" name="kids_age" value="{{ $tour->kids_age  }}">
                                            @if ($errors->has('kids_age'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('kids_age')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('includes')) has-error @endif col-sm-6 required">
                                        <label for="includes" class="col-sm-2 control-label">Includes</label>
                                        <div class="col-sm-10">
                                            <textarea name="includes" id="includes" class="form-control ckeditor">{{ $tour->includes }}</textarea>
                                            @if ($errors->has('includes'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('includes')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('dont_forget')) has-error @endif col-sm-6">
                                        <label for="dont_forget" class="col-sm-2 control-label">Don't Forget</label>
                                        <div class="col-sm-10">
                                            <textarea name="dont_forget" id="dont_forget" class="form-control ckeditor">{{ $tour->dont_forget }}</textarea>
                                            @if ($errors->has('dont_forget'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('dont_forget')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('description')) has-error @endif col-sm-12">
                                        <label for="description" class="col-sm-1 control-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" id="description" class="form-control ckeditor">{{ $tour->description }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-6">
                                        <label for="inputActive" class="col-sm-2 control-label">Active</label>
                                        <div class="col-sm-10">
                                            <div class="checkbox icheck">
                                                <label><input type="checkbox" value="1" name="status" @if ($tour->status == 1) checked @endif></label>
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
                                                <label><input type="checkbox" value="1" name="hot_deal" @if ($tour->hot_deal == 1) checked @endif></label>
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
                                            <input type="text" class="form-control" id="keywords" placeholder="Keywords" name="keywords" value="{{ $tour->keywords  }}">
                                            @if ($errors->has('keywords'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('keywords')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('title_og')) has-error @endif col-sm-6">
                                        <label for="title_og" class="col-sm-2 control-label">OG Title:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="title_og" placeholder="OG Title" name="title_og" value="{{ $tour->title_og  }}">
                                            @if ($errors->has('title_og'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('title_og')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('description_tag')) has-error @endif col-sm-6">
                                        <label for="description_tag" class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description_tag" id="description_tag" class="form-control">{{ $tour->description_tag }}</textarea>
                                            @if ($errors->has('description_tag'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description_tag')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('description_og')) has-error @endif col-sm-6">
                                        <label for="description_og" class="col-sm-2 control-label">OG Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description_og" id="description_og" class="form-control">{{ $tour->description_og }}</textarea>
                                            @if ($errors->has('description_og'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description_og')}}</span>
                                            @endif
                                        </div>
                                    </div>


                                </div>
                                <div class="box-footer">
                                    <a href="{{ route('tours.index') }}" class="btn btn-default btn-flat"><i class="fa fa-times-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</a>
                                    <button type="submit" class="btn btn-primary pull-right btn-flat"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Update</button>
                                    <a href="{{ route('tours.delete', $tour->id) }}"  class="btn btn-danger pull-right btn-flat" onclick="return confirm('Delete {{ $tour->name }}?');"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Delete</a>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane @if (Request::route('tab') == "tab_2") active @endif" id="tab_2">
                            <div class="row">
                                <div class="col-sm-7">
                                    <h3>Images</h3>
                                    <div class="box">
                                        <div class="box-body">
                                            <table class="table table-bordered table-striped" id="tablita1">
                                                <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Type</th>
                                                    <th>Dimension</th>
                                                    <th>Size</th>
                                                    <th>Status</th>
                                                    <th style="width: 45px">Edit</th>
                                                    <th style="width: 45px">View</th>
                                                    <th style="width: 45px">Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($photos as $photo)
                                                    <?php
                                                    $filename = "http://".$_SERVER['SERVER_NAME']."/uploads/".$photo->image;
                                                    //if (file_exists($filename)){
                                                        $size = getimagesize($filename);
                                                    /*} else{
                                                        $size[0]="0"; $size[1]="0";
                                                    }*/
                                                    ?>
                                                    <tr>
                                                        <td>{{ $photo->title }}</td>
                                                        <td>
                                                                @if ($photo->type_id == "1")Main @endif
                                                                @if ($photo->type_id == "2")Category @endif
                                                                @if ($photo->type_id == "3")Gallery @endif
                                                                    @if ($photo->type_id == "4")Facebook OG @endif
                                                        </td>
                                                        <td>
                                                            <?php echo $size[0]; ?>px by <?php echo $size[1]; ?>px
                                                        </td>
                                                        <td><?php echo bytesToHuman($photo->size); ?></td>
                                                        <td>@if ($photo->status == 1)
                                                                Active
                                                            @else
                                                                Inactive
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <a data-fancybox="iframe" data-src="{{ route('photos.edit', [$photo->id]) }}" data-type="iframe" href="javascript:;" title="Edit" class="fancy1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="/uploads/{{ $photo->image }}" title="Preview {{ $photo->title }}" data-fancybox="gallery" data-caption="<strong>{{ $photo->title }}</strong> <br >{{ $photo->description }}"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('photos.delete', [$photo->id, $tour->id]) }}" title="Delete {{ $photo->title }}" onclick="return confirm('Delete {{ $photo->title }}?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <form class="form-horizontal" method="post" action="{{ route('photos.store') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                                        <div class="box-body" style="padding-top: 0px; border: solid #CCC 1px;">
                                            <h3>Add an image</h3>

                                            <div class="form-group @if ($errors->has('category_id')) has-error @endif col-sm-12 required">
                                                <label for="category_id" class="col-sm-2 control-label">Type</label>
                                                <div class="col-sm-10">
                                                    <select name="type_id" id="category_id" class="form-control">
                                                        <option value="">Please select..</option>
                                                        <option value="1">Main</option>
                                                        <option value="2">Category</option>
                                                        <option value="3">Gallery</option>
                                                        <option value="4">Facebook OG</option>
                                                    </select>
                                                    @if ($errors->has('category_id'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('category_id')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group @if ($errors->has('title')) has-error @endif col-sm-12 required">
                                                <label for="title" class="col-sm-2 control-label">Title</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="title" name="title">
                                                    @if ($errors->has('title'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('title') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group @if ($errors->has('image')) has-error @endif col-sm-12 required">
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
                                                    <textarea name="description" id="description" class="form-control"></textarea>
                                                    @if ($errors->has('description'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-6">
                                                <label for="status" class="col-sm-4 control-label">Active</label>
                                                <div class="col-sm-8">
                                                    <div class="checkbox icheck">
                                                        <label><input type="checkbox" value="1" name="status"></label>
                                                    </div>
                                                    @if ($errors->has('status'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('status') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <button type="submit" class="btn btn-success pull-right btn-flat col-sm-6"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Photo
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane @if (Request::route('tab') == "tab_3") active @endif" id="tab_3">
                            <div class="row">
                                <div class="col-sm-7">
                                    <h3>Schedules</h3>
                                    <div class="box">
                                        <div class="box-body table-responsive no-padding">
                                            <table class="table table-hover table-bordered" id="tablita2">
                                                <thead>
                                                <tr>
                                                    <th>Days</th>
                                                    <th>Start</th>
                                                    <th>Finish</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Edit</th>
                                                    <th class="text-center">Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($scheds as $sched)
                                                    <tr>
                                                        <td>
                                                            @foreach(explode(',', $sched->days) as $day)
                                                                    @if($day == 0) Everyday - @endif
                                                                    @if($day == 1) Monday - @endif
                                                                    @if($day == 2) Tuesday - @endif
                                                                    @if($day == 3) Wednesday - @endif
                                                                    @if($day == 4) Thursday - @endif
                                                                    @if($day == 5) Friday - @endif
                                                                    @if($day == 6) Saturday - @endif
                                                                    @if($day == 7) Sunday - @endif
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $sched->start }}</td>
                                                        <td>{{ $sched->finish }}</td>
                                                        <td class="text-center">@if ($sched->status == "1")Active @else Inactive @endif</td>
                                                        <td class="text-center">
                                                            <a data-fancybox="iframe" data-src="{{ route('schedules.edit', [$sched->id]) }}" data-type="iframe" href="javascript:;" title="Edit" class="fancy2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('schedules.delete', [$sched->id, $tour->id]) }}" title="Delete" onclick="return confirm('Are you sure?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <form class="form-horizontal" method="post" action="{{ route('schedules.store') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                                        <div class="box-body" style="padding-top: 0px; border: solid #CCC 1px;">
                                            <h3>Add a Schedule</h3>

                                            <div class="form-group @if ($errors->has('days')) has-error @endif col-sm-12 required">
                                                <label for="days" class="col-sm-3 control-label">Days</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control select2" multiple="multiple" data-placeholder="Select" style="width: 100%;" id="days" name="days[]">
                                                        <option value="0">Everyday</option>
                                                        <option value="1">Monday</option>
                                                        <option value="2">Tuesday</option>
                                                        <option value="3">Wednesday</option>
                                                        <option value="4">Thursday</option>
                                                        <option value="5">Friday</option>
                                                        <option value="6">Saturday</option>
                                                        <option value="7">Sunday</option>
                                                    </select>
                                                    @if ($errors->has('days'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('days') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group @if ($errors->has('start')) has-error @endif col-sm-12 required">
                                                <label for="start" class="col-sm-3 control-label">Start Time</label>
                                                <div class="col-sm-9">
                                                    <div class='input-group date clock'>
                                                        <input type='text' class="form-control" id="start" name="start" />
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-time"></span>
                                                        </span>
                                                    </div>
                                                    @if ($errors->has('start'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('start') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group @if ($errors->has('finish')) has-error @endif col-sm-12 required">
                                                <label for="finish" class="col-sm-3 control-label">Finish Time</label>
                                                <div class="col-sm-9">
                                                    <div class='input-group date clock'>
                                                        <input type='text' class="form-control" id="finish" name="finish" />
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-time"></span>
                                                        </span>
                                                    </div>
                                                    @if ($errors->has('finish'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('finish') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-9">
                                                <label for="status" class="col-sm-4 control-label">Active</label>
                                                <div class="col-sm-8">
                                                    <div class="checkbox icheck">
                                                        <label><input type="checkbox" value="1" name="status"></label>
                                                    </div>
                                                    @if ($errors->has('status'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('status') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-3">
                                                <button type="submit" class="btn btn-success pull-right btn-flat"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Schedule
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane @if (Request::route('tab') == "tab_4") active @endif" id="tab_4">
                            <form method="post" action="{{ route('tourprices.store') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="tour_id" value="{{$tour->id}}" id="tour_id">
                                <div class="box-body">

                                    <div class="row">
                                        <div class="col-sm-2 text-center"><strong>Type</strong></div>
                                        <div class="col-sm-2 text-center"><strong>Detail</strong></div>
                                        <div class="col-sm-1 text-center"><strong>Ad. Price</strong></div>
                                        <div class="col-sm-1 text-center"><strong>Our Price</strong></div>
                                    </div>
                                    <div class="input_fields_wrap">
                                        <div class="nuestros">
                                            <div class="col-sm-2">
                                                <select class="form-control" style="width: 100%;" id="type" name="type[]">
                                                    <option value="1">By Person</option>
                                                    <option value="2">By Item</option>
                                                    <option value="3">Fixed</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <select class="form-control" style="width: 100%;" id="detail" name="detail[]">
                                                    <option value="1">Adult</option>
                                                    <option value="2">Child</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" class="form-control" id="price_ad" name="price_ad[]" required>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" class="form-control" id="price_real" name="price_real[]" required>
                                            </div>
                                            <button class="btn btn-success add_field_button">
                                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <button type="submit" class="btn btn-success pull-right btn-flat"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Tour Price(s)</button>
                                    </div>
                                </div>

                            </form>
                            <hr>
                            <div class="box-body">
                                <table class="table table-bordered table-striped" id="tablita4">
                                    <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Detail</th>
                                        <th>Ad Price</th>
                                        <th>Real Price</th>
                                        <th style="width: 45px">Edit</th>
                                        <th style="width: 45px">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($prices as $price)
                                        <tr>
                                            <td>
                                                @if ($price->type == "1")By Person @endif
                                                @if ($price->type == "2")By Item @endif
                                                @if ($price->type == "3")Fixed @endif
                                            </td>
                                            <td>
                                                @if ($price->detail == "1")Adult @endif
                                                @if ($price->detail == "2")Child @endif
                                            </td>
                                            <td>$ {{ number_format($price->price_ad,2) }}</td>
                                            <td>$ {{ number_format($price->price_real,2) }}</td>
                                            <td style="width: 45px">
                                                <a data-fancybox="iframe" data-src="{{ route('tourprices.edit', [$price->id]) }}" data-type="iframe" href="javascript:;" title="Edit" class="fancy2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            </td>
                                            <td style="width: 45px"><a href="{{ route('tourprices.delete', [$price->id, $tour->id]) }}" title="Delete" onclick="return confirm('Are you sure?');"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="tab-pane @if (Request::route('tab') == "tab_5") active @endif" id="tab_5">
                            <div class="row">
                                <div class="col-sm-7">
                                    <h3>FAQs</h3>
                                    <div class="box">
                                        <div class="box-body">
                                            <table class="table table-bordered table-striped" id="tablita5">
                                                <thead>
                                                <tr>
                                                    <th>Question</th>
                                                    <th>Order</th>
                                                    <th>Status</th>
                                                    <th style="width: 45px">Edit</th>
                                                    <th style="width: 45px">Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($faqs as $faq)
                                                    <tr>
                                                        <td>{{ $faq->question }}</td>
                                                        <td>{{ $faq->orden }}</td>
                                                        <td>@if ($faq->status == 1)
                                                                Active
                                                            @else
                                                                Inactive
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <a data-fancybox="iframe" data-src="{{ route('faqs.edit', [$faq->id]) }}" data-type="iframe" href="javascript:;" title="Edit" class="fancy3"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('faqs.delete', [$faq->id, $tour->id]) }}" title="Delete {{ $faq->question }}" onclick="return confirm('Delete {{ $faq->question }}?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <form class="form-horizontal" method="post" action="{{ route('faqs.store') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                                        <div class="box-body" style="padding-top: 0px; border: solid #CCC 1px;">
                                            <h3>Add a FAQ</h3>

                                            <div class="form-group @if ($errors->has('question')) has-error @endif col-sm-12 required">
                                                <label for="title" class="col-sm-3 control-label">Question</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="question" name="question">
                                                    @if ($errors->has('question'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('question') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group @if ($errors->has('answer')) has-error @endif col-sm-12 required">
                                                <label for="answer" class="col-sm-3 control-label">Answer</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="answer" name="answer">
                                                    @if ($errors->has('answer'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('answer') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group @if ($errors->has('orden')) has-error @endif col-sm-12">
                                                <label for="orden" class="col-sm-3 control-label">Order</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="orden" name="orden">
                                                    @if ($errors->has('orden'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('orden') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-9">
                                                <label for="status" class="col-sm-4 control-label">Active</label>
                                                <div class="col-sm-8">
                                                    <div class="checkbox icheck">
                                                        <label><input type="checkbox" value="1" name="status"></label>
                                                    </div>
                                                    @if ($errors->has('status'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('status') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-3">
                                                <button type="submit" class="btn btn-success pull-right btn-flat"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add FAQ
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var max_fields      = 10; //maximum input boxes allowed
            var wrapper         = $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    //$(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
                    $(wrapper).append('<div class="nuestros"><div class="col-sm-2"><select class="form-control" style="width: 100%;" id="type" name="type[]"><option value="1">By Person</option><option value="2">By Item</option><option value="3">Fixed</option></select></div><div class="col-sm-2"><select class="form-control" style="width: 100%;" id="detail" name="detail[]"><option value="1">Adult</option><option value="2">Child</option></select></div><div class="col-sm-1"><input type="text" class="form-control" id="price_ad" name="price_ad[]" required></div><div class="col-sm-1"><input type="text" class="form-control" id="price_ad" name="price_real[]" required></div><button class="btn btn-danger remove_field"><i class="fa fa-trash" aria-hidden="true"></i></button></div>');
                }
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });
    </script>
    <script>
        $(function () {
            $('.select2').select2();
        });
        $(".fancy1").fancybox({
            iframe : {
                css : {
                    width : '800px',
                    height : '515px'
                }
            }
        });
        $(".fancy2").fancybox({
            iframe : {
                css : {
                    width : '800px',
                    height : '390px'
                }
            }
        });
        $(".fancy3").fancybox({
            iframe : {
                css : {
                    width : '800px',
                    height : '360px'
                }
            }
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
    <script>
        function convert() {
            //$("#url").val(slug($("#name").val())+".html");
        }
    </script>
    <script>
        $(function () {
            $('#tablita1').DataTable({
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                'columns': [
                    null,
                    null,
                    null,
                    null,
                    null,
                    { "width": "40px" },
                    { "width": "40px" },
                    { "width": "40px" }
                ]
            });
        });

        $(function () {
            $('#tablita2').DataTable({
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                'columns': [
                    null,
                    null,
                    null,
                    null,
                    { "width": "40px" },
                    { "width": "40px" }
                ]
            });
        });

        $(function () {
            $('#tablita4').DataTable({
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                'columns': [
                    null,
                    null,
                    null,
                    null,
                    { "width": "40px" },
                    { "width": "40px" }
                ]
            });
        });

        $(function () {
            $('#tablita5').DataTable({
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                'columns': [
                    null,
                    null,
                    null,
                    { "width": "40px" },
                    { "width": "40px" }
                ]
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            //$("#sub_category_id").children('option:not(:first)').remove();
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

    <script type="text/javascript">
        $(function () {
            $('.clock').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@endsection