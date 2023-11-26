<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\api\CommentRequest;
use App\Http\Requests\api\ShowCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
//    public function store(Request $request)
//    {
//        $request->validate([
//            'order_id' => 'required',
//            'food_id' => 'required',
//            'score' => 'required|integer|min:1|max:5',
//            'message' => 'required|string'
//        ]);
//        $order = $request->order_id;
////        $food = $request->food_id;
//        Comment::query()->create([
//            'user_id' => auth()->user()->id,
//            'order_id' => $order,
//            'food_id' => $request->food_id,
//            'message' => $request->message,
//            'score' => $request->score,
//        ]);
//        return response(['message' => 'comment created successfully']);
//    }



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
////        $request->validate([
////            'food_id' => ['nullable', Rule::requiredIf(is_null($request->restaurant_id)), Rule::exists('foods', 'id')],
////            'restaurant_id' => ['nullable', Rule::requiredIf(is_null($request->food_id)), Rule::exists('restaurants', 'id')],
////        ]);
//
//        $request->validate([
//            'food_id' => ['nullable', 'exists:foods,id'],
//            'restaurant_id' => ['nullable', 'exists:restaurants,id'],
//        ]);
//        if (!is_null($request->food_id)) {
//            $comments = Comment::query()->where(['food_id' => $request->food_id, 'user_id' => auth()->user()->id])->orderByDesc('created_at')->get();
//            return response(['Comments' => CommentResource::collection($comments)]);
//        }
//
//        if (!is_null($request->restaurant_id)) {
//            $comments = [];
//            $orders = Order::where(['restaurant_id' => $request->restaurant_id, 'user_id' => auth()->user()->id])->get();
//            foreach ($orders as $order) {
//                foreach ($order->comments as $comment) {
//                    $comments[$comment->created_at->format('Y-m-d-H-i-s')] = $comment;
//                }
//            }
//            ksort($comments);
//            return response(['Comments' => CommentResource::collection(array_values($comments))]);
//        }
//
//
//    }



//    public function index(Request $request)
//    {
//        $request->validate([
//            'food_id' => 'nullable|exists:food,id',
//            'restaurant_id' => 'nullable|exists:restaurants,id',
//        ]);
//
//        $user = auth()->user();
//
//        if (!is_null($request->food_id)) {
//            $comments = Comment::query()
//                ->where(['food_id' => $request->food_id, 'user_id' => $user->id])
//                ->with(['user', 'order.food'])
//                ->orderByDesc('created_at')
//                ->get();
//
//            $transformedComments = $comments->map(function ($comment) {
//                return $this->transformComment($comment);
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
//                        'message' => $comment->message,
//                    ];
//                });
//                $comments = $comments->concat($orderComments);
//            }
//
//            $sortedComments = $comments->sortBy('created_at')->values();
//
//            return response(['comments' => $sortedComments]);
//        }
//    }




//    public function index(Request $request)
//    {
//        $request->validate([
//            'food_id' => 'nullable|exists:foods,id',
//            'restaurant_id' => 'nullable|exists:restaurants,id',
//        ]);
//
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

        if (!is_null($request->food_id)) {
            $comments = Comment::query()
                ->where(['food_id' => $request->food_id, 'user_id' => $user->id])
                ->with(['user', 'order'])
                ->orderByDesc('created_at')
                ->get();

            $viewComments = $comments->map(function ($comment) {
                return $this->viewComment($comment);
            });

            return response(['comments' => $viewComments]);
        }

        if (!is_null($request->restaurant_id)) {
            $orders = Order::query()
                ->where(['restaurant_id' => $request->restaurant_id, 'user_id' => $user->id])
                ->get();

            $comments = collect([]);

            foreach ($orders as $order) {
                $orderComments = $order->comments->map(function ($comment) use ($order) {
                    return $this->viewComment($comment);
                });

                $comments = $comments->concat($orderComments);
            }

            $sortedComments = $comments->sortBy('created_at')->values();

            return response(['comments' => $sortedComments]);
        }
    }



}
