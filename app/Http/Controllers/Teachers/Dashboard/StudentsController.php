<?php

namespace App\Http\Controllers\Teachers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceSearchRequest;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index()
    {
        $sectionIds = Teacher::find(auth()->user()->id)->sections()->pluck('section_id')->toArray();
        $students = Student::query();
        $grades = Grade::all();
        $classrooms = Classroom::all();
        $sections = Section::all();

        $students->when(request('grade'), function ($q) use ($sectionIds) {
            return $q->where('grade_id', request('grade'))->whereIn('section_id', $sectionIds);
        });

        $students->when(request('classroom'), function ($q) use ($sectionIds) {
            return $q->where('classroom_id', request('classroom'))->whereIn('section_id', $sectionIds);
        });

        $students->when(request('section'), function ($q) use ($sectionIds) {
            return $q->where('section_id', request('section'))->whereIn('section_id', $sectionIds);
        });

        $students = $students->whereIn('section_id',$sectionIds)->get();

        return view('pages.teachers.dashboard.students.index', compact('students', 'grades', 'classrooms', 'sections'));
    }

    public function sections()
    {
        $sections = Teacher::find(auth()->user()->id)->sections()->get();

        return view('pages.teachers.dashboard.sections.index', compact('sections'));
    }

    public function attendance(Request $request)
    {

        foreach ($request->attendances as $studentId => $attendance) {

            if ($attendance == 'presence') {
                $attendance_status = 1;
            } elseif ($attendance == 'absent') {
                $attendance_status = 0;
            }

            Attendance::updateOrCreate([
                'student_id'=>$studentId,
                'attendance_date' => date('Y-m-d')
            ], [
                'student_id' => $studentId,
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                'teacher_id' => auth()->user()->id,
                'attendance_date' => date('Y-m-d'),
                'attendance_status' => $attendance_status,

            ]);

        }

        return redirect()->back();
    }


    public function attendanceReport()
    {

        $sectionIds = Teacher::find(auth()->user()->id)->sections()->pluck('section_id')->toArray();
        $students = Student::whereIn('section_id', $sectionIds)->get();

        return view('pages.teachers.dashboard.students.attendance_report', compact('students'));
    }

    public function attendanceSearch(AttendanceSearchRequest $request)
    {

        $sectionIds = Teacher::find(auth()->user()->id)->sections()->pluck('section_id')->toArray();
        $students = Student::whereIn('section_id', $sectionIds)->get();

        if ($request->student_id == 0) {

            $studentsSearch = Attendance::whereBetween('attendance_date', [$request->from, $request->to])->get();
        } else {
            $studentsSearch = Attendance::whereBetween('attendance_date', [$request->from, $request->to])
                                    ->where('student_id', $request->student_id)
                                    ->get();
        }

        return view('pages.teachers.dashboard.students.attendance_report',compact('students', 'studentsSearch'));
    }

}
