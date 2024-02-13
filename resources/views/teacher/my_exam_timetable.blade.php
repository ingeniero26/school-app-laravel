@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Horario Examanes Docente</h1>
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
                        @include('_message')
                        @foreach ($getRecord as $value)
                            <h2 style="font-size: 32px; margin-bottom;">Programa: <span style="color: blue;">{{ $value['class_name'] }}</span></h2>
                            @foreach ($value['exam'] as $exam)
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Examen: <b>{{ $exam['exam_name'] }}</b> </h3
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <table id="example2" class="table  table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Asignatura</th>
                                                    <th>Tipo</th>
                                                    <th>Dia</th>
                                                    <th>Fecha</th>

                                                    <th>Hora Inicio</th>
                                                    <th>Hora Fin</th>
                                                    <th>Salon</th>
                                                    <th>Maxima</th>
                                                    <th>Minima</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ( $exam['subject'] as $valueW )
                                                    <tr>
                                                        <th>{{ $valueW['subject_name'] }}</th>
                                                        <th>{{ $valueW['subject_type'] }}</th>

                                                        <th>{{date('l',strtotime($valueW['exam_date'])) }}</th>
                                                        <th>{{!empty($valueW['exam_date'])? date('d-m-Y',strtotime($valueW['exam_date'])) : '' }}</th>

                                                        <th>{{!empty($valueW['start_time'])? date('h: i A',strtotime($valueW['start_time'])) : '' }}</th>
                                                        <th>{{!empty($valueW['end_time'])? date('h: i A',strtotime($valueW['end_time'])) : '' }}</th>
                                                        <th>{{ $valueW['room_number'] }}</th>
                                                        <th>{{ $valueW['full_marks'] }}</th>
                                                        <th>{{ $valueW['passing_mark'] }}</th>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table><br>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            @endforeach
                        @endforeach

                    </div>

                </div>
            </div>
            <!-- /.col -->
        </section>
    </div>


@endsection
