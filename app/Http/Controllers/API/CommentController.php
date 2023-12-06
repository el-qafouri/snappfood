<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\api\CommentRequest;
use App\Http\Requests\api\ShowCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Food;

class CommentController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'score' => 'required|integer|min:1|max:5',
            'message' => 'required|string',
        ]);

        $order = Order::find($request->order_id);

        if (!$order) {
            return response(['error' => 'Order not found.']);
        }

        if ($order->seller_status !== 'delivered') {
            return response(['error' => 'You can only comment on delivered orders.']);
        }

        $existingComment = Comment::where('user_id', auth()->user()->id)
            ->where('order_id', $order->id)
            ->first();

        if ($existingComment) {
            return response(['error' => 'You have already commented on this order.']);
        }

        Comment::create([
            'user_id' => auth()->user()->id,
            'order_id' => $order->id,
            'message' => $request->message,
            'score' => $request->score,
        ]);

        return response(['message' => 'Comment created successfully']);
    }


    public function index(Request $request)
    {
        $user = auth()->user();

        if (!is_null($request->food_id)) {

            $food = Food::query()->findOrFail($request->food_id);
            $orders = $food->orders->filter(fn($order) => $order->comments->first() !== null);
            $comments = $orders->map(fn($order) => $order->comments)->map(fn($comment) => $comment->first())->filter(fn($comment)=>$comment->status=='accepted');
            return response()->json(['comments' => CommentResource::collection($comments)]);
        }

        if (!is_null($request->restaurant_id)) {
            $restaurant = Restaurant::query()->find($request->restaurant_id);
            $comments = $restaurant->comments->filter(fn($comment) => $comment->parent_id == null and $comment->status == 'accepted');
            return response()->json(['comments' => CommentResource::collection($comments)]);

        }

    }


    public
    function answerComment(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->route('food.index')->with('error', 'Comment not found.');
        }

        $request->validate([
            'answer' => 'required|string',
        ]);

        $reply = new Reply([
            'message' => $request->input('answer'),
        ]);

        $comment->replies()->save($reply);

        if ($comment->order) {
            return redirect()->route('food.show', ['id' => $comment->order->food_id])->with('success', 'Answer added successfully.');
        } else {
            return redirect()->route('food.index')->with('error', 'Order not found for the comment.');
        }
    }


    public
    function acceptComment($commentId)
    {
        // متد مربوط به تأیید کامنت
    }


    public
    function deleteComment($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->route('food.index')->with('error', 'Comment not found.');
        }

        if (!$comment->food) {
            return redirect()->route('food.index')->with('error', 'Comment is not associated with any food.');
        }

        $foodId = $comment->food->id;

        $comment->delete();

        return redirect()->route('food.show', ['id' => $foodId])->with('success', 'Comment deleted successfully.');
    }


}
