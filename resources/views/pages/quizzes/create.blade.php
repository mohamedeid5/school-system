@extends('layouts.master')

    @section('title')
        {{ __('quizzes.add_new_quiz') }}
    @stop

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('quizzes.store')}}" method="post" autocomplete="off">
                                @csrf

                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{ __('quizzes.quiz_name_ar') }}</label>
                                        <input type="text" name="name_ar" value="{{ old('name_ar') }}" class="form-control">
                                    </div>

                                    <div class="col">
                                        <label for="title">{{ __('quizzes.quiz_name_en') }}</label>
                                        <input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="grade_id">{{ __('main.subject') }}: <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="subject_id">
                                                <option selected disabled>{{ __('main.choose') }}</option>
                                                @foreach($subjects as $subject)
                                                    <option  value="{{ $subject->id }}" {{ $subject->id == old('subject_id') ? 'selected' : '' }}>{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="teacher_id">{{ __('main.teacher_name') }} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="teacher_id">
                                                <option selected disabled>{{ __('main.choose') }}</option>
                                                @foreach($teachers as $teacher)
                                                    <option  value="{{ $teacher->id }}" {{ $teacher->id == old('teacher_id') ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="grade_id">{{__('main.grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="grade_id">
                                                <option selected disabled>{{trans('main.choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option  value="{{ $grade->id }}" {{ $grade->id == old('grade_id') ? 'selected' : '' }}>{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="classroom_id">{{trans('main.classrooms')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="classroom_id">
                                                @if(old('classroom_id'))
                                                    @foreach($classrooms as $classroom)
                                                        <option  value="{{ $classroom->id }}" {{ $classroom->id == old('classroom_id') ? 'selected' : '' }}>{{ $grade->name }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('main.section')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id">
                                                @if(old('section_id'))
                                                    @foreach($sections as $section)
                                                        <option  value="{{ $section->id }}" {{ $section->id == old('section_id') ? 'selected' : '' }}>{{ $grade->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit"> {{ __('main.submit') }}</button>
                            </form>
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
