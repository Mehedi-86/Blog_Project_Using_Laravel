<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    @include('home.homecss')

    <style>
        .posts_wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding: 50px 30px 30px;
            background-color: #2C3E50;
        }

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
    </style>
</head>
<body>
    <!-- header section start -->
    <div class="header_section">
        @include('home.header')
    </div>

    <!-- heading that show My Posts-->
<h2 style="text-align: center; font-size: 36px; font-weight: bold; color: #2C3E50;">My Posts</h2>

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

    <!-- posts wrapper -->
    <div class="posts_wrapper">
        @foreach($data as $data)
            <div class="post_card">
                <img class="img_deg" src="/postimage/{{$data->image}}">
                <h4 class="title_deg">{{$data->title}}</h4>
                <a onclick="return confirm('Are you sure to delete this?')" href="{{url('my_post_del',$data->id)}}" class="btn btn-danger">Delete</a>
                <a href="{{url('post_update_page',$data->id)}}" class="btn btn-primary">Update</a>
            </div>
        @endforeach
    </div>

    <!-- footer section start -->
    @include('home.footer')
</body>
</html>
