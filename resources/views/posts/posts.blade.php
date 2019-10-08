<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://bootswatch.com/4/cyborg/bootstrap.min.css">

    
    <title>Add Post</title>
</head>
<body>
    <div class="container">

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Post</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <form method="POST" action="{{ url('/addPost')}}" role="form" enctype="multipart/form-data">
                            @csrf

                                <div class="form-group row">
                                    <label for="post_title" class="col-md-4 col-form-label text-md-right">{{ __('Add Title') }}</label>

                                    <div class="col-md-6">
                                        <input id="post_title" type="text" class="form-control @error('post_title') is-invalid @enderror" name="post_title" value="{{ old('post_title') }}" required autocomplete="post_title" autofocus>

                                        @error('post_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="post_body" class="col-md-4 col-form-label text-md-right">{{ __('Add Body') }}</label>

                                    <div class="col-md-6">
                                        <textarea id="post_body" type="post_body" rows="5" class="form-control @error('post_body') is-invalid @enderror" name="post_body" value="{{ old('post_body') }}" required autocomplete="post_body"></textarea>

                                        @error('post_body')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Add Category') }}</label>

                                <div class="col-md-6">
                                    <select id="category_id" type="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id" required autocomplete="category_id">
                                        <option value="">Select</option>
                                        @if(count($categories) > 0)
                                            @foreach($categories->all() as $category)
                                                <option value="{{ $category->id }}">{{$category->category}}</option>
                                                
                                            @endforeach
                                        @endif 
                                    </select>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="post_image" class="col-md-4 col-form-label text-md-right">Upload Image</label>
                                        <div class="col-md-6">
                                            <input id="post_image" type="file" class="form-control" name="post_image">
                                            @if (auth()->user()->image)
                                            <code>{{ auth()->user()->image }}</code>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary btn-large btn-block">
                                            {{ __('Share Post') }}
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
    @endsection

</body>
</html>