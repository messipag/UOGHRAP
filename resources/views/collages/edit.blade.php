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
                            <h1 class="m-0"><i class="fas fa-edit"></i> Colleges</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @can('dashboard')
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">
                                            <i class="fas fa-home"></i> Home</a></li>
                                @endcan
                                <li class="breadcrumb-item active">Edit College</li>
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
                                    <h3 class="card-title">Edit <b>{{ $collage->collage_name }}</b> Collage </h3>
                                    <span class="float-right">

                                        <a class="btn btn-primary btn-sm" href="{{ route('collages.index') }}">
                                            <i class="fas fa-arrow-circle-left"></i> Back
                                        </a>
                                    </span>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    {!! Form::model($collage, ['route' => ['collages.update', $collage->id], 'method' => 'PATCH']) !!}
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        {!! Form::text('collage_name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
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
        </div>
    </div>
@endsection
