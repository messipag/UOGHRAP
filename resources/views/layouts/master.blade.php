<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> {{ config('app.name', 'UOGHRAP') }} </title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('vendor/plugins/fontawesome-free/css/all.min.css') }} ">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('vendor/dist/css/adminlte.min.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}">  --}}
  
  <link rel="stylesheet" href="{{ asset('vendor/dist/css/dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/dist/css/buttons.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/dist/css/bootstrap4.min.css') }}">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  
{{-- ////////////////////////////////////////////////// --}}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

{{-- ///////////////////////////////////////////////// --}}
{{-- @toastr_css --}}
 </head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif
        {{-- @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif --}}
    @else
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        {{-- <a href="{{ route('contact.index') }}" class="nav-link">Contact</a> --}}
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->

	  <li class="nav-foot">
           
          {{-- <div class="pull-right"> --}}
            <a href="{{ route('logout') }}" class="btn btn-danger btn-sm m-2"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
           <i class="fas fa-power-off"></i> Sign Out</a>
            
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
          {{-- </div> --}}
       </li>
 
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('vendor/dist/img/logo.png') }}" alt="School Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">UOGHRAP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('vendor/dist/img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
{{-- ///////////////////////////////////////////////////////////////////////////////// --}}
          @can('dashboard')
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard 
              </p>
            </a>
          </li>
          @endcan
{{-- ///////////////////////////////////////////////////////////////////////////////// --}}
          <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-key"></i>
                <p>
                  User Management 
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('user-list')
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-users nav-icon"></i>
                    <p>Users</p>
                  </a>
                </li>
                @endcan
                @can('role-list')
                <li class="nav-item">
                  <a href="{{ route('roles.index') }}" class="nav-link">
                    <i class="fas fa-user-tag nav-icon"></i>
                    <p>Roles</p>
                  </a>
                </li>
                @endcan
                @can('permission-list')
                <li class="nav-item">
                  <a href="{{ route('permissions.index') }}" class="nav-link">
                    <i class="fas fa-shield-alt nav-icon"></i>
                    <p>Permissions</p>
                  </a>
                </li>
                @endcan
              </ul>
            </li>    
{{-- ///////////////////////////////////////////////////////////////////////////////// --}}
{{-- ///////////////////////////////////////////////////////////////////////////////// --}}
<li class="nav-item">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-cogs"></i>
    <p>
      Configuration 
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    @can('user-list')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('users.index') }}">
        <i class="fas fa-layer-group nav-icon"></i>
        <p>Category</p>
      </a>
    </li>
    @endcan
    @can('role-list')
    <li class="nav-item">
      <a href="{{ route('roles.index') }}" class="nav-link">
        <i class="fas fa-user-tag nav-icon"></i>
        <p>Roles</p>
      </a>
    </li>
    @endcan
    @can('permission-list')
    <li class="nav-item">
      <a href="{{ route('permissions.index') }}" class="nav-link">
        <i class="fas fa-shield-alt nav-icon"></i>
        <p>Permissions</p>
      </a>
    </li>
    @endcan
  </ul>
</li>    
{{-- ///////////////////////////////////////////////////////////////////////////////// --}}
      </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <main class="py-1">
    @yield('content')
 </main>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Developer: Developers
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy;</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
</body>
<!-- REQUIRED SCRIPTS -->
 {{-- <script src="{{ asset('js/app.js') }}"></script>  --}}
<!-- jQuery -->

<script src="{{ asset('vendor/dist/js/jquery-3.5.1.js') }}"></script>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  --}}
{{-- <script src="{{ asset('vendor/plugins/jquery/jquery.min.js') }}"></script> --}}
<!-- Bootstrap 4 -->
<script src="{{ asset('vendor/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('vendor/dist/js/adminlte.min.js') }}"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  --}}
<script src="{{ asset('vendor/dist/js/jquery.validate.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
<script src="{{ asset('vendor/dist/js/bootstrap.min.js') }}"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
<script src="{{ asset('vendor/dist/js/jquery.dataTables.min.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}
<script src="{{ asset('vendor/dist/js/dataTables.bootstrap4.min.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  --}}
<script src="{{ asset('vendor/dist/js/dataTables.buttons.min.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script> --}}
<script src="{{ asset('vendor/dist/js/jszip.min.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> --}}
<script src="{{ asset('vendor/dist/js/pdfmake.min.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> --}}
<script src="{{ asset('vendor/dist/js/vfs_fonts.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> --}}
<script src="{{ asset('vendor/dist/js/buttons.html5.min.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>  --}}
<script src="{{ asset('vendor/dist/js/sweetalert.min.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> --}}

 
{{-- ///////////////////////////////////////////////////////////////////////////////////////////////////// --}}
@stack('scripts')
{{-- @jquery --}}
{{-- @toastr_js
@toastr_render  --}}
  
<script>
$(document).ready(function() {
    $('#index_datatable').DataTable( {
      dom: 'Bfrtip',
          buttons: [
          
            {
                extend:    'copyHtml5',
                text:      '<i class="fas fa-copy"></i> Copy',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="far fa-file-excel"></i> Excel',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fas fa-file-csv"></i> CSV',
                titleAttr: 'CSV'
            }, 
          
      ],
       // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );
});
</script>
<script>
  $(document).ready(function() {
      $('#index_datatable2').DataTable( {
      } );
  });
  </script>
 
@endguest 
</html>
