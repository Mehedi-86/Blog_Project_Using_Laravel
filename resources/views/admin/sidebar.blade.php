<nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">

         <div class="avatar"><img src="{{ asset('admincss/img/myPhoto.jpeg') }}" alt="User Avatar" class="img-fluid rounded-circle"></div>
               
          <div class="title">
            <h1 class="h5">Mehedi Hasan</h1>
            <p>Web Designer</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="active"><a href="{{ route('home') }}"> <i class="icon-home"></i>Home </a></li>
                <li><a href="{{ url('/admin_profile') }}"> <i class="fa fa-user"></i>Profile</a></li>
                <li><a href="{{ url('/all_posts') }}"> <i class="fa fa-list"></i>All Posts </a></li>
                <li><a href="{{url('post_page')}}"> <i class="icon-grid"></i>Add Post </a></li>
                <li><a href="{{url('/show_post')}}"> <i class="fa fa-bar-chart"></i>Show Post </a></li>
                <li><a href="{{url('admin_post')}}"> <i class="icon-padnote"></i>Admin Post </a></li>
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Example dropdown </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                  </ul>
                </li>
        </ul><span class="heading">Extras</span>
        <ul class="list-unstyled">
          <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
        </ul>
      </nav>