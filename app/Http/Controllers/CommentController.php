<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Video $video)
    {
        return $video->comments()->paginate(10);
    }
}
