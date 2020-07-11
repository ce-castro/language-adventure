@extends('layouts.master')

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/home.css') }}"> --}}
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
                <img src="{{ asset('images/avion.png') }}" alt="Air Travel">
                <img src="{{ asset('images/bote.png') }}" alt="Boat Travels">
                <img src="{{ asset('images/bus.png') }}" alt="Bus Travel">
            </div>
            <div class="col-md-12 text-center">What's your next destination?</div>
            <div class="col-md-12 text-center"><a href="" title="Check our most popular tours">Check our most popular tours</a></div>
        </div>

    </div>


@endsection