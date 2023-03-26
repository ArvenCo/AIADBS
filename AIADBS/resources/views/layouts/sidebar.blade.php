
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link" style="text-decoration:none;">
    <img src="../../dist/img/logo/SMCC.png" alt="AdminLTE Logo" class="brand-image " style="opacity: .8">
    <span class="brand-text font-weight-light" >{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="../../dist/img/logo/profile.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block" style="text-decoration:none;">{{Auth::user()->name}}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
            @php
              $uri = Request::route()->uri();
            @endphp
        
        @if(Auth::user()->role == 'admin')
          <li class="nav-item">
            <a href="/departments"  class="nav-link ">
              <i class="nav-icon fas fa-school"></i>
              <p>
                Department
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="/register-user" class="nav-link ">
              <i class="nav-icon fas fa-chalkboard-teacher    "></i>
              <p>
                Instructor
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
          </li>
          
        @else
        <li class="nav-item">
            <a href="{{ ($uri =='test') ? '' : '/test' }}" class="nav-link {{ ($uri == 'test')||($uri == 'test/create')||($uri == 'test/{id}')||($uri == 'test/show/{id}')  ? 'active' : '' }}">
                <i class="nav-icon fas fa-pencil-alt"></i>
                <p>
                    Test
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/analysis_list" class="nav-link {{ (request()->is('analysis_list')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                    Analysis
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/databank" class="nav-link {{ (request()->is('databank')) ? 'active' : '' }}">
              <i class="fas fa-database"></i>
                <p>
                    Test Bank
                </p>
            </a>
        </li>
        <!-- -->
        @endif
        

        
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
