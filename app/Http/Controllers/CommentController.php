<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Video $video)
    {
        return $video->comments()->latest()->paginate(10);
    }

    public function show(Comment $comment)
    {
        return $comment->replies()->paginate(10);
    }
}
