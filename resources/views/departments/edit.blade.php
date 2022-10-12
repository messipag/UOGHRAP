@extends('layouts.master')
@section('content')


    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><i class="fas fa-book"></i> Departments</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @can('dashboard')
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">
                                            <i class="fas fa-home"></i> Home</a></li>
                                @endcan
                                <li class="breadcrumb-item active">Edit Department</li>
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
                                    <h3 class="card-title">Edit <b>{{ $department->department_name }}</b> Department </h3>
                                    <span class="float-right">

                                        <a class="btn btn-primary btn-sm" href="{{ route('departments.index') }}">
                                            <i class="fas fa-arrow-circle-left"></i> Back
                                        </a>
                                    </span>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form action="{{ route('departments.update', $department->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <div class="form-group">
                                            <strong>College:</strong>
                                            <select name="collage_id" class="form-control">
                                                @foreach ($collages as $col)
                                                    <option {{ $col->id == $collage_id ? 'selected' : '' }}
                                                        value="{{ $col->id }}">{{ $col->collage_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <strong>Name:</strong>
                                            <input type="text" class="form-control" placeholder="name"
                                                name="department_name" value="{{ $department->department_name }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
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
        </div>
    </div>
@endsection
