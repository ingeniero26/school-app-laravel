@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Resultado de <span style="color: blue">    ({{ $getStudent->name }} - {{ $getStudent->last_name }})</span></h1>
        </div>

      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        
            
         @foreach ($getRecord as $value )
        <div class="col-md-12">
           
          <div class="card">
            <div class="card-header">
               <h3 class="card-title"><b> {{$value['exam_name']}}</b> </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-striped" id="example2">
                <thead>
                  <tr>
                    <th>Aignatura</th>
                    <th>Trabajo Clase</th>
                    <th>Tarea</th>
                    <th>Taller</th>
                    <th>Examen</th>
                     <th>Total</th>
                    <th>Nota Maxima</th>
                    <th>Nota Minima</th>
                    <th>Estado</th>
                   
                    
                   </tr>
                </thead>
                <tbody>
                    @php
                        $total_score =0;
                        $full_marks =0;
                        $result_validation =0;
                    @endphp
                @foreach($value['subject'] as $exam)
                  @php
                        $total_score =$total_score  + $exam['total_score'];
                        $full_marks =$full_marks  + $exam['full_marks'];
                    @endphp
                       <tr>
                           <td>{{$exam['subject_name'] }}</td>
                           <td>{{$exam['class_work'] }}</td>
                           <td>{{$exam['test_work'] }}</td>
                           <td>{{$exam['home_work'] }}</td>
                           <td>{{$exam['exam'] }}</td>
                           <td>{{$exam['total_score'] }}</td>
                           <td>{{$exam['full_marks'] }}</td>
                           <td>{{$exam['passing_mark'] }}</td>
                           <td>
                           @if($exam['total_score'] >= $exam['passing_mark'])
                           <span style="color:aqua; font-weight: bold">Aprobado</span>
                           @else
                           @php
                               $result_validation = 1;
                           @endphp
                            <span style="color:red font-weight: bold">Perdiste</span>
                           @endif
                           </td>
                        
                       </tr>
                    @endforeach  
                    <tr>
                        <td colspan="2">
                            <b>Totales:
                                 {{ $total_score }} /{{ $full_marks }}
                                </b>
                        </td>
                        <td colspan="3">
                            <b>Porcentaje:
                                 {{  round(( $total_score * 100 ) / $full_marks,2) }} %
                                </b>
                        </td>
                        <td colspan="5">
                            <b>Estado:
                                 @if($result_validation == 0) 
                                 <span style="color: blue">Aprobaste</span>
                                 @else
                                <span style="color: red">Perdiste</span>
                                 @endif
                            </b>
                        </td>
                    </tr>
               </tbody>
              </table>
              {{--  <div style="padding:10px; float:right;">
                   {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>  --}}
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        @endforeach
        <!-- /.col -->

        <!-- /.row -->

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

<script>
     $(function () {
    $("#example2").DataTable({
      "responsive": true,
       "lengthChange":
       false,
       "autoWidth":
       false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

  });
</script>

@endsection

