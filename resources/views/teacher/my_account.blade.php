@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Perfil</h1>
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
                                                value="{{ old('name', $getTeacher->name) }}" placeholder="nombre"
                                                name="name">
                                            <div style="color:red;">
                                                {{ $errors->first('name') }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label> Apellidos<span style="color: red">*</span> </label>
                                            <input type="text" required class="form-control"
                                                value="{{ old('last_name', $getTeacher->last_name) }}" placeholder="Apellido"
                                                name="last_name">
                                            <div style="color:red;">
                                                {{ $errors->first('last_name') }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label> Tipo Documento<span style="color: red"></span> </label>
                                            <select name="document_type" id="" required class="form-control">
                                                <option value="">Tipo Documento</option>
                                                <option
                                                    {{ old('document_type', $getTeacher->document_type) == 'CEDULA' ? 'selected' : '' }}
                                                    value="CEDULA">CEDULA</option>
                                                <option
                                                    {{ old('document_type', $getTeacher->document_type) == 'TI' ? 'selected' : '' }}
                                                    value="TI">TI</option>
                                                <option
                                                    {{ old('document_type', $getTeacher->document_type) == 'PASAPORTE' ? 'selected' : '' }}
                                                    value="PASAPORTE">PASAPORTE</option>
                                                <option
                                                    {{ old('document_type', $getTeacher->document_type) == 'OTRO' ? 'selected' : '' }}
                                                    value="OTRO">Otro</option>
                                            </select>
                                            <div style="color:red;">
                                                {{ $errors->first('gender') }}
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label> Número<span style="color: red"></span> </label>
                                            <input type="text" class="form-control"
                                                value="{{ old('roll_number', $getTeacher->roll_number) }}"
                                                placeholder="Documento" name="roll_number">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label> Genero<span style="color: red"></span> </label>
                                            <select name="gender" id="" required class="form-control">
                                                <option value="">Seleccione Sexo</option>
                                                <option {{ old('gender', $getTeacher->gender) == 'Male' ? 'selected' : '' }}
                                                    value="Male">Masculino</option>
                                                <option {{ old('gender', $getTeacher->gender) == 'Female' ? 'selected' : '' }}
                                                    value="Female">Femenino</option>
                                                <option {{ old('gender', $getTeacher->gender) == 'Other' ? 'selected' : '' }}
                                                    value="Other">Otro</option>
                                            </select>
                                            <div style="color:red;">
                                                {{ $errors->first('gender') }}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label> Fecha Nacimiento<span style="color: red">*</span> </label>
                                            <input type="date" required class="form-control"
                                                value="{{ old('date_of_birth', $getTeacher->date_of_birth) }}"
                                                placeholder="Fecha Matricula" name="date_of_birth">
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label> Teléfono<span style="color: red"></span> </label>
                                            <input type="text" class="form-control"
                                                value="{{ old('mobile_number', $getTeacher->mobile_number) }}"
                                                placeholder="Celular" name="mobile_number">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label> Ocupacion<span style="color: red"></span> </label>
                                            <input type="text" class="form-control"
                                                value="{{ old('occupation', $getTeacher->occupation) }}" placeholder=""
                                                name="occupation">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label> Estado Civil<span style="color: red"></span> </label>
                                            <input type="text" class="form-control"
                                                value="{{ old('marital_status', $getTeacher->marital_status) }}"
                                                placeholder="Estado civil" name="marital_status">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label> Direcciòn 1<span style="color: red"></span> </label>
                                            <textarea type="text" class="form-control" value="" placeholder="Direccin de casa" name="address">{{ old('address', $getTeacher->address) }}</textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label> Direcciòn 2<span style="color: red"></span> </label>
                                            <textarea type="text" class="form-control" placeholder="Direccin de trabajo" name="permanent_address">{{ old('permanent_address', $getTeacher->permanent_address) }}</textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label> Calificación<span style="color: red"></span> </label>
                                            <textarea type="text" class="form-control" value="" placeholder="" name="qualification">{{ $getTeacher->qualification }}</textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label> Experiencia<span style="color: red"></span> </label>
                                            <textarea type="text" class="form-control" value="" placeholder="" name="work_experiencie">{{ $getTeacher->work_experiencie }}</textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label> Notas<span style="color: red"></span> </label>
                                            <textarea type="text" class="form-control" value="" placeholder="" name="notes">{{ $getTeacher->notes }}</textarea>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label> Foto<span style="color: red"></span> </label>
                                            <input type="file" name="profile_pic" class="form-control">
                                            @if (!empty($getTeacher->getProfile()))
                                                <img src="{{ $getTeacher->getProfile() }}" style="width:100px;">
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label> Grupo Sanguineo<span style="color: red"></span> </label>
                                            <input type="text" class="form-control"
                                                value="{{ old('blood_group', $getTeacher->blood_group) }}" placeholder=""
                                                name="blood_group">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label> EPS<span style="color: red"></span> </label>
                                            <input type="text" class="form-control"
                                                value="{{ old('eps', $getTeacher->eps) }}" placeholder="" name="eps">
                                        </div>

                                    </div>
                                    <hr>
                                    <h2 class="text-center"> <b>Datos de ingreso</b></h2>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $getTeacher->email) }}" placeholder="Enter email">
                                        <div style="color:red;">
                                            {{ $errors->first('email') }}
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning">Editar</button>
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
