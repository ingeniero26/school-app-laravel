<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\StudentAttendanceModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function AttendanceStudent(Request $request)
    {
        $data['getClass'] = ClassModel::getClassSubject();
        if (!empty($request->get('class_id')) &&
            !empty($request->get('attendance_date'))) {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));

        }
        $data['header_title'] = 'Asistencia';
        return view('admin.attendance.student', $data);
    }

    public function AttendanceStudentSubmit(Request $request)
    {
        $check_attendance = StudentAttendanceModel::CheckAlreadyAttendance(
            $request->student_id,
            $request->class_id,
            $request->attendance_date
        );

        if (!empty($check_attendance)) {
            $attendance = $check_attendance;
        } else {
            $attendance = new StudentAttendanceModel;
            $attendance->student_id = $request->student_id;
            $attendance->class_id = $request->class_id;
            $attendance->attendance_date = $request->attendance_date;
            $attendance->created_by = Auth::user()->id;

        }

        $attendance->attendance_type = $request->attendance_type;

        $attendance->save();

        $json['message'] = 'Registro exitoso';
        echo json_encode($json);
    }

    //reporte
    public function AttendanceReport()
    {
        $data['getClass'] = ClassModel::getClassSubject();
        $data['getRecord'] = StudentAttendanceModel::getRecord();
        $data['header_title'] = 'Reporte';
        return view('admin.attendance.report', $data);
    }
    //reporte docente
    public function AttendanceReportTeacher(Request $request)
    {
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $classarray = array();
        foreach ($getClass as $value) {
            $classarray[] = $value->class_id;
        }
        // dd($classarray);
        $data['getClass'] = $getClass;
        $data['getRecord'] = StudentAttendanceModel::getRecordTeacher($classarray);
        $data['header_title'] = 'Reporte';
        return view('teacher.attendance.report', $data);
    }

    //asistencia modulo docente
    public function AttendanceStudentTeacher(Request $request)
    {
        //$data['getClass'] = ClassModel::getClassSubject();
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        // dd($data['getClass']);
        if (!empty($request->get('class_id')) &&
            !empty($request->get('attendance_date'))) {
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));

        }
        $data['header_title'] = 'Asistencia';
        return view('teacher.attendance.student', $data);
    }

    //asistenai modulo estudiantes
    public function myAttendanceStudent()
    {

        $data['getRecord'] = StudentAttendanceModel::getRecordStudent(Auth::user()->id);
        $data['getClass'] = StudentAttendanceModel::getClassStudent(Auth::user()->id);

        $data['header_title'] = 'Reporte';
        return view('student.my_attendance', $data);
    }
}