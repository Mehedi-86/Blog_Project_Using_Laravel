<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function post_page()
    {
        return view('admin.post_page');
    }

    public function add_post(Request $request)
    { 
      $user=Auth()->user();
      $userid=$user->id;
      $name=$user->name;
      $usertype=$user->usertype;

      $post = new Post;
      $post->title = $request->title;
      $post->description = $request->description;
      $post->post_staus = 'active';
      $post->user_id = $userid;
      $post->name = $name;
      $post->usertype = $usertype;

////////////
      $image=$request->image;

      if($image)
      {
      $imagename=time().'.'.$image->getClientOriginalExtension();
      $request->image->move('postimage',$imagename);
      $post->image = $imagename;
      }
////////////

      $post->save();
      return redirect()->back()->with('message','Post Added Successfully');
    }

    public function show_post()
    {    
        $post = Post::all();
        return view('admin.show_post',compact('post'));
    }

    public function delete_post($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->back()->with('message','Post Deleted Successfully');
    }

    public function edit_page($id)
    {
        $post=Post::find($id);
        return view('admin.edit_page', compact('post'));
    }

    public function update_post(Request $request, $id)
   {
    $data = Post::find($id);
    $data->title = $request->title;
    $data->description = $request->description;

    $oldImage = $data->image; // Get the old image file name

    $image = $request->image;
    if ($image) {
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('postimage', $imagename);
        $data->image = $imagename;

        // Delete the old image file
        if ($oldImage) {
            $oldImagePath = public_path('postimage/'.$oldImage);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
    }

    $data->save();
    return redirect()->back()->with('message', 'Post Updated Successfully');
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

    public function admin_post()
    {

    $adminId = Auth::id();
    $data = Post::where('user_id', $adminId)->get();
    return view('admin.admin_post', compact('data'));
   }


}
