<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\JourneysModel;
use App\Models\HeadquartersModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class StudentController extends Controller
{
      //
      public function list()
      {
          $data['getRecord'] = User::getStudent();
          $data['header_title'] = 'Estudiantes';
          return view('admin.student.list',$data);
      }

      public function add()
      {
         $data['getRecord'] = ClassModel::getClassSubject();
         $data['getJourney'] = JourneysModel::getJourneySelect();
         $data['getHeadquater'] = HeadquartersModel::getHeadquaterSelect();
          $data['header_title'] = 'Add Estudiante';
          return view('admin.student.add',$data);
      }

      public function insert(Request $request) {

        //valida si el correo ya esta en el sistema
        request()->validate([
            'email' => 'required|email|unique:users',
             'name' => 'max:250',
             'admission_number' => 'max:50',
             'roll_number' => 'max:50',
             'height' => 'max:20',
             'weight' => 'max:20',
             'mobile_number' => 'max:20|min:10',
             'caste' => 'max:50',
             'eps' => 'max:50',
             'blood_group' => 'max:10'
        ]);

        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->document_type = trim($request->document_type);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->headquarter_id = trim($request->headquarter_id);
        $student->journey_id = trim($request->journey_id);
        $student->gender = trim($request->gender);
        if(!empty($request->date_of_birth))
        {
            $student->date_of_birth = trim($request->date_of_birth);
        }

        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->social_stratum = trim($request->social_stratum);
        $student->mobile_number = trim($request->mobile_number);
        if(!empty($request->admission_date))
        {
            $student->admission_date = trim($request->admission_date);
        }

        if(!empty($request->file('profile_pic')))
        {


            $ext=$request->file('profile_pic')->getClientOriginalExtension();
            $file =$request->file('profile_pic');
            $randomStr=date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);
            $student->profile_pic=$filename;
        }

        $student->blood_group = trim($request->blood_group);
        $student->eps = trim($request->eps);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->status = trim($request->status);

        $student->user_type = 3;

        $student->save();

        return redirect('admin/student/list')->with('success','Estudiante agregado al sistema');
      }

      public function edit($id)
      {
          $data['getStudent'] = User::getSingle($id);
          if(!empty($data['getStudent']))
          {

            $data['getRecord'] = ClassModel::getClassSubject();
            $data['getJourney'] = JourneysModel::getJourneySelect();
            $data['getHeadquater'] = HeadquartersModel::getHeadquaterSelect();
            $data['header_title'] = 'Editar Estudiante';
              return view('admin.student.edit',$data);
          }
          else
          {
              abort(404);
          }

      }


public function update($id, Request $request)
{
   //valida si el correo ya esta en el sistema
   request()->validate([
    'email' => 'required|email|unique:users,email,'.$id,
     'name' => 'max:250',
     'admission_number' => 'max:50',
     'roll_number' => 'max:50',
     'height' => 'max:20',
     'weight' => 'max:20',
     'mobile_number' => 'max:20|min:10',
     'caste' => 'max:50',
     'eps' => 'max:50',
     'blood_group' => 'max:10'
]);

$student = User::getSingle($id);
$student->name = trim($request->name);
$student->last_name = trim($request->last_name);
$student->document_type = trim($request->document_type);


$student->admission_number = trim($request->admission_number);
$student->roll_number = trim($request->roll_number);
$student->class_id = trim($request->class_id);
$student->headquarter_id = trim($request->headquarter_id);
$student->journey_id = trim($request->journey_id);
$student->gender = trim($request->gender);
if(!empty($request->date_of_birth))
{
    $student->date_of_birth = trim($request->date_of_birth);
}

$student->caste = trim($request->caste);
$student->religion = trim($request->religion);
$student->social_stratum = trim($request->social_stratum);
$student->mobile_number = trim($request->mobile_number);
if(!empty($request->admission_date))
{
    $student->admission_date = trim($request->admission_date);
}

if(!empty($request->file('profile_pic')))
{
         if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_pic);
            }

    $ext=$request->file('profile_pic')->getClientOriginalExtension();
    $file =$request->file('profile_pic');
    $randomStr=date('Ymdhis').Str::random(20);
    $filename = strtolower($randomStr).'.'.$ext;
    $file->move('upload/profile/',$filename);
    $student->profile_pic=$filename;
}

$student->blood_group = trim($request->blood_group);
$student->eps = trim($request->eps);
$student->height = trim($request->height);
$student->weight = trim($request->weight);
$student->status = trim($request->status);
$student->email = trim($request->email);

if(!empty($request->password))
{
    $student->password = Hash::make($request->password);
}
$student->save();

return redirect('admin/student/list')->with('success','Estudiante editado con exito');
    }

   // eliminar admin
   public function delete($id) {
    $student = User::getSingle($id);
    $student->is_delete = 1;
    $student->save();
    return redirect('admin/student/list')->with('success','Estudiante eliminado con exito');

}






}
