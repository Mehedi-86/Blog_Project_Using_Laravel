      <!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      @include('home.homecss')

   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         
       @include('home.header')

         <!-- banner section start -->
         

         <!-- banner section end -->
      </div>
      <!-- header section end -->



      <!-- services section start -->
      
       

      <!-- services section end -->

      <!-- about section start -->
     <div class="about_section layout_padding">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-6">
                  <div class="about_taital_main">
                     <h1 class="about_taital">About Project</h1>
                     <p class="about_text">A Laravel-based social blogging platform where users can create posts, connect with others, and manage their profiles. It features customizable social links, secure authentication, and admin controls, combining usability, responsive design, and community interaction in one seamless experience. </p>
                     <div class="readmore_bt"><a href="#">Read More</a></div>
                  </div>
               </div>
               <div class="col-md-6 padding_right_0">
                  <div><img src="images/about-img1.jpg" class="about_img"></div>
               </div>
            </div>
         </div>
      </div>
      <!-- about section end -->
     
     
      <!-- footer section start -->
       @include('home.footer')
      </body>
</html>