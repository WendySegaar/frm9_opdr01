
@extends('layouts.app')

@section('content')

    @auth
        Login was successful, you are now able to make changes in the gallery
    @endauth

    @guest
        Welcome! This is a (very) simple photo gallery
    @endguest
@endsection