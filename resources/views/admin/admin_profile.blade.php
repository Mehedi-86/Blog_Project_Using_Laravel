<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style>
        .profile-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .profile-header {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .profile-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #dee2e6;
            margin-right: 20px;
            background-color: #f8f9fa;
        }
        .card {
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,.05);
            border: none;
        }
        .btn-primary, .btn-secondary {
            min-width: 160px;
        }
        .btn-outline-secondary {
            color: #333;
            border-color: #ced4da;
            background-color: #f8f9fa;
        }
        .btn-outline-secondary:hover {
            background-color: #e9ecef;
        }

        .profile-container {
            max-width: 100%;
            margin: 0 auto;
        }

    </style>
  </head>

  <body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
      @include('admin.sidebar')

      <div class="page-content container-fluid px-3 py-4">
      <div class="profile-container px-3">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="profile-header mb-0">
                    <i class="fas fa-user-circle me-2"></i>
                    {{ $admin->name }}'s Profile
                </h5>
            </div>

            <div class="card p-4">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    @if ($admin->profile_picture)
                        <img src="{{ asset('storage/' . $admin->profile_picture) }}" alt="Profile Picture" class="profile-img mb-3 mb-md-0">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile" class="profile-img mb-3 mb-md-0">
                    @endif

                    <div class="ms-md-4 text-left text-md-start">
                        <h5 class="mb-1">Name: {{ $admin->name }}</h5>
                        <p class="mb-2">Email: {{ $admin->email }}</p>

                        <form action="{{ route('admin.profile.picture.update') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                            @csrf
                            <input type="file" name="profile_picture" id="profile_picture_input" accept="image/*" style="display: none;" onchange="document.getElementById('uploadForm').submit();">

                            @error('profile_picture')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror

                            <div class="d-flex gap-2 justify-content-center justify-content-md-start mt-3">
                                @if (!$admin->profile_picture)
                                    <button type="button" class="btn btn-primary" onclick="document.getElementById('profile_picture_input').click();">
                                        Add Profile Picture
                                    </button>
                                @endif
                                <button type="button" class="btn btn-secondary" onclick="document.getElementById('profile_picture_input').click();">
                                    <strong>Update Picture</strong>
                                </button>
                                <a href="{{ route('switch.user.home') }}" class="btn btn-outline-secondary mt-3">
                                    Switch Dashboard
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>

    @include('admin.footer')
  </body>
</html>
