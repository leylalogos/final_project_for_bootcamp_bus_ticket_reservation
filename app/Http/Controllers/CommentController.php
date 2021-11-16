<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    public function index()
    {
        return CommentResource::collection(Comment::all());
    }
    public function create(Request $request)
    {
        if (!Gate::allows('comment')) {
            abort(403);
        };

        Comment::create(

            $request->except('user_id') + ['user_id' => auth()->id()]
        );
        return response()->json(array('message' => 'نظر شما اضافه شد'), 201);
    }
}
