<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class AlbumController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $albums = Auth::user()->albums;
        return view('albums.index', compact('albums'));
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $album = Auth::user()->albums()->create($request->only('title'));
        return redirect()->route('albums.index', $album);
    }

    public function show(Album $album)
    {
        $this->authorize('view', $album);
//      $images = $album->getMedia();
        $images = Image::where('album_id', $album->id)->get();

        return view('albums.show', compact('images' ,'album'));
    }

    public function edit(Album $album)
    {
        $this->authorize('update', $album);
        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $this->authorize('update', $album);
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $album->update($request->only('title'));
        return redirect()->route('albums.index', $album);
    }

    public function destroy(Album $album)
    {
        $this->authorize('delete', $album);
        $album->delete();
        return redirect()->back();
    }

    public function delete(Album $album)
    {
        $this->authorize('delete', $album);
        $album->images()->delete();
        $album->delete();

        return redirect()->back();

        
    }

    public function moveImages(Album $album, $targetAlbumId)
    {
        $this->authorize('update', $album);
        if ($album->id === $targetAlbumId) {
            return redirect()->back();
        }


        Image::where('album_id', $album->id)->update(['album_id' => $targetAlbumId]);
        $album->delete();

        return redirect()->back();

    }
    public function upload(Request $request, Album $album)
    {

        if ($request->has('image')) {
            $album->addMedia($request->image)->toMediaCollection();
        }
        return redirect()->back();
    }
}
