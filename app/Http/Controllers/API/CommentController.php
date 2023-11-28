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


//    public function store(CommentRequest $request)
//    public function store(Request $request)
//    {
//        $order = $request->order_id;
//
//        Comment::query()->create([
//            'user_id' => auth()->user()->id,
//            'order_id' => $order,
//            'food_id' => $request->food_id,
//            'message' => $request->message,
//            'score' => $request->score,
//        ]);
//
//        return response(['message' => 'comment created successfully']);
//    }


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


//    public function index(ShowCommentRequest $request)
//    {
//        $user = auth()->user();
//
//        $comments = Comment::query()->where('user_id', $user->id)
//            ->orderByDesc('created_at')
//            ->get();
//
//        return response(['comments' => $comments]);
//}

//    public function index(ShowCommentRequest $request)
//    public function index(Request $request)
//    {
//        $user = auth()->user();
//
//        $comments = Comment::query()->where('user_id', $user->id)
//            ->orderByDesc('created_at')
//            ->get();
//
////        return response(['comments' => $comments]);
//
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
////                        'created_at' => '',
//                        'score' => $comment->score,
//                        'content' => $comment->message,
//                        'created_at' => $comment->created_at->toDateTimeString(),
//
//                    ];
//                });
//                $comments = $comments->concat($orderComments);
//            }
//
//            $sortedComments = $comments->sortBy('created_at')->values();
//
//            return response(['comments' => $sortedComments]);
//        }
//
//
//    }


//    private function transformComment($comment)
//    {
//        return [
//            'author' => [
//                'name' => $comment->user->name,
//            ],
//            'food' => $comment->order->food->name,
//            'created_at' => $comment->created_at->toDateTimeString(),
//            'score' => $comment->score,
//            'content' => $comment->message,
//        ];
//    }

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

        // اگر کامنت ریپلای دارد
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



    // CommentController.php

//    public function answerComment(Request $request, $commentId)
//    {
//        $request->validate([
//            'answer_message' => 'required|string',
//        ]);
//
//        $comment = Comment::find($commentId);
//
//        if (!$comment) {
//            // اگر کامنت یافت نشد، مدیریت کنید
//            return redirect()->route('food.index')->with('error', 'Comment not found.');
//        }
//
//        $answer = new Comment([
//            'user_id' => auth()->id(),
//            'message' => $request->input('answer_message'),
//            'order_id' => $comment->order_id, // یا هر فیلد مرتبط با جواب دادن به کامنت
//            'score' => 0, // یا هر فیلد دیگری که لازم است
//        ]);
//
//        $comment->answers()->save($answer);
//
//        return redirect()->route('food.show', ['id' => $comment->order->food_id])
//            ->with('success', 'Answer added successfully.');
//    }


//    public function answerComment($id, Request $request)
//    {
//        $comment = Comment::find($id);
//
//        if (!$comment) {
//            return redirect()->route('food.index')->with('error', 'Comment not found.');
//        }
//
//        $reply = new Comment([
//            'user_id' => auth()->id(),
//            'message' => $request->input('answer_message'),
//            'parent_id' => $comment->id,
//            'score' => 0,
//        ]);
//
//        $reply->save();
//
//        return redirect()->route('food.show', ['id' => $comment->order->food_id])
//            ->with('success', 'Answer added successfully.');
//    }


//    public function answerComment($id, Request $request)
//    {
//        $comment = Comment::find($id);
//
//        if (!$comment || !$comment->order) {
//            return redirect()->route('food.index')->with('error', 'Comment not found or has no associated order.');
//        }
//
//        $reply = new Comment([
//            'user_id' => auth()->id(),
//            'message' => $request->input('answer_message'),
//            'parent_id' => $comment->id,
//            'order_id' => $comment->order_id,
//        ]);
//
//        $reply->save();
//
//        return redirect()->route('food.show', ['id' => $comment->order->food_id])
//            ->with('success', 'Answer added successfully.');
//
//    }


//    public function answerComment($id, Request $request)
//    {
//        $comment = Comment::find($id);
//
//        if (!$comment) {
//            return redirect()->route('food.index')->with('error', 'Comment not found.');
//        }
//
//        // اگر order موجود باشد، ادامه دهید
//        if ($comment->order) {
//            $reply = new Comment([
//                'user_id' => auth()->id(),
//                'message' => $request->input('answer'),
//                'parent_id' => $comment->id,
//                'order_id' => $comment->order_id,
//
//            ]);
//
//            $reply->save();
//
//            return redirect()->route('food.show', ['id' => $comment->order->food_id])
//                ->with('success', 'Answer added successfully.');
//        } else {
//            // اگر order وجود نداشته باشد، به روز رسانی کنید
//            // یا با یک خطا مدیریت کنید
//            return redirect()->route('food.index')->with('error', 'Order not found for the comment.');
//        }
//    }


//    public function answerComment(Request $request, $id)
//    {
//        $comment = Comment::find($id);
//
//        if (!$comment) {
//            return redirect()->route('food.index')->with('error', 'Comment not found.');
//        }
//
//        $request->validate([
//            'answer' => 'required|string',
//        ]);
//
//        // ایجاد یک Reply جدید
//        $reply = new Reply([
//            'message' => $request->input('answer'),
//        ]);
//
//        // اتصال Reply به Comment
//        $comment->replies()->save($reply);
//
//        return redirect()->route('food.show', ['id' => $comment->order->food_id])->with('success', 'Answer added successfully.');
//    }




    public function answerComment(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->route('food.index')->with('error', 'Comment not found.');
        }

        $request->validate([
            'answer' => 'required|string',
        ]);

        // ایجاد یک Reply جدید
        $reply = new Reply([
            'message' => $request->input('answer'),
        ]);

        // اتصال Reply به Comment
        $comment->replies()->save($reply);

        // اگر order وجود داشته باشد، به روز رسانی کنید
        if ($comment->order) {
            return redirect()->route('food.show', ['id' => $comment->order->food_id])->with('success', 'Answer added successfully.');
        } else {
            // اگر order وجود نداشته باشد، به روز رسانی کنید
            // یا با یک خطا مدیریت کنید
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
//        if (isset($comment->order)) {
//            $foodId = $comment->order->food_id;
//
//            $comment->delete();
//
//            return redirect()->route('food.show', ['id' => $foodId])->with('success', 'Comment deleted successfully.');
//        } else {
//            return redirect()->route('food.index')->with('error', 'Order not found for the comment.');
//        }
//    }



    public function deleteComment($id)
    {
        $comment = Comment::query()->find($id);

        if (!$comment) {
            return redirect()->route('food.index')->with('error', 'Comment not found.');
        }

        // دسترسی به غذا از طریق رابطه
        $food = $comment->food;

        if ($food) {
            $comment->delete();
            return redirect()->route('food.show', ['id' => $food->id])->with('success', 'Comment deleted successfully.');
        } else {
            return redirect()->route('food.index')->with('error', 'Food not found for the comment.');
        }
    }



}
