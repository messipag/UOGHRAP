@extends('layouts.master')

@section('content')
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0"> <i class="fas fa-microscope"></i>
                                    </i> Fields of study</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    @can('dashboard')
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">
                                                <i class="fas fa-home"></i> Home</a></li>
                                    @endcan
                                    <li class="breadcrumb-item active">Field of study list</li>
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
                                        <h3 class="card-title">Field of study List</h3>
                                        <span class="float-right">
                                            <a class="btn btn-primary btn-sm" href="{{ route('fields.create') }}">
                                                <i class="fas fa-microscope"></i>
                                                New Field of study</a>
                                        </span>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered  table-hover" id="index_datatable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Field of study</th>
                                                    <th>Department Name</th>
                                                    <th width="280px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($fields as $key => $field)
                                                    <tr>
                                                        <td>{{ $field->id }}</td>
                                                        <td>{{ $field->field_of_study }}</td>

                                                        @foreach ($deps as $dep)
                                                            @if ($dep->id == $field->dep_id)
                                                                <td>{{ $dep->department_name }}</td>
                                                            @endif
                                                        @endforeach
                                                        <td>
                                                            <div class="btn-group">


                                                                <a class="btn btn-primary  btn-sm mr-1 mb-0"
                                                                    href="{{ route('fields.edit', $field->id) }}"><i
                                                                        class="fas fa-edit"></i></a>

                                                                <a class="btn btn-success  btn-sm mr-1 mb-0"
                                                                    href="{{ route('fields.show', $field->id) }}"><i
                                                                        class="fas fa-eye"></i></a>

                                                                <form action="{{ route('fields.destroy', $field->id) }}"
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
