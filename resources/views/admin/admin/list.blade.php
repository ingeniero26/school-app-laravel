@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Listado Admin</h1>
        </div>
        <div class="col-sm-6" style="text-align:right">
          <a href="{{ url('admin/admin/add') }}" class="btn btn-primary">Nuevo Administrador</a>
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
            @include('_message')
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Listado de Administradores</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Creado</th>
                    <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                     @foreach($getRecord as $value)
                        <tr>
                            <td>{{$value->id  }}</td>
                            <td>{{$value->name  }}</td>
                            <td>{{$value->email  }}</td>
                            <td>{{$value->created_at  }}</td>
                            <td>
                                <a href="{{ url('admin/admin/edit/'.$value->id) }}" class="btn btn-warning">Editar</a>
                                <a href="{{ url('admin/admin/delete/'.$value->id) }}" class="btn btn-danger">Eliminar</a>
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
