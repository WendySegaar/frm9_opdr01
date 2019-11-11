<?php

namespace App\Http\Controllers;

use App\Album;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PhotoController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id)
    {
        $album = Album::find($id);
        return view('photos.create', compact('album'));
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

        $photo = New Photo();

        $photo->name = $request->name;
        $photo->image = $image;
        $photo->album_id = $request->album;

        $photo->save();

        request()->image->move(public_path('images'), $image);

        return back()
            ->with('success', 'You have successfully added this photo.')
            ->with('image', $image);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::find($id);
        return view('photos.edit', compact('photo'));
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

        Photo::where('id', $id)->update(array(
            'name' => $request->name,
            'image' => $image,
        ));

        request()->image->move(public_path('images'), $image);

        return back()
            ->with('success', 'You have successfully updated this photo.')
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
        Photo::where('id', $id)->delete();
        return redirect()->route('albums');
    }
}
