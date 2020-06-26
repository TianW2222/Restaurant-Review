@extends('layouts.app')

@section('content')
<div class="container">
    @if (Auth::check())
        <a href="/restaurants/create" class="btn btn-primary" role="button">Add New restaurant</a>
    @endif
    <div class="row">
        <sort-menu class="col-2 offset-10"></sort-menu>
    </div>
    <div class="album py-3 bg-light">
        <div class="container">
            <div class="row">
                @foreach($restaurants as $restaurant)
                    <a class="col-md-4" style="text-decoration:none" href="/restaurants/{{ $restaurant->id }}?sort=new">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" src="{{ $restaurant->image }}">
                            <div class="card-body">
                                <h3 class="card-title">{{ $restaurant->name }}</h3>
                                <h4 class="car-subtitle">{{ $restaurant->location }}</h4>
                                <div>
                                    @for ($i = 0; $i < round($restaurant->reviews->avg('rating')); $i++)
                                        <span class="fa fa-star fa-2x" style="color:orange"></span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
