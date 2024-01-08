@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-8">
          <h1>Listado de  Asignaturas <span style="color: blue"> ({{ $getUser->name  }} {{ $getUser->last_name }}) </span></h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
              @include('_message')
          <div class="card">
            <div class="card-header">
               <h3 class="card-title"><b> Listado de
              Asignaturas</b> </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-striped">
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
                           <td>{{$value->type  }}</td>

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
