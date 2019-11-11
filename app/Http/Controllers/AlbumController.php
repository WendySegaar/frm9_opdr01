<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::all();
        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:50'
        ]);

        $image = pathinfo(Input::file('image')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . request()->image->getClientOriginalExtension();

        $album = New Album();

        $album->name = $request->name;
        $album->album_cover = $image;

        $album->save();

        request()->image->move(public_path('images'), $image);

        return back()
            ->with('success', 'You have successfully created this album.')
            ->with('image', $image);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photos = Photo::where('album_id', '=', $id)->get();
        $album = Album::find($id);
        return view('albums.show', compact('photos', 'album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::find($id);
        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:50'
        ]);

        $image = pathinfo(Input::file('image')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . request()->image->getClientOriginalExtension();

        Album::where('id', $id)->update(array(
            'name' => $request->name,
            'album_cover' => $image
        ));

        request()->image->move(public_path('images'), $image);

        return back()
            ->with('success', 'You have successfully updated this album.')
            ->with('image', $image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Album::where('id', $id)->delete();
        return redirect()->route('albums');
    }
}
