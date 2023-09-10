 <!-- Responsive navbar-->
 <nav class="navbar navbar-expand-lg">
     <div class="container">
         <a class="navbar-brand" href="#!">Start Bootstrap</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
             aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                 class="navbar-toggler-icon"></span></button>
         <div
             class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
             <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                 <div class="container">
                     <a class="navbar-brand" href="{{ url('/') }}">
                         {{ config('app.name', 'Laravel') }}
                     </a>
                     <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                         data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                         aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                         <span class="navbar-toggler-icon"></span>
                     </button>

                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                         <!-- Left Side Of Navbar -->
                         <ul class="navbar-nav me-auto">

                         </ul>

                         <!-- Right Side Of Navbar -->
                         <ul class="navbar-nav ms-auto">
                             <!-- Authentication Links -->
                             @guest
                                 @if (Route::has('login'))
                                     <li class="nav-item">
                                         <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                     </li>
                                 @endif

                                 @if (Route::has('register'))
                                     <li class="nav-item">
                                         <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                     </li>
                                 @endif
                             @else
                                 <li class="nav-item dropdown">
                                     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                         data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                         {{ Auth::user()->name }}
                                     </a>

                                     <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                         <a class="dropdown-item" href="#"
                                             onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                             {{ __('Logout') }}
                                         </a>
                                         @if (Auth::guard('admin')->check())
                                             <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                                 class="d-none">
                                                 @csrf
                                             </form>

                                         @else
                                             <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                                                 class="d-none">
                                                 @csrf
                                             </form>
                                         @endif
                                     </div>
                                 </li>
                             @endguest
                         </ul>
                     </div>
                 </div>
             </nav>
         </div>
     </div>
     </div>
 </nav>



 <!-- Page header with logo and tagline-->
 <header class="py-5 bg-light border-bottom mb-4">
     <div class="container">
         <div class="text-center my-5">
             <h1 class="fw-bolder">Welcome to Blog Home!</h1>
             <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
         </div>
     </div>
 </header>
