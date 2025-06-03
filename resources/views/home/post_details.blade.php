<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <style>
        .header_section {
          margin-bottom: 30px; 
        }

        .post-image {
          display: block;
          margin: 20px auto;
          width: 600px;
          height: 350px;
          object-fit: cover;
          border-radius: 12px; /* Rounded corners */
          border: 3px solid #4A148C; /* Purple-ish border */
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
          transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
          cursor: pointer;
        }

        .post-image:hover {
          transform: scale(1.05);
          box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2); /* Deeper shadow on hover */
          border-color: #311B92; /* Darker purple on hover */
        }

        /* Increase container width */
        .wide-container {
            max-width: 95%; /* Increase to your desired width */
            margin: 0 auto;
            padding: 0 15px; /* Optional padding */
        }

        .desc_content {
          font-size: 19px;
          line-height: 1.8;
          color: #333;
          text-align: justify;
          padding: 20px 0;
          max-width: 90%;
          margin: 0 auto;
          margin-bottom: 50px;
        }

        .desc_content p {
          font-size: 19px !important;
          line-height: 1.8 !important;
          color: #333 !important;
        }

        /* Styling for alert messages */
        .alert {
          padding: 15px;
          margin-bottom: 20px;
          border-radius: 5px;
        }

        .alert-success {
          background-color: #d4edda;
          color: #155724;
        }

        .alert-danger {
          background-color: #f8d7da;
          color: #721c24;
        }

        /* Custom Wrapper for Description and Comment */
        .desc_comment_wrapper {
          padding: 30px 50px;
        }

        /* Styling for the comment form and comments section */
        .form-control {
          font-size: 1rem;
          padding: 10px;
        }

        .btn-success {
          font-size: 1rem;
          padding: 10px 20px;
        }

        .border {
          border: 1px solid #ddd;
        }

        .mt-4 {
          margin-top: 1.5rem;
        }

        .mt-3 {
          margin-top: 1rem;
        }

        hr {
          margin: 40px 0;
          border-top: 2px solid #ccc;
        }

        /* Comment Styling */
        .comment-content 
        {
         font-size: 1.2rem;  
        }

        .comment-user 
        {
          font-size: 1.5rem;  
          font-weight: bold;
        }

       /* Timestamp (e.g., 30 minutes ago) */
        .comment-time 
        {
         font-size: 1.1rem;  
         color: #777;        
        }

        /* Light mode (default): headings are blue */
        body h1,
        body h2,
        body h3,
        body h4,
        body h5,
        body h6 {
          color: #3F51B5; /* Tailwind's blue-800 or any blue you prefer */
        }

        body h1 { font-size: 1.4em; }
        body h2 { font-size: 1.35em; }
        body h3 { font-size: 1.3em; }
        body h4 { font-size: 1.25em; }
        body h5 { font-size: 1.2em; }
        body h6 { font-size: 1.15em; }

        /* Dark Mode CSS start */

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

        body.dark-mode {
           background-color: #121212;
           color: #e0e0e0;
        }

        body.dark-mode .header_section,
        body.dark-mode .wide-container,
        body.dark-mode .desc_comment_wrapper,
        body.dark-mode .modal-content {
          background-color: #1e1e1e;
          color: #e0e0e0;
        }

        body.dark-mode .desc_content {
          color: #cccccc;
        }

        body.dark-mode .border {
          border-color: #444;
          background-color: #1e1e1e;
        }

        body.dark-mode .form-control {
          background-color: #2a2a2a;
          color: #ffffff;
          border-color: #555;
        }

        body.dark-mode .form-control::placeholder {
          color: #aaaaaa;
        }

        body.dark-mode .btn-primary {
          background-color: #0d6efd;
          border-color: #0d6efd;
          color: #fff;
        }

        body.dark-mode .btn-secondary {
          background-color: #6c757d;
          border-color: #6c757d;
          color: #fff;
        }

        body.dark-mode .btn-success {
          background-color: #198754;
          border-color: #198754;
          color: #fff;
        }

        body.dark-mode .btn-outline-secondary {
          background-color: #333;
          color: #ddd;
          border-color: #666;
        }

        body.dark-mode .btn-dark {
          background-color: #444;
          border-color: #555;
          color: #fff;
        }

        body.dark-mode hr {
          border-top: 2px solid #555;
        }

        body.dark-mode .alert-success {
          background-color: #3b8c47; 
          color: #f1f8e4; 
        }

        body.dark-mode .alert-danger {
          background-color: #5f1a1a;
          color: #f8cfcf;
        }

        body.dark-mode .dropdown-menu {
          background-color: #2c2c2c;
          color: #ffffff;
        }

        body.dark-mode .dropdown-item {
          color: #ffffff;
        }

        body.dark-mode .dropdown-item:hover {
          background-color: #444;
        }

        body.dark-mode p.text-muted {
          color: #bbbbbb; /* Light gray for muted text */
        }

        body.dark-mode p.text-muted b {
          color: #ffffff; /* Bright white for the author's name */
        }

        body.dark-mode p.text-muted span {
          color: #cccccc; /* Slightly softer white for the view count */
        }

        body.dark-mode .text-muted {
          color: #bbbbbb !important; /* Brighten muted text in dark mode */
        }

        body.dark-mode h1,
        body.dark-mode h2,
        body.dark-mode h3,
        body.dark-mode h4,
        body.dark-mode h5,
        body.dark-mode h6 {
          color: #a0cfff; 
        }

        body.dark-mode p {
          color: #dddddd;
        }

        body.dark-mode b {
          color: #ffffff;
        }

        body.dark-mode .desc_content p {
          color: #cccccc !important; /* Light gray for dark background */
        }
      </style>

      <base href="/public">
      @include('home.homecss')
   </head>

   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
      </div>
      <!-- header section end -->

      <!-- Use the wide-container class here -->
      <div class="wide-container">


        <!-- Image and Title Section -->
        <div class="text-center">
          <img src="/postimage/{{$post->image}}" class="post-image" alt="Post Image">
          <h1 style="font-size: 2rem; font-weight: bold;">{{$post->title}}</h1>
          <p class="text-muted mb-1">
           Post by <b>{{ $post->name }}</b>
           <span style="margin-left: 30px; margin-right: 30px;">|</span>
           <span><i class="fas fa-eye me-2"></i>{{ $post->views }} views</span>
           </p>
           <div style="display: flex; justify-content: flex-end;">
            <button id="darkModeToggle" onclick="toggleDarkMode()" class="btn btn-sm btn-outline-secondary text-white">
                <i class="fas fa-moon me-1"></i>
                <i class="fas fa-arrow-right-arrow-left me-1"></i>
                <i class="fas fa-sun"></i>
            </button>
           </div>
        </div>

        <!-- Description + Comment Section -->
        <div class="desc_comment_wrapper">

            <!-- Description -->
            <div class="desc_content mb-4">
                {!! $post->description !!}
            </div>


           <!-- Container for Like and Save Buttons on Same Line -->
