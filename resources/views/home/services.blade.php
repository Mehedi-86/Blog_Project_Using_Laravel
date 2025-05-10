<div class="services_section layout_padding">
    <div class="container">
        <h1 class="services_taital">Blog Posts</h1>
        <p class="services_text" style="display: flex; justify-content: space-between; align-items: center;">
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
            <button id="darkModeToggle" onclick="toggleDarkMode()" class="btn btn-sm btn-outline-secondary" style="margin-left: auto;">
                🌙 ↔️ ☀️
            </button>
        </p>

        <!-- Custom Dropdown Form -->
        <form method="GET" action="{{ url('/') }}" class="mb-2">
    <div class="row justify-content-center align-items-center">
        <!-- Category Dropdown -->
        <div class="col-auto">
            <div class="custom-select-wrapper">
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
                        <div class="dropdown-option {{ $selectedCategory == $category->name ? 'active' : '' }}" data-value="{{ $category->name }}">
                            {{ $category->name }}
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="category" id="categoryInput" value="{{ $selectedCategory }}">
            </div>
        </div>

        <!-- Search Input and Button -->
        <div class="col-auto">
            <div class="input-group">
                <input type="text" name="search" class="form-control search-input" placeholder="Search posts...  🔍" value="{{ $searchTerm ?? '' }}">
                <div class="input-group-append">
                <button type="submit" class="search-button">
                  <i class="fa fa-search"></i> <span class="search-text ml-2">Search</span>
                </button>
                </div>
            </div>
        </div>
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
        width: 300px;
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

     /* Search Icon inside input */

    .search-text {
        font-weight: bold;
    }

    .search-input {
        border-radius: 30px;
        padding-left: 50px; 
        padding-right: 40px; 
        font-size: 16px;
        transition: all 0.3s ease-in-out;
        width: 100%;
    }

    .search-input::placeholder {
        color: #aaa;
    }

    /* Search Button Style */
    .search-button {
        border-radius: 30px;
        padding: 5px 25px; /* Wider padding */
        font-size: 16px;
        background-color: #007bff;
        color: #fff;
        border: 2px solid rgba(25, 42, 86, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease-in-out;
        white-space: nowrap; /* Prevents text wrapping */
    }

    .search-button:hover {
        background-color: #0056b3;
    }

    /* Search Button Icon */
    .search-button i {
        margin-left: 5px;
    }

    .input-group .input-group-prepend,
    .input-group .input-group-append {
        border: none;
    }

    .input-group {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .input-group .search-button {
        margin-left: 10px;
    }

    .input-group .search-input {
        flex-grow: 1;
    }

    /* Hover Effects on Input */
    .search-input:focus {
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.6);
        border-color: #007bff;
    }

    /* Small tweaks for alignment and spacing */
    .col-md-8 {
        padding-right: 0;
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

    body.dark-mode {
    background-color: #1e272e;
    color: #f1f2f6;
    }

    body.dark-mode .custom-select {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.2);
        color: #f1f2f6;
    }

    body.dark-mode .custom-select:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.3);
        box-shadow: 0 10px 28px rgba(255, 255, 255, 0.1);
    }

    body.dark-mode .dropdown-icon {
        stroke: #f1f2f6;
    }

    body.dark-mode .dropdown-options {
        background: #2f3640;
        border-color: rgba(255, 255, 255, 0.1);
        box-shadow: 0 12px 24px rgba(255, 255, 255, 0.08);
    }

    body.dark-mode .dropdown-option {
        background: #2f3640;
        color: #dcdde1;
    }

    body.dark-mode .dropdown-option:hover,
    body.dark-mode .dropdown-option.active {
        background: #3c6382;
        color: #ffffff;
    }

    body.dark-mode #selectedCategory {
        color: #dcdde1;
    }

    body.dark-mode .blog-card {
        background: #2f3640;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.4);
    }

    body.dark-mode .blog-card-title {
        color: #f5f6fa;
    }

    body.dark-mode .blog-card-meta {
        color: #a4b0be;
    }

    body.dark-mode .read-more {
        background: #5e60ce;
    }

    body.dark-mode .read-more:hover {
        background: #4e4fc4;
    }

    body.dark-mode .services_taital,
    body.dark-mode .services_text {
        color: #f5f6fa;
    }

    body.dark-mode .search-input {
        background-color: #2c3e50;  
        color: #ecf0f1;              
        border: 1px solid #34495e;   
    }

    body.dark-mode .search-input::placeholder {
        color: #7f8c8d;  
    }

    body.dark-mode .search-button {
        background-color: #2980b9;  
        border-color: rgba(255, 255, 255, 0.2);  
        color: #fff;  
    }

    body.dark-mode .search-button:hover {
        background-color: #3498db;  
    }

    body.dark-mode .text-muted {
        color: #cccccc !important; 
    }

    body.dark-mode .text-muted b {
        color: #ffffff; 
    }

    body.dark-mode .text-muted span {
        color: #dddddd; 
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
