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
            background-color: #2C3E50;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .div_deg {
            max-width: 700px;
            margin: 0 auto;
            margin-top: 10px;
            padding: 50px 20px 20px;
            background-color: #34495E;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            text-align: left;
        }

        .title_deg {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            color: white;
        }

        .input_deg {
            margin-bottom: 25px;
        }

        label {
            font-size: 18px;
            font-weight: bold;
            color: #ECF0F1;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
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

        .alert.full_width 
        {
           width: 100%;
           margin: 0;
           border-radius: 0;
           font-size: 25px;
           text-align: center;
           position: relative;
           padding: 4px 2.5rem 4px 15px;
       }

       .alert.full_width .close 
       {
           position: absolute;
           right: 10px;
           top: 50%;
           transform: translateY(-50%);
           font-size: 2.5rem;
       }

       .btn.btn-primary 
       {
        font-size: 18px;
        padding: 5px 10px;
        border-radius: 6px;
        transition: background-color 0.3s ease;
       }
    </style>
</head>
<body>

    <!-- header section -->
    <div class="header_section">
        @include('home.header')
    </div>

    <h1 class="title_deg">Update Post</h1>

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
                <textarea name="description" id="description">{{ $data->description }}</textarea>
            </div>

            <div class="input_deg">
                <label>Current Image</label>
                <img class="img_deg" src="/postimage/{{ $data->image }}" alt="Current Post Image">
            </div>

            <div class="input_deg">
                <label for="image">Change Image</label>
                <input type="file" name="image" id="image">
            </div>

            <div class="input_deg" style="text-align: center;">
              <input type="submit" value="Update" class="btn btn-primary" style="background-color: #007bff; border-color: white; color: white;">
            </div>

        </form>
    </div>

    <!-- footer section -->
    @include('home.footer')

</body>
</html>
