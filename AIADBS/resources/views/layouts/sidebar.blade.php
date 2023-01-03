
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
        <img src="../../dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
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

        <li class="nav-item">
            <a href="{{ (request()->is('test')) ? '' : '/test' }}" class="nav-link {{ (request()->is('test')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-solid fa-user"></i>
                <p>
                    Test
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/analysis" class="nav-link {{ (request()->is('analysis')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-images"></i>
                <p>
                    Analysis
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/attendance" class="nav-link {{ (request()->is('attendance')) ? 'active' : '' }}">
                <i class="nav-icon fas fa-clock"></i>
                <p>
                    Time In
                </p>
            </a>
        </li>
        <!-- Gate  w/Dropdown-->
        @php
            $gatePage = (request()->is('gate/register')) || (request()->is('gate/lists')) ? true : false;
        @endphp
        <li class="nav-item {{ $gatePage ? 'menu-is-open menu-open' : '' }}">
            <a href="#" class="nav-link {{ $gatePage ? 'active' : '' }}">
              <i class="nav-icon fa-solid fa-person-military-pointing"></i>
              <p>
                Gates
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/gate/lists" class="nav-link {{ (request()->is('gate/lists')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gate Lists</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/gate/register" class="nav-link {{ (request()->is('gate/register')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Register Gate</p>
                    </a>
                </li>
              
            </ul>
        </li>

        @php
            $page = (request()->is('sms/sent_messages')) || (request()->is('sms/inbox')) ? true : false;
        @endphp
        <li class="nav-item {{ $page ? 'menu-is-open menu-open' : '' }}">
            <a href="#" class="nav-link {{ $page ? 'active' : '' }}">
              <i class="nav-icon fas fa-message"></i>
              <p>
                SMS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/sms/inbox" class="nav-link {{ (request()->is('sms/inbox')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Inbox</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/sms/sent_messages" class="nav-link {{ (request()->is('sms/sent_messages')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sent Messages</p>
                    </a>
                </li>
                
            </ul>
        </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
