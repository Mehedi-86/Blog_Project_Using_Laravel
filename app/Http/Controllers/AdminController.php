<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function post_page()
    {
        return view('admin.post_page');
    }


    public function adminHome()
    {
        return view('admin.adminhome');
    }

    public function show_post()
    {    
        $post = Post::all();
        return view('admin.show_post',compact('post'));
    }

    public function delete_post($id)
    {
        $post = Post::find($id);


        if (!empty($post->image)) {
            $imagePath = public_path('postimage/' . $post->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }        

      $post->delete();
      return redirect()->back()->with('message','Post Deleted Successfully');
    }

    public function accept_post($id)
    {
        $data = Post::find($id);
        $data->post_staus='active';
        $data->save();
        return redirect()->back()->with('message','Post Status changed to Active');

    }

    public function reject_post($id)
    {
        $data = Post::find($id);
        $data->post_staus='rejected';
        $data->save();
        return redirect()->back()->with('message','Post Status changed to Rejected');

    }

    public function viewPostDetails($id)
{
    $post = \App\Models\Post::with('user', 'comments.replies')->findOrFail($id);

    return view('admin.post_details', compact('post'));
}


}
