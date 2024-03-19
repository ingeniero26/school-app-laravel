@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1> Asistencia  <span style="color: blue"> (Total:{{ $getRecord->total() }}) </span> </h1>
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
                            <h3 class="card-title">Buscar Estudiante</h3>
                        </div>
                        <!-- form start -->
                        <form method="get" action="">

                            <div class="card-body">
                                <div class="row">

                                   <div class="form-group col-md-2">
                                        <label>Programa</label>
                                        <select  class="form-control select2"
                                         name="class_id">
                                            <option value="">Select</option>
                                              @foreach ($getClass as $class)
                                            <option  {{ (Request::get('class_id')==$class->class_id) ? 'selected' : '' }}
                                                value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                                                     
                                 
                                     
                                    <div class="form-group col-md-2">
                                        <label>Fecha Asistencia</label>
                                      <input type="date" name="attendance_date"
                                       class="form-control"
                                        value="{{ Request::get('attendance_date') }}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Tipo Asistencia</label>
                                       <select name="attendance_type" class="form-control">
                                            <option value="">Select</option>
                                            <option {{ (Request::get('attendance_type')==1) ? 'selected' : '' }} value="1">Presente</option>
                                            <option {{ (Request::get('attendance_type')==2) ? 'selected' : '' }} value="2">Tarde</option>
                                            <option {{ (Request::get('attendance_type')==3) ? 'selected' : '' }} value="3">Ausente</option>
                                            <option {{ (Request::get('attendance_type')==4) ? 'selected' : '' }} value="4">Excusa</option>
                                       </select>
                                    </div>


                                    <div class="form-group col-md-2">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 30px">
                                            Buscar</button>
                                        <a href="{{ url('student/my_attendance') }}" class="btn btn-success"
                                            style="margin-top: 30px">Limpiar</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
               
                     <div class="card-header">
                            <h3 class="card-title"><b> Asistencia      </h3>
                        </div>

                    <div class="card-body p-0" style="overflow: auto" >
                     <table class="table table-striped table-responsive">
                       <thead>
                        <tr>
                          
                            <th>Programa</th>
                            <th>Tipo Asistencia</th>
                            <th>Fecha Asistencia</th>
                            <th>Creado</th>
                        </tr>
                       </thead>
                        <tbody>
                           @forelse ($getRecord as $value)
                                <tr>
                                    <td>{{$value->class_name  }}</td>
                                    <td>
                                        @if($value->attendance_type == 1)
                                        Presente
                                        @elseif ($value->attendance_type ==2 )
                                        Tarde
                                        @elseif ($value->attendance_type ==3 )
                                        Ausente
                                        @elseif ($value->attendance_type ==4 )
                                        Excusa
                                        @endif
                                    </td>
                                    <td>{{date('d-m-Y',strtotime($value->attendance_date )) }}</td>

                                    <td>{{date('d-m-Y H:i A',strtotime($value->created_at )) }}</td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">No hay datos</td>
                                </tr>
                            @endforelse

                       </tbody>
                    </table>
                      <div style="padding:10px; float:right;">
                         {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
                    </div>


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


    </script>
@endsection
