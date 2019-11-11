@extends('layouts.app')

@section('content')

    <h1>{{ $album->name }}</h1>
    <table class="table table-striped table-bordered">
        <tbody>
        @foreach($photos as $key => $photo)
            <div class="card" style="width: 18rem;">
                <img src=" {{ url('/images/' . $photo->image ) }}" class="card-img-top" alt="album cover">
                <div class="card-body">
                    <h5 class="card-title">{{ $photo->name }}</h5>
                    <form action="{{ route('delete_photo',$photo->id) }}" method="POST">
                        @auth
                            <a href="{{ route('edit_photo', $photo->id ) }}" class="btn btn-primary">Edit photo</a>

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete photo</button>
                    </form>
                    @endauth
                </div>
            </div>
        @endforeach
        </tbody>
    </table>

    @auth
        <a href=" {{ route('create_photo', $album->id ) }}">New photo</a>
    @endauth

@endsection