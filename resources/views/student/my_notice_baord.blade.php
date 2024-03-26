@extends('layouts.app')

@section('content')

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mis Noticias</h1>
          </div>
       
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
              <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Buscar</h3>
              </div>

              <form method="get" action="">

                <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label>Nombre</label>
                    <input type="text" class="form-control"
                    value="{{ Request::get('title') }}"
                     placeholder="title" name="title">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Notificacion Inicio</label>
                    <input type="date"
                     name="notice_date_to"
                    class="form-control"
                    value="{{ Request::get('notice_date_to') }}"
                      placeholder="Enter email">

                  </div>
                  <div class="form-group col-md-2">
                    <label>Notificación Fin</label>
                    <input type="date"
                     name="notice_date_from"
                    class="form-control"
                    value="{{ Request::get('notice_date_from') }}"
                      >
                  </div>

                
                  <div class="form-group col-md-3">
                    <button type="submit"
                    class="btn btn-primary"
                     style="margin-top: 30px">
                    Buscar</button>
                    <a href="{{ url('student/my_notice_board') }}"
                    class="btn btn-success"
                     style="margin-top: 30px">Limpiar</a>
                  </div>
                </div>


                </div>

              </form>
            </div>
         

        </div>
        @foreach($getRecord as $value)
        <div class="col-md-12">
          <div class="card card-primary card-outline">
          
           
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5> <b>{{ $value->title }}</b></h5>
                <h6>
                  <span class="mailbox-read-time float-right"
                   style="font-weight: bold; color: #000; font-size:16px">
                    {{ $value->created_at  }}</span></h6>
              </div>
            
            
              <div class="mailbox-read-message">
                {!! $value->message   !!}

               
              </div>
            </div>
         
           
          </div>
        </div>
        @endforeach
        <div class="col-md-12">
            <div style="padding:10px; float:right;">
                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
      </div>
</div>
      </div>
    </section>

  </div>

@endsection
