@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Listado de hijos</h1>
        </div>
        {{--  <div class="col-sm-6" style="text-align:right">
          <a href="{{ url('admin/parent/add') }}" class="btn btn-primary">Nuevo Estudiante</a>
        </div>  --}}
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col -->

        <!-- /.row -->
            @include('_message')

          <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>Mi Hijos</b></h3>
            </div>
            <div class="card-body p-0" style="overflow: auto;">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                          <tr>

                            <th>Foto</th>
                            <th>Estudiante</th>
                            <th>Tipo Documento</th>
                            <th>No Documento</th>
                            <th>Email</th>
                            <th>Fecha Nac</th>
                            <th>Fecha Matricula</th>
                            <th>Programa</th>
                            <th>Sede</th>
                            <th>Jornada</th>
                            <th>Genero</th>
                            <th>Fecha Nacimiento</th>
                            <th>Raza</th>
                            <th>Direccion</th>
                            <th>Telèfono</th>
                            <th>Creado</th>
                            <th>Accion</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($getRecord as $value)
                               <tr>
                                 <td>
                                    @if(!empty($value->getProfile()))
                                        <img src="{{$value->getProfile()  }}" class="img-fluid">
                                    @endif
                                </td>
                                <td>{{$value->name  }} {{$value->last_name  }}</td>

                                <td>{{$value->document_type  }}</td>
                                <td>{{$value->roll_number  }}</td>
                                <td>{{$value->email  }}</td>
                                <td>{{$value->admission_number  }}</td>
                                <td>
                                    @if(!empty($value->admission_date))
                                      {{date('d-m-Y',strtotime($value->admission_date))}}
                                    @endif
                                </td>
                                <td>{{$value->class_name  }}</td>
                                <td>{{$value->headquarter_name  }}</td>
                                <td>{{$value->journey_name  }}</td>
                                <td>{{$value->gender  }}</td>
                                <td>
                                    @if(!empty($value->date_of_birth))
                                      {{date('d-m-Y',strtotime($value->date_of_birth))}}
                                    @endif
                                </td>

                                <td>{{$value->caste  }}</td>
                                <td>{{$value->address  }}</td>
                                <td>{{$value->mobile_number  }}</td>
                                <td>{{date('d-m-y H:i A',strtotime($value->created_at )) }}</td>
                                <td style="min-width: 470px">
                                    <a href="{{ url('parent/my_student/subject/'.$value->id) }}" class="btn btn-success btn-sm">Asignaturas</a>
                                    <a href="{{ url('parent/my_student/exam_timetable/'.$value->id) }}" class="btn btn-info btn-sm">Exámenes</a>
                                    <a href="{{ url('parent/my_student/calendar/'.$value->id) }}" class="btn btn-primary btn-sm">Horario</a>
                                    <a href="{{ url('parent/my_student/exam_result/'.$value->id) }}" class="btn btn-warning btn-sm">Notas</a>
                                    <a href="{{ url('parent/my_student/attendance/'.$value->id) }}" class="btn btn-default btn-sm">Asistencia</a>
                                </td>
                               </tr>
                            @endforeach
                       </tbody>
                    </table>
                </div>
              <div style="padding:10px; float:right;">
              </div>
            </div>
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
