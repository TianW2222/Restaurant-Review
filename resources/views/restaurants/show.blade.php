@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <img src="{{preg_match('/^http/', $restaurant->image) ? $restaurant->image : '/storage/'.$restaurant->image }}" class="w-100">
        </div>
        <div class="col-6">
            <h1 class="pt-4">{{ $restaurant->name }}</h1>
            <h2 class="pt-4">{{ $restaurant->location }}</h2>
            <h3 class="pt-4">Posted by: {{ $restaurant->user->name }}</h3>
            <div class="pt-4">
                <h3 class="pt-1">Average Rating:</h3>
                @for ($i = 0; $i < round($restaurant->reviews->avg('rating')); $i++)
                    <span class="fa fa-star fa-3x pt-3" style="color:orange"></span>
                @endfor
            </div>
        </div>
    </div>
    <div class="mt-5">
        <div class="row">
            <h2 class="col-10">Reviews</h2>
            <sort-menu restaurant_id="{{ $restaurant->id }}" class="col-2"></sort-menu>
        </div>
        @foreach($reviews as $review)
        <div class="card mt-4">
            <div class="card-header">
                <div class="row pt-2">
                    <h3 class="col-6">{{ $review->title }}</h4>
                    <div class="col-6">   
                        @for ($i = 0; $i < $review->rating; $i++)
                            <span class="fa fa-star fa-2x" style="color:orange"></span>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text h5">{{ $review->body }}</p>
            </div>
            <div class="card-footer">
                Posted by {{ $review->user->name }} at {{ $review->created_at->toDateString() }}
            </div>
        </div>
        @endforeach
    </div>
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center">
            {{ $reviews->appends(['sort' => $sort])->links() }}
        </div>
    </div>
    <a href="/reviews/create?restaurant_id={{ $restaurant->id }}" class="btn btn-primary btn-lg mt-4 h1">Write a Review</a>
</div>
@endsection
