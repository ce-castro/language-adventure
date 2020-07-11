@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
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
    <div class="container-fluid next-cat" id="next" style="background-color: #f2f2f2">
        <div class="row">
            <div class="col-md-12 text-center" id="icons" style="margin-bottom: 10px">
                <img src="{{ asset('images/about.png') }}" alt="Air Travel">
            </div>
            <div class="col-md-12 text-center">How was Catch a Tour born?</div>
            <div class="col-md-12 text-center rem2">Get to know our story</div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center" style="padding: 25px 15px">
                <iframe width="720" height="405" src="https://www.youtube.com/embed/dkPLIw9aZwY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <div class="container" id="meet" >
        <div class="row" style="margin-top: 25px" id="our-team">
            <div class="col-md-12 text-center" id="icons" style="margin-bottom: 10px">
                <img src="{{ asset('images/hands.png') }}" alt="Air Travel">
            </div>
            <div class="col-md-12 text-center rem1" style="line-height: 0.5">Our Team</div>
            <div class="col-md-12 text-center rem2">Meet our experts</div>
        </div>
        <div class="row">
            <div class="review">
                <img src="{{ asset('images/yeni.png') }}" alt="" class="img-responsive center-block">
                <div class="text">
                    Aenean porta eros ut feugiat dignissim. Vivamus sed mollis nunc. Suspendisse non nibh nunc. Donec nulla felis, bibendum at pulvinar et, molestie sed felis. Nulla tempor hendrerit feugiat. Ut egestas est sit amet turpis ornare rhoncus. Mauris in arcu tristique magna cursus varius.
                </div>                
                <div class="author">- Yeni, Director</div>
            </div>
            <div class="review">
                <img src="{{ asset('images/yeni.png') }}" alt="" class="img-responsive center-block">
                <div class="text">
                    Quisque aliquam tellus nec ante vulputate, vestibulum euismod dolor sagittis. Aenean viverra enim vel diam tincidunt eleifend blandit ac massa. Donec nec tempus diam. Nulla vitae augue nec tellus placerat ultricies sit amet a erat. Cras a magna tellus.
                </div>                
                <div class="author">- Christina, Tour Guide</div>
            </div> 
            <div class="review">
                <img src="{{ asset('images/dude.png') }}" alt="" class="img-responsive center-block">
                <div class="text">
                    Cras iaculis dictum nulla, vitae aliquam augue dictum sit amet. Ut suscipit laoreet aliquam. Duis sed euismod eros. Quisque in mi a diam scelerisque dapibus ut vitae ex. Sed dictum leo eget arcu placerat pharetra. Vestibulum laoreet hendrerit magna, eget sagittis sem.
                </div>                
                <div class="author">- Ruben, Tour Guide</div>
            </div>
            <div class="review">
                <img src="{{ asset('images/dude.png') }}" alt="" class="img-responsive center-block">
                <div class="text">
                    Quisque aliquam tellus nec ante vulputate, vestibulum euismod dolor sagittis. Aenean viverra enim vel diam tincidunt eleifend blandit ac massa. Donec nec tempus diam. Nulla vitae augue nec tellus placerat ultricies sit amet a erat. Cras a magna tellus.
                </div>                
                <div class="author">- Alfredo, Tour Guide</div>
            </div>                                   
        </div>
    </div>

@endsection