@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Asistencia Estudiantes</h1>
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
                            <h3 class="card-title">Buscar Estudiante</h3>
                        </div>
                        <!-- form start -->
                        <form method="get" action="">

                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-3">
                                        <label>Programa</label>
                                        <select required class="form-control select2" id="getClass" name="class_id">
                                            <option value="">Select</option>
                                            @foreach ($getClass as $class)
                                            <option  {{ (Request::get('class_id')==$class->class_id) ? 'selected' : '' }}
                                                value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Fecha Asistencia</label>
                                      <input type="date" name="attendance_date" id="getAttendanceDate" required
                                       class="form-control" value="{{ Request::get('attendance_date') }}">
                                    </div>


                                    <div class="form-group col-md-3">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 30px">
                                            Buscar</button>
                                        <a href="{{ url('teacher/attendance/student') }}" class="btn btn-success"
                                            style="margin-top: 30px">Limpiar</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                   @if (!empty(Request::get('class_id')) &&
                    !empty(Request::get('attendance_date')))


                     <div class="card-header">
                            <h3 class="card-title"><b> Estudiantes      </h3>
                        </div>

                    <div class="card-body p-0" style="overflow: auto" >
                     <table class="table table-striped table-responsive">
                       <thead>
                        <tr>
                            <th>ID</th>
                            <th>Estudiante</th>
                            <th>Documento</th>
                            <th>Asistencia</th>
                        </tr>
                       </thead>
                        <tbody>
                             @if(!empty($getStudent) && !empty($getStudent->count()))
                                @foreach($getStudent as $value)
                                @php
                                $attendance_type ='';
                                  $getAttendance = $value->getAttendance($value->id,
                                  Request::get('class_id'),
                                  Request::get('attendance_date'));
                                 if(!empty($getAttendance->attendance_type))
                                 {
                                    $attendance_type =$getAttendance->attendance_type;
                                 }
                                  @endphp
                             <tr>
                               <td>{{ $value->id }}</td>
                               <td>{{ $value->name }} {{ $value->last_name }}</td>
                               <td>{{ $value->roll_number }} </td>
                               <td>
                                <label for="" style="margin-right: 10px"><input type="radio" {{ ($attendance_type =='1') ? 'checked' : '' }} value="1" id="{{ $value->id }}" class="SaveAttendance" name="attendance{{ $value->id }}" id="">Presente</label>
                                <label for="" style="margin-right: 10px"><input type="radio" {{ ($attendance_type =='2') ? 'checked' : '' }}  value="2" id="{{ $value->id }}"  class="SaveAttendance" name="attendance{{ $value->id }}" id="">Tarde</label>
                                <label for="" style="margin-right: 10px"><input type="radio" {{ ($attendance_type =='3') ? 'checked' : '' }}  value="3" id="{{ $value->id }}" class="SaveAttendance" name="attendance{{ $value->id }}" id="">Ausente</label>
                                <label for="" style="margin-right: 10px"><input type="radio" {{ ($attendance_type =='4') ? 'checked' : '' }}  value="4" id="{{ $value->id }}" class="SaveAttendance"  name="attendance{{ $value->id }}" id="">Excusa</label>
                               </td>
                             </tr>

                              @endforeach
                             @endif
                        </tbody>
                    </table>
                    </div>


                    @endif



                </div>
                <!--/.col (left) -->
                <!-- right column -->

                <!--/.col (right) -->
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

@section('script')
    <script type="text/javascript">
      $(function () {
        $('.select2').select2()
       });
        $('.SaveAttendance').change(function(e){

           var student_id = $(this).attr('id');
           var attendance_type = $(this).val();
           var class_id = $('#getClass').val();
           var attendance_date = $('#getAttendanceDate').val();


         $.ajax({
                type: "POST",
                url: "{{ url('teacher/attendance/student/save')}} ",
                data: {
                   "_token" : "{{ csrf_token() }}",
                    student_id:student_id,
                    attendance_type:attendance_type,
                    class_id:class_id,
                    attendance_date:attendance_date

                },
                dataType: "json",
                success: function(data) {
                    Swal.fire({
                position: "top-end",
                icon: "success",
                title: ( data.message),
                showConfirmButton: false,
                timer: 1500,


                });
                        //alert(data.message);
                }
            });
        });
    </script>
@endsection
