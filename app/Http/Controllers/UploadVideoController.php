<?php

namespace App\Http\Controllers;

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
        return $channel->videos()->create([
            'title' => \request()->title,
            'path' => \request()->video->store("channel/{$channel->id}"),
        ]);
    }
}
