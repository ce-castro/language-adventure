<?php
function bytesToHuman($bytes) {
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
    <link rel="stylesheet" href="{{ asset('vendors/datatables/datatables.min.css') }}">
    <style type="text/css">
        .input_fields_wrap .nuestros {
            margin-top: 15px;
        }

        .input_fields_wrap {
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('vendors/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendors/fancybox/jquery.fancybox.min.js') }}"></script>
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
                        <li @if (Request::route('tab') == "tab_1") class="active" @endif><a href="#tab_1"
                                                                                            data-toggle="tab"><i
                                        class="fa fa-info-circle" aria-hidden="true"></i> Tour Info</a></li>
                        <li @if (Request::route('tab') == "tab_2") class="active" @endif><a href="#tab_2"
                                                                                            data-toggle="tab"><i
                                        class="fa fa-picture-o" aria-hidden="true"></i> Images</a></li>
                        <li @if (Request::route('tab') == "tab_3") class="active" @endif><a href="#tab_3"
                                                                                            data-toggle="tab"><i
                                        class="fa fa-calendar-check-o" aria-hidden="true"></i> Schedules</a></li>
                        <li @if (Request::route('tab') == "tab_4") class="active" @endif><a href="#tab_4"
                                                                                            data-toggle="tab"><i
                                        class="fa fa-usd" aria-hidden="true"></i> Prices</a></li>
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
                                            <input type="text" class="form-control" id="name" placeholder="Name"
                                                   name="name" onchange="convert()" value="{{ $tour->name }}">
                                            @if ($errors->has('name'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('url')) has-error @endif col-sm-6 required">
                                        <label for="url" class="col-sm-2 control-label">URL</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="url" placeholder="URL"
                                                   name="url" value="{{ $tour->url }}">
                                            @if ($errors->has('url'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('url')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('category_id')) has-error @endif col-sm-6 required">
                                        <label for="category_id" class="col-sm-2 control-label">Category</label>
                                        <div class="col-sm-10">
                                            <select name="category_id[]" id="category_id" class="form-control select2"
                                                    multiple="multiple">
                                                <option value="">Please select..</option>
                                                @foreach($listcategories as $category)
                                                    <option value="{{ $category->id }}"
                                                            @foreach($tour->categories as $cat) @if($category->id == $cat->id) selected @endif @endforeach >
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('category_id')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('sku')) has-error @endif col-sm-6">
                                        <label for="url" class="col-sm-2 control-label">SKU</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="sku" placeholder="SKU #"
                                                   name="sku" value="{{ $tour->sku }}">
                                            @if ($errors->has('sku'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('sku')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('country_id')) has-error @endif col-sm-6 required">
                                        <label for="country_id" class="col-sm-2 control-label">Country</label>
                                        <div class="col-sm-10">
                                            <select name="country_id" id="country_id" class="form-control"
                                                    multiple="multiple">
                                                <option value="">Please select..</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}" @if($country->id == $tour->country_id) selected @endif >
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('country_id'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('country_id')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('recommended')) has-error @endif col-sm-6">
                                        <label for="recommended" class="col-sm-4 control-label">Show in Homepage</label>
                                        <div class="col-sm-6">
                                            <div class="checkbox icheck">
                                                <label><input type="checkbox" value="1" name="recommended"
                                                              @if ($tour->recommended == 1) checked @endif></label>
                                            </div>
                                            @if ($errors->has('recommended'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('recommended')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('desc_top')) has-error @endif col-sm-12">
                                        <label for="description" class="col-sm-1 control-label">Desc Top</label>
                                        <div class="col-sm-10">
                                            <textarea name="desc_top" id="desc_top"
                                                      class="form-control ckeditor">{{ $tour->desc_top }}</textarea>
                                            @if ($errors->has('desc_top'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('desc_top')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('desc_bottom')) has-error @endif col-sm-12">
                                        <label for="desc_bottom" class="col-sm-1 control-label">Desc Bottom</label>
                                        <div class="col-sm-10">
                                            <textarea name="desc_bottom" id="desc_bottom"
                                                      class="form-control ckeditor">{{ $tour->desc_bottom }}</textarea>
                                            @if ($errors->has('desc_bottom'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('desc_bottom')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('available')) has-error @endif col-sm-6">
                                        <label for="available" class="col-sm-2 control-label">Available</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="available"
                                                   placeholder="Available" name="available"
                                                   value="{{ $tour->available }}">
                                            @if ($errors->has('available'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('available')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('duration')) has-error @endif col-sm-6">
                                        <label for="duration" class="col-sm-2 control-label">Duration</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="duration" placeholder="Duration"
                                                   name="duration" value="{{ $tour->duration }}">
                                            @if ($errors->has('duration'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('duration')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('includes')) has-error @endif col-sm-6">
                                        <label for="description" class="col-sm-2 control-label">Include</label>
                                        <div class="col-sm-10">
                                            <textarea name="includes" id="includes"
                                                      class="form-control ckeditor">{{ $tour->includes }}</textarea>
                                            @if ($errors->has('includes'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('includes')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('does_not_include')) has-error @endif col-sm-6">
                                        <label for="does_not_include" class="col-sm-2 control-label">Don't Include</label>
                                        <div class="col-sm-10">
                                            <textarea name="does_not_include" id="does_not_include"
                                                      class="form-control ckeditor">{{ $tour->does_not_include }}</textarea>
                                            @if ($errors->has('does_not_include'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('does_not_include')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('additional_info')) has-error @endif col-sm-12">
                                        <label for="additional_info" class="col-sm-1 control-label">Additional Info</label>
                                        <div class="col-sm-10">
                                            <textarea name="additional_info" id="additional_info" class="form-control ckeditor">{{ $tour->additional_info }}</textarea>
                                            @if ($errors->has('additional_info'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('additional_info')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- <div class="form-group @if ($errors->has('how_to_get')) has-error @endif col-sm-6">
                                        <label for="url" class="col-sm-2 control-label">Map</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="how_to_get" placeholder="How To Get"
                                                   name="how_to_get" value="{{ $tour->how_to_get }}">
                                            @if ($errors->has('how_to_get'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('how_to_get')}}</span>
                                            @endif
                                        </div>
                                    </div> --}}

                                    <div class="form-group @if ($errors->has('order')) has-error @endif col-sm-4">
                                        <label for="order" class="col-sm-3 control-label">Order</label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" id="order" placeholder="Order"
                                                   name="order" value="{{ $tour->order }}">
                                            @if ($errors->has('order'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('order')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-6">
                                        <label for="inputActive" class="col-sm-2 control-label">Active</label>
                                        <div class="col-sm-10">
                                            <div class="checkbox icheck">
                                                <label><input type="checkbox" value="1" name="status"
                                                              @if ($tour->status == 1) checked @endif></label>
                                            </div>
                                            @if ($errors->has('status'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('status')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                        <h3>Meta Tags: </h3>
                                    </div>

                                    <div class="form-group @if ($errors->has('keywords')) has-error @endif col-sm-6">
                                        <label for="keywords" class="col-sm-2 control-label">Keywords:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="keywords" placeholder="Keywords"
                                                   name="keywords" value="{{ $tour->keywords  }}">
                                            @if ($errors->has('keywords'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('keywords')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('description_html')) has-error @endif col-sm-6">
                                        <label for="description_html" class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description_html" id="description_html"
                                                      class="form-control">{{ $tour->description_html }}</textarea>
                                            @if ($errors->has('description_html'))
                                                <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description_html')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="box-footer">
                                    <a href="{{ route('tours.index') }}" class="btn btn-default btn-flat"><i
                                                class="fa fa-times-circle-o"
                                                aria-hidden="true"></i>&nbsp;&nbsp;Cancel</a>
                                    <button type="submit" class="btn btn-primary pull-right btn-flat"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Update
                                    </button>
                                    <a href="{{ route('tours.delete', $tour->id) }}"
                                       class="btn btn-danger pull-right btn-flat"
                                       onclick="return confirm('Delete {{ $tour->name }}?');"><i class="fa fa-trash"
                                                                                                 aria-hidden="true"></i>&nbsp;&nbsp;Delete</a>
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
                                                    <th>Order</th>
                                                    <th>Status</th>
                                                    <th style="width: 45px">Edit</th>
                                                    <th style="width: 45px">View</th>
                                                    <th style="width: 45px"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($photos as $photo)
                                                    <?php
                                                    $filename = "http://" . $_SERVER['SERVER_NAME'] . "/uploads/" . $photo->image;
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
                                                        <td>{{ $photo->order }}</td>
                                                        <td>@if ($photo->status == 1)
                                                                Active
                                                            @else
                                                                Inactive
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <a data-fancybox="iframe"
                                                               data-src="{{ route('photos.edit', [$photo->id]) }}"
                                                               data-type="iframe" href="javascript:;" title="Edit"
                                                               class="fancy1"><i class="fa fa-pencil-square-o"
                                                                                 aria-hidden="true"></i></a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="/uploads/{{ $photo->image }}"
                                                               title="Preview {{ $photo->title }}"
                                                               data-fancybox="gallery"
                                                               data-caption="<strong>{{ $photo->title }}</strong> <br >{{ $photo->description }}"><i
                                                                        class="fa fa-picture-o" aria-hidden="true"></i></a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('photos.delete', [$photo->id, $tour->id]) }}"
                                                               title="Delete {{ $photo->title }}"
                                                               onclick="return confirm('Delete {{ $photo->title }}?');"><i
                                                                        class="fa fa-trash" aria-hidden="true"></i></a>
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
                                    <form class="form-horizontal" method="post" action="{{ route('photos.store') }}"
                                          enctype="multipart/form-data">
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
                                                <label for="description" class="col-sm-2 control-label">Alt.
                                                    Text</label>
                                                <div class="col-sm-10">
                                                    <textarea name="description" id="description"
                                                              class="form-control" style="height: 80px !important;"></textarea>
                                                    @if ($errors->has('description'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('description') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group @if ($errors->has('order')) has-error @endif col-sm-12">
                                                <label for="order" class="col-sm-2 control-label">Order</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="order" name="order">
                                                    @if ($errors->has('order'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('order') }}</span>
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
                                                <button type="submit"
                                                        class="btn btn-success pull-right btn-flat col-sm-6"><i
                                                            class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add
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
                                                    <th class="text-center"></th>
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
                                                        <td class="text-center">@if ($sched->status == "1")Active @else
                                                                Inactive @endif</td>
                                                        <td class="text-center">
                                                            <a data-fancybox="iframe"
                                                               data-src="{{ route('schedules.edit', [$sched->id]) }}"
                                                               data-type="iframe" href="javascript:;" title="Edit"
                                                               class="fancy2"><i class="fa fa-pencil-square-o"
                                                                                 aria-hidden="true"></i></a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('schedules.delete', [$sched->id, $tour->id]) }}"
                                                               title="Delete"
                                                               onclick="return confirm('Are you sure?');"><i
                                                                        class="fa fa-trash" aria-hidden="true"></i></a>
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
                                                    <select class="form-control select2" multiple="multiple"
                                                            data-placeholder="Select" style="width: 100%;" id="days"
                                                            name="days[]">
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
                                                        <input type='text' class="form-control" id="start"
                                                               name="start"/>
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
                                                        <input type='text' class="form-control" id="finish"
                                                               name="finish"/>
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
                                                <button type="submit" class="btn btn-success pull-right btn-flat"><i
                                                            class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add
                                                    Schedule
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane @if (Request::route('tab') == "tab_4") active @endif" id="tab_4">
                            <div class="row">
                                <div class="col-sm-8">
                                    <h3>Prices</h3>
                                    <div class="box">
                                        <div class="box-body table-responsive no-padding">
                                            <table class="table table-hover table-bordered" id="tablita4">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">A Retail</th>
                                                    <th class="text-center">A. Disc.</th>
                                                    <th class="text-center">C. Retail</th>
                                                    <th class="text-center">C. Disc.</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center"></th>
                                                    <th class="text-center"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($prices as $price)
                                                    <tr>
                                                        <td class="text-center">${{ number_format($price->adult_retail, 2) }}</td>
                                                        <td class="text-center">${{ number_format($price->adult_discount, 2) }}</td>
                                                        <td class="text-center">${{ number_format($price->child_retail, 2) }}</td>
                                                        <td class="text-center">${{ number_format($price->child_discount, 2) }}</td>
                                                        <td class="text-center">
                                                            @if ($price->status == "1")
                                                                Active
                                                            @else
                                                                Inactive
                                                            @endif</td>
                                                        <td class="text-center">
                                                            <a data-fancybox="iframe"
                                                               data-src="{{ route('tourprices.edit', [$price->id]) }}"
                                                               data-type="iframe" href="javascript:;" title="Edit"
                                                               class="fancy4"><i class="fa fa-pencil-square-o"
                                                                                 aria-hidden="true"></i></a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('tourprices.delete', [$price->id, $tour->id]) }}"
                                                               title="Delete"
                                                               onclick="return confirm('Are you sure?');"><i
                                                                        class="fa fa-trash" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <form class="form-horizontal" method="post" action="{{ route('tourprices.store') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                                        <div class="box-body" style="padding-top: 0px; border: solid #CCC 1px;">
                                            <h3>Add a Price</h3>

                                            <div class="form-group @if ($errors->has('adult_retail')) has-error @endif col-sm-12 required">
                                                <label for="adult_retail" class="col-sm-5 control-label">Adult Retail</label>
                                                <div class="col-sm-7">
                                                    <div class='input-group date clock'>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-usd"></span>
                                                        </span>
                                                        <input type='text' class="form-control" id="adult_retail" name="adult_retail"/>

                                                    </div>
                                                    @if ($errors->has('adult_retail'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('adult_retail') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group @if ($errors->has('adult_discount')) has-error @endif col-sm-12 required">
                                                <label for="adult_discount" class="col-sm-5 control-label">Adult Discount</label>
                                                <div class="col-sm-7">
                                                    <div class='input-group date clock'>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-usd"></span>
                                                        </span>
                                                        <input type='text' class="form-control" id="adult_discount" name="adult_discount"/>

                                                    </div>
                                                    @if ($errors->has('adult_discount'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('adult_discount') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group @if ($errors->has('child_retail')) has-error @endif col-sm-12 required">
                                                <label for="child_retail" class="col-sm-5 control-label">Child Retail</label>
                                                <div class="col-sm-7">
                                                    <div class='input-group date clock'>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-usd"></span>
                                                        </span>
                                                        <input type='text' class="form-control" id="child_retail" name="child_retail"/>

                                                    </div>
                                                    @if ($errors->has('child_retail'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('child_retail') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group @if ($errors->has('child_discount')) has-error @endif col-sm-12 required">
                                                <label for="child_discount" class="col-sm-5 control-label">Child Discount</label>
                                                <div class="col-sm-7">
                                                    <div class='input-group date clock'>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-usd"></span>
                                                        </span>
                                                        <input type='text' class="form-control" id="child_discount" name="child_discount"/>

                                                    </div>
                                                    @if ($errors->has('child_discount'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('child_discount') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group @if ($errors->has('status')) has-error @endif col-sm-12">
                                                <label for="status" class="col-sm-5 control-label">Active</label>
                                                <div class="col-sm-7">
                                                    <div class="checkbox icheck">
                                                        <label><input type="checkbox" value="1" name="status"></label>
                                                    </div>
                                                    @if ($errors->has('status'))
                                                        <span class="help-block"><i class="fa fa-times-circle-o"></i> {{ $errors->first('status') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-12">
                                                <button type="submit" class="btn btn-success pull-right btn-flat"><i
                                                            class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add
                                                    Price
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
        $(function () {
            $('.select2').select2();
            $("#country_id").select2({
                maximumSelectionLength: 1
            });
        });
        $(".fancy1").fancybox({
            iframe: {
                css: {
                    width: '800px',
                    height: '515px'
                }
            }
        });
        $(".fancy2").fancybox({
            iframe: {
                css: {
                    width: '800px',
                    height: '390px'
                }
            }
        });
        $(".fancy3").fancybox({
            iframe: {
                css: {
                    width: '800px',
                    height: '360px'
                }
            }
        });
        $(".fancy4").fancybox({
            iframe: {
                css: {
                    width: '500px',
                    height: '425px'
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
                'paging': false,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                'columns': [
                    null,
                    null,
                    null,
                    null,
                    null,
                    {"width": "40px"},
                    {"width": "40px"},
                    {"width": "20px"}
                ]
            });
        });

        $(function () {
            $('#tablita2').DataTable({
                'paging': false,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                'columns': [
                    null,
                    null,
                    null,
                    null,
                    {"width": "40px"},
                    {"width": "20px"}
                ]
            });
        });

        $(function () {
            $('#tablita4').DataTable({
                'paging': false,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                'columns': [
                    null,
                    null,
                    null,
                    null,
                    null,
                    {"width": "20px"},
                    {"width": "20px"}
                ]
            });
        });

    </script>

    <script>
        $(document).ready(function () {

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