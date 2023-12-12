Author: {{ $comment->user->name }}
Comment: {{ $comment->message }}
Score: {{ $comment->score }}
<form action="{{ route('comments.store' , $comment) }}" method="post">
@csrf
    <input type="hidden" name="status" value="accept" >
    <input type="hidden" name="order_id" value="{{ $comment->order->id }}" >
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" >
{{--    <input type="hidden" name="score" value="null" >--}}
    <input type="hidden" name="parent_id" value="{{ $comment->id }}" >
    <label for="message">Reply</label>
    @if($reply!==null)
    <input name="message" type="text" value="{{ $reply->message }}">
    @else
        <input name="message" type="text">
    @endif
    <input type="submit" value="reply">
</form>
