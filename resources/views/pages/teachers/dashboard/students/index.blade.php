@extends('layouts.master')

@section('title')
    {{trans('main.students_list')}}
@stop


@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <form action="{{ route('teacher-students.index', ['grade' => request('grade'), 'classroom' => request('classroom'), 'section' => request('section')]) }}" method="get">

                                    <select class="form-select" name="grade" aria-label="Default select example">
                                        <option value="" selected>Open this select menu</option>
                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}" {{ $grade->id == request('grade') ? 'selected' : '' }}>{{ $grade->name }}</option>
                                        @endforeach
                                    </select>

                                    <select class="form-select" name="classroom" aria-label="Default select example">
                                        <option value="" selected>Open this select menu</option>
                                        @foreach($classrooms as $classroom)
                                            <option value="{{ $classroom->id }}" {{ $classroom->id == request('classroom') ? 'selected' : '' }}>{{ $classroom->name }}</option>
                                        @endforeach
                                    </select>

                                    <select class="form-select" name="section" aria-label="Default select example">
                                        <option value="" selected>Open this select menu</option>
                                        @foreach($sections as $section)
                                            <option value="{{ $section->id }}" {{ $section->id == request('section') ? 'selected' : '' }}>{{ $section->name }}</option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="btn btn-primary btn-sm">search</button>
                                </form>
                                <a href="{{ route('teacher-students.index') }}" class="btn btn-info">reset</a>

                                <div class="table-responsive">
                                    <h5 style="font-family: 'Cairo', sans-serif;color: red"> تاريخ اليوم : {{ date('Y-m-d') }}</h5>
                                    <form method="post" action="{{ route('attendance') }}" autocomplete="off">
                                        @csrf
                                        @method('POST')
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('students.name')}}</th>
                                            <th>{{trans('students.email')}}</th>
                                            <th>{{trans('students.gender')}}</th>
                                            <th>{{trans('students.grade')}}</th>
                                            <th>{{trans('students.classrooms')}}</th>
                                            <th>{{trans('students.section')}}</th>
                                            <th>{{trans('main.attendance')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->email}}</td>
                                                <td>{{$student->gender->type}}</td>
                                                <td>{{$student->grade->name}}</td>
                                                <td>{{$student->classroom->name}}</td>
                                                <td>{{$student->section->name}}</td>
                                                <td>

                                                    <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                                        <input name="attendances[{{ $student->id }}]" class="leading-tight" type="radio"
                                                               value="presence"
                                                            {{ $student->attendance->where('attendance_date', date('Y-m-d'))->first()?->attendance_status == '1' ? 'checked' : '' }}
                                                        >
                                                        <span class="text-success">حضور</span>
                                                    </label>

                                                    <label class="ml-4 block text-gray-500 font-semibold">
                                                        <input name="attendances[{{ $student->id }}]" class="leading-tight" type="radio"
                                                               value="absent"
                                                            {{ $student->attendance->where('attendance_date', date('Y-m-d'))->first()?->attendance_status == '0' ? 'checked' : '' }}
                                                        >
                                                        <span class="text-danger">غياب</span>
                                                    </label>


                                                    <input type="hidden" name="grade_id" value="{{ $student->grade_id }}">
                                                    <input type="hidden" name="classroom_id" value="{{ $student->classroom_id }}">
                                                    <input type="hidden" name="section_id" value="{{ $student->section_id }}">

                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>

                                        <button class="btn btn-success" type="submit">{{ trans('main.submit') }}</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
