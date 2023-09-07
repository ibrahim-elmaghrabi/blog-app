<!DOCTYPE html>
<html lang="en">
@include('front.layout.head')

<body>
    @include('front.layout.nav')
    <!-- Page content-->
    <div class="container">
        @yield('content')
    </div>

    @include('front.layout.footer')
