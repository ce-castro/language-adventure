@extends('layouts.master')

@section('css')
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
                    <img src="{{ asset('images/logo.png') }}" alt="Catch a Tour" class="img-responsive">
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
        <div class="row" style="margin-top: 20px" id="destinations">
            <div class="col-md-12" style="padding: 0px">
                <div class="carousel slide multi-item-carousel" id="slide-destination">
                    <div class="carousel-inner">

                        @foreach($tours as $tour)
                        <div class="item @if ($loop->first) active @endif">
                            <div class="col-md-3">
                                @foreach ($tour->photos as $photo)
                                    @if($photo->type_id == '1')
                                        <img src="{{ asset('uploads/'.$photo->image) }}" alt="{{ $photo->name }}"  title="{{ $photo->name }}" class="img-responsive img-destino">
                                    @else
                                        <img src="{{ asset('images/logo_placeholder.jpg') }}" alt="{{ $tour->name }}"  title="{{ $tour->name }}" class="img-responsive img-destino">
                                    @endif
                                @endforeach
                                <div class="home-destino">
                                    <div class="row">
                                        <div class="col-md-8"><a href="{{ route('tour.show', $tour->url) }}" title="{{ $tour->name }}">{{ $tour->name }}</a></div>
                                        <div class="col-md-4 text-center"><i class="fa fa-suitcase" aria-hidden="true"></i></div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-8 pais">{{ $tour->country->name }}</div>
                                        <div class="col-md-4 text-center"><a href="{{ route('tour.show', $tour->url) }}" title="{{ $tour->name }}" class="btn btn-cat-home">Book</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <ol class="carousel-indicators">
                        @for ($i = 0; $i < count($tours); $i++)
                        <li data-target="#slide-destination" data-slide-to="{{ $i }}" @if($i == '0') class="active" @endif></li>
                        @endfor
                    </ol>
                    <a class="left carousel-control" href="#slide-destination" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#slide-destination" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>

            </div>
        </div>

    </div>
    <div class="container-fluid" id="remember">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="{{ asset('images/camara.png') }}" class="img-icon">
                    <span class="rem1">To remember is to live again</span>
                    <span class="rem2">Our best moments</span>
                </div>
            </div>

            <div class="row" style="margin-top: 20px; padding-bottom: 40px">
                <div class="col-md-12" style="padding: 0px">
                    <div class="carousel slide multi-item-carousel" id="slide-remember">
                        <div class="carousel-inner">
                            @foreach($sliders as $slider)
                            <div class="item @if ($loop->first) active @endif">
                                <div class="col-md-3"><img src="{{ asset('uploads/'.$slider->image) }}" alt="{{ $slider->title }}" class="img-responsive"></div>
                            </div>
                            @endforeach
                        </div>
                        <ol class="carousel-indicators">
                            @for ($i = 0; $i < count($sliders); $i++)
                            <li data-target="#slide-remember" data-slide-to="{{ $i }}" @if($i == '0') class="active" @endif></li>
                            @endfor
                        </ol>
                        <a class="left carousel-control" href="#slide-remember" data-slide="prev" style="width: 1%"><i class="glyphicon glyphicon-chevron-left" style="color: #FFF;"></i></a>
                        <a class="right carousel-control" href="#slide-remember" data-slide="next" style="width: 1%"><i class="glyphicon glyphicon-chevron-right" style="color: #FFF;"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="reviews">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="{{ asset('images/cheque.png') }}" class="img-icon">
                <span class="rem1">Our actions speak louder than our words</span>
                <span class="rem2">Our customers reviews</span>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">

            @foreach($reviews as $review)
            <div class="review">
                <div class="col-md-12 text-center stars">
                    @for ($i = 1; $i <= $review->stars; $i++)
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @endfor
                    @for ($i = 1; $i <= (5-$review->stars); $i++)
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @endfor
                </div>
                <div class="text">
                    {{ strip_tags($review->review) }}
                </div>

                <div class="author">- {{ $review->name }}, {{ $review->country }}</div>
            </div>
            @endforeach
        </div>
    </div>
@endsection