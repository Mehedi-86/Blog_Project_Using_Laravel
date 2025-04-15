<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style type="text/css">
      .title_deg {
          font-size: 24px; /* Reduced from 30px to 24px */
          font-weight: bold;
          color: white;
          padding: 30px;
          text-align: center;
      }
      .post_deg {
          padding: 30px;
          text-align: center;
          background-color: #333;
          margin-bottom: 20px;
      }
      .des_deg {
          font-size: 18px;
          font-weight: bold;
          padding: 15px;
          color: #ccc;
      }
      .img_deg {
          height: 200px;
          width: 100%;
          max-width: 300px;
          padding: 30px;
          margin: auto;
          object-fit: cover;
      }
      /* Optional: Custom blue style if you want a different blue shade than Bootstrap */
      .btn-update {
          background-color: #007bff; /* Bootstrap primary blue */
          border-color: #007bff;
          color: #fff;
      }
      .btn-update:hover {
          background-color: #0069d9;
          border-color: #0062cc;
          color: #fff;
      }
    </style>
  </head>

  <body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      
      <div class="page-content container">
        <h1 class="title_deg">Admin Posts</h1>
        
        @if(session()->has('message'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
          </div>
        @endif

        <!-- Start a row for posts -->
        <div class="row">
          @foreach($data as $post)
            <div class="col-md-4">
              <div class="post_deg">
                <img src="{{ asset('postimage/' . $post->image) }}" class="img_deg" alt="Post Image">
                <h4 class="title_deg">{{ $post->title }}</h4>
                <p class="des_deg">{{ $post->description }}</p>
                <a onclick="return confirm('Are you sure to delete this?')" href="{{ url('my_post_del', $post->id) }}" class="btn btn-danger">Delete</a>
                <!-- Using custom blue class for update button -->
                <a href="{{ url('post_update_page', $post->id) }}" class="btn btn-update">Update</a>
              </div>
            </div>
          @endforeach
        </div>
        <!-- End row -->
      </div>
    </div>

    @include('admin.footer')
  </body>
</html>
