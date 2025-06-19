<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Report;


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
    return redirect()->back()->with([
        'message' => 'Post Deleted Successfully',
        'type' => 'danger' // For red alert
    ]);
}

public function accept_post($id)
{
    $data = Post::find($id);
    $data->post_staus = 'active';
    $data->save();

    return redirect()->back()->with([
        'message' => 'Post Status changed to Active',
        'type' => 'success' // For green alert
    ]);
}

public function reject_post($id)
{
    $data = Post::find($id);
    $data->post_staus = 'rejected';
    $data->save();

    return redirect()->back()->with([
        'message' => 'Post Status changed to Rejected',
        'type' => 'danger' // You can change to 'warning' if desired
    ]);
}


    public function viewPostDetails($id)
{
    $post = \App\Models\Post::with('user', 'comments.replies')->findOrFail($id);

    return view('admin.post_details', compact('post'));
}

public function manage_users()
{
    $users = User::where('usertype', 'user')
    ->withCount('reportsReceived') // Eager load report count
    ->get();

    return view('admin.manage_users', compact('users'));
}

public function banUser($id)
{
    $user = User::findOrFail($id);
    $user->is_banned = true;
    $user->save();

    return back()->with([
        'message' => 'User banned successfully!',
        'type' => 'danger'
    ]);
}

public function unbanUser($id)
{
    $user = User::findOrFail($id);
    $user->is_banned = false;
    $user->save();

    return back()->with([
        'message' => 'User unbanned successfully!',
        'type' => 'success'
    ]);
}

public function viewUserReports($id)
{
    $reports = Report::with(['reportedBy', 'post', 'reportedUser'])
        ->where('user_id', $id)
        ->latest()
        ->get();

    $user = User::findOrFail($id);

    return view('admin.user_reports', compact('reports', 'user'));
}

public function userReports($userId)
{
    $user = User::findOrFail($userId);

    $reports = Report::with(['reportedBy', 'post'])
        ->where('user_id', $userId)
        ->latest()
        ->get();

    return view('admin.user_reports', compact('user', 'reports'));
}

public function clearReports(User $user)
{
    
    Report::where('user_id', $user->id)->delete();

    return redirect()->back()->with('success', 'All reports cleared successfully.');
}

}
