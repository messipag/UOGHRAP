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

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Show <b>{{ $department->department_name }}</b> Detail</h3>
                                    <span class="float-right">


                                        <a class="btn btn-primary btn-sm" href="{{ route('departments.index') }}">
                                            <i class="fas fa-arrow-circle-left"></i> Back
                                        </a>
                                    </span>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="lead">
                                        <strong>Department Name:</strong>
                                        {{ $department->department_name }}
                                    </div>
                                    <div class="lead">
                                        <strong>College Name:</strong>
                                        {{ $collage_name }}
                                    </div>
                                    <div class="lead">
                                        <strong>Created at:</strong>
                                        {{ $department->created_at }}
                                    </div>
                                    <div class="lead">
                                        <strong>Updated at:</strong>
                                        {{ $department->updated_at }}
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
