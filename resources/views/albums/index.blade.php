@extends('layouts.app')

@section('content')

    <h1>Photo albums</h1>
<table class="table table-striped table-bordered">
    <tbody>
@foreach($albums as $key => $album)
    <div class="card" style="width: 18rem;">
        <img src=" {{ url('/images/' . $album->album_cover ) }}" class="card-img-top" alt="album cover">
        <div class="card-body">
            <h5 class="card-title">{{ $album->name }}</h5>
            <form action="{{ route('delete_album',$album->id) }}" method="POST">
                <a href="{{ route('show_album', $album->id ) }}" class="btn btn-primary">Bekijk album</a>
                @auth
                <a href="{{ route('edit_album', $album->id ) }}" class="btn btn-primary">Edit album</a>

                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete album</button>
            </form>
            @endauth
        </div>
    </div>
    @endforeach
    </tbody>
    </table>

@auth
    <a href=" {{ route('create_album') }}">New album</a>
@endauth

@endsection