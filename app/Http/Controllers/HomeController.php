<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class HomeController extends Controller
{
    
    public function homepage(Request $request)
    {
        $selectedCategory = $request->query('category');
        $searchTerm = $request->query('search');
    
        // Query the posts
        $query = Post::where('post_staus', 'active')->latest();
    
        // Apply category filter if selected
        if ($selectedCategory) {
            $category = Category::where('name', $selectedCategory)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }
    
        // Apply search filter if search term is provided
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }
    
        // Get the posts based on the above filters
        $post = $query->get();
    
        // Get the categories for the dropdown
        $categories = Category::all();
    
        // Return the view with the posts, categories, and selected category
        return view('home.homepage', compact('post', 'categories', 'selectedCategory', 'searchTerm'));
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
    $categories = Category::all();
    return view('home.create_post',  compact('categories'));
  }

  public function user_post(Request $request)
  { 
    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
      'category_id' => 'required|exists:categories,id',
  ]); 

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
    $post->category_id = $request->category_id;

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

  public function my_post(Request $request)
{ 
    $user = Auth::user();
    $userid = $user->id;

    $category = $request->input('category');

    if ($category) {

        $category = Category::where('name', $category)->first();

        if ($category) {
            $data = Post::where('user_id', $userid)
                        ->where('category_id', $category->id) 
                        ->get();
        } else {
            $data = collect(); 
        }
    } else {
       
        $data = Post::where('user_id', $userid)->get();
    }

    $categories = Category::all(); 

    return view('home.my_post', compact('data', 'categories'));
}


  public function my_post_del($id)
{
    $data = Post::find($id);

    if (!empty($data->image)) {
        $imagePath = public_path('postimage/' . $data->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $data->delete();

    return redirect()->back()->with('message', 'Post Deleted Successfully');
}

  public function post_update_page($id)
  { 
    $data=Post::find($id);
    $categories = Category::all();

    return view('home.post_page', compact('data', 'categories'));
  }

  public function update_post_data(Request $request, $id)
  { 
    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
  ]); 

    $data=Post::find($id);
    $data->title=$request->title;
    $data->description=$request->description;
    $image=$request->image;
    $data->category_id = $request->category_id;

    if($image)
   {
     // Delete old image
    if ($data->image && file_exists(public_path('postimage/' . $data->image))) {
      unlink(public_path('postimage/' . $data->image));
   }

    // Save new image
    $imagename = uniqid() . '.' . $image->getClientOriginalExtension();
    $request->image->move('postimage', $imagename);
    $data->image = $imagename;
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

public function increase_view($id)
{
    $post = Post::find($id);
    if ($post) {
        $post->increment('views');
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}

public function profile($id)
{
    $user = User::findOrFail($id);
    $comments = Comment::where('user_id', $id)->latest()->get();
    $likedPosts = $user->likedPosts()->latest()->get(); // Assumes relationship exists

    return view('home.profile', compact('user', 'comments', 'likedPosts'));
}

public function showPictureForm()
{
    return view('home.profile_picture_upload');
}

public function updatePicture(Request $request)
{
       $request->validate([
       'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:5120',
       ], [
       'profile_picture.max' => 'Maximum size should be 5MB',
       ]);

    $user = auth()->user();

    if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
        Storage::disk('public')->delete($user->profile_picture);
    }

    $path = $request->file('profile_picture')->store('profile_pictures', 'public');

    $user->profile_picture = $path;
    $user->save();

    return redirect()->route('user.profile', ['id' => $user->id])->with('success', 'Profile picture updated!');
}

}
