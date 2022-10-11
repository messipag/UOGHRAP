@extends('layouts.master')
@section('content')
 
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
@can('permission-list')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-puzzle-piece"></i> Permissions</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  @can('dashboard')<li class="breadcrumb-item"><a href="{{ route('home') }}">
                      <i class="fas fa-home"></i> Home</a></li>@endcan
                      <li class="breadcrumb-item active">Permissions List</li>
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
                <h3 class="card-title">Permissions List</h3>
            
                    <span class="float-right">
                        @can('user-list')
                        <a href="{{ route('users.index') }}" class="btn btn-default btn-sm ">
                            <i class="fas fa-users nav-icon"></i> Users Lis</a>
                        @endcan
                        @can('role-list')
                        <a href="{{ route('roles.index') }}" class="btn btn-default btn-sm ">
                            <i class="fas fa-user-tag nav-icon"></i> Roles</a>
                        @endcan
                        @can('permission-create')
                                <a class="btn btn-primary btn-sm" href="{{ route('permissions.create') }}">
                                    <i class="fas fa-puzzle-piece"></i> New Permission</a> 
                        @endcan
                    </span>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
 
                    <table id="index_datatable" class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                      <div class="btn-group">
                                          @can('permission-edit')
                                              <a class="btn btn-primary btn-sm mr-1 mb-0" href="{{ route('permissions.edit',$permission->id) }}"><i class="fas fa-edit"></i></a>
                                          @endcan
                                          @can('permission-show')
                                          <a class="btn btn-success btn-sm mr-1 mb-0" href="{{ route('permissions.show',$permission->id) }}"><i class="fas fa-eye"></i></a>
                                          @endcan
                                          @can('permission-delete') 
                                          <form action="{{ route('permissions.destroy', $permission->id)}}" method="POST">
                                              @csrf
                                              @method('DELETE')
                                              <button class="btn btn-danger  btn-sm" type="submit" onclick="return confirm('Are you sure you went to delete?')"><i class="fa fa-trash"></i></button>
                                          </form>  
                                          @endcan
                                      </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $data->appends($_GET)->links() }} --}}
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
