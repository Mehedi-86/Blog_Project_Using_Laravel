<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Like;
use App\Models\Comment;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            $post=Post::where('post_staus','=','active')->get();

            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                return view('admin.adminhome'); // Ensure you have 'admin/home.blade.php'
            } else {
                return view('home.homepage',compact('post'));
            }
        }

        return redirect()->route('login');
    }

    public function homepage()
  {
    $post = Post::where('post_staus','=','active')->get();
    return view('home.homepage',compact('post')); 
  }

  public function post_details($id)
{
    $post = Post::findOrFail($id);

    $comments = Comment::with([
        'user',
        'replies.user',
        'replies.replies.user',
    ])->where('post_id', $post->id)
      ->whereNull('parent_id')
      ->latest()
      ->get();

    return view('home.post_details', compact('post', 'comments'));
}


  public function create_post()
  {
    return view('home.create_post');
  }

  public function user_post(Request $request)
  {  
    $user=Auth()->user();
    $userid=$user->id;
    $username=$user->name;
    $usertype= $user->usertype;

    $post = new Post;
    $post->title= $request->title;
    $post->description= $request->description;
    $post->user_id= $userid;
    $post->name= $username;
    $post->usertype= $usertype;
    $post->post_staus= 'pending';

    $image= $request->image;
    if($image)
    {
      $imagename=time().'.'.$image->getClientOriginalExtension();
      $request->image->move('postimage',$imagename);
      $post->image=$imagename;
    }

    $post->save();

    Alert::success('Congrats','You have Added the data Successfully');

    return redirect()->back();
  }

  public function my_post()
  { 
    $user=Auth::user();
    $userid=$user->id;
    $data = Post::where('user_id', $userid)->get();
    return view('home.my_post',compact('data'));
  }

  public function my_post_del($id)
  {
    $data = Post::find($id);
    $data->delete();
    return redirect()->back()->with('message','Post Deleed Successfully');
  }

  public function post_update_page($id)
  { 
    $data=Post::find($id);
    return view('home.post_page',compact('data'));
  }

  public function update_post_data(Request $request, $id)
  {
    $data=Post::find($id);
    $data->title=$request->title;
    $data->description=$request->description;
    $image=$request->image;

    if($image)
    {
      $imagename=time().'.'.$image->getClientOriginalExtension();
      $request->image->move('postimage',$imagename);
      $data->image=$imagename;
    }
    $data->save();
    return redirect()->back()->with('message','Post Updated Successfully');
  }

  public function like($id)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('like_error', 'You must be logged in to like a post.');
    }

    $user = Auth::user();
    $post = Post::find($id);

    if (!$post) {
        return redirect()->back()->with('like_error', 'Post not found.');
    }

    $existingLike = Like::where('post_id', $post->id)
                        ->where('user_id', $user->id)
                        ->first();

    if ($existingLike) {
        $existingLike->delete();
        return redirect()->route('post.details', $id)
                         ->with('like_message', 'Like removed.')
                         ->withFragment('like-section');
    }

    Like::create([
        'user_id' => $user->id,
        'post_id' => $post->id,
    ]);

    return redirect()->route('post.details', $id)
                     ->with('like_message', 'Post liked successfully!')
                     ->withFragment('like-section');
}


public function storeComment(Request $request, $postId)
{
    $request->validate([
        'body' => 'required|string|max:1000',
    ]);

    if (!Auth::check()) {
        return redirect()->route('login')->with('comment_error', 'Please log in to comment.');
    }

    Comment::create([
        'user_id' => Auth::id(),
        'post_id' => $postId,
        'body' => $request->body,
    ]);

    return redirect()->route('post.details', $postId)
    ->with('comment_message', 'Comment added successfully.')
    ->withFragment('comment-section');

}

public function deleteComment($id)
{
    $comment = Comment::findOrFail($id);

    if ($comment->user_id !== auth()->id()) {
        return back()->with('comment_error', 'Unauthorized action.');
    }

    $comment->delete();
    return back()->with('comment_message', 'Comment deleted successfully.')->withFragment('comment-section');
}

public function updateComment(Request $request, $id)
{
    $request->validate([
        'body' => 'required|string|max:1000',
    ]);

    $comment = Comment::findOrFail($id);

    if ($comment->user_id !== auth()->id()) {
        return back()->with('comment_error', 'Unauthorized action.');
    }

    $comment->body = $request->body;
    $comment->save();

    return redirect()->route('post.details', $comment->post_id)
                     ->with('comment_message', 'Comment updated successfully.')
                     ->withFragment('comment-section');
}

public function about()
{
    return view('home.about'); 
}

public function blog()
{
    return view('home.blog'); 
}

public function storeReply(Request $request, Comment $comment)
{
    if (!auth()->check()) {
        return redirect()->route('login')->with('comment_error', 'Please log in to reply.');
    }

    $validated = $request->validate([
        'body' => 'required|string|max:1000',
    ]);

    $reply = new Comment();
    $reply->body = $validated['body'];
    $reply->user_id = auth()->id();
    $reply->parent_id = $comment->id;
    $reply->post_id = $comment->post_id;
    $reply->save();

    return back()->with('comment_message', 'Reply posted successfully!')->withFragment('comment-section');
}

public function updateReply(Request $request, $id)
{
    $request->validate([
        'body' => 'required|string|max:1000',
    ]);

    $reply = Comment::findOrFail($id);

    if ($reply->user_id !== auth()->id()) {
        return redirect()->back()->with('comment_error', 'Unauthorized action.');
    }

    $reply->body = $request->input('body');
    $reply->save();

    return redirect()->back()->with('comment_message', 'Reply updated successfully!')->withFragment('comment-section');
}

public function destroyReply($id)
{
    $reply = Comment::findOrFail($id);

    if ($reply->user_id !== auth()->id()) {
        return redirect()->back()->with('comment_error', 'Unauthorized action.');
    }

    $reply->delete();

    return redirect()->back()->with('comment_message', 'Reply deleted successfully!')->withFragment('comment-section');
}

}
