@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Listado de docentes</h1>
        </div>
        <div class="col-sm-6" style="text-align:right">
          <a href="{{ url('admin/teacher/add') }}" class="btn btn-primary">Nuevo Docente</a>
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
            <!-- general form elements -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Buscar</h3>
              </div>
              <!-- form start -->
              <form method="get" action="">

                <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-2">
                    <label>Nombre</label>
                    <input type="text" class="form-control"
                    value="{{ Request::get('name') }}"
                     placeholder="nombre" name="name">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Apelidos</label>
                    <input type="text" class="form-control"
                    value="{{ Request::get('last_name') }}"
                     placeholder="apellido" name="last_name">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Documento</label>
                    <input type="text" class="form-control"
                    value="{{ Request::get('roll_number') }}"
                     placeholder="documento" name="roll_number">
                  </div>

                  <div class="form-group col-md-2">
                    <label>Email</label>
                    <input type="text"
                     name="email"
                    class="form-control"
                    value="{{ Request::get('email') }}"
                      placeholder="Enter email">

                  </div>
                  <div class="form-group col-md-2">
                    <label>Fecha Matricula</label>
                    <input type="date"
                     name="admission_date"
                    class="form-control"
                    value="{{ Request::get('admission_date') }}"
                      >
                  </div>
                  <div class="form-group col-md-2">
                    <label>Fecha Creado</label>
                    <input type="date"
                     name="date"
                    class="form-control"
                    value="{{ Request::get('date') }}"
                      >
                  </div>
                  <div class="form-group col-md-2">
                    <label>Estado</label>
                    <select name="status" id="" class="form-control">
                        <option value="">Seleccione estado</option>
                        <option {{ (Request::get('status')==100)? 'selected' : ''}} value="100">Activo</option>
                        <option {{ (Request::get('status')==1)? 'selected' : ''}} value="1">Inactivo</option>
                    </select>

                  </div>
                  <div class="form-group col-md-3">
                    <button type="submit"
                    class="btn btn-primary"
                     style="margin-top: 30px">
                    Buscar</button>
                    <a href="{{ url('admin/teacher/list') }}"
                    class="btn btn-success"
                     style="margin-top: 30px">Limpiar</a>
                  </div>
                </div>


                </div>
                <!-- /.card-body -->
              </form>
            </div>
            <!-- /.card -->

            <!-- general form elements -->



          </div>
          <!--/.col (left) -->
          <!-- right column -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
            @include('_message')
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Listado de
              Estudiantes (Total: {{  $getRecord->total() }})</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Docente</th>

                            <th>Tipo Documento</th>
                            <th>No Documento</th>
                            <th>Email</th>
                            <th>Sexo</th>
                            <th>Fecha Nac</th>
                            <th>Fecha Ingreso</th>
                            <th>Ocupaciòn</th>
                            <th>Estado Civil</th>
                            <th>Direccion Trabajo</th>
                            <th>Direccion Casa</th>
                            <th>Calificacion</th>
                            <th>Expericiencia</th>
                            <th>Eps</th>
                            <th>Notas</th>
                            <th>Estado</th>

                            <th>Creado</th>
                            <th>Acciones</th>

                          </tr>
                        </thead>
                        <tbody>
                             @foreach($getRecord as $value)
                                <tr>
                                    <td>{{$value->id  }}</td>
                                    <td>
                                        @if(!empty($value->getProfile()))
                                            <img src="{{$value->getProfile()  }}" class="img-fluid">
                                        @endif

                                    </td>

                                    <td>{{$value->name  }} {{$value->last_name  }}</td>
                                    <td>{{$value->document_type  }}</td>
                                    <td>{{$value->roll_number  }}</td>
                                    <td>{{$value->email  }}</td>
                                    <td>{{$value->gender  }}</td>
                                    <td>
                                        @if(!empty($value->date_of_birth))
                                          {{date('d-m-Y',strtotime($value->date_of_birth))}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($value->admission_date))
                                          {{date('d-m-Y',strtotime($value->admission_date))}}
                                        @endif
                                    </td>
                                    <td>{{$value->occupation  }}</td>

                                    <td>{{$value->marital_status  }}</td>
                                    <td>{{$value->address  }}</td>
                                    <td>{{$value->permanent_address  }}</td>
                                    <td>{{$value->qualification  }}</td>
                                    <td>{{$value->work_experiencie  }}</td>
                                    <td>{{$value->eps  }}</td>

                                    <td>{{$value->notes  }}</td>
                                    <td>
                                        @if($value->status==0)
                                        Activo
                                        @else
                                        Inactivo
                                        @endif
                                       </td>
                                    <td>{{date('d-m-y H:i A',strtotime($value->created_at )) }}</td>
                                    <td>
                                        <a href="{{ url('admin/teacher/edit/'.$value->id) }}" class="btn btn-warning">Editar</a>
                                        <a href="{{ url('admin/teacher/delete/'.$value->id) }}" class="btn btn-danger">Eliminar</a>
                                    </td>

                                </tr>
                             @endforeach
                        </tbody>
                      </table>
                </div>


              <div style="padding:10px; float:right;">

              {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>

      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection
