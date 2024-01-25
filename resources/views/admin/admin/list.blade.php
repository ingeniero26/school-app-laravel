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
                    <label>Nombre</label>
                    <input type="text" class="form-control"
                    value="{{ Request::get('name') }}"
                     placeholder="nombre" name="name">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Email</label>
                    <input type="text"
                     name="email"
                    class="form-control"
                    value="{{ Request::get('email') }}"
                      placeholder="Enter email">

                  </div>
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
                    <a href="{{ url('admin/admin/list') }}"
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
              Administradores (Total: {{  $getRecord->total() }})</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table id="example2" class="table  table-bordered table-striped">
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
                            <td>{{date('d-m-y H:i A',strtotime($value->created_at )) }}</td>
                            <td>
                                <a href="{{ url('admin/admin/edit/'.$value->id) }}" class="btn btn-warning">Editar</a>
                                <a href="{{ url('admin/admin/delete/'.$value->id) }}" class="btn btn-danger">Eliminar</a>
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
  <script>

</script>
</div>
@endsection

@section('script')

 $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@endsection
