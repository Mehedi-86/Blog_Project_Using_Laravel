<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.homecss')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            padding-top: 30px;
            padding-bottom: 30px;
            padding-left: 14px;
            padding-right: 14px;
        }

        .nav-tabs .nav-link {
            font-weight: 600;
            font-size: 1.025rem;
            border: none;
            border-bottom: 3px solid transparent;
            color: #495057;
        }

        .nav-tabs .nav-link.active {
            color: #0d6efd;
            background-color: transparent;
            border-color: #0d6efd;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .user-card {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        }

        .user-card p {
            margin-bottom: 10px;
            color: #495057;
        }

        .header_section{
            margin-bottom: 30px;
        }

        .text-dark-gray {
            color: #343a40;
        }

    </style>
</head>
<body>
    <!-- Header -->
    <div class="header_section">
        @include('home.header')
    </div>

    <div class="container mb-5" >
        <div class="row align-items-center mb-4">
            <div class="col text-start">
                <a href="{{ route('connections') }}"
                class="btn shadow-sm rounded-circle px-2 py-1" style="background-color: #e9ecef; color: #495057; border: 1px solid #ced4da;"> <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        <div class="col text-center">
            <h3 class="display-6 fw-bold mb-0 text-dark-gray" style="font-size: 2rem;">
                <i class="fas fa-file-alt me-2"></i> Post Details
            </h3>
        </div>
        <div class="col"><!-- Empty column to balance layout --></div>
    </div>


        <!-- Tabs -->
        <ul class="nav nav-tabs mb-4" id="userTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fs-6 fw-semibold" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts" type="button" role="tab">
                    <i class="bi bi-card-text me-1"></i> Posts
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ route('user.viewDetails', $user->id) }}" class="nav-link fs-6 fw-semibold" id="details-tab" role="tab">
                    <i class="bi bi-info-circle me-1"></i> Details
                </a>
            </li>
        </ul>

        
        <div class="tab-content" id="userTabContent">
        <!-- Posts Tab -->
        <div class="tab-pane fade show active" id="posts" role="tabpanel">
            @forelse($posts as $post)
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title fs-4 fw-semibold">{{ $post->title }}</h5>
                            <p class="card-text fs-5">{{ Str::limit($post->content, 100) }}</p>
                            <small class="text-muted fs-6">{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                        <a href="{{ route('post.details', $post->id) }}" 
                        class="btn btn-primary px-3 py-2 ms-3" 
                        style="font-size: 0.9rem; white-space: nowrap;">
                        <i class="bi bi-eye-fill me-1"></i> <strong>View Post</strong>
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-muted fs-5">No posts available.</p>
            @endforelse

            <!-- Pagination -->
            <div class="mt-3">
                {{ $posts->withQueryString()->links() }}
            </div>
        </div>
    </div>
  </div>

    <!-- Footer -->
    @include('home.footer')

    <!-- Bootstrap Bundle JS (required for tabs) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
