@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="fas fa-american-sign-language-interpreting"></i> Programas-Docentes </h1>
                    </div>
                    {{--  <div class="col-sm-6" style="text-align:right">
                        <a href="{{ url('admin/assign_class_teacher/add') }}" class="btn btn-primary">Asignar Clases</a>
                    </div>  --}}
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
                                            <th>Asignatura</th>
                                             <th>Tipo</th>
                                            <th>Semestre</th>
                                            <th>Sede</th>

                                            <th>Creado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->class_name }}</td>
                                                <td>{{ $value->subject_name }}</td>
                                                <td>{{ $value->subject_type }}</td>

                                                <td>{{ $value->semester }}</td>
                                              {{-- <td>
                                                  @php
                                                $ClassSubject=$value->getMyTimeTable($value->class_id,$value->subject_id)
                                                @endphp
                                               @if(!empty($ClassSubject))
                                                {{ $ClassSubject->start_time }} to {{ $ClassSubject->end_time }}
                                               @endif
                                                </td>--}}
                                                <td>{{ $value->headquarter_name }}</td>

                                                <td>{{ date('d-m-y H:i A', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('teacher/my_class_subject/class_timetable/'.$value->class_id.'/'.$value->subject_id) }}" class="btn btn-warning">Mi Horario</a>
                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding:10px; float:right;">
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
