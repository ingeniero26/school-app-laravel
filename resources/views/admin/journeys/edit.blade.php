@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar de Jornadas</h1>
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
            <!-- general form elements -->
            <div class="card card-primary">

              <!-- form start -->
              <form method="post">
                {{ @csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Nombre Clase</label>
                    <input type="text" class="form-control"
                    placeholder="nombre clase" name="name"
                    value="{{ $getRecord->name}}">
                  </div>
                  <div class="form-group">
                    <label>Abreviatura</label>
                    <input type="text" class="form-control"
                    placeholder="" name="abbreviation"
                    value="{{ $getRecord->abbreviation}}">
                  </div>
                 

                  <div class="form-group">
                    <label>Estado</label>
                    <select name="status" id="" class="form-control">
                        <option {{ ($getRecord->status == 0)? 'selected' : ''}} value="0">Activo</option>
                        <option {{ ($getRecord->status == 1)? 'selected' : '' }} value="1">Inactivo</option>
                    </select>
                     
                  </div>
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit"
                  class="btn btn-warning">Editar</button>
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
