<div class="services_section layout_padding">
    <div class="container">
        <h1 class="services_taital">Blog Posts</h1>
        <p class="services_text">
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
        </p>

        <!-- Custom Dropdown Form -->
        <form method="GET" action="{{ url('/') }}" class="mb-2 text-center">
            <div class="custom-select-wrapper mx-auto" style="max-width: 300px;">
                <div class="custom-select" id="customSelect">
                    <span id="selectedCategory">
                        {{ $selectedCategory ?? 'Choose a category' }}
                    </span>
                    <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                        <path d="M6 9l6 6 6-6" stroke="black" stroke-width="2" fill="none"/>
                    </svg>
                </div>
                <div class="dropdown-options" id="dropdownOptions">
                    <div class="dropdown-option {{ $selectedCategory == '' ? 'active' : '' }}" data-value="">All</div>
                    @foreach ($categories as $category)
                        <div 
                            class="dropdown-option {{ $selectedCategory == $category->name ? 'active' : '' }}" 
                            data-value="{{ $category->name }}">
                            {{ $category->name }}
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="category" id="categoryInput" value="{{ $selectedCategory }}">
            </div>
        </form>

            <!-- Blog Posts Section -->
        <div class="services_section_2" style="margin-top: 40px;">
            <div class="row">
                @foreach($post as $post)
                <div class="col-md-4 mb-4">
                    <div class="blog-card h-100 d-flex flex-column">
                        <div class="blog-card-image">
                            <img src="/postimage/{{ $post->image }}" alt="{{ $post->title }}" class="services_img">
                        </div>
                        <div class="blog-card-body">
                            <h4 class="blog-card-title">{{ $post->title }}</h4>
                            <p class="text-muted mb-1">
                            Post by <b>{{ $post->name }}</b>
                            <span style="margin-left: 10px; margin-right: 10px;">|</span>
                            <span>👁️ {{ $post->views }} views</span>
                            </p>
                            <div class="btn_main mt-auto">
                                <a href="#" class="read-more" data-post-id="{{ $post->id }}" data-href="{{ url('post_details', $post->id) }}">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    .custom-select-wrapper {
        position: relative;
        width: 100%;
        font-family: 'Poppins','Segoe UI', sans-serif;
    }

    .custom-select {
        background: rgba(25, 42, 86, 0.2);
        backdrop-filter: blur(12px);
        border: 2px solid rgba(25, 42, 86, 0.4);
        border-radius: 12px;
        padding: 14px 20px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #1e272e;
        font-weight: 600;
        box-shadow: 0 6px 18px rgba(25, 42, 86, 0.1);
        transition: all 0.3s ease;
    }

    .custom-select:hover {
        background: rgba(25, 42, 86, 0.3);
        border-color: rgba(25, 42, 86, 0.6);
        box-shadow: 0 10px 28px rgba(25, 42, 86, 0.2);
    }

    .dropdown-icon {
        transition: transform 0.3s ease;
        stroke: #0a3d62;
    }

    .custom-select.active .dropdown-icon {
        transform: rotate(180deg);
    }

    .dropdown-options {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        width: 100%;
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.1);
        box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        max-height: 260px;
        overflow-y: auto;
        z-index: 10;
    }

    .custom-select.active + .dropdown-options {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-option {
        padding: 14px 20px;
        font-weight: 500;
        color: #2f3640;
        background: #ffffff;
        cursor: pointer;
        transition: background 0.2s ease-in-out;
    }

    .dropdown-option:hover,
    .dropdown-option.active {
        background: #dff0ff;
        color: #0a3d62;
        font-weight: 600;
    }

    .services_text {
        margin-bottom: 2rem;
    }

    #selectedCategory {
        font-weight: 600;
        color: #0a3d62;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .blog-card {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        height: 100%;
    }

    .blog-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
    }

    .blog-card-image img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .blog-card:hover .blog-card-image img {
        transform: scale(1.05);
    }

    .blog-card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .blog-card-title {
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 12px;
        color: #0a3d62;
    }

    .blog-card-meta {
        font-size: 0.95rem;
        color: #778ca3;
        margin-bottom: 20px;
    }

    .read-more {
        margin-top: auto;
        display: inline-block;
        background: #0a3d62;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .read-more:hover {
        background: #074078;
    }

    .services_taital {
        font-size: 2.5rem;
        font-weight: 800;
        color: #0a3d62;
        margin-bottom: 20px;
        text-align: left;
    }

    .services_text {
        color: #636e72;
        font-size: 1rem;
        margin: 0 auto 30px;
        text-align: left;
    }

</style>

<!-- Scripts -->
<script>
    const customSelect = document.getElementById('customSelect');
    const dropdownOptions = document.getElementById('dropdownOptions');
    const selectedCategorySpan = document.getElementById('selectedCategory');
    const categoryInput = document.getElementById('categoryInput');

    customSelect.addEventListener('click', () => {
        dropdownOptions.style.display = dropdownOptions.style.display === 'block' ? 'none' : 'block';
        customSelect.classList.toggle('active');
    });

    document.querySelectorAll('.dropdown-option').forEach(option => {
        option.addEventListener('click', () => {
            const value = option.getAttribute('data-value');
            const text = option.textContent;

            categoryInput.value = value;
            selectedCategorySpan.textContent = text;
            dropdownOptions.style.display = 'none';
            customSelect.classList.remove('active');

            // Submit the form after selection
            option.closest('form').submit();
        });
    });

    document.addEventListener('click', function (e) {
        if (!customSelect.contains(e.target) && !dropdownOptions.contains(e.target)) {
            dropdownOptions.style.display = 'none';
            customSelect.classList.remove('active');
        }
    });

    // AJAX Read More
    document.querySelectorAll('.read-more').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const postId = this.getAttribute('data-post-id');
            const href = this.getAttribute('data-href');

            fetch(`/increase-view/${postId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(() => {
                window.location.href = href;
            });
        });
    });
</script>
