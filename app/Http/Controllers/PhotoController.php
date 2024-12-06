<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function photoIndex()
{
    $photos = Photo::all();
    // dd($photos);
    return view('admin.photos.index', compact('photos'));
}


    public function create()
    {
        return view('admin.photos.create');
    }

    public function show(Photo $photo)
{
    return view('admin.photos.show', compact('photo'));
}


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $request->file('image')->store('photos', 'public');

        Photo::create([
            'title' => $request->title,
            'image' => $imagePath,
        ]);

        return redirect()->route('photos.index')->with('success', 'Photo added successfully!');
    }

    public function edit(Photo $photo)
    {
        return view('admin.photos.edit', compact('photo'));
    }

    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($photo->image);
            $photo->image = $request->file('image')->store('photos', 'public');
        }

        $photo->update([
            'title' => $request->title,
            'image' => $photo->image,
        ]);

        return redirect()->route('photos.index')->with('success', 'Photo updated successfully!');
    }

    public function destroy(Photo $photo)
    {
        Storage::disk('public')->delete($photo->image);
        $photo->delete();

        return redirect()->route('photos.index')->with('success', 'Photo deleted successfully!');
    }
}

