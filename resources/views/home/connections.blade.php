<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('home.homecss')
    <!-- Add Bootstrap Icons CDN to <head> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>

    .header_section{
        margin-bottom: 30px;
    }

    .tight-container {
            padding-bottom: 0px;
            padding-top: 0;
        }

    body {
        background-color: #f1f3f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .section-title {
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        color: #212529;
    }

    .nav-tabs .nav-link {
        font-weight: 600;
        color: #495057;
        border: none;
        border-bottom: 2px solid transparent;
        transition: all 0.3s ease-in-out;
    }

    .nav-tabs .nav-link.active {
        color: #0d6efd;
        border-bottom: 2px solid #0d6efd;
    }

    .connection-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 16px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        transition: transform 0.2s ease-in-out;
    }

    .connection-card:hover {
        transform: translateY(-2px);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .user-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #dee2e6;
    }

    .user-name {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 600;
        color: #212529;
    }

    .btn-follow,
    .btn-unfollow {
        border: none;
        border-radius: 50px;
        padding: 8px 18px;
        font-size: 0.9rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease-in-out;
    }

    .btn-follow {
        background-color: #0d6efd;
        color: white;
    }

    .btn-follow:hover {
        background-color: #0b5ed7;
    }

    .btn-unfollow {
        background-color: #696969;
        color: #212529;
    }

    .btn-unfollow:hover {
        background-color: #343a40;
    }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header_section">
        @include('home.header')
    </div>

    <!-- Inside Main Content -->
<div class="container tight-container">
<div class="container">
    <div class="row align-items-center mb-4">
        <!-- Left-aligned Back Button -->
        <div class="col text-start">
            <a href="{{ route('user.profile', ['id' => $user->id]) }}"
            class="btn shadow-sm rounded-circle px-2 py-1" style="background-color: #e9ecef; color: #495057; border: 1px solid #ced4da;"> <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <!-- Centered Title -->
        <div class="col text-center">
            <h1 class="section-title mb-0" style="font-size: 2rem;">
                <i class="bi bi-people-fill me-2"></i>Connections
            </h1>
        </div>

        <!-- Right Empty Column to Balance Layout -->
        <div class="col"></div>
    </div>
</div>

    <ul class="nav nav-tabs mb-4" id="connectionTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#followers" type="button">
                <i class="bi bi-person-fill-down me-1"></i> Followers
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#followings" type="button">
                <i class="bi bi-person-fill-up me-1"></i> Followings
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#suggestions" type="button">
                <i class="bi bi-person-plus-fill me-1"></i> Suggestions
            </button>
        </li>
    </ul>

    <div class="tab-content">
    <!-- Followers Tab -->
    <div class="tab-pane fade show active" id="followers">
        @forelse ($followers as $follower)
            <div class="connection-card">
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($follower->name) }}" class="user-avatar" alt="{{ $follower->name }}">
                    @if ($followingIds->contains($follower->id))
                        <a href="{{ route('user.view', $follower->id) }}" class="user-name">{{ $follower->name }}</a>
                    @else
                        <p class="user-name">{{ $follower->name }}</p>
                    @endif
                </div>
                <div>
                    @if ($followingIds->contains($follower->id))
                        <form action="{{ route('unfollow', $follower->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-unfollow"><i class="bi bi-person-dash-fill"></i> Unfollow</button>
                        </form>
                    @else
                        <form action="{{ route('follow', $follower->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-follow"><i class="bi bi-person-plus-fill"></i> Follow</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <p>No followers yet.</p>
        @endforelse
    </div>

    <!-- Followings Tab -->
    <div class="tab-pane fade" id="followings">
        @forelse ($followings as $following)
            <div class="connection-card">
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($following->name) }}" class="user-avatar" alt="{{ $following->name }}">
                    <a href="{{ route('user.view', $following->id) }}" class="user-name">{{ $following->name }}</a>
                </div>
                <form action="{{ route('unfollow', $following->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-unfollow"><i class="bi bi-person-dash-fill"></i> Unfollow</button>
                </form>
            </div>
        @empty
            <p>You are not following anyone.</p>
        @endforelse
    </div>

    <!-- Suggestions Tab -->
    <div class="tab-pane fade" id="suggestions">
        @forelse ($suggestions as $suggested)
            <div class="connection-card">
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($suggested->name) }}" class="user-avatar" alt="{{ $suggested->name }}">
                    @if ($followingIds->contains($suggested->id))
                        <a href="{{ route('user.view', $suggested->id) }}" class="user-name">{{ $suggested->name }}</a>
                    @else
                        <p class="user-name">{{ $suggested->name }}</p>
                    @endif
                </div>
                <form action="{{ route('follow', $suggested->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-follow"><i class="bi bi-person-plus-fill"></i> Follow</button>
                </form>
            </div>
        @empty
            <p>No suggestions available.</p>
        @endforelse
    </div>
</div>
</div>

    <!-- Footer -->
    @include('home.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
