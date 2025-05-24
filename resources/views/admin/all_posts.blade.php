<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style type="text/css">
      .title_deg {
          font-size: 24px;
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
          border-radius: 10px;
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
      .btn-read {
          background-color: #28a745;
          border-color: #28a745;
          color: #fff;
      }
      .btn-read:hover {
          background-color: #218838;
          border-color: #1e7e34;
          color: #fff;
      }
      .meta-info {
          font-size: 14px;
          color: #aaa;
          margin-top: 10px;
      }
    </style>
  </head>

  <body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
      @include('admin.sidebar')

      <div class="page-content container">
        <h1 class="title_deg">All Posts</h1>

        @if(session()->has('message'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
          </div>
        @endif

        <div class="row">
          @foreach($data as $post)
            <div class="col-md-4">
              <div class="post_deg">
                <img src="{{ asset('postimage/' . $post->image) }}" class="img_deg" alt="Post Image">
                <h4 class="title_deg">{{ $post->title }}</h4>
                <div class="meta-info">
                  Posted by <b>{{ $post->name }}</b>
                  <span style="margin: 0 10px;">|</span>
                  <i class="fas fa-eye"></i> {{ $post->views }} views
                </div>
                    <div class="btn_main mt-auto">
                    <a href="{{ url('read_post', $post->id) }}" class="btn btn-read mt-3 read-more-btn" data-id="{{ $post->id }}">Read More</a>
                    </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    @include('admin.footer')

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const readButtons = document.querySelectorAll('.read-more-btn');

        readButtons.forEach(btn => {
            btn.addEventListener('click', function (e) {
                const postId = this.getAttribute('data-id');

                // Send AJAX request to increment view
                fetch(`/admin/increment-view/${postId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({})
                });
            });
        });
    });
</script>

  </body>
</html>
