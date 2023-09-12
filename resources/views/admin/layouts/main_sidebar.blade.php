 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
         <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">AdminLTE 3</span>
     </a>
     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ asset('images/v3.png') }}" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">Name
                     {{-- {{ auth()->user()->name }} --}}
                 </a>
             </div>
         </div>
         <!-- SidebarSearch Form -->
         <div class="form-inline">
             <div class="input-group" data-widget="sidebar-search">
                 <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                     aria-label="Search">
                 <div class="input-group-append">
                     <button class="btn btn-sidebar">
                         <i class="fas fa-search fa-fw"></i>
                     </button>
                 </div>
             </div>
         </div>
         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                 {{-- <li class="nav-item">
            <a href="{{ route('change-passwords.edit' , auth()->user()->id ) }}" class="nav-link">
                 <i class="fa-solid fa-key"></i>
              <p>
                change Password
              </p>
            </a>
          </li> --}}


             <li class="nav-item">
            <a href="{{ route('admin.index') }}" class="nav-link">
                 <i class="fa-home fa-key"></i>
              <p>
              Home
              </p>
            </a>
          </li>


                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="fa-solid fa-users-gear"></i>
                         <p>
                             Admins
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>

                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ route('admins.create') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Add Admin</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('admins.index') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>
                                     Manage Users
                                 </p>
                             </a>
                         </li>
                 </li>
             </ul>


             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="fa-solid fa-users-gear"></i>
                     <p>
                         Posts
                         <i class="fas fa-angle-left right"></i>
                     </p>
                 </a>

                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="{{ route('admin_posts.create') }}" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Add post</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('admin_posts.index') }}" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>
                                 Manage Posts
                             </p>
                         </a>
                     </li>
             </li>
             </ul>

             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="fa-solid fa-users-gear"></i>
                     <p>
                         Reports
                         <i class="fas fa-angle-left right"></i>
                     </p>
                 </a>

                 <ul class="nav nav-treeview">
                     <li class="nav-item">
                         <a href="{{ route('admin_reports.create') }}" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>Add Report</p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('admin_reports.index') }}" class="nav-link">
                             <i class="far fa-circle nav-icon"></i>
                             <p>
                                 Manage Reports
                             </p>
                         </a>
                     </li>
             </li>
             </ul>

             <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-users-gear"></i>
                    <p>
                        Users
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Manage users
                            </p>
                        </a>
                    </li>
                </ul>
            </li>


             <li class="nav-item">
                 <a href="{{ route('admin.logout') }}" class="nav-link">
                     <i class="fa-solid fa-right-from-bracket"></i>
                     <p>
                         Logout
                     </p>
                 </a>
             </li>
             </ul>
         </nav>
     </div>
 </aside>
