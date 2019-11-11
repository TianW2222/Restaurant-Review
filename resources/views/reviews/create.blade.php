@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/reviews?restaurant_id={{ $restaurant_id }}" enctype="multipart/form-data" method="post">
        @csrf

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h2>Write a Customer Review</h1>
                </div>
                
                <div class="form-group row mt-3">
                    <label for="title" class="col-4 h4">Title</label>

                    <input id="title"
                           type="text"
                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                           name="title"
                           value="{{ old('title') }}"
                           autocomplete="off" autofocus>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="body" class="col-4 h4">Body</label>

                    <textarea name="body" id="body" cols="30" rows="10" class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}">{{ old('body') }}</textarea>

                    @if ($errors->has('body'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="rating" class="col-4 h4">Rating</label>

                    <div class="rating w-100 mt-2">
                        @for ($i = 1; $i <= 10; $i++)
                            <input id="rating{{ $i }}" type="radio" name="rating" value="{{ $i }}">{{ $i }}&nbsp&nbsp&nbsp&nbsp
                        @endfor
                    </div>

                    @if ($errors->has('rating'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('rating') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary btn-lg">Submit</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
