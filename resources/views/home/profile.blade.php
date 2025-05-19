@extends('layouts.home')

@section('content')

<style>
    body {
        background-color: #f0f4f8;
    }

    .profile-header {
        font-size: 2.2rem;
        font-weight: bold;
        margin-bottom: .5rem;
        color: #2c3e50;
    }

    .profile-container {
        padding-top: 220px;
    }

    .card {
        background-color: #fff;
        border: none;
        border-radius: 15px;
        border-left: 5px solid #3498db;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        transition: transform 0.2s ease;
        margin-bottom: 1.5rem; /* Adds spacing between card sections */
    }

    .card:hover {
        transform: translateY(-4px);
    }

    .card h5 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #34495e;
    }

    .card p,
    .card small,
    .no-data-text,
    .card a {
        font-size: 1.2rem;
        color: #7f8c8d;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: .5rem;
        color: #343a40;
        margin: 2rem 0 1rem;
        padding-top: 20px; /* Adds spacing between section titles */
    }

    .card a {
        font-weight: 600;
        font-size: 1rem;
        color: #3498db;
        text-decoration: none;
        display: inline-block;
        margin-top: 0.3rem;
    }

    .card a:hover {
        text-decoration: underline;
        color: #2c82c9;
    }

    #bell-icon svg {
    fill: #a97142; 
    }

    .btn-primary,
    .btn-secondary {
        font-size: 0.95rem;
        padding: 0.45rem 1rem;
        border-radius: 8px;
        margin-top: 0.5rem;
        cursor: pointer;
    }

    .profile-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #3498db;
        margin-right: 1rem;
    }

    .no-data-text {
        font-style: italic;
        color: #b2bec3;
    }

    @media (max-width: 768px) {
    .profile-header {
        text-align: center;
    }

    .profile-container {
        padding-top: 120px;
    }

    .d-flex.align-items-center {
        flex-direction: column;
        text-align: center;
    }

    .profile-img {
        margin-bottom: 1rem;
    }
    
}

 /* Dark mode styles - apply globally */
 body.dark-mode {
        background-color: #1e1e1e;
        color: #ffffff;
    }

    body.dark-mode .profile-header {
        color: #ffffff;
    }

    body.dark-mode .card {
        background-color: #333;
        border-left: 5px solid #2980b9;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    }

    body.dark-mode .card h5 {
        color: #e6e6fa; 
    }

    body.dark-mode .card a,
    body.dark-mode .no-data-text,
    body.dark-mode .no-data-text,
    body.dark-mode .card p {
        color: #e5e4e2;
    }

    body.dark-mode .section-title {
        color: #5dade2;
    }

    body.dark-mode .card a {
        color: #9fa8da;
    }

    body.dark-mode .card a:hover {
        color: #7986cb;
    }

    body.dark-mode .btn-primary,
    body.dark-mode .btn-secondary {
        background-color: #3f51b5;
        color: #fff;
    }

    /* Default light mode button style */
    #darkModeToggle {
        background-color: #343a40; /* light gray */
        color: #333;
        border: 1px solid #d0d8e0;
    }

    /* Dark mode style override */
    body.dark-mode #darkModeToggle {
        background-color: #999999; /* soft light bg */
        color: #121212;
        border: 1px solid #444;
    }
    
    body.dark-mode #bell-icon svg {
    fill: #f1c40f; 
    }

    body.dark-mode .card a:hover,
    body.dark-mode .btn-primary:hover {
        color: white; 
    }

</style>

<div class="container profile-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="profile-header mb-0">
            <i class="fas fa-user-circle me-2" ></i>
            {{ $user->name }}'s Profile
        </h5>
        <button id="darkModeToggle" onclick="toggleDarkMode()" class="btn btn-sm btn-outline-secondary text-white">
            <i class="fas fa-moon me-1"></i>
            <i class="fas fa-arrow-right-arrow-left me-1"></i>
            <i class="fas fa-sun"></i>
        </button>
    </div>              

    {{-- Profile Info --}}
