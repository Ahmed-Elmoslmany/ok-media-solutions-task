<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ImageController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request, Album $album)
    {
        if ($request->has('image')) {
            $img = $album->addMedia($request->image)->toMediaCollection();
            $imageUrl = $img->getUrl();

            $title = $request->input('title');

            $image = new Image();
            $image->url = $imageUrl;
            $image->title = $title;
            $image->album_id = $album->id;
            $image->save();
        }


        return redirect()->back();
    }

    public function destroy(Album $album, $id)
    {
        $this->authorize('update', $album);
        $image = Image::where('id', $id)->first();
        $image->delete();

        return redirect()->back();
    }

    public function edit(Album $album, $id)
    {
        $this->authorize('update', $album);
        $image = Image::where('id', $id)->first();


        return view('images.edit', compact('image', 'album'));
    }

    public function update(Request $request, Album $album, $id)
    {
        $this->authorize('update', $album);
        $image = Image::where('id', $id)->first();

        $image->update($request->only('title'));

        return view('images.edit', compact('image', 'album'));
    }


}
