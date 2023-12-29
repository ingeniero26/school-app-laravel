@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cambiar contraseña</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- left column -->
          <div class="col-md-8">
              @include('_message')
            <!-- general form elements -->
            <div class="card card-primary">

              <!-- form start -->
              <form method="post">
                {{ @csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Contraseña Actual</label>
                    <input type="password" class="form-control"
                    placeholder="" name="old_password">
                  </div>
                  <div class="form-group">
                    <label>Contraseña nueva</label>
                    <input type="password" class="form-control"
                    placeholder="" name="new_password">
                  </div>

                  {{--  <div class="form-group">
                    <label>Confirmar Contraseña</label>
                    <input type="password" class="form-control"
                    placeholder="" name="new_password">
                  </div>  --}}


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit"
                  class="btn btn-primary">Actualizar</button>
                </div>
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
