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
                <li class="admin-home"><a href="{{ route('admin.home') }}"><i class="icon-home"></i> Home</a></li>
                <li><a href="{{ route('switch.user.home') }}"><i class="fas fa-random me-1"></i> Switch Dashboard</a></li>
                <li><a href="{{url('/show_post')}}"> <i class="fa fa-bar-chart"></i>Show Post </a></li>
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