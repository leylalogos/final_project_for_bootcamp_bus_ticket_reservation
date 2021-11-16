<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
    }
    public function create(Request $request)
    {
        Comment::create([
            $request->input(),
        ]);
    }
}
