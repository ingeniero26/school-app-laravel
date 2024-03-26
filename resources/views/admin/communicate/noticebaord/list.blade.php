@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Noticias</h1>
        </div>
        <div class="col-sm-6" style="text-align:right">
          <a href="{{ url('admin/communicate/notice_board/add') }}" class="btn btn-primary">Nueva Noticia</a>
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


            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Buscar</h3>
              </div>

              <form method="get" action="">

                <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label>Nombre</label>
                    <input type="text" class="form-control"
                    value="{{ Request::get('title') }}"
                     placeholder="title" name="title">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Notificacion Inicio</label>
                    <input type="date"
                     name="notice_date_to"
                    class="form-control"
                    value="{{ Request::get('notice_date_to') }}"
                      placeholder="Enter email">

                  </div>
                  <div class="form-group col-md-2">
                    <label>Notificación Fin</label>
                    <input type="date"
                     name="notice_date_from"
                    class="form-control"
                    value="{{ Request::get('notice_date_from') }}"
                      >
                  </div>

                  <div class="form-group col-md-2">
                    <label>Publicacion Inicio</label>
                    <input type="date"
                     name="publish_date_to"
                    class="form-control"
                    value="{{ Request::get('publish_date_to') }}"
                      >
                  </div>
                  <div class="form-group col-md-2">
                    <label>Publicacion Fin</label>
                    <input type="date"
                     name="publish_date_from"
                    class="form-control"
                    value="{{ Request::get('publish_date_from') }}"
                      >
                  </div>
                 <div class="form-group col-md-2">
                     <label>Mensaje para</label>
                         <select name="message_to" class="form-control">
                            <option value="">Select</option>
                            <option {{ (Request::get('message_to')==3) ? 'selected' : '' }} value="3">Estudiante</option>
                            <option {{ (Request::get('message_to')==2) ? 'selected' : '' }} value="2">Docente</option>
                            <option {{ (Request::get('message_to')==4) ? 'selected' : '' }} value="4">Padre de familia</option>
                            </select>
                        </div>
                  <div class="form-group col-md-3">
                    <button type="submit"
                    class="btn btn-primary"
                     style="margin-top: 30px">
                    Buscar</button>
                    <a href="{{ url('admin/communicate/notice_board') }}"
                    class="btn btn-success"
                     style="margin-top: 30px">Limpiar</a>
                  </div>
                </div>


                </div>

              </form>
            </div>
            @include('_message')
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Listado de
              {{--  Administradores (Total: {{  $getRecord->total() }})</h3>  --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table id="example1" class="table  table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Titulo</th>
                    <th>Fecha Notificación</th>
                    <th>Fecha Publicacion</th>
                    <th>Mensaje para</th>
                    <th>Usuario</th>
                    <th>Fecha Creado</th>
                    <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                 @forelse($getRecord as $value)
                        <tr>
                            <td>{{$value->id  }}</td>
                            <td>{{$value->title  }}</td>
                            <td>{{$value->notice_date  }}</td>
                            <td>{{$value->publish_date  }}</td>
                            {{--  <td>{{$value->message  }}</td>  --}}
                           <td>
                            @foreach ($value->getMessage as $message )
                                @if($message->message_to == 2)
                                <div>Docente -</div>
                                @elseif ($message->message_to == 3)
                                <div>Estudiante -</div>
                                @elseif ($message->message_to == 4)
                                <div>Padre de Familia</div>
                                @endif
                            {{--  //{{ $message->message_to }}  --}}
                            @endforeach
                           </td>
                            <td>{{$value->created_by_name  }}</td>
                            <td>{{date('d-m-y H:i A',strtotime($value->created_at )) }}</td>
                            <td>
                                <a href="{{ url('admin/communicate/notice_board/edit/'.$value->id) }}" class="btn btn-warning">Editar</a>
                                <a href="{{ url('admin/communicate/notice_board/delete/'.$value->id) }}" class="btn btn-danger">Eliminar</a>
                            </td>

                        </tr>
                          @empty
                                <tr>
                                    <td colspan="100%">No hay datos</td>
                                </tr>
                     @endforelse
                </tbody>
              </table>

            </div>

          </div>

        </div>

      </div>

    </div>
  </section>

  <script>

</script>
</div>
@endsection


@section('script')
<script>
 $(function () {
    $("#example1").DataTable({
       "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
        "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });
</script>

@endsection
