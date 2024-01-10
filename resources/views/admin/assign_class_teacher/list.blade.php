@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-american-sign-language-interpreting    "></i> Clases</h1>
                    </div>
                    <div class="col-sm-6" style="text-align:right">
                        <a href="{{ url('admin/assign_class_teacher/add') }}" class="btn btn-primary">Asignar Clases</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">
                        <!-- /.row -->
                        @include('_message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b> Listado de
                                        {{--  Asignaturas (Total: {{  $getRecord->total() }})</b> </h3>  --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Programa</th>
                                            <th>Docente</th>
                                            <th>Sede</th>
                                            <th>Usuario</th>
                                            <th>Estado</th>
                                            <th>Creado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->class_name }}</td>
                                                <td>{{ $value->teacher_name }} {{ $value->last_name }}</td>
                                                <td>{{ $value->headquarter }}</td>
                                                <td>{{ $value->created_by_name }}</td>

                                                <td>
                                                    @if ($value->status == 0)
                                                        Activo
                                                    @else
                                                        Inactivo
                                                    @endif
                                                </td>

                                                <td>{{ date('d-m-y H:i A', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/assign_class_teacher/edit/' . $value->id) }}"
                                                        class="btn btn-warning">Editar</a>
                                                        <a href="{{ url('admin/assign_class_teacher/edit_single/'.$value->id) }}" class="btn btn-info">Cambiar</a>

                                                    <a href="{{ url('admin/assign_class_teacher/delete/' . $value->id) }}"
                                                        class="btn btn-danger">Eliminar</a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding:10px; float:right;">
                                    {{--  {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}  --}}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
                <!-- /.col -->
            </div>

            <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
