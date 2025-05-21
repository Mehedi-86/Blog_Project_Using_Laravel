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
                           @auth
                                 <a class="nav-link" href="{{ route('home') }}">
                                    <i class="fas fa-house-user me-2"></i> Home
                                 </a>
                           @else
                                 <a class="nav-link" href="{{ route('homepage') }}">
                                    <i class="fas fa-home me-2"></i> Home
                                 </a>
                           @endauth
                        </li>

                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('about.page') }}">
                                 <i class="fas fa-info-circle me-2"></i> About
                           </a>
                        </li>

                        @if (Route::has('login'))
                           @auth
                                 <li><x-app-layout></x-app-layout></li>

                                 <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('user.profile', Auth::id()) }}">
                                       <i class="fas fa-user-circle me-2"></i> My Profile
                                    </a>
                                 </li>

                                 <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ url('my_post') }}">
                                       <i class="fas fa-file-alt me-2"></i> My Post
                                    </a>
                                 </li>

                                 <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ url('create_post') }}">
                                       <i class="fas fa-plus-circle me-2"></i> Create Post
                                    </a>
                                 </li>
                           @else
                                 {{-- For guests --}}
                                 <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">
                                       <i class="fas fa-sign-in-alt me-2"></i> Login
                                    </a>
                                 </li>

                                 <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">
                                       <i class="fas fa-user-plus me-2"></i> Register
                                    </a>
                                 </li>
                           @endauth
                        @endif
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
                     <a href="{{ route('home') }}"><i class="fas fa-house-user me-2"></i>Home</a>
                     @else
                     <a href="{{ route('homepage') }}"><i class="fas fa-house-user me-2"></i>Home</a>
                     @endauth
                     </li>

                     <li><a href="{{ route('about.page') }}"><i class="fas fa-info-circle me-2"></i>About</a></li>                    
         
                     @if (Route::has('login'))
                     @auth
                     
                    <li> <x-app-layout> </x-app-layout> </li>

                    <li><a href="{{ route('user.profile', Auth::id()) }}"><i class="fas fa-user-circle me-2"></i>My Profile</a></li>
                    
                    <li><a href="{{url('my_post')}}"><i class="fas fa-file-alt me-2"></i>My Post</a></li>
    
                    <li><a href="{{url('create_post')}}"><i class="fas fa-plus-circle me-2"></i>Create Post</a></li>
                     @else
                     
                     <li><a href="{{route('login')}}"><i class="fas fa-sign-in-alt me-2"></i>login</a></li>
                     <li><a href="{{route('register')}}"><i class="fas fa-user-plus me-2"></i>Register</a></li>
                     
                     @endauth
                     @endif

                  </ul>
               </div>
            </div>
         </div>