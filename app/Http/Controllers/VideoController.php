<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show(Video $video)
    {
        if (\request()->wantsJson()){
            return $video;
        }

        $otherVideos = Video::where('id', '!=', $video->id)->where('channel_id', $video->channel->id)->latest()->take(8)->get();
        return view('video', compact('video', 'otherVideos'));
    }

    public function myVideos()
    {
        $videos = Video::where('channel_id', auth()->user()->channel->id)->latest()->paginate();

        return view('video.my_videos', compact('videos'));
    }

    public function updateViews(Video $video)
    {
        $video->increment('views');

        return response()->json([]);
    }
}
