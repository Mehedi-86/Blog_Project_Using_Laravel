<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.homecss')
</head>
<body>
    <div class="header_section">
        @include('home.header')
    </div>

    @yield('content')

    @include('home.footer')
</body>
</html>
