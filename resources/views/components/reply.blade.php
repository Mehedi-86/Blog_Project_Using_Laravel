<div class="border rounded p-3 mb-3 position-relative ms-3">
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

    <!-- Nested Reply Button -->
    <button class="btn btn-primary btn-sm mt-2" onclick="toggleReplyForm({{ $reply->id }})">Reply</button>

    <!-- Reply Form -->
    <div id="reply-form-{{ $reply->id }}" class="mt-3" style="display: none;">
        <form action="{{ route('post.comment.reply', $reply->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="body" class="form-control" rows="3" placeholder="Write a reply..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn btn-sm">Post Reply</button>
        </form>
    </div>

    <!-- Show Replies Button for Current Reply -->
@if($reply->replies->count())
    <button class="btn btn-secondary btn-sm mt-2" onclick="toggleReplies({{ $reply->id }}, this)">
        Show Replies ({{ $reply->replies->count() }})
    </button>
@endif

    <!-- Recursive Replies Container -->
    <div id="replies-{{ $reply->id }}" class="mt-2 ms-3" style="display: none;">
        @foreach($reply->replies as $childReply)
            @include('components.reply', ['reply' => $childReply]) <!-- This includes the same component recursively -->
        @endforeach
    </div>
</div>
