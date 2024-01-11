@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Editar Programas-Docente</h1>
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
                                        <label>Nombre Progama</label>
                                        <select name="class_id" id=""
                                        class="form-control" required>
                                            <option value="">Seleccione una clase</option>
                                           @foreach($getClassSubject as $class)
                                               <option {{ ($getRecord->class_id==$class->id) ? 'selected':'' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                           @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label>Docente</label>
                                          @foreach($getTeacher as $teacher)
                                        @php
                                            $checked = "";
                                        @endphp
                                        @foreach ($getAssignTeacherID as $teacherAssign )
                                            @if($teacherAssign->teacher_id==$teacher->id)
                                            @php
                                            $checked = "checked";
                                              @endphp
                                            @endif
                                        @endforeach
                                        <div>
                                         <label style="font-weight: normal">
                                         <input {{ $checked }} type="checkbox" value="{{ $teacher->id }}" name="teacher_id[]" id=""> {{ $teacher->name }} {{ $teacher->last_name }}
                                        </label>
                                        </div>
                                        @endforeach

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
                                    <button type="submit" class="btn btn-primary">Registrar</button>
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
