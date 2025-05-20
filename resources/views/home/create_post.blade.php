<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('home.homecss')

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #4e54c8, #764ba2); 
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
            padding: 10px 20px;
        }

        .form-wrapper {
            max-width: 750px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            padding: 45px;
            transition: all 0.3s ease;
        }

        .title_deg {
            text-align: center;
            font-size: 2.3rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #ffffff;
        }

        .field_deg {
            margin-bottom: 25px;
        }

        label {
            font-size: 1.2rem;
            font-weight: 600;
            color: #f5f5f5;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 14px;
            font-size: 1rem;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background-color: rgba(255, 255, 255, 0.25);
            color: #fff;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input::placeholder,
        textarea::placeholder {
            color: #ddd;
        }

        input:focus,
        textarea:focus {
            outline: none;
            background-color: rgba(255, 255, 255, 0.35);
        }

        textarea {
            resize: vertical;
            min-height: 140px;
            color: #000;
        }

        #description {
            background-color: rgba(255, 255, 255, 0.95) !important;
            color: #000 !important;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 14px;
            font-size: 1.2rem;
            font-weight: 600;
            background: linear-gradient(to right, #4e54c8, #667eea);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .submit-btn:hover {
            background: linear-gradient(to right, #3f4c6b, #6a11cb);
            transform: scale(1.02);
        }

        @media (max-width: 768px) {
            .form-wrapper {
                padding: 30px 20px;
            }

            .title_deg {
                font-size: 2.2rem;
            }
        }

        /* Wrapper for the custom select */
    .custom-select-wrapper {
        position: relative;
        width: 100%;
    }

    /* Style the main select box */
    .custom-select {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        cursor: pointer;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .custom-select:hover {
        background-color: rgba(255, 255, 255, 0.3);
    }

    .dropdown-icon {
        width: 20px;
        height: 20px;
        transition: transform 0.3s ease;
    }

    .dropdown-options {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        z-index: 10;
    }

    .dropdown-option {
        padding: 12px;
        background-color: rgba(255, 255, 255, 0.15);
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dropdown-option:hover {
        background-color: rgba(255, 255, 255, 0.25);
    }

    /* Show the options when the select box is active */
    .dropdown-options.show {
        display: block;
    }
    </style>

    <!-- Optional Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body>

    @include('sweetalert::alert')

    <!-- header section -->
    <div class="header_section">
        @include('home.header')
    </div>

    <div class="container">
        <h1 class="title_deg"><i class="fas fa-plus-circle" style="margin-right: 20px;"></i>Add Post</h1>

        <div class="form-wrapper">
            <form action="{{ url('user_post') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="field_deg">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter post title" required>
                </div>

                <div class="field_deg">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" placeholder="Write something amazing..." required></textarea>
                </div>

                <div class="field_deg">
                    <label for="image">Add Image</label>
                    <input type="file" name="image" id="image" accept="image/*">
                </div>

                <div class="field_deg">
                 <label for="category" style="color: #fff;">Select Category</label>
                   <div class="custom-select-wrapper">
                     <div class="custom-select" id="customSelect">
                      <span id="selectedCategory">Choose a category</span>
                      <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                     </div>
                     <div class="dropdown-options" id="dropdownOptions">
                      @foreach ($categories as $category)
                       <div class="dropdown-option" data-value="{{ $category->id }}">{{ $category->name }}</div>
                      @endforeach
                     </div>
                      <input type="hidden" name="category_id" id="category_id">
                   </div>
                </div>

                <div class="field_deg">
                  <input type="submit" class="submit-btn" value="Add Post">
                </div>
            </form>
        </div>
    </div>

    <!-- footer section -->
    @include('home.footer')

    <script src="https://cdn.tiny.cloud/1/43ryrgz42cov96zpsu0vhqz1guhojcq6vmqfgc6clavjiirl/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: '#description',
        menubar: false,
        plugins: 'link image code lists',
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright | bullist numlist | link | code',
        height: 300,
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });
</script>

<script>
    // Toggle dropdown visibility on click
    const customSelect = document.getElementById('customSelect');
    const dropdownOptions = document.getElementById('dropdownOptions');
    const selectedCategory = document.getElementById('selectedCategory');
    const categoryInput = document.getElementById('category_id');

    customSelect.addEventListener('click', () => {
        dropdownOptions.classList.toggle('show');
        const icon = document.querySelector('.dropdown-icon');
        icon.style.transform = dropdownOptions.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0deg)';
    });

    // Handle category selection
    const dropdownItems = document.querySelectorAll('.dropdown-option');
    dropdownItems.forEach(item => {
        item.addEventListener('click', () => {
            selectedCategory.textContent = item.textContent;
            categoryInput.value = item.getAttribute('data-value');
            dropdownOptions.classList.remove('show');
            document.querySelector('.dropdown-icon').style.transform = 'rotate(0deg)';
        });
    });

    // Close dropdown if clicked outside
    window.addEventListener('click', (e) => {
        if (!customSelect.contains(e.target)) {
            dropdownOptions.classList.remove('show');
            document.querySelector('.dropdown-icon').style.transform = 'rotate(0deg)';
        }
    });
</script>

</body>
</html>
