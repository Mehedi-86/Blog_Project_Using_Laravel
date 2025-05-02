@extends('layouts.home')

@section('content')

<style>
    body {
        background-color: #f7f9fc;
    }

    .profile-header {
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: .5rem;
        color: #2980b9;
    }

    .profile-container {
        padding-top: 220px;
    }

    .card {
        background-color: #ffffff;
        border-left: 5px solid #3498db;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem; /* Adds spacing between card sections */
    }

    .card h5 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2d3436;
    }

    .card p,
    .card small,
    .no-data-text,
    .card a {
        font-size: 1.2rem;
        color: #636e72;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: .5rem;
        color: #2980b9;
        padding-top: 20px; /* Adds spacing between section titles */
    }

    .card a {
        font-weight: 600;
        display: inline-block;
        margin-top: 0.5rem;
        color: #0984e3;
        text-decoration: none;
    }

    .card a:hover {
        text-decoration: underline;
        color: #0652DD;
    }

    .no-data-text {
        font-style: italic;
        color: #b2bec3;
    }
</style>

<div class="container profile-container">
    <h5 class="profile-header">{{ $user->name }}'s Profile</h5>

    {{-- Profile Info --}}
<div class="card p-3 mb-4">
    <div class="d-flex align-items-center">
        {{-- Profile Picture Display --}}
        @if ($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="rounded-circle me-3" width="100" height="100">
        @else
            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile" class="rounded-circle me-3" width="100" height="100">
        @endif

        <div>
            <h5 class="mb-1">Name: {{ $user->name }}</h5>
            <p class="mb-2">Email: {{ $user->email }}</p>

            {{-- Profile Picture Upload Form --}}
            <form action="{{ route('profile.picture.update') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                <input type="file" name="profile_picture" id="profile_picture_input" accept="image/*" capture="user" style="display: none;" onchange="document.getElementById('uploadForm').submit();">

                {{-- Show validation error message for profile picture --}}
                @error('profile_picture')
                    <div id="error_message" class="text-danger mt-1">{{ $message }}</div>
                @enderror

                {{-- Show "Add" if no profile picture --}}
                @if (!$user->profile_picture)
                    <button type="button" class="btn btn-primary me-2" onclick="document.getElementById('profile_picture_input').click();">Add Profile Picture</button>
                @endif

                {{-- Always show update --}}
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('profile_picture_input').click();">Update Profile Picture</button>
            </form>
        </div>
    </div>
</div>


    {{-- Saved Posts --}}
    <div class="mb-4">
        <h4 class="section-title">Saved Posts</h4>
        @forelse($savedPosts as $post)
            <div class="card p-3 mb-2">
                <h5>{{ $post->title }}</h5>
                <a href="{{ url('post_details', $post->id) }}">View Post</a>
            </div>
        @empty
            <p class="no-data-text">No saved posts yet.</p>
        @endforelse
    </div>


    {{-- Liked Posts --}}
    <div class="mb-4">
        <h4 class="section-title">Liked Posts</h4>
        @forelse($likedPosts as $post)
            <div class="card p-3 mb-2">
                <h5>{{ $post->title }}</h5>
                <a href="{{ url('post_details', $post->id) }}">View Post</a>
            </div>
        @empty
            <p class="no-data-text">No liked posts yet.</p>
        @endforelse
    </div>

    {{-- Comments --}}
    <div class="mb-4">
        <h4 class="section-title">Comment On Posts</h4>
        @forelse($comments as $comment)
            <div class="card p-3 mb-2">
                <p>{{ $comment->content }}</p>
                <small>On Post: <a href="{{ url('post_details', $comment->post_id) }}">{{ $comment->post->title ?? 'Unknown' }}</a></small>
            </div>
        @empty
            <p class="no-data-text">No comments yet.</p>
        @endforelse
    </div>
</div>

{{-- JavaScript to hide error message after 3 seconds --}}
<script>
    @if ($errors->has('profile_picture'))
        setTimeout(function() {
            const errorMessage = document.getElementById('error_message');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 5000); // 5000ms = 5 seconds
    @endif
</script>

@endsection
