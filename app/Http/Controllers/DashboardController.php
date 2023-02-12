<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function teacherDashboard()
    {
        $sectionIds = Teacher::find(auth()->user()->id)->sections()->pluck('section_id');
        $sectionsCount = $sectionIds->count();
        $studentCount = Student::whereIn('section_id', $sectionIds)->count();

        return view('pages.teachers.dashboard.dashboard', compact('sectionsCount', 'studentCount'));
    }
}
