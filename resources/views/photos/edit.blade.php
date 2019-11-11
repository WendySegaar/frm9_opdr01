@extends('layouts.app')

@section('content')

    @auth
        <h1>Edit photo</h1>

        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading"><h2>Upload new photo</h2></div>
                <div class="panel-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        <img src=" {{ url('/images/' . Session::get('image')) }} ">

                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('update_photo', $photo->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <label for="name">New name of photo:</label>
                                <input type="text" name="name" class="form-control" placeholder=" {{ $photo->name }}">
                            </div>
                        </div>
                        @if (!$message = Session::get('success'))
                            <img src=" {{ url('/images/' . $photo->image ) }}" class="col-md-6" alt="photo cover">
                        @endif
                        <div class="row">
                            <div class="form-group">
                                <label for="name">New photo:</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    @endauth

@endsection
