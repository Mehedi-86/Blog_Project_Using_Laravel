<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    @include('home.homecss')

    <style>
        /* Style for the posts wrapper */
        .posts_wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding: 10px 30px 30px;
            background-color: #2C3E50;
        }

        /* Style for the post cards */
        .post_card {
            background-color: #34495E;
            padding: 20px;
            width: 300px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .img_deg {
            height: 200px;
            width: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .title_deg {
            font-size: 22px;
            font-weight: bold;
            color: white;
            margin: 15px 0;
        }

        .btn {
            margin: 5px;
        }

        .alert {
            width: 80%;
            margin: 20px auto;
        }

        /* Custom Dropdown Styles */
        .custom-select-wrapper {
            position: relative;
            width: 100%;
            font-family: 'Segoe UI', sans-serif;
            margin: 20px auto;
            text-align: center;
            max-width: 300px;
        }

        .custom-select {
            background: rgba(230, 240, 255, 0.95);
            backdrop-filter: blur(8px);
            border: 2px solid rgba(120, 120, 120, 0.8);
            border-radius: 12px;
            padding: 14px 20px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #333; /* Dark text for readability */
            font-weight: 600;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .custom-select:hover {
            background: #c0e4ff; 
            border-color: rgba(150, 150, 150, 0.9);   
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15); 
        }



        .dropdown-icon {
            transition: transform 0.3s ease;
            stroke: #555; /* Darker stroke for the arrow */
        }

        .custom-select.active .dropdown-icon {
            transform: rotate(180deg);
        }

        .dropdown-options {
            position: absolute;
            top: calc(100% + 5px);
            left: 0;
            width: 100%;
            background: #ffffff;
            border: 2px solid rgba(200, 200, 200, 0.7);
            border-radius: 0 0 12px 12px;
            display: none;
            z-index: 10;
            max-height: 240px;
            overflow-y: auto;
            box-shadow: 0 12px 22px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.3s ease-in-out;
        }

        .dropdown-option {
            padding: 14px 20px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            font-weight: 500;
            color: #555; /* Slightly dark text */
        }

        .dropdown-option:hover,
        .dropdown-option.active {
            background: #f0f0f0;
            color: #000;
            font-weight: 600;
        }

        #selectedCategory {
            font-weight: 600;
            color: #333;
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

        .category-filter-section 
        {
            background: #2C3E50;
            padding: 1px 0;
        }

        /* for search */
        .category-search-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 20px auto;
            max-width: 700px;
            align-items: center;
        }

        .search-bar-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-input {
            padding: 12px 15px;
            border-radius: 12px;
            border: 2px solid rgba(120, 120, 120, 0.8);
            font-weight: 500;
            width: 220px;
            background: rgba(230, 240, 255, 0.95);
            color: #333;
        }

        .search-button {
            padding: 6px 10px;
            border-radius: 12px;
            font-weight: bold;
        }
    </style>
    
</head>
<body>
    <!-- header section start -->
    <div class="header_section">
        @include('home.header')
    </div>

    <!-- heading that show My Posts-->
    <h2 style="text-align: center; font-size: 36px; font-weight: bold; color: #2C3E50;"><i class="fas fa-file-alt" style="margin-right: 20px;"></i>My Posts</h2>

    <!-- Success message here -->
    @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" 
         style="width: 100%; margin: 0; font-size: 25px; padding: 4px 2.5rem 4px 15px; text-align: center; position: relative; border-radius: 0;">
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" 
                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); font-size: 2.5rem;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Custom Dropdown Category Filter -->
    <div class="category-filter-section">
        <form method="GET" action="{{ url('/my_post') }}" class="category-search-wrapper">
        <div class="custom-select-wrapper">
            <div class="custom-select" id="customSelect">
                <span id="selectedCategory">{{ request('category') ?? 'Choose a category' }}</span>
                <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                    <path d="M6 9l6 6 6-6" stroke="black" stroke-width="2" fill="none"/>
                </svg>
            </div>
            <div class="dropdown-options" id="dropdownOptions">
                <div class="dropdown-option {{ request('category') == '' ? 'active' : '' }}" data-value="">All</div>
                @foreach ($categories as $category)
                    <div 
                        class="dropdown-option {{ request('category') == $category->name ? 'active' : '' }}" 
                        data-value="{{ $category->name }}">
                        {{ $category->name }}
                    </div>
                @endforeach
            </div>
            <input type="hidden" name="category" id="categoryInput" value="{{ request('category') }}">
        </div>

        <!-- Search Functionality -->
        <div class="search-bar-wrapper">
            <input type="text"  name="search"  class="search-input"  placeholder="Search posts...  🔍" value="{{ request('search') }}">
            <button type="submit" class="btn btn-success search-button">Search</button>
        </div>
        </form>
    </div>

    <!-- posts wrapper -->
    <div class="posts_wrapper">
        @foreach($data as $post)
            <div class="post_card">
                <img class="img_deg" src="/postimage/{{$post->image}}">
                <h4 class="title_deg">{{$post->title}}</h4>
                <a onclick="return confirm('Are you sure to delete this?')" href="{{url('my_post_del',$post->id)}}" class="btn btn-danger">Delete</a>
                <a href="{{url('post_update_page',$post->id)}}" class="btn btn-primary">Update</a>
            </div>
        @endforeach
    </div>

    <!-- footer section start -->
    @include('home.footer')

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
    </script>
</body>
</html>