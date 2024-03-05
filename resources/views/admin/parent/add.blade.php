@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro de Padres de Familia</h1>
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
                            <label> Tipo Documento<span style="color: red"></span> </label>
                            <select name="document_type" id="" required class="form-control">
                                <option value="">Tipo Documento</option>
                                <option {{ (old('document_type')=='CEDULA')?'selected' : '' }} value="CEDULA">CEDULA</option>
                                <option {{ (old('document_type')=='TI')?'selected' : '' }}  value="TI">TI</option>
                                <option {{ (old('document_type')=='PASAPORTE')?'selected' : '' }}  value="PASAPORTE">PASAPORTE</option>
                                <option {{ (old('document_type')=='OTRO')?'selected' : '' }} value="OTRO">Otro</option>
                            </select>
                            <div style="color:red;">
                                {{ $errors->first('gender') }}
                               </div>
                         </div>
                         <div class="form-group col-md-6">
                            <label> Número<span style="color: red"></span> </label>
                            <input type="text" class="form-control"
                            value="{{ old('roll_number') }}"
                            placeholder="Documento" name="roll_number">
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
                            <label> Foto<span style="color: red"></span> </label>
                            <input type="file" name="profile_pic"  class="form-control"
                           >
                         </div>
                         <div class="form-group col-md-6">
                            <label> Direccion<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('address') }}"
                            placeholder="" name="address">
                         </div>

                         <div class="form-group col-md-6">
                            <label> Celular<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('mobile_number') }}"
                            placeholder="" name="mobile_number">
                         </div>
                         <div class="form-group col-md-6">
                            <label> Ocupacion<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('occupation') }}"
                            placeholder="" name="occupation">
                         </div>
                         <div class="form-group col-md-6">
                            <label> EPS<span style="color: red"></span> </label>
                            <input type="text" class="form-control"
                                value="{{ old('eps') }}" placeholder=""
                                name="eps">
                        </div>
                        <div class="form-group col-md-6">
                            <label> Grupo Sanguineo<span style="color: red"></span> </label>
                            <input type="text" class="form-control"
                                value="{{ old('blood_group') }}" placeholder=""
                                name="blood_group">
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
