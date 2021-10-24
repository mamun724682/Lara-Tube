<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Video;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->paginate(20);
        return view('welcome', compact('videos'));
    }

    public function search()
    {
        $search = \request()->search;
        if ($search){
            $videos = Video::where('title', 'LIKE', "%{$search}%")->orWhere('description', 'LIKE', "%{$search}%")->latest()->paginate(10, '*', 'videos_page');
            $channels = Channel::where('name', 'LIKE', "%{$search}%")->orWhere('description', 'LIKE', "%{$search}%")->withCount('videos')->latest()->paginate(10, '*', 'channel_page');
        }

        return view('search', compact('videos', 'channels'));
    }
}
