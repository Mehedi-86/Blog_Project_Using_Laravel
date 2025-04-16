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
          width: 500px;
          height: 250px;
          object-fit: cover;
        }

        /* Increase container width */
        .wide-container {
            max-width: 95%; /* Increase to your desired width */
            margin: 0 auto;
            padding: 0 15px; /* Optional padding */
        }

        .desc_content {
          font-size: 20px;
          line-height: 1.8;
          color: #333;
          text-align: justify;
          padding: 20px 0;
          max-width: 90%;
          margin: 0 auto;
          margin-bottom: 50px;
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
          <h4 style="font-size: 1.5rem; font-weight: bold;">{{$post->title}}</h4>
          <p>Post by <b>{{$post->name}}</b></p>
        </div>

        <!-- Description + Comment Section -->
        <div class="desc_comment_wrapper">

            <!-- Description -->
            <div class="desc_content mb-4">
                {!! $post->description !!}
            </div>

            <!-- Like Section with the added id="like-section" -->
            <div class="mt-4 d-flex flex-column align-items-center"  id="like-section">
                <!-- Like Button -->
                <form action="{{ route('post.like', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn {{ $post->likes()->where('user_id', auth()->id())->exists() ? 'btn-secondary' : 'btn-primary' }}">
                        <strong>{{ $post->likes()->where('user_id', auth()->id())->exists() ? 'Liked' : 'Like' }}</strong>
                    </button>
                </form>

                <!-- Like Count -->
                <div class="mt-2">
                    <p class="mb-0 fw-bold" style="font-size: 1.2rem; font-weight: 700;">
                        <strong>{{ $post->likes->count() }}</strong> Likes
                    </p>
                </div>
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
       <button class="btn btn-secondary btn-sm mt-2" onclick="toggleReplies({{ $comment->id }})">Show Replies</button>

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
                <div class="border rounded p-3 mb-3 position-relative">
    <div class="d-flex justify-content-between">
        <div>
            <strong>{{ $reply->user->name }}:</strong>
            <span>{{ $reply->body }}</span>
        </div>

        @if(auth()->check() && auth()->id() === $reply->user_id)
        <!-- Dropdown Button for Reply -->
        <div class="dropdown">
            <button class="btn btn-sm btn-dark dropdown-toggle" type="button" id="dropdownMenuReply{{ $reply->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                ⋮
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuReply{{ $reply->id }}">
                <li>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); openEditModal({{ $reply->id }}, '{{ $reply->body }}', true);">Edit</a>
                </li>
                <li>
                    <form action="{{ route('comment.reply.delete', $reply->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reply?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                    </form>
                </li>
            </ul>
        </div>
        @endif
    </div>

    <div class="text-muted small mt-1">{{ $reply->created_at->diffForHumans() }}</div>
</div>

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


function toggleReplies(commentId) {
    const repliesSection = document.getElementById('replies-' + commentId);
    repliesSection.style.display = repliesSection.style.display === 'none' ? 'block' : 'none';
}

function openEditModal(commentId, body, isReply = false) {
    const form = document.getElementById('editCommentForm');
    const actionUrl = isReply
        ? `/reply/${commentId}/edit` // Your actual reply update route
        : `/comment/${commentId}/edit`; // Your actual comment update route

    form.action = actionUrl;
    document.getElementById('editCommentBody').value = body;
    const modal = new bootstrap.Modal(document.getElementById('editCommentModal'));
    modal.show();
}

</script>


<!-- footer section start -->
@include('home.footer')
</body>
</html>
