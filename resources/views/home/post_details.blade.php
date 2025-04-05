<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
       <base href="/public">
      @include('home.homecss')

   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         
       @include('home.header')

        
      </div>
      <!-- header section end -->

     
    <div class="row justify-content-center">
      <div class="col-md-4 text-center">
        <div>
            <img style="padding: 20px" src="/postimage/{{$post->image}}" class="services_img" style="width: 100%; height: 200px; object-fit: cover;">
        </div>
        <h4 style="font-size: 1.5rem; font-weight: bold;">{{$post->title}}</h4>
        <h4>{{$post->description}}</h4>
        <p>Post by <b>{{$post->name}}</b></p>
      </div>
    </div>





      <!-- footer section start -->
       @include('home.footer')
      </body>
</html>