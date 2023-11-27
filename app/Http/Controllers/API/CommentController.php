<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\api\CommentRequest;
use App\Http\Requests\api\ShowCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    public function store(CommentRequest $request)
    {
        $order = $request->order_id;

        Comment::query()->create([
            'user_id' => auth()->user()->id,
            'order_id' => $order,
            'food_id' => $request->food_id,
            'message' => $request->message,
            'score' => $request->score,
        ]);

        return response(['message' => 'comment created successfully']);
    }



//    public function index(Request $request)
//    {
//        $user = auth()->user();
//
//        if (!is_null($request->food_id)) {
//            $comments = Comment::query()
//                ->where(['food_id' => $request->food_id, 'user_id' => $user->id])
//                ->with(['user', 'order'])
//                ->orderByDesc('created_at')
//                ->get();
//
//            $viewComments = $comments->map(function ($comment) {
//                return $this->viewComment($comment);
//            });
//
//            return response(['comments' => $viewComments]);
//        }
//
//        if (!is_null($request->restaurant_id)) {
//            $orders = Order::query()
//                ->where(['restaurant_id' => $request->restaurant_id, 'user_id' => $user->id])
//                ->get();
//
//            $comments = collect([]);
//
//            foreach ($orders as $order) {
//                $orderComments = $order->comments->map(function ($comment) use ($order) {
//                    return $this->viewComment($comment);
//                });
//
//                $comments = $comments->concat($orderComments);
//            }
//
//            $sortedComments = $comments->sortBy('created_at')->values();
//
//            return response(['comments' => $sortedComments]);
//        }
//    }


    public function index(ShowCommentRequest $request)
    {
        $user = auth()->user();

        $comments = Comment::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return response(['comments' => $comments]);


//
//        if (!is_null($request->food_id)) {
//            $comments = Comment::query()
//                ->where(['food_id' => $request->food_id, 'user_id' => $user->id])
//                ->with(['user', 'order.food'])
//                ->orderByDesc('created_at')
//                ->get();
//
//            $transformedComments = $comments->map(function ($comment) {
//                return $this->transformComments($comment);
//            });
//
//            return response(['comments' => $transformedComments]);
//        }
//
//        if (!is_null($request->restaurant_id)) {
//            $orders = Order::query()
//                ->where(['restaurant_id' => $request->restaurant_id, 'user_id' => $user->id])
//                ->with('food')
//                ->get();
//
//            $comments = collect([]);
//            foreach ($orders as $order) {
//                $orderComments = $order->comments->map(function ($comment) use ($order) {
//                    return [
//                        'author' => [
//                            'name' => $comment->user->name,
//                        ],
//                        'food' => $order->foods->pluck('name')->toArray(),
//                        'created_at' => '',
//                        'score' => $comment->score,
//                        'content' => $comment->message,
//                    ];
//                });
//                $comments = $comments->concat($orderComments);
//            }
//
//            $sortedComments = $comments->sortBy('created_at')->values();
//
//            return response(['comments' => $sortedComments]);
//        }



    }
}
