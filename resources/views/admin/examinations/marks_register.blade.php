@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Registro Examenes</h1>
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
                                        <a href="{{ url('admin/examinations/marks_register') }}" class="btn btn-success"
                                            style="margin-top: 30px">Limpiar</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                    @include('_message')
                    @if(!empty($getSubject) && !empty($getSubject->count()))
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b> Listado
                                        {{-- Clases (Total: {{ $getRecord->total() }})</b> </h3> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>ESTUDIANTES</th>
                                            @foreach($getSubject as $subject)
                                            <th>
                                                {{ $subject->subject_name }} <br />
                                                ({{ $subject->subject_type }}:{{ $subject->passing_mark }}/ {{ $subject->full_marks }})
                                            </th>
                                            @endforeach

                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if(!empty($getStudent) && !empty($getStudent->count()))
                                            @foreach($getStudent as $student)
                                            <form action="" method="POST" class="SubmitForm">
                                               {{ csrf_field() }}
                                               <input type="hidden" name="student_id" value="{{ $student->id }}">
                                               <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                                               <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                                                <tr>
                                                    <td>{{ $student->name }} {{ $student->last_name }}</td>
                                               @php
                                               $i =1;
                                               @endphp
                                                    @foreach($getSubject as $subject)
                                                    @php
                                                        $getMark = $subject->getMark($student->id,Request::get('exam_id'),
                                                        Request::get('class_id'),$subject->subject_id);
                                                    @endphp

                                                    <td>
                                                        <div style="margin-botom:10px">
                                                            Trabajo Clase:
                                                             <input type="hidden" name="mark[{{ $i }}][subject_id]" value="{{ $subject->subject_id }}">
                                                             <input type="text"
                                                             name="mark[{{ $i }}][class_work]"
                                                             style="width: 200px"
                                                             id="class_work_{{ $student->id }}{{ $subject->subject_id }}"
                                                              placeholder="Digite la nota"
                                                              class="form-control"          value="{{ !empty($getMark->class_work) ? $getMark->class_work : '' }}">
                                                        </div>
                                                         <div style="margin-botom:10px">
                                                             Tarea:
                                                             <input type="text"
                                                             name="mark[{{ $i }}][home_work]"
                                                              style="width: 200px"
                                                              placeholder="Digite la nota"
                                                              class="form-control"
                                                               id="home_work_{{ $student->id }}{{ $subject->subject_id }}"
                                                               value="{{ !empty($getMark->home_work) ? $getMark->home_work : '' }}">
                                                        </div>
                                                         <div style="margin-botom:10px">
                                                             Taller:
                                                             <input type="text"
                                                              name="mark[{{ $i }}][test_work]"
                                                               style="width: 200px"
                                                               id="test_work_{{ $student->id }}{{ $subject->subject_id }}"
                                                                placeholder="Digite la nota"
                                                                class="form-control" value="{{ !empty($getMark->test_work) ? $getMark->test_work : '' }}">
                                                        </div>
                                                         <div style="margin-botom:10px">
                                                             Examen:
                                                             <input type="text"
                                                             name="mark[{{ $i }}][exam]"
                                                             style="width: 200px"
                                                              placeholder="Digite la nota"
                                                                id="exam_{{ $student->id }}{{ $subject->subject_id }}"
                                                               class="form-control"
                                                                value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}">
                                                        </div> <br>

                                                         <div style="margin-botom:10px">
                                                            <button type="submit"
                                                           class="btn btn-primary SaveSingleSubject"
                                                     id="{{ $student->id }}"
                                                     data-val="{{ $subject->subject_id }}"
                                                     data-exam="{{ Request::get('exam_id') }}"
                                                     data-class="{{ Request::get('class_id') }}">Guardar</button>
                                                        </div>

                                                     </td>
                                                    @php
                                                    $i++;
                                                    @endphp
                                                @endforeach
                                                <td><button type="submit" class="btn btn-success">Guardar</button></td>
                                                </tr>
                                                </form>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table> <br>
                            </div>
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
        $('.SubmitForm').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ url('admin/examinations/submit_marks_register')}} ",
                data: $(this).serialize(),
                 "_token" : "{{ csrf_token() }}",
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

        $('.SaveSingleSubject').click(function(e){

           var student_id = $(this).attr('id');
           var subject_id = $(this).attr('data-val');
           var exam_id = $(this).attr('data-exam');
           var class_id = $(this).attr('data-class');
           var class_work =$('#class_work_'+student_id+subject_id).val();
           var home_work =$('#home_work_'+student_id+subject_id).val();
           var test_work =$('#test_work_'+student_id+subject_id).val();
           var exam =$('#exam_'+student_id+subject_id).val();
         $.ajax({
                type: "POST",
                url: "{{ url('admin/examinations/single_submit_marks_register')}} ",
                data: {
                   "_token" : "{{ csrf_token() }}",
                    student_id:student_id,
                    subject_id:subject_id,
                    exam_id:exam_id,
                    class_id:class_id,
                    class_work:class_work,
                    home_work:home_work,
                    test_work:test_work,
                    exam:exam
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
