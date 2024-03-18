@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <i class="fas fa-american-sign-language-interpreting"></i>
                             {{--  Programas-Docentes({{ $getRecord->total() }}) </h1>  --}}
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
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
                                <label>Nombre Programa</label>
                                  <select name="class_id" id=""
                                class="form-control getClassSubject select2" required>
                                    <option value="">Seleccione un programa</option>
                                @foreach($getClassSubject as $class)
                                    <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                                </select>
                              </div>
                              <div class="form-group col-md-3">
                                <label>Asignatura</label>

                               <select name="subject_id" id=""  class="form-control getSubject select2" required>
                                    <option value="">Seleccione </option>
                                    @if(!empty($getSubject))
                                @foreach($getSubject as $subject)
                                    <option {{ (Request::get('subject_id') == $subject->subject_id) ?
                                        'selected' : '' }} value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                                @endforeach
                                @endif
                                </select>
                              </div>


                              <div class="form-group col-md-3">
                                <button type="submit"
                                class="btn btn-primary"
                                 style="margin-top: 30px">
                                Buscar</button>
                                <a href="{{ url('admin/class_timetable/list') }}"
                                class="btn btn-success"
                                 style="margin-top: 30px">Limpiar</a>
                              </div>
                            </div>


                            </div>
                            <!-- /.card-body -->
                          </form>
                        </div>
                        @if(!empty(Request::get('class_id')) && !empty(Request::get('subject_id')))
                        <form action="{{ url('admin/class_timetable/add') }}" method="POST">
                             {{ @csrf_field() }}
                            <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}">
                            <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                         @include('_message')
                            <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Dia Semana
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body p-0">
                            <table id="example2" class="table  table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>Dia</th>
                                          <th>Hora Inicio</th>
                                          <th>Hora Fin</th>
                                          <th>Salon</th>
                                      </tr>
                                  </thead>
                              <tbody>
                                @php
                                    $i =1;
                                @endphp
                                @foreach($week as  $value)
                                    <tr>
                                        <th>
                                            <input type="hidden" name="timetable[{{ $i }}][week_id]" value="{{ $value['week_id'] }}">
                                                {{ $value['week_name'] }}
                                            </th>
                                              <td><input  type="time" name="timetable[{{ $i }}][start_time]" value="{{ $value['start_time'] }}" class="form-control"></td>
                                              <td><input type="time" name="timetable[{{ $i }}][end_time]" value="{{ $value['end_time'] }}" class="form-control"></td>
                                              <td><input type="text" name="timetable[{{ $i }}][room_number]" style="width: 150px" value="{{ $value['room_number'] }}" class="form-control"></td>
                                          </tr>
                                           @php
                                            $i++;
                                        @endphp
                                      @endforeach
                              </tbody>
                            </table><br>
                              <button type="submit" class="btn btn-primary">Guardar</button>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        </form>
                        @endif
                      </div>

                  </div>
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
    $('.getClassSubject').change(function(){
        var class_id = $(this).val();
        $.ajax({
            url:"{{ url('admin/class_timetable/get_subject')  }}",
            type:"GET",
            data:{
                "_token":"{{ csrf_token() }}",
                class_id:class_id,
            },
            dataType:"json",
            success:function(response){
             console.log(response);
               $('.getSubject').html(response.html);
             //   $('#').html(response.success);
             //   $('#').modal('show');
            },
        });
    });
     $(function () {
        $('.select2').select2()
       });
</script>

@endsection
