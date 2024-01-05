@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Perfil</h1>
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
            @include('_message')
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
                            value="{{ old('name',$getStudent->name) }} "
                            placeholder="nombre" name="name">
                            <div style="color:red;">
                                {{ $errors->first('name') }}
                               </div>
                         </div>
                        <div class="form-group col-md-6">
                            <label> Apellidos<span style="color: red">*</span> </label>
                            <input type="text" required class="form-control"
                            value="{{ old('last_name',$getStudent->last_name) }}"
                            placeholder="Apellido"
                             name="last_name">
                             <div style="color:red;">
                                {{ $errors->first('last_name') }}
                               </div>
                         </div>
                         <div class="form-group col-md-6">
                            <label> Tipo Documento<span style="color: red"></span> </label>
                            <select name="document_type" id="" required class="form-control">
                                <option value="">Seleccione Tipo Documento</option>
                                <option {{ (old('document_type',$getStudent->document_type)=='CEDULA')?'selected' : '' }} value="CEDULA">CEDULA</option>
                                <option {{ (old('document_type',$getStudent->document_type)=='TI')?'selected' : '' }}  value="TI">TI</option>
                                <option {{ (old('document_type',$getStudent->document_type)=='REGISTRO_CIVIL')?'selected' : '' }}  value="REGISTRO_CIVIL">REGISTRO CIVIL</option>
                                <option {{ (old('document_type',$getStudent->document_type)=='PASAPORTE')?'selected' : '' }} value="PASAPORTE">PASAPORTE</option>
                                <option {{ (old('document_type',$getStudent->document_type)=='OTRO')?'selected' : '' }} value="OTRO">OTRO</option>
                            </select>
                            <div style="color:red;">
                                {{ $errors->first('document_type') }}
                               </div>
                         </div>


                         <div class="form-group col-md-6">
                            <label> Numero de Documento<span style="color: red"></span> </label>
                            <input type="text" class="form-control"
                            value="{{ old('roll_number',$getStudent->roll_number) }}"
                            placeholder="Documento" name="roll_number">
                         </div>



                         <div class="form-group col-md-6">
                            <label> Genero<span style="color: red"></span> </label>
                            <select name="gender" id="" required class="form-control">
                                <option value="">Seleccione Sexo</option>
                                <option {{ (old('gender',$getStudent->gender)=='Male')?'selected' : '' }} value="Male">Masculino</option>
                                <option {{ (old('gender',$getStudent->gender)=='Female')?'selected' : '' }}  value="Female">Femenino</option>
                                <option {{ (old('gender',$getStudent->gender)=='Other')?'selected' : '' }} value="Other">Otro</option>
                            </select>
                            <div style="color:red;">
                                {{ $errors->first('gender') }}
                               </div>
                         </div>

                         <div class="form-group col-md-6">
                            <label> Fecha Matricula<span style="color: red">*</span> </label>
                            <input type="date" required class="form-control"
                            value="{{ old('date_of_birth',$getStudent->date_of_birth) }}"
                            placeholder="Fecha Matricula" name="date_of_birth">
                         </div>

                         <div class="form-group col-md-6">
                            <label> Raza<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('caste',$getStudent->caste) }}"
                            placeholder="Raza" name="caste">
                         </div>

                         <div class="form-group col-md-6">
                            <label> Religion<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('religion',$getStudent->religion) }}"
                            placeholder="" name="religion">
                         </div>
                         <div class="form-group col-md-6">
                            <label> Estrato Social<span style="color: red"></span> </label>
                            <select name="social_stratum" id="" required class="form-control">
                                <option value="">Seleccione Estrato</option>
                                <option {{ ($getStudent->social_stratum == '1')? 'selected' : ''}} value="1">uno</option>
                                <option {{ ($getStudent->social_stratum == '2')? 'selected' : ''}} value="2">dos</option>
                                <option {{ ($getStudent->social_stratum == '3')? 'selected' : ''}} value="3">tres</option>

                                {{--  <option value="1">Uno</option>
                                <option value="2">Dos</option>
                                <option value="3">Tres</option>  --}}
                            </select>
                         </div>
                         <div class="form-group col-md-6">
                            <label> Celular<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('mobile_number',$getStudent->mobile_number) }}"
                            placeholder="" name="mobile_number">
                         </div>


                         <div class="form-group col-md-6">
                            <label> Foto<span style="color: red"></span> </label>
                            <input type="file" name="profile_pic"
                             class="form-control">
                             @if(!empty($getStudent->getProfile()))
                             <img src="{{ $getStudent->getProfile() }}" style="width:100px;" >
                             @endif
                         </div>
                         <div class="form-group col-md-6">
                            <label> Grupo Sanguineo<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('blood_group',$getStudent->blood_group) }}"
                            placeholder="" name="blood_group">
                         </div>
                         <div class="form-group col-md-6">
                            <label> Direccion <span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('address',$getStudent->address) }}"
                            placeholder="" name="address">
                         </div>
                         <div class="form-group col-md-6">
                            <label> EPS<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('eps',$getStudent->eps) }}"
                            placeholder="" name="eps">
                         </div>
                         <div class="form-group col-md-6">
                            <label> Altura<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('height',$getStudent->height) }}"
                            placeholder="" name="height">
                         </div>
                         <div class="form-group col-md-6">
                            <label> Peso<span style="color: red"></span> </label>
                            <input type="text"  class="form-control"
                            value="{{ old('weight',$getStudent->weight) }}"
                            placeholder="" name="weight">
                         </div>


                    </div>
                    <hr> <h2 class="text-center"> <b>Datos de ingreso</b></h2>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email"
                     name="email"
                    class="form-control"
                    value="{{ old('email' ,$getStudent->email) }}"
                      placeholder="Enter email">
                      <div style="color:red;">
                         {{ $errors->first('email') }}
                        </div>

                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit"
                  class="btn btn-warning">Editar</button>
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
