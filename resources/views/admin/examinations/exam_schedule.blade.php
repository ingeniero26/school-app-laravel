@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Horario Examenes</h1>
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
                            <h3 class="card-title">Buscar</h3>
                        </div>
                        <!-- form start -->
                        <form method="get" action="">

                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Examen</label>
                                        <select name="exam_id" required class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($getExamR as $exam)
                                            <option {{ (Request::get('exam_id')==$exam->id) ? 'selected' : '' }}
                                                value="{{ $exam->id }}">{{ $exam->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Programa</label>
                                        <select required class="form-control" name="class_id">
                                            <option value="">Select</option>
                                            @foreach ($getClass as $class)
                                            <option {{ (Request::get('class_id')==$class->id) ? 'selected' : '' }}
                                                value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group col-md-3">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 30px">
                                            Buscar</button>
                                        <a href="{{ url('admin/examinations/exam_schedule') }}" class="btn btn-success"
                                            style="margin-top: 30px">Limpiar</a>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->
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
            @include('_message')
            @if(!empty($getRecord))
            <form action="{{ url('admin/examinations/exam_schedule_insert') }}" method="POST">
                {{ @csrf_field() }}
                <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b> Listado de
                                {{-- Clases (Total: {{ $getRecord->total() }})</b> </h3> --}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Asignatura</th>
                                    <th>Fecha Examen</th>
                                    <th>Inicio</th>
                                    <th>Fin</th>
                                    <th>Salon</th>
                                    <th>Maxima Nota</th>
                                    <th>Nota Probada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i =1;
                                @endphp
                                @foreach($getRecord as $value)
                                <tr>
                                    <td>{{$value['subject_name' ] }}
                                        <input type="hidden" class="form-control" value="{{ $value['subject_id'] }}"
                                            name="schedule[{{ $i }}][subject_id]">
                                    </td>
                                    <td><input type="date" value="{{ $value['exam_date'] }}" class="form-control"
                                            name="schedule[{{ $i }}][exam_date]"></td>
                                    <td><input type="time" value="{{ $value['start_time'] }}" class="form-control"
                                            name="schedule[{{ $i }}][start_time]"></td>
                                    <td><input type="time" value="{{ $value['end_time'] }}" class="form-control"
                                            name="schedule[{{ $i }}][end_time]"></td>
                                    <td><input type="text" value="{{ $value['room_number'] }}" class="form-control"
                                            name="schedule[{{ $i }}][room_number]"></td>
                                    <td><input type="text" value="{{ $value['full_marks'] }}" class="form-control"
                                            name="schedule[{{ $i }}][full_marks]"></td>
                                    <td><input type="text" value="{{ $value['passing_mark'] }}" class="form-control"
                                            name="schedule[{{ $i }}][passing_mark]"></td>

                                </tr>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table> <br>
                        <button type="submit" class="btn btn-primary">Guardar</button>


                    </div>
                </div>
            </form>

            @endif
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
