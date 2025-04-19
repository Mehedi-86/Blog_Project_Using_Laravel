<div class="header_main">
            <div class="mobile_menu">
               <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <div class="logo_mobile"><a href="index.html"><img src="images/logo.png"></a></div>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                     <ul class="navbar-nav">
                        <li class="nav-item">
                           <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="about.html">About</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="services.html">Services</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link " href="blog.html">Blog</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link " href="contact.html">Contact</a>
                        </li>
                     </ul>
                  </div>
               </nav>
            </div>
            <div class="container-fluid">
            <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a></div>
               <div class="menu_main">
                  <ul>
                    <li>
                     @auth
                     <a href="{{ route('home') }}">Home</a>
                     @else
                     <a href="{{ route('homepage') }}">Home</a>
                     @endauth
                     </li>

                     <li><a href="{{ route('about.page') }}">About</a></li>                    
                     <li><a href="{{ route('blog.page') }}">Blog</a></li>


                     @if (Route::has('login'))
                     @auth
                     
                    <li> <x-app-layout> </x-app-layout> </li>

                    <li><a href="{{ route('user.profile', Auth::id()) }}">My Profile</a></li>
                    
                    <li><a href="{{url('my_post')}}">My Post</a></li>
    
                    <li><a href="{{url('create_post')}}">Create Post</a></li>
                     @else
                     
                     <li><a href="{{route('login')}}">login</a></li>
                     <li><a href="{{route('register')}}">Register</a></li>
                     
                     @endauth
                     @endif

                  </ul>
               </div>
            </div>
         </div>