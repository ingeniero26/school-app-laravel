@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro de Estudiantes</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">

              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Nombre <span style="color: red">*</span> </label>
                            <input type="text" required class="form-control"
                            value="{{ old('name') }}"
                            placeholder="nombre" name="name">
                            <div style="color:red;">
                                {{ $errors->first('name') }}
                               </div>
                         </div>
                        <div class="form-group col-md-6">
                            <label> Apellidos<span style="color: red">*</span> </label>
                            <input type="text" required class="form-control"
                            value="{{ old('last_name') }}"
                            placeholder="Apellido"
                             name="last_name">
                             <div style="color:red;">
                                {{ $errors->first('last_name') }}
                               </div>
                         </div>

                         <div class="form-group col-md-6">
                            <label> Numero de Matricula<span style="color: red">*</span> </label>
                            <input type="text" required class="form-control"
                            value="{{ old('admission_number') }}"
                            placeholder="Matricula No"
                             name="admission_number">
                             <div style="color:red;">
                                {{ $errors->first('admission_number') }}
                               </div>
                         </div>
                         <div class="form-group col-md-6">
                            <label> Numero de Folio<span style="color: red"></span> </label>
                            <input type="text" class="form-control"
                            value="{{ old('roll_number') }}"
                            placeholder="Folio No" name="roll_number">
                         </div>

                         <div class="form-group col-md-6">
                            <label> Programa<span style="color: red">*</span> </label>
                            <select name="class_id" id=""
                            class="form-control" required>
                                <option value="">Seleccione un Programa</option>
                            @foreach($getRecord as $class)
                                <option {{ (old('class_id')==$class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                            </select>
                            <div style="color:red;">
                                {{ $errors->first('class_id') }}
                               </div>
                         </div>
                         <div class="form-group col-md-6">
                            <label> Sede<span style="color: red">*</span> </label>
                            <select name="headquarter_id" id=""
                            class="form-control" required>
                                <option value="">Seleccione un Sede</option>
                            @foreach($getHeadquater as $headquarter)
                                <option value="{{ $headquarter->id }}">{{ $headquarter->name }}</option>
                            @endforeach
                            </select>
                         </div>
                         <div class="form-group col-md-6">
                            <label> Jornada<span style="color: red">*</span> </label>
                            <select name="journey_id" id=""
                            class="form-control" required>
                                <option value="">Seleccione un Jornada</option>
                            @foreach($getJourney as $journey)
                                <option value="{{ $journey->id }}">{{ $journey->name }}</option>
                            @endforeach
                            </select>
                         </div>

                         <div class="form-group col-md-6">
                            <label> Genero<span style="color: red"></span> </label>
                            <select name="gender" id="" required class="form-control">
                                <option value="">Seleccione Sexo</option>
                                <option {{ (old('gender')=='Male')?'selected' : '' }} value="Male">Masculino</option>
                                <option {{ (old('gender')=='Female')?'selected' : '' }}  value="Female">Femenino</option>
                                <option {{ (old('gender')=='Other')?'selected' : '' }} value="Other">Otro</option>
                            </select>
                            <div style="color:red;">
                                {{ $errors->first('gender') }}
                               </div>
                         </div>

                         <div class="form-group col-md-6">
                            <label> Fecha Matricula<span style="color: red">*</span> </label>
                            <input type="date" required class="form-control"
                            value="{{ old('date_of_birth') }}"
                            placeholder="Fecha Matricula" name="date_of_birth">
                         </div>

                         <div class="form-group col-md-6">
                            <label> Raza<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('caste') }}"
                            placeholder="Raza" name="caste">
                         </div>

                         <div class="form-group col-md-6">
                            <label> Religion<span style="color: red"></span> </label>
                            <input type="text"
                            class="form-control"
                            value="{{ old('religion') }}"
                            placeholder="" name="religion">
                         </div>
                         <div class="form-group col-md-6">
                            <label> Estrato Social<span style="color: red"></span> </label>
                            <select name="social_stratum" id="" required class="form-control">
                                <option value="">Seleccione Estrato</option>
                                <option value="1">Uno</option>
                                <option value="2">Dos</option>
                                <option value="3">Tres</option>
                            </select>
                         </div>
                         <div class="form-group col-md-6">
                            <label> Celular<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('mobile_number') }}"
                            placeholder="" name="mobile_number">
                         </div>

                         <div class="form-group col-md-6">
                            <label> Fecha Admision<span style="color: red">*</span> </label>
                            <input type="date" required class="form-control"
                            value="{{ old('admission_date') }}"
                            placeholder="Fecha Admision" name="admission_date">
                         </div>

                         <div class="form-group col-md-6">
                            <label> Foto<span style="color: red"></span> </label>
                            <input type="file" name="profile_pic"  class="form-control"
                           >
                         </div>
                         <div class="form-group col-md-6">
                            <label> Grupo Sanguineo<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('blood_group') }}"
                            placeholder="" name="blood_group">
                         </div>
                         <div class="form-group col-md-6">
                            <label> EPS<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('eps') }}"
                            placeholder="" name="eps">
                         </div>
                         <div class="form-group col-md-6">
                            <label> Altura<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('height') }}"
                            placeholder="" name="height">
                         </div>
                         <div class="form-group col-md-6">
                            <label> Peso<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('weight') }}"
                            placeholder="" name="weight">
                         </div>

                         <div class="form-group col-md-6">
                            <label>Estado</label>
                            <select name="status" id="" class="form-control">
                                <option value="0">Activo</option>
                                <option value="1">Inactivo</option>
                            </select>

                          </div>
                    </div>
                    <hr> <h2 class="text-center"> <b>Datos de ingreso</b></h2>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email"
                     name="email" required
                    class="form-control"
                    value="{{ old('email') }}"
                      placeholder="Enter email">
                      <div style="color:red;">
                         {{ $errors->first('email') }}
                        </div>

                  </div>
                  <div class="form-group">
                    <label >Password</label>
                    <input type="password"
                     class="form-control"
                    name="password" required
                      placeholder="Password">
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit"
                  class="btn btn-primary">Registrar</button>
                </div>
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
