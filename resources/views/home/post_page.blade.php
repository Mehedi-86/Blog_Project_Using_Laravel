<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <base href="/public">
    @include('home.homecss')

    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: #fff;
        }

        .div_deg {
            max-width: 700px;
            margin: 0 auto;
            margin-top: 10px;
            padding: 50px 20px 20px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            text-align: left;
        }

        .title_deg {
            text-align: center;
            font-size: 34px;
            font-weight: bold;
            color: #ffffff;
        }

        .input_deg {
            margin-bottom: 25px;
        }

        label {
            font-size: 18px;
            font-weight: bold;
            color: #f1f1f1;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            box-sizing: border-box;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
            color: #000;
        }

        .img_deg {
            display: block;
            max-width: 100%;
            height: auto;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #1ABC9C;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #16A085;
        }

        .alert.full_width {
           width: 100%;
           margin: 0;
           border-radius: 0;
           font-size: 25px;
           text-align: center;
           position: relative;
           padding: 4px 2.5rem 4px 15px;
       }

       .alert.full_width .close {
           position: absolute;
           right: 10px;
           top: 50%;
           transform: translateY(-50%);
           font-size: 2.5rem;
       }

       .btn.btn-primary {
        font-size: 18px;
        padding: 5px 10px;
        border-radius: 6px;
        transition: background-color 0.3s ease;
       }

       #description 
       {
        background-color: rgba(255, 255, 255, 0.9) !important;
        color: #000 !important;
       }

       .header_section 
       {
        margin-bottom: 10px; 
       }

       .custom-select-wrapper {
    position: relative;
    user-select: none;
}

.custom-select {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    background-color: rgba(255, 255, 255, 0.15);
    border-radius: 10px;
    cursor: pointer;
    color: #fff;
}

.dropdown-options {
    display: none;
    position: absolute;
    width: 100%;
    top: 100%;
    left: 0;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 10px;
    max-height: 200px;
    overflow-y: auto;
    z-index: 999;
}

.dropdown-options.show {
    display: block;
}

.dropdown-option {
    padding: 10px 12px;
    cursor: pointer;
}

.dropdown-option:hover {
    background-color: rgba(255, 255, 255, 0.25);
}

.dropdown-icon {
    fill: #fff;
}

    </style>
</head>
<body>

    <!-- header section -->
    <div class="header_section">
        @include('home.header')
    </div>

    <h1 class="title_deg"><i class="fas fa-edit" style="margin-right: 20px;"></i>Update Post</h1>

    @if(session()->has('message'))
    <div class="alert alert-success full_width alert-dismissible fade show" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Form container -->
    <div class="div_deg">
        <form action="{{ url('update_post_data', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="input_deg">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ $data->title }}">
            </div>

            <div class="input_deg">
                <label for="description">Description</label>
                <textarea name="description" id="description">{!! $data->description !!}</textarea>
            </div>

            <div class="input_deg">
                <label>Current Image</label>
                <img class="img_deg" src="/postimage/{{ $data->image }}" alt="Current Post Image">
            </div>

            <div class="input_deg">
                <label for="image">Change Image</label>
                <input type="file" name="image" id="image">
            </div>

            <div class="input_deg">
              <label for="category" style="color: #fff;">Update Category</label>
                 <div class="custom-select-wrapper">
                     <div class="custom-select" id="customSelect">
                          <span id="selectedCategory">
                            {{ $categories->firstWhere('id', $data->category_id)->name ?? 'Choose a category' }}
                          </span>
                          <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                     </div>
                     <div class="dropdown-options" id="dropdownOptions">
                     @foreach ($categories as $category)
                       <div 
                         class="dropdown-option" 
                           data-value="{{ $category->id }}"
                           @if ($category->id == $data->category_id) style="background-color: rgba(255,255,255,0.2);" @endif
                            >
                           {{ $category->name }}
                        </div>
                     @endforeach
                     </div>
                   <input type="hidden" name="category_id" id="category_id" value="{{ $data->category_id }}">
                 </div>
            </div>


            <div class="input_deg" style="text-align: center;">
              <input type="submit" value="Update" class="btn btn-primary" style="background-color: #007bff; border-color: white; color: white;">
            </div>

        </form>
    </div>

    <!-- footer section -->
    @include('home.footer')

    <script src="https://cdn.tiny.cloud/1/43ryrgz42cov96zpsu0vhqz1guhojcq6vmqfgc6clavjiirl/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
       tinymce.init({
            selector: '#description',
            height: 300,
            menubar: false,
            plugins: 'link image code lists',
            toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright | bullist numlist | link | code',
            content_style: 'body { font-family:Arial,sans-serif; font-size:14px }'
        });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
    const select = document.getElementById("customSelect");
    const options = document.getElementById("dropdownOptions");
    const hiddenInput = document.getElementById("category_id");
    const selectedText = document.getElementById("selectedCategory");

    // Preselect current category
    const currentValue = hiddenInput.value;
    if (currentValue) {
        const preselectedOption = document.querySelector(`.dropdown-option[data-value='${currentValue}']`);
        if (preselectedOption) {
            selectedText.textContent = preselectedOption.textContent;
            preselectedOption.style.backgroundColor = "rgba(255,255,255,0.2)";
        }
    }

    // Toggle dropdown
    select.addEventListener("click", () => {
        options.classList.toggle("show");
    });

    // Select an option
    document.querySelectorAll(".dropdown-option").forEach(option => {
        option.addEventListener("click", () => {
            selectedText.textContent = option.textContent;
            hiddenInput.value = option.getAttribute("data-value");

            // Highlight selected
            document.querySelectorAll(".dropdown-option").forEach(opt => opt.style.backgroundColor = "");
            option.style.backgroundColor = "rgba(255,255,255,0.2)";
            
            options.classList.remove("show");
        });
    });

    // Close on outside click
    document.addEventListener("click", e => {
        if (!select.contains(e.target) && !options.contains(e.target)) {
            options.classList.remove("show");
        }
    });
});
</script>

</body>
</html>
