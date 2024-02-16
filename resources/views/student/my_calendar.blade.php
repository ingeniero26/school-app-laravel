@extends('layouts.app')

@section('style')
    <style type="text/css">
    .fc-daygrid-event{

        white-space: normal;
    }
</style>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calendario Academico</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">

            <div id="calendar"></div>

          </div>
        </div>
      </div>
    </section>

  </div>

@endsection

@section('script')
<script src="{{ url('public/dist/fullcalendar/index.global.js') }}"></script>
<script>
var events = new Array();
@foreach ($getMyTimetable as  $value )
    @foreach ($value['week'] as $week)
        events.push({
            title:'{{ $value['name'] }}',
            daysOfWeek:[{{ $week['fullcalendar_day'] }}],
            startTime:'{{ $week['start_time'] }}',
            endtTime:'{{ $week['end_time'] }}'
        });
    @endforeach
@endforeach

@foreach ($getExamTimetable as  $valueE )
    @foreach ($valueE['exam'] as $exam)
        events.push({
            title:'{{ $valueE['name'] }} Asignatura {{ $exam['subject_name'] }} {{ date('h:i A',strtotime($exam['start_time'])) }} a:{{ date('h:i A',strtotime($exam['end_time'])) }}- Salon: {{ $exam['room_number'] }} ',
            start:'{{ $exam['exam_date'] }}',
            end:'{{ $exam['exam_date'] }}',
            color:'#001f3f',
            url:'{{ url('student/my_exam_timetable') }}'

        });
    @endforeach
@endforeach

       var calendarID = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarID, {
          headerToolbar: {
            left:'prev,next today',
            center:'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
          },
          initialDate: '<?=date('Y-m-d')?>',
          navLinks:true,
          editable:false,
          events:events,
          initialView:'dayGridMonth',
          locales: 'es',
        });
        calendar.render();

</script>
@endsection
