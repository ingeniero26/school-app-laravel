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
          <a href="{{ url('admin/assign_subject/add') }}"
           class="btn btn-primary">Asignar Clases</a>
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
                  <div class="form-group col-md-3">
                    <label>Nombre Programa</label>
                    <input type="text" class="form-control"
                    value="{{ Request::get('class_name') }}"
                     placeholder="Programa" name="class_name">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Nombre Materia</label>
                    <input type="text" class="form-control"
                    value="{{ Request::get('subject_name') }}"
                     placeholder="Asignatura" name="subject_name">
                  </div>
                  {{--  <div class="form-group col-md-3">
                    <label>Tipo Asignatura</label>
                    <select name="type" id=""
                    class="form-control">
                    <option value="0">Seleccione un tipo</option>
                    <option {{ (Request::get('type') =='Theory')? 'selected' : ''}} value="Theory">Theory</option>
                    <option {{ (Request::get('type') =='Practical')? 'selected' : ''}} value="Practical">Practical</option>
                    </select>
                  </div>  --}}
                  <div class="form-group col-md-3">
                    <label>Fecha</label>
                    <input type="date"
                     name="date"
                    class="form-control"
                    value="{{ Request::get('date') }}"
                      >
                  </div>
                  <div class="form-group col-md-3">
                    <button type="submit"
                    class="btn btn-primary"
                     style="margin-top: 30px">
                    Buscar</button>
                    <a href="{{ url('admin/assign_subject/list') }}"
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
                    <th>Materia</th>

                    <th>Usuario</th>
                    <th>Estado</th>
                    <th>Creado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                        @foreach($getRecord as $value)
                       <tr>
                           <td>{{$value->id  }}</td>
                           <td>{{$value->class_name  }}</td>
                           <td>{{$value->subject_name  }}</td>
                           <td>{{$value->created_by_name  }}</td>

                           <td>
                            @if($value->status==0)
                            Activo
                            @else
                            Inactivo
                            @endif
                           </td>

                           <td>{{date('d-m-y H:i A',strtotime($value->created_at )) }}</td>
                           <td>
                               <a href="{{ url('admin/assign_subject/edit/'.$value->id) }}" class="btn btn-warning">Editar</a>
                               <a href="{{ url('admin/assign_subject/edit_single/'.$value->id) }}" class="btn btn-info">Cambiar</a>
                               <a href="{{ url('admin/assign_subject/delete/'.$value->id) }}" class="btn btn-danger">Eliminar</a>
                           </td>

                       </tr>
                    @endforeach
               </tbody>
              </table>
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
