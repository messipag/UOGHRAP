@extends('layouts.master')

@section('content')
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0"><i class="fas fa-university"></i> Colleges</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    @can('dashboard')
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">
                                                <i class="fas fa-home"></i> Home</a></li>
                                    @endcan
                                    <li class="breadcrumb-item active">College list</li>
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
                                        <h3 class="card-title">College List</h3>
                                        <span class="float-right">
                                            <a class="btn btn-primary btn-sm" href="{{ route('collages.create') }}">
                                                <i class="fas fa-university"></i> New College</a>
                                        </span>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered  table-hover" id="index_datatable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Created by</th>
                                                    <th>Updated by</th>
                                                    <th width="280px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($collages as $key => $collage)
                                                    <tr>
                                                        <td>{{ $collage->id }}</td>
                                                        <td>{{ $collage->collage_name }}</td>
                                                        <td>{{ $collage->created_by }}</td>
                                                        <td>{{ $collage->updated_by }}</td>
                                                        <td>
                                                            <div class="btn-group">


                                                                <a class="btn btn-primary  btn-sm mr-1 mb-0"
                                                                    href="{{ route('collages.edit', $collage->id) }}"><i
                                                                        class="fas fa-edit"></i></a>

                                                                <a class="btn btn-success  btn-sm mr-1 mb-0"
                                                                    href="{{ route('collages.show', $collage->id) }}"><i
                                                                        class="fas fa-eye"></i></a>

                                                                <form action="{{ route('collages.destroy', $collage->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-danger  btn-sm " type="submit"
                                                                        onclick="return confirm('Are you sure you went to delete?')"><i
                                                                            class="fa fa-trash"></i></button>
                                                                </form>
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
            </div>
        </div>
    @endsection
