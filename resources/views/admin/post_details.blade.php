<!DOCTYPE html>
<html lang="en">
<head> 
  @include('admin.css')
  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .post-details-container {
      width: 100%;
      max-width: 1200px;
      margin: 0px auto;
      background-color: #ffffff;
      border-radius: 18px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      padding: 50px 40px;
      overflow: hidden;
    }

    .post-details-image {
      display: block;
      max-width: 600px;
      max-height: 350px;
      width: 100%;
      height: auto;
      object-fit: cover;
      border-radius: 14px;
      margin: 0 auto 100px;
      border: 2px solid #e0e0e0;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      transition: transform 0.3s ease;
    }

    .post-details-image:hover {
      transform: scale(1.02);
    }

    .desc_content {
      font-size: 18px;
      line-height: 1.8;
      color: #2e2e2e;
      text-align: justify;
      padding: 0 10px;
      margin: 0 auto;
      max-width: 92%;
    }

    .desc_content h1, .desc_content h2, .desc_content h3,
    .desc_content h4, .desc_content h5, .desc_content h6 {
      color: #3F51B5;
      margin-top: 1.5rem;
      margin-bottom: 0.5rem;
    }

    .desc_content h1 { font-size: 1.5em; }
    .desc_content h2 { font-size: 1.4em; }
    .desc_content h3 { font-size: 1.3em; }
    .desc_content h4 { font-size: 1.2em; }
    .desc_content h5 { font-size: 1.1em; }
    .desc_content h6 { font-size: 1em; }

    .desc_content p {
      margin-bottom: 1.2rem;
    }

    .no-description {
      color: #999;
      font-style: italic;
      font-size: 16px;
      text-align: center;
      display: block;
      margin-top: 20px;
    }

    @media (max-width: 768px) {
      .post-details-container {
        padding: 30px 20px;
      }

      .post-title {
        font-size: 26px;
      }

      .desc_content {
        font-size: 16px;
      }
    }

    .post-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 40px;
    }

    .back-button {
    font-size: 20px;
    color: #4A148C;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
    flex: 0 0 auto;
    margin-bottom: 10px;
    }

    .back-button:hover {
    color: #311B92;
    }

    .post-title {
    font-size: 32px;
    font-weight: 700;
    color: #4A148C;
    text-align: center;
    flex: 1;
    margin-bottom: 10px;
    padding-bottom: 10px;
    position: relative;
    border-bottom: none;
    }

    .post-title::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 2%;
    right: -2%;
    border-bottom: 2px solid #ccc;
    }


    .spacer {
    width: 80px; /* adjust width to balance the space */
    flex: 0 0 auto;
    }

  </style>
</head>

<body>
  @include('admin.header')

  <div class="d-flex align-items-stretch">
    @include('admin.sidebar')

    <div class="page-content">
      <div class="post-details-container">
        <div class="post-header">
            <a href="{{ url()->previous() }}" class="back-button"><i class="fas fa-arrow-left"></i></a>
            <div class="post-title">{{ $post->title }}</div>
            <div class="spacer"></div>
        </div>


        @if($post->image)
          <img src="{{ asset('postimage/' . $post->image) }}" alt="Post Image" class="post-details-image">
        @endif

        <div class="desc_content">
          @if($post->description)
            {!! $post->description !!}
          @else
            <span class="no-description">No description provided for this post.</span>
          @endif
        </div>
      </div>
    </div>
  </div>

  @include('admin.footer')  
</body>
</html>
