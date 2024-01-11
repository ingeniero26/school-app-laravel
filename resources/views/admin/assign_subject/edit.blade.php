@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro de Asignaturas</h1>
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
                    <label>Nombre Programa</label>
                    <select name="class_id" id=""
                    class="form-control" required>
                        <option value="">Seleccione una clase</option>
                       @foreach($getClassSubject as $class)
                           <option {{ ($getRecord->class_id==$class->id) ? 'selected':'' }} value="{{ $class->id }}">{{ $class->name }}</option>
                       @endforeach
                    </select>

                  </div>

                  <div class="form-group">
                    <label>Nombre Asignatura</label>

                       @foreach($getSubjectClass as $subject)
                       @php
                           $checked = "";
                       @endphp
                       @foreach ($getAssignSubjectID as $subjectAssign )
                           @if($subjectAssign->subject_id==$subject->id)
                           @php
                           $checked = "checked";
                             @endphp
                           @endif
                       @endforeach
                       <div>
                        <label style="font-weight: normal">
                        <input {{ $checked }} type="checkbox" value="{{ $subject->id }}" name="subject_id[]" id=""> {{ $subject->name }}
                       </label>
                       </div>
                       @endforeach

                  </div>
                  <div class="form-group">
                    <label>Sede</label>
                    <select name="headquarter_id" id=""
                    class="form-control" required>
                        <option value="">Seleccione una clase</option>
                       @foreach($getHeadquater as $headquarter)
                           <option {{ ($getRecord->headquarter_id==$headquarter->id) ? 'selected':'' }} value="{{ $headquarter->id }}">{{ $headquarter->name }}</option>
                       @endforeach
                    </select>

                </div>
                  <div class="form-group">
                    <label>Estado</label>
                    <select name="status" id="" class="form-control">
                        <option {{ ($getRecord->status ==0) ? 'selected':'' }} value="0">Activo</option>
                        <option {{ ($getRecord->status ==1) ? 'selected':'' }} value="1">Inactivo</option>
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

