@extends('layouts.master')
@section('content')
 
    
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
@can('user-show')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-eye"></i> Users</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @can('dashboard')<li class="breadcrumb-item"><a href="{{ route('home') }}">
                        <i class="fas fa-home"></i> Home</a></li>@endcan
                  <li class="breadcrumb-item active">Users Show</li>
                </ol>
              </div><!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
 
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Show <b> {{ $user->name }}  </b> Detail </h3>
                    <span class="float-right">
                        @can('role-list')
                        <a href="{{ route('roles.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-user-tag nav-icon"></i> Roles</a>
                        @endcan
                        @can('permission-list')
                            <a href="{{ route('permissions.index') }}" class="btn btn-default btn-sm">
                                <i class="fas fa-puzzle-piece nav-icon"></i> Permissions</a>
                        @endcan 
                        @can('user-list')
                            <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">
                                <i class="fas fa-arrow-circle-left"></i> Back
                            </a>
                        @endcan
                    </span> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
 
                <div class="lead">
                    <strong>Name:</strong>
                     {{ $user->name }}  
                </div>
                <div class="lead">
                    <strong>Email:</strong>
                    {{ $user->email }} 
                </div>
                <div class="lead">
                    <strong>Password:</strong>
                    ********
                </div>
                    
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 @endcan
  </div>
</div>
@endsection
