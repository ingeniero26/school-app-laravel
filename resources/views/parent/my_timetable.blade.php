@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h2>
                            <i class="fas fa-american-sign-language-interpreting"></i>
                              Horario-Clase( {{ $getClass->name }}-{{ $getSubject->name }}) - <span style="color: blue">({{ $getStudent->name }}-{{ $getStudent->last_name }} ) </span> </h2>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->

                            <div class="card">
                          <div class="card-header">
                            <h3 class="card-title"> <b>
                                {{ $getClass->name }}-{{ $getSubject->name }}</b>
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
                                @foreach ( $getRecord as $valueW )
                                    <tr>
                                        <th>{{ $valueW['week_name'] }}</th>
                                        <th>{{!empty($valueW['start_time'])? date('h: i A',strtotime($valueW['start_time'])) : '' }}</th>
                                        <th>{{!empty($valueW['end_time'])? date('h: i A',strtotime($valueW['end_time'])) : '' }}</th>
                                        <th>{{ $valueW['room_number'] }}</th>
                                    </tr>
                                @endforeach
                              </tbody>
                            </table><br>
                          </div>
                          <!-- /.card-body -->
                        </div>
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



{{--  <script type="text/javascript">
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
</script>  --}}


