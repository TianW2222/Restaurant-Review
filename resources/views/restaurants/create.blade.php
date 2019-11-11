@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/restaurants" enctype="multipart/form-data" method="post">
        @csrf

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Add New Restaurant</h1>
                </div>
                
                <div class="form-group row">
                    <label for="name" class="col-4 h4">Name</label>

                    <input id="name"
                           type="text"
                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name"
                           value="{{ old('name') }}"
                           autocomplete="off" autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="location" class="col-4 h4">Location</label>

                    <input id="location"
                           type="text"
                           class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}"
                           name="location"
                           value="{{ old('location') }}"
                           autocomplete="off">

                    @if ($errors->has('location'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="image" class="col-4 h4">Image</label>

                    <input type="file" class="form-control-file" id="image" name="image">

                    @if ($errors->has('image'))
                        <strong>{{ $errors->first('image') }}</strong>
                    @endif
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Add New Restaurant</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
