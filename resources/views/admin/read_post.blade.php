<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style type="text/css">
      .title_deg {
          font-size: 28px;
          font-weight: bold;
          color: white;
          padding: 30px;
          text-align: center;
      }
      .post_container {
            background-color: #2c2f33;
            color: #ccc;
            padding: 40px 20px; /* Reduced left and right padding */
            border-radius: 10px;
            margin: 30px auto;
            max-width: 1100px; /* Increased width for a larger appearance */
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

      .img_deg {
          display: block;
          margin: 0 auto 30px;
          max-width: 100%;
          height: auto;
          border-radius: 10px;
      }
      .desc_deg {
          font-size: 18px;
          line-height: 1.8;
          white-space: pre-wrap;
      }

      .post-meta-centered {
            text-align: center;
            color: white;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .post-title {
    font-size: 32px; /* Increased size */
    font-weight: 800; /* Extra bold */
    color: white;
    text-align: center;
    margin-bottom: 1.5rem;
}

    </style>
  </head>

  <body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
      @include('admin.sidebar')

      <div class="page-content container">
        <h1 class="title_deg">Post Details</h1>

        <div class="post_container">
          <!-- Inside .post_container -->
            <h2 class="post-title">{{ $post->title }}</h2>

            <img src="{{ asset('postimage/' . $post->image) }}" class="img_deg" alt="Post Image">

            <p class="post-meta-centered">
            Post by <b>{{ $post->name }}</b>
            <span style="margin: 0 30px;">|</span>
            <span><i class="fas fa-eye me-2"></i>{{ $post->views }} views</span>
            </p>

            <div class="desc_deg">
            {!! $post->description !!}
            </div>

          <div class="mt-4 text-muted text-right">
            <small>Posted by: {{ $post->name }}</small><br>
            <small>Created at: {{ $post->created_at }}</small>
          </div>
        </div>
      </div>
    </div>

    @include('admin.footer')
  </body>
</html>
