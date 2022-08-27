<?php

namespace App\Repositories;

use App\Interfaces\AttendanceRepositoryInterface;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;

class AttendanceRepository implements AttendanceRepositoryInterface
{

    public function index()
    {
        $grades = Grade::with('sections')->get();

        return view('pages.attendance.sections', compact('grades'));
    }

    public function store($request)
    {

        foreach ($request->attendances as $studentId => $attendance) {

            if ($attendance == 'presence') {
                $attendanceStatus = true;
            } else {
                $attendanceStatus = false;
            }

            Attendance::create([
                'student_id' => $studentId,
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                'teacher_id' => 1,
                'attendance_date' =>  date('Y-m-d'),
                'attendance_status' => $attendanceStatus,
            ]);
        }

        return redirect()->back();
    }

    public function show($id)
    {

        $students = Student::with('attendance')->where('section_id', $id)->get();

        return view('pages.attendance.index', compact('students'));
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
