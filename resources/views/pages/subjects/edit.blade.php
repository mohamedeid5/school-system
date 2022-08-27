@extends('layouts.master')

@section('title')
    {{ __('subjects.edit_subject') }}
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
                            <form action="{{route('subjects.update', $subject->id)}}" method="post" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ __('subjects.subject_name_ar') }}</label>
                                        <input type="text" name="name_ar" value="{{ $subject->getTranslation('name', 'ar') }}" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="title">{{ __('subjects.subject_name_en') }}</label>
                                        <input type="text" name="name_en" value="{{ $subject->getTranslation('name', 'en') }}" class="form-control">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputState">{{ __('main.grade') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="grade_id">
                                            <option selected disabled>{{__('main.choose')}}...</option>
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->id}}" {{ $grade->id == $subject->grade_id ? 'selected' : '' }}>{{$grade->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col">
                                        <label for="inputState"> {{__('main.classroom')}}</label>
                                        <select name="classroom_id" class="custom-select">
                                            @foreach($classrooms as $classroom)
                                                <option value="{{$classroom->id}}" {{ $classroom->id == $subject->classroom_id ? 'selected' : '' }}>{{$classroom->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group col">
                                        <label for="inputState">{{trans('subjects.teacher_name')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="teacher_id">
                                            <option selected disabled>{{trans('main.choose')}}...</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}" {{ $teacher->id == $subject->teacher_id ? 'selected' : '' }}>{{$teacher->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{ __('main.submit') }}</button>
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
