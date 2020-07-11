@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/destinations.css') }}">
@endsection

@section('title')
    Catch A Tour | The best tours!
@endsection

@section('content')
    <div id="chat">
        <a href="#chat-link"><img src="{{ asset('images/chat.png') }}"></a>
    </div>
    <div class="container-fluid" id="div-pre-logo">
        <div class="container">
            <div class="row" >
                <div class="col-md-12 text-center" id="div-logo">
                    <img src="{{ asset('images/logo-solo.png') }}" alt="Catch a Tour" class="img-responsive center-block">
                </div>
            </div>
        </div>
    </div>       
    <div class="container" id="next">
        <div class="row">
            <div class="col-md-12 text-center" id="icons">
                <img src="{{ asset('images/mapa.png') }}">
            </div>
            <div class="col-md-12 text-center">What's your next destination?</div>
            <div class="col-md-12 text-center"><a href="" title="Check our most popular tours">Don't miss any of these amazing places</a></div>
        </div>
    </div>
    <div class="container" id="search-destination">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 cajita" style="padding-left: 8px">
                <div class="col-md-8" style="padding-left: 0px">
                    <div class="input-group" style="padding-left: 0px">
                        <span class="input-group-addon" id="basic-addon1" style="padding-left: 0px">
                            <img src="{{ asset('images/lupa.png') }}" alt="" style="width: 28px">
                        </span>
                        <input type="text" class="form-control" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="region" id="region" class="form-control">
                        <option value="North America">North America</option>
                        <option value="Central America">Central America</option>
                        <option value="South America">South America</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="big-map">
        <div class="row">
            <div class="col-md-12">
                <img src="{{ asset('images/big-map.jpg') }}" class="img-responsive center-block">
            </div>
        </div>
    </div>

@endsection