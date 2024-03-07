@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Semestres-Periodos Academicos</h1>
        </div>
        <div class="col-sm-6" style="text-align:right">
          <a href="{{ url('admin/examinations/marks_grade/add') }}" class="btn btn-primary">Nuevo</a>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col -->
       
        </div>
        <!-- /.row -->
            @include('_message')
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b> Listado de
              {{--  Periodos (Total: {{  $getRecord->total() }})</b> </h3>  --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                   
                    <th>Nombre</th>
                    <th>% Inicio</th>
                    <th>% Fin</th>             
                    <th>Usuario</th>
                    <th>Fecha Creado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($getRecord as $value)
                       <tr>
                          
                           <td>{{$value->name  }}</td>
                           <td>{{$value->percent_from  }}</td>
                           <td>{{$value->percent_to  }}</td>

                           <td>{{$value->created_by_name  }}</td>
                           <td>{{date('d-m-y H:i A',strtotime($value->created_at )) }}</td>
                           <td>
                               <a href="{{ url('admin/examinations/marks_grade/edit/'.$value->id) }}" class="btn btn-warning">Editar</a>
                               <a href="{{ url('admin/examinations/marks_grade/delete/'.$value->id) }}" class="btn btn-danger">Eliminar</a>
                           </td>

                       </tr>
                    @endforeach 
               </tbody>
              </table>
           
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
