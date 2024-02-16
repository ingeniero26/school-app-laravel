@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Listado de mis Asignaturas</h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
              @include('_message')
          <div class="card">
            <div class="card-header">
               <h3 class="card-title"><b> Listado de
              Asignaturas</b> </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-striped" id="example2">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                   </tr>
                </thead>
                <tbody>
                         @foreach($getRecord as $value)
                       <tr>
                           <td>{{$value->subject_name  }}</td>
                           <td>{{$value->subject_type  }}</td>

                       </tr>
                    @endforeach
               </tbody>
              </table>
              {{--  <div style="padding:10px; float:right;">
                   {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>  --}}
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.col -->

        <!-- /.row -->

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

@section('script')

<script>
     $(function () {
    $("#example2").DataTable({
      "responsive": true,
       "lengthChange":
       false,
       "autoWidth":
       false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

  });
</script>

@endsection
