@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro de Noticias</h1>
          </div>

        </div>
      </div>
    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <form method="post">
                {{ @csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Titulo</label>
                    <input type="text" class="form-control"
                    value="{{ old('title',$getRecord->title) }}"
                     placeholder="Titulo" name="title">
                  </div>
                  <div class="form-group">
                    <label>Fecha Notificación</label>
                    <input type="date" class="form-control"
                    value="{{ old('notice_date',$getRecord->notice_date) }}"
                     name="notice_date">
                  </div>
                  <div class="form-group">
                    <label>Fecha Publicacion</label>
                    <input type="date" class="form-control"
                    value="{{ old('title',$getRecord->notice_date) }}"
                      name="publish_date">
                  </div>

                  @php
                      $message_to_student=$getRecord->getMessageToSingle($getRecord->id,3);
                      $message_to_parent=$getRecord->getMessageToSingle($getRecord->id,4);
                      $message_to_teacher=$getRecord->getMessageToSingle($getRecord->id,2);
                  @endphp


                   <div class="form-group">
                    <label style="display: block">Mensaje para</label> <br>
                    <label style="margin-right: 50px">
                      <input type="checkbox"  {{ !empty($message_to_student)  ? 'checked' : ''}}
                       value="3"  name="message_to[]" >Estudiante
                    </label>
                    <label style="margin-right: 50px">
                      <input type="checkbox"  {{ !empty($message_to_parent)  ? 'checked' : ''}} value="4"  name="message_to[]">Padre de familia
                    </label>
                    <label>
                      <input type="checkbox"  {{ !empty($message_to_teacher)  ? 'checked' : ''}} value="2"   name="message_to[]">Docente
                    </label>
                  </div>

                  <div class="form-group">
                    <label>Mensaje</label>
                    <textarea id="compose-textarea"
                      name="message"  class="form-control"
                     style="height: 300px">{{  $getRecord->message }}</textarea>
                  </div>


                </div>
               <div class="card-footer">
                  <button type="submit"
                  class="btn btn-warning">Editar</button>
                </div>
              </form>
            </div>

          </div>

        </div>
      </div>
    </section>

  </div>

@endsection
@section('script')

<script src="{{ url('public/plugins/summernote/summernote-bs4.min.js') }}"></script>


<script>
 $(function () {
    //Add text editor
    $('#compose-textarea').summernote({
        height: 150,
        codemirror: {
            theme:'monokai'
        }
    });
  });
</script>
@endsection
