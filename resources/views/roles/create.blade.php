@extends('layouts.master')
@section('content')
 
    
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
@can('role-create')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-user-tag"></i> Roles</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  @can('dashboard')<li class="breadcrumb-item"><a href="{{ route('home') }}">
                      <i class="fas fa-home"></i> Home</a></li>@endcan
                      <li class="breadcrumb-item active">Role Create</li>
                </ol>
              </div><!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      @if (count($errors) > 0)
        <div class="card-body">
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Error Message!</h5>
            <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
            <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
          </div>
        </div>
      @endif
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Role Create</h3>
                <span class="float-right"> 
                    @can('permission-list')
                        <a href="{{ route('permissions.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-puzzle-piece nav-icon"></i> Permissions</a>
                    @endcan
                    @can('user-list')
                        <a class="btn btn-default btn-sm" href="{{ route('users.index') }}">
                            <i class="fas fa-users"></i> Users List</a>
                    @endcan 
                    @can('role-list')
                        <a class="btn btn-primary btn-sm" href="{{ route('roles.index') }}">
                            <i class="fas fa-arrow-circle-left"></i> Back
                        </a>
                    @endcan
                </span> 
              </div>
              <!-- /.card-header -->
              <div class="card-body"> 
                {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>Permissions:</strong>
                    <br/>
                    <div class="row">
                      @foreach($permission as $value)
                        <div class="col-md-3">
                          <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                          {{ $value->name }}</label>
                        </div>
                      @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            {!! Form::close() !!} 
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
  