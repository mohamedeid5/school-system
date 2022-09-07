@extends('layouts.master')

@section('title')
{{ __('library.add_new_book') }}
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
                            <form action="{{route('library.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{ __('library.book_name') }}</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>

                                </div>
                                <br>


                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="teacher_id">{{trans('main.teacher')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="teacher_id">
                                                <option selected disabled>{{trans('main.choose')}}...</option>
                                                @foreach($teachers as $teacher)
                                                    <option  value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="grade_id">{{trans('main.grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="grade_id">
                                                <option selected disabled>{{trans('main.choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option  value="{{ $grade->id }}">{{ $grade->name }}</option>
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
                                                            <option  value="{{ $classroom->id }}">{{ $classroom->name }}</option>
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
                                                        <option  value="{{ $section->id }}">{{ $section->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                </div><br>



                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="file_name">{{ __('main.attachments') }} : <span class="text-danger">*</span></label><br>
                                            <input type="file" accept="application/pdf" name="file_name" required>
                                        </div>
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
