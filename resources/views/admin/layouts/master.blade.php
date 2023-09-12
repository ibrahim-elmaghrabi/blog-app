<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bloodbank</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/Icon.png') }}">

    @include('admin.layouts.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        @include('admin.layouts.main_headbar')


        @include('admin.layouts.main_sidebar')

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">@yield('pageName')</a></li>
                                <li class="breadcrumb-item active">@yield('main-pageName')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')

        </div>

        @include('admin.layouts.footer')

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    @include('admin.layouts.footer_scripts')
</body>

</html>
