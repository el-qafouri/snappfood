<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\api\CommentRequest;
use App\Http\Requests\api\ShowCommentRequest;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Food;

class CommentController extends Controller
{









    private function transformComment($comment)
    {
        $transformedComment = [
            'author' => [
                'name' => $comment->user->name,
            ],
            'food' => $comment->order->food->name,
            'created_at' => $comment->created_at->toDateTimeString(),
            'score' => $comment->score,
            'content' => $comment->message,
        ];

        if ($comment->replies->count() > 0) {
            $transformedComment['replies'] = [];

            foreach ($comment->replies as $reply) {
                $transformedComment['replies'][] = [
                    'author' => [
                        'name' => $reply->user->name,
                    ],
                    'content' => $reply->message,
                    'created_at' => $reply->created_at->toDateTimeString(),
                ];
            }
        }

        return $transformedComment;
    }



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
            $comments = Comment::where(['food_id' => $request->food_id, 'user_id' => $user->id])
                ->with(['user', 'order.food'])
                ->orderByDesc('created_at')
                ->get();

            $transformedComments = $comments->map(function ($comment) {
                return $this->transformComment($comment);
            });

            return response(['comments' => $transformedComments->toArray()]);
        }

        if (!is_null($request->restaurant_id)) {
            $orders = Order::where(['restaurant_id' => $request->restaurant_id, 'user_id' => $user->id])
                ->with(['food', 'comments.user'])
                ->get();

            $comments = collect([]);
            foreach ($orders as $order) {
                $orderComments = $order->comments->map(function ($comment) use ($order) {
                    return [
                        'author' => [
                            'name' => $comment->user->name,
                        ],
                        'food' => $order->food->name,
                        'created_at' => $comment->created_at->toDateTimeString(),
                        'score' => $comment->score,
                        'content' => $comment->message,

                    ];
                });
                $comments = $comments->concat($orderComments);
            }

            $transformedComments = $comments->sortBy('created_at')->values()->toArray();

            return response(['comments' => $transformedComments]);
        }
    }



    public function answerComment(Request $request, $id)
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


    public function acceptComment($commentId)
    {
        // متد مربوط به تأیید کامنت
    }










//    public function deleteComment($id)
//    {
//        $comment = Comment::find($id);
//
//        if (!$comment) {
//            return redirect()->route('food.index')->with('error', 'Comment not found.');
//        }
//
//        $foodId = $comment->food->id;
//
//        $comment->delete();
//
//        return redirect()->route('food.show', ['id' => $foodId])->with('success', 'Comment deleted successfully.');
//    }



    public function deleteComment($id)
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
