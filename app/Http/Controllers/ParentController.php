<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function list()
    {
       $data['getRecord'] = User::getParent();
        $data['header_title'] = 'Padre de familia';
        return view('admin.parent.list',$data);
    }
    public function add()
    {
      // $data['getRecord'] = ClassModel::getClassSubject();
     //  $data['getJourney'] = JourneysModel::getJourneySelect();
    //   $data['getHeadquater'] = HeadquartersModel::getHeadquaterSelect();
        $data['header_title'] = 'Add Padre de familia';
        return view('admin.parent.add',$data);
    }

    public function insert(Request $request) {

        //valida si el correo ya esta en el sistema
        request()->validate([
            'email' => 'required|email|unique:users',
             'name' => 'max:250',
            
             'roll_number' => 'max:50',
           
             'mobile_number' => 'max:20|min:10'
            
        ]);

        $parent = new User;
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->document_type = trim($request->document_type);
        $parent->email = trim($request->email);
        $parent->password = Hash::make($request->password);
        $parent->roll_number = trim($request->roll_number);
        $parent->gender = trim($request->gender);
      
         if(!empty($request->file('profile_pic')))
            {


                $ext=$request->file('profile_pic')->getClientOriginalExtension();
                $file =$request->file('profile_pic');
                $randomStr=date('Ymdhis').Str::random(20);
                $filename = strtolower($randomStr).'.'.$ext;
                $file->move('upload/profile/',$filename);
                $parent->profile_pic=$filename;
            }
        $parent->address = trim($request->address);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->occupation = trim($request->occupation);
             
        $parent->status = trim($request->status);

        $parent->user_type = 4;

        $parent->save();

        return redirect('admin/parent/list')->with('success','Padre de familia agregado al sistema');
    }

    public function edit($id)
    {
        $data['getParent'] = User::getSingle($id);
        if(!empty($data['getParent']))
        {

        //  $data['getRecord'] = ClassModel::getClassSubject();
       //   $data['getJourney'] = JourneysModel::getJourneySelect();
       //   $data['getHeadquater'] = HeadquartersModel::getHeadquaterSelect();
          $data['header_title'] = 'Editar Estudiante';
            return view('admin.parent.edit',$data);
        }
        else
        {
            abort(404);
        }

    }

    public function update($id, Request $request){

        //valida si el correo ya esta en el sistema
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
             'name' => 'max:250',
            
             'roll_number' => 'max:50',
           
             'mobile_number' => 'max:20|min:10'
            
        ]);

        $parent = User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->document_type = trim($request->document_type);
        $parent->email = trim($request->email);
        $parent->password = Hash::make($request->password);
        $parent->roll_number = trim($request->roll_number);
        $parent->gender = trim($request->gender);
      
        if(!empty($request->file('profile_pic')))
        {
                 if(!empty($parent->getProfile()))
                    {
                        unlink('upload/profile/'.$parent->profile_pic);
                    }
        
            $ext=$request->file('profile_pic')->getClientOriginalExtension();
            $file =$request->file('profile_pic');
            $randomStr=date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/',$filename);
            $parent->profile_pic=$filename;
        }
        $parent->address = trim($request->address);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->occupation = trim($request->occupation);
             
        $parent->status = trim($request->status);

       
        $parent->save();

        return redirect('admin/parent/list')->with('success','Padre de familia editado al sistema');
    }


    public function delete($id) {
        $student = User::getSingle($id);
        $student->is_delete = 1;
        $student->save();
        return redirect('admin/parent/list')->with('success','Padre de familia eliminado con exito');
    
    }

    //estudiante-padre

    public function myStudent($id) {
        $data['getParent'] = User::getSingle($id);
        $data['parent_id'] =$id;
        $data['getSearchStudent'] = User::getSearchStudent();
        $data['getRecord'] = User::getMyStudent($id);
        $data['header_title'] = 'Padre de familia -Estudiante';
        return view('admin.parent.my_student',$data);
    }

    public function AssignStudentParent($student_id, $parent_id)
    {
        $student = User::getSingle($student_id);
        $student->parent_id =$parent_id;
        $student->save();
        return redirect()->back()->with('success','Registro agregado');
    }
    public function AssignStudentParentDelete($student_id)
    {
        $student = User::getSingle($student_id);
        $student->parent_id =null;
        $student->save();
        return redirect()->back()->with('success','Registro Eliminado');
    }

    

}
