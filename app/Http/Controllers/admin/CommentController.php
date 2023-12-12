<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use http\Env\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view('panel.admin.comments.index');
    }

    public function update(Request $request, Comment $comment)
    {
        $comment = Comment::query()->findOrFail($comment);

//        orders->map(fn($order) => $order->comments->first())->filter(fn($comment) => $comment !== null)->sortByDesc('created_at');
    }

    public function destroy()
    {

    }



}