<div class="d-flex justify-content-center align-items-start mt-4" id="like-section">
    
    <!-- Like Section -->
    <div class="d-flex flex-column align-items-center me-3"> <!-- Added right margin -->
        <!-- Like Button -->
        <form action="{{ route('post.like', $post->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn {{ $post->likes()->where('user_id', auth()->id())->exists() ? 'btn-secondary' : 'btn-primary' }}">
                <strong>{{ $post->likes()->where('user_id', auth()->id())->exists() ? 'Liked' : 'Like' }}</strong>
            </button>
        </form>

        <!-- Like Count -->
        <div class="mt-2">
            <p class="mb-0 fw-bold" style="font-size: 1.2rem;">
                <strong>{{ $post->likes->count() }}</strong> Likes
            </p>
        </div>
    </div>

    <!-- Save Post Button -->
    <div class="d-flex flex-column align-items-center">
        <form action="{{ auth()->check() ? route('posts.toggleSave', $post->id) : route('login') }}" method="POST">
            @csrf
            <button type="submit"
                    class="btn {{ auth()->check() && auth()->user()->savedPosts->contains($post->id) ? 'btn-secondary' : 'btn-primary' }}"
                    @guest onclick="event.preventDefault(); window.location='{{ route('login') }}';" @endguest>
                <strong>
                    @auth
                        {{ auth()->user()->savedPosts->contains($post->id) ? 'Unsave Post' : 'Save Post' }}
                    @else
                        Save Post
                    @endauth
                </strong>
            </button>
        </form>
    </div>
</div>


       <!-- Success Message for Save Post -->
<div style="max-height: 50px; overflow: hidden; padding: 5px 15px;">
    @if(session('save_message'))
        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert" style="padding: 6px 12px; font-size: 14px; font-weight: bold; margin-bottom: 10px;">
            <div>{{ session('save_message') }}</div>
            <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close" style="font-size: 25px; font-weight: bold;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>



            <!-- Success/Error Messages for like section -->
