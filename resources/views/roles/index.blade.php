@extends('layouts.master')
@section('content')
    
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
@can('role-list')
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
                      <li class="breadcrumb-item active">Role List</li>
                </ol>
              </div><!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Role List</h3>
                    <span class="float-right">
                        @can('user-list')
                        <a href="{{ route('users.index') }}" class="btn btn-default btn-sm ">
                            <i class="fas fa-users nav-icon"></i> Users Lis</a>
                        @endcan
                        @can('permission-list')
                            <a href="{{ route('permissions.index') }}" class="btn btn-default btn-sm">
                                <i class="fas fa-puzzle-piece nav-icon"></i> Permissions</a>
                        @endcan
                        @can('role-create')
                                <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">
                                    <i class="fas fa-user-tag"></i> New Role</a> 
                        @endcan
                    </span>
              </div>
              <!-- /.card-header -->
              <div class="card-body"> 
                <table class="table table-bordered  table-hover" id="index_datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Guard Name</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->guard_name }}</td>
                                <td>
                                  <div class="btn-group">
                                    
                                    @can('role-edit')
                                        <a class="btn btn-primary  btn-sm mr-1 mb-0" href="{{ route('roles.edit',$role->id) }}"><i class="fas fa-edit"></i></a>
                                    @endcan
                                    @can('role-show')
                                      <a class="btn btn-success  btn-sm mr-1 mb-0" href="{{ route('roles.show',$role->id) }}"><i class="fas fa-eye"></i></a>
                                    @endcan
                                    @can('role-delete')
                                    <form action="{{ route('roles.destroy', $role->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger  btn-sm " type="submit" onclick="return confirm('Are you sure you went to delete?')"><i class="fa fa-trash"></i></button>
                                    </form> 
                                    @endcan
                                  </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $data->render() }} --}}
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
  