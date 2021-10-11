<?php

namespace App\Http\Controllers;

use App\Jobs\ConvertVideoForStreaming;
use App\Jobs\CreateVideoThumbnail;
use App\Models\Channel;
use Illuminate\Http\Request;

class UploadVideoController extends Controller
{
    public function index(Channel $channel)
    {
        return view('channel.upload', compact('channel'));
    }

    public function store(Channel $channel)
    {
        $video = $channel->videos()->create([
            'title' => explode('.', \request()->title)[0],
            'path' => \request()->video->store("channel/{$channel->id}"),
        ]);

        CreateVideoThumbnail::dispatch($video);
        ConvertVideoForStreaming::dispatch($video);

        return $video;
    }
}