<div style="max-height: 50px; overflow: hidden; padding: 5px 15px;">
    @if(session()->has('like_message'))
        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert" style="padding: 6px 12px; font-size: 14px; font-weight: bold; margin-bottom: 10px;">
            <div>{{ session()->get('like_message') }}</div>
            <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close" style="font-size: 25px; font-weight: bold;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session()->has('like_error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert" style="padding: 6px 12px; font-size: 14px; font-weight: bold; margin-bottom: 10px;">
            <div>{{ session()->get('like_error') }}</div>
            <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close" style="font-size: 25px; font-weight: bold;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>

            <!-- Gap between Like and Comment Form -->
            <hr style="margin: 40px 0; border-top: 2px solid #ccc;">

            <!-- Comment Section Anchor -->
<div id="comment-section">

<!-- Success/Error Messages for comment section -->
<div style="max-height: 50px; overflow: hidden; padding: 5px 15px;">
    @if(session()->has('comment_message'))
        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert" style="padding: 6px 12px; font-size: 14px; font-weight: bold; margin-bottom: 10px;">
            <div>{{ session()->get('comment_message') }}</div>
            <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close" style="font-size: 25px; font-weight: bold;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session()->has('comment_error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert" style="padding: 6px 12px; font-size: 14px; font-weight: bold; margin-bottom: 10px;">
            <div>{{ session()->get('comment_error') }}</div>
            <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close" style="font-size: 25px; font-weight: bold;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>

<!-- Comment Form -->
<form action="{{ route('post.comment', $post->id) }}" method="POST" class="mt-3">
    @csrf
    <div class="mb-3">
        <textarea name="body" class="form-control" rows="3" placeholder="Write a comment..." required></textarea>
    </div>
    <button type="submit" class="btn btn-success">Post Comment</button>
</form>

<!-- Show Comments -->
<div class="mt-4">
    <h6 style="font-weight: bold; font-size: 1.2rem;">{{ $post->comments->count() }} Comments</h6>
    @foreach($post->comments->whereNull('parent_id') as $comment)
    <div class="border rounded p-3 mb-3 position-relative">
        <div class="d-flex justify-content-between">
            <div>
                <span class="comment-user" style="font-size: 1rem; font-weight: 600;">{{ $comment->user->name }}</span>:
                <span class="comment-content" style="font-size: 1.2rem; font-weight: 600;">{{ $comment->body }}</span>
            </div>

            @if(auth()->check() && auth()->id() === $comment->user_id)
            <!-- Dropdown Button -->
            <div class="dropdown">
                <button class="btn btn-sm btn-dark dropdown-toggle" type="button" id="dropdownMenuButton{{ $comment->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                    ⋮
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton{{ $comment->id }}">
                    <li>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); openEditModal({{ $comment->id }}, '{{ $comment->body }}');">Edit</a>
                    </li>
                    
                    <li>
                     <form action="{{ route('comment.delete', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                       @csrf
                         @method('DELETE')
                         <button type="submit" class="dropdown-item text-danger">Delete</button>
                     </form>
                    </li>

                </ul>
            </div>
            @endif
        </div>

        <div class="comment-time text-muted small mt-1" style="font-size: 0.85rem;">
            {{ $comment->created_at->diffForHumans() }}
        </div>

        <!-- Reply Button -->
        <button class="btn btn-primary btn-sm mt-2" onclick="toggleReplyForm({{ $comment->id }})">Reply</button>

       <!-- Show Replies Button -->
@if($comment->replies->count())
    <button class="btn btn-secondary btn-sm mt-2" onclick="toggleReplies({{ $comment->id }}, this)">
        Show Replies ({{ $comment->replies->count() }})
    </button>
@endif


        <!-- Reply Form -->
        <div id="reply-form-{{ $comment->id }}" class="mt-3" style="display: none;">
            <form action="{{ route('post.comment.reply', $comment->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea name="body" class="form-control" rows="3" placeholder="Write a reply..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn btn-sm">Post Reply</button>
            </form>
        </div>

       <!-- Replies Section -->
<div id="replies-{{ $comment->id }}" class="mt-3 ms-3" style="display: none;">
    @if($comment->replies->count())
        @foreach($comment->replies as $reply)
            @include('components.reply', ['reply' => $reply])
        @endforeach
    @else
        <div>No replies yet.</div>
    @endif
</div>

    </div>
    @endforeach
</div>

    <!-- Edit Comment Modal -->
    <div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editCommentForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                    </div>
                    <div class="modal-body">
                        <textarea id="editCommentBody" name="body" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div> <!-- End of comment-section -->
</div> 
</div> 

<script>
function toggleReplyForm(commentId) {
    const form = document.getElementById('reply-form-' + commentId);

    // Toggle the visibility of the form
    const isVisible = form.style.display === 'block';
    form.style.display = isVisible ? 'none' : 'block';

    if (!isVisible) {
        // Wait for the form to be rendered and then scroll into view
        setTimeout(() => {
            form.scrollIntoView({ behavior: 'smooth', block: 'center' });

            const textarea = form.querySelector('textarea');
            if (textarea) {
                textarea.focus();
            }
        }, 100); // short delay to allow the DOM to update
    }
}


function toggleReplies(replyId, btn = null) {
    // Find the section with replies under the current reply
    const repliesSection = document.getElementById('replies-' + replyId);

    if (repliesSection) {
        const isHidden = repliesSection.style.display === 'none';
        repliesSection.style.display = isHidden ? 'block' : 'none';

        if (btn) {
            // Change the button text to show/hide replies
            const count = repliesSection.children.length;
            btn.textContent = isHidden
                ? `Hide Replies (${count})`
                : `Show Replies (${count})`;
        }
    }
}


function openEditModal(commentId, body, isReply = false) {
    const form = document.getElementById('editCommentForm');
    const actionUrl = isReply
        ? `/reply/${commentId}/edit` // for reply update
        : `/comment/update/${commentId}`; // fixed top-level comment update

    form.action = actionUrl;
    document.getElementById('editCommentBody').value = body;

    const modal = new bootstrap.Modal(document.getElementById('editCommentModal'));
    modal.show();
}


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


<!-- footer section start -->
@include('home.footer')
</body>
</html>
