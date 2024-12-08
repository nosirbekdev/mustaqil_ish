<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        // Validate title and youtube_link
        $request->validate([
            'title' => 'required|string|max:255',
            'youtube_link' => 'required|url',
        ]);

        // Save the video with both title and youtube link
        Video::create([
            'title' => $request->title,       // Save the title
            'youtube_link' => $request->youtube_link,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video muvaffaqiyatli qo\'shildi!');
    }

    public function index()
    {
        $videos = Video::latest()->paginate(9);
        return view('admin.videos.index', compact('videos'));
    }

    public function destroy($id)
    {
        // Find the video by ID
        $video = Video::findOrFail($id);
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video muvaffaqiyatli o‘chirildi!');
    }
}