<div class="card p-3 mb-4">
    <div class="d-flex align-items-center">
        {{-- Profile Picture Display --}}
        @if ($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="profile-img">
        @else
            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile" class="profile-img">
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

                <div class="d-flex flex-wrap align-items-center gap-2 mt-2">
                {{-- Show "Add" if no profile picture --}}
                @if (!$user->profile_picture)
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('profile_picture_input').click();">
                        Add Profile Picture
                    </button>
                @endif

                {{-- Always show update --}}
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('profile_picture_input').click();">
                    <strong>Update Picture</strong>
                </button>

                {{-- Connection button --}}
                <a href="{{ route('connections') }}" class="btn btn-primary">Connections</a>

                {{-- Details button --}}
                <a href="{{ route('user.details', $user->id) }}" class="btn btn-primary">Details</a>
            </div>
            </form>
        </div>
    </div>
</div>


    {{-- Notifications --}}
    @if(auth()->id() === $user->id)
        <div class="mb-4">
            
            <h4 class="section-title position-relative" style="display: flex; align-items: center;">
                Notifications
                <span style="position: relative; margin-left: 8px; cursor: pointer;" id="bell-icon"> {{-- Added cursor pointer for clickable effect --}}
                    {{-- Inline SVG Bell Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#2c3e50" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 1.985-1.75H6.015A2 2 0 0 0 8 16zm6-6a1 1 0 0 1-1-1V7a5.002 5.002 0 0 0-4-4.9V2a1 1 0 0 0-2 0v.1A5.002 5.002 0 0 0 3 7v2a1 1 0 0 1-1 1H1v1h14v-1h-1z"/>
                    </svg>

                    {{-- Notification Count Badge --}}
                    @if($notifications->count() > 0)
                        <span style="position: absolute; top: -8px; right: -10px; background: red; color: white; font-size: 10px; border-radius: 50%; padding: 2px 5px;">
                            {{ $notifications->count() }}
                        </span>
                    @endif
                </span>
            </h4>

            {{-- Notifications Section --}}
            <div id="notifications-section" style="display: none; border: 1px solid #ddd; background-color: white; padding: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                @forelse($notifications as $notification)
                    <div class="card p-3 mb-2">
                        @if($notification->type === 'App\Notifications\PostLiked')
                            <p>
                                <strong>{{ $notification->data['liker_name'] ?? 'Someone' }}</strong>
                                liked your post:
                                <strong>{{ $notification->data['post_title'] ?? 'Untitled Post' }}</strong>
                            </p>
                            <a href="{{ url('post_details', $notification->data['post_id'] ?? '#') }}">View Post</a>

                        @elseif($notification->type === 'App\Notifications\CommentedOnPost')
                            <p>
                                <strong>{{ $notification->data['commenter_name'] ?? 'Someone' }}</strong>
                                commented on your post:
                                <strong>{{ $notification->data['post_title'] ?? 'Untitled Post' }}</strong>
                            </p>
                            <a href="{{ url('post_details', $notification->data['post_id'] ?? '#') }}">View Post</a>

                        @elseif($notification->type === 'App\Notifications\RepliedToComment')
                            <p>
                                <strong>{{ $notification->data['replier_name'] ?? 'Someone' }}</strong>
                                replied to your comment on the post:
                                <strong>{{ $notification->data['post_title'] ?? 'Untitled Post' }}</strong>
                            </p>
                            <a href="{{ url('post_details', $notification->data['post_id'] ?? '#') }}">View Post</a>

                        @else
                            <p>New notification</p>
                        @endif
                    </div>
                @empty
                    <p class="no-data-text">No new notifications.</p>
                @endforelse
            </div>
        </div>
    @endif


    {{-- Saved Posts --}}
    <div class="mb-4">
        <h4 class="section-title">
           <i class="fas fa-bookmark me-2"></i> Saved Posts
        </h4>
        @forelse($savedPosts as $post)
            <div class="card p-3 mb-2">
                <h5>{{ $post->title }}</h5>
                <a href="{{ url('post_details', $post->id) }}">View Post</a>
            </div>
        @empty
            <p class="no-data-text">No saved posts yet.</p>
        @endforelse

         <!-- Pagination save -->
         <div class="mt-3">
            {{ $savedPosts->withQueryString()->links() }}
        </div>
        
    </div>


    {{-- Liked Posts --}}
    <div class="mb-4">
        <h4 class="section-title">
            <i class="fas fa-thumbs-up me-2"></i> Liked Posts
        </h4>
        @forelse($likedPosts as $post)
            <div class="card p-3 mb-2">
                <h5>{{ $post->title }}</h5>
                <a href="{{ url('post_details', $post->id) }}">View Post</a>
            </div>
        @empty
            <p class="no-data-text">No liked posts yet.</p>
        @endforelse

         <!-- Pagination Links -->
         <div class="mt-3">
            {{ $likedPosts->links() }}
        </div>

    </div>
    

    {{-- Comments --}}
<div class="mb-4">
    <h4 class="section-title">
        <i class="fas fa-comment-dots me-2"></i> Comment On Posts
    </h4>

    @forelse($commentedPosts as $post)
        <div class="card p-3 mb-2">
            <h5>{{ $post->title }}</h5>
            <p>You’ve commented on this post.</p>
            <a href="{{ url('post_details', $post->id) }}">View Post</a>
        </div>
    @empty
        <p class="no-data-text">No comments yet.</p>
    @endforelse

    <!-- Pagination -->
    <div class="mt-3">
        {{ $commentedPosts->withQueryString()->links() }}
    </div>
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

{{-- Add the following JavaScript to toggle the visibility --}}
<script>
    // Select the bell icon and notifications section
    const bellIcon = document.getElementById('bell-icon');
    const notificationsSection = document.getElementById('notifications-section');

    // Toggle notifications visibility on bell icon click
    bellIcon.addEventListener('click', () => {
        if (notificationsSection.style.display === 'none' || notificationsSection.style.display === '') {
            notificationsSection.style.display = 'block';  // Show notifications
        } else {
            notificationsSection.style.display = 'none';  // Hide notifications
        }
    });

    // Close notifications if clicked outside the bell icon
    window.addEventListener('click', (event) => {
        if (!bellIcon.contains(event.target) && !notificationsSection.contains(event.target)) {
            notificationsSection.style.display = 'none';  // Close notifications if clicked outside
        }
    });
</script>

<script>
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('theme', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
    }

    // Load theme from localStorage
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
    }
</script>


@endsection
