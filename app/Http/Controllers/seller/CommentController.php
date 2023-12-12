<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = auth()->user()->restaurant->orders->map(fn($order) => $order->comments->first())->filter(fn($comment) => $comment !== null);
        return view('panel.seller.comments.index', ['comments' => $comments]);

    }

    public function update(Comment $comment, $status)
    {
//        dd('hi');
        $comment->update([
            'status' => $status
        ]);
        return auth()->user()->hasRole('admin') ? redirect()->route('comments.all') : redirect()->route('comments.index') ;
    }

    public function destroy(Comment $comment)
    {
            $comment->delete();
        return redirect()->route('comments.all');
    }

    public function create(Comment $comment)
    {
        $reply = Comment::query()->where('parent_id', $comment->id)->first();
        return view('panel.seller.comments.create', ['reply' => $reply, 'comment' => $comment]);
    }

    public function store(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'message' => 'required',
            'order_id' => 'required',
//           'score'=>'required',
            'parent_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ]);

        Comment::query()->updateOrCreate(['parent_id' => $comment->id], $validated);
        return redirect()->route('comments.index');
    }


    public function viewComments()
    {
        $comments = Comment::query()->where('status' , 'delete_request')->get();
        return view('panel.admin.comments.index', ['comments' => $comments]);
    }

}
