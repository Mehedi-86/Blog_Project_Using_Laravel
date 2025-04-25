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
        <div class="services_section_2" style="margin-top: 20px;">
            <div class="row">
                @foreach($post as $post)
                <div class="col-md-4" style="padding:30px">
                    <div>
                        <img src="/postimage/{{ $post->image }}" class="services_img" style="margin-bottom: 20px; width: 100%; height: 200px; object-fit: cover;">
                    </div>
                    <h4 style="font-weight: bold; font-size: 1.5rem;">{{ $post->title }}</h4>
                    <p class="text-muted mb-1">
                        Post by <b>{{ $post->name }}</b>
                        <span style="margin-left: 40px; margin-right: 40px;">|</span>
                        <span>👁️ {{ $post->views }} views</span>
                    </p>
                    <div class="btn_main">
                        <a href="#" class="read-more" data-post-id="{{ $post->id }}" data-href="{{ url('post_details', $post->id) }}">Read more</a>
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
        font-family: 'Segoe UI', sans-serif;
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
        top: calc(100% + 5px);
        left: 0;
        width: 100%;
        background: white;
        border: 2px solid rgba(25, 42, 86, 0.4);
        border-radius: 0 0 12px 12px;
        display: none;
        z-index: 10;
        max-height: 240px;
        overflow-y: auto;
        box-shadow: 0 12px 22px rgba(0, 0, 0, 0.15);
        animation: fadeIn 0.3s ease-in-out;
    }

    .dropdown-option {
        padding: 14px 20px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        font-weight: 500;
        color: #2f3640;
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
