@extends('layouts.app')

@section('content')

    @auth
        <h1>Edit album</h1>

        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading"><h2>Upload album cover</h2></div>
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

                    <form action="{{ route('update_album', $album->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <label for="name">New name of album:</label>
                                <input type="text" name="name" class="form-control" placeholder=" {{ $album->name }}">
                            </div>
                        </div>
                        @if (!$message = Session::get('success'))
                        <img src=" {{ url('/images/' . $album->album_cover ) }}" class="col-md-6" alt="album cover">
                        @endif
                        <div class="row">
                            <div class="form-group">
                                <label for="name">New album cover:</label>
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