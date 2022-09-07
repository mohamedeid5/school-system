<?php

namespace App\Repositories;

use App\Http\Traits\ZoomMeeting;
use App\Interfaces\OnlineClassRepositoryInterface;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\OnlineClass;
use App\Models\Section;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineClassRepository implements OnlineClassRepositoryInterface
{

    use ZoomMeeting;

    public function index()
    {
        $onlineClasses = OnlineClass::all();

        return view('pages.online_classes.index', compact('onlineClasses'));
    }

    public function create()
    {
        $grades = Grade::all();
        $classrooms = Classroom::all();
        $sections = Section::all();

        return view('pages.online_classes.create', compact('grades', 'classrooms', 'sections'));
    }

    public function indirectCreate()
    {
        $grades = Grade::all();
        $classrooms = Classroom::all();
        $sections = Section::all();

        return view('pages.online_classes.indirect', compact('grades', 'classrooms', 'sections'));
    }


    public function store($request)
    {
        $meeting = $this->createMeeting($request);

        OnlineClass::create([
           'integration' => true,
           'grade_id' => $request->grade_id,
           'classroom_id' => $request->classroom_id,
           'section_id' => $request->section_id,
           'user_id' => auth()->user()->id,
           'meeting_id' => $meeting->id,
           'topic' => $request->topic,
           'start_time' => $request->start_time,
           'duration' => $request->duration,
           'start_url' => $meeting->start_url,
           'join_url' => $meeting->join_url,
        ]);

        return redirect()->route('online-classes.index');
    }

    public function indirectStore($request)
    {
        OnlineClass::create([
            'integration' => false,
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'section_id' => $request->section_id,
            'user_id' => auth()->user()->id,
            'meeting_id' => $request->meeting_id,
            'password' => $request->password,
            'topic' => $request->topic,
            'start_time' => $request->start_time,
            'duration' => $request->duration,
            'start_url' => $request->start_url,
            'join_url' => $request->join_url,
        ]);

        return redirect()->route('online-classes.index');
    }


    public function destroy($id)
    {
        $onlineClass = OnlineClass::findOrFail($id);
        $onlineClass->delete();

        if ($onlineClass->integration) {
            $this->deleteMeeting($onlineClass->meeting_id);
        }

        return redirect()->route('online-classes.index');
    }
}
