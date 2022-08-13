@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('students.edit_students') }}
@stop
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">


                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('students.update', $student->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="old_password" value="{{ $student->password }}">
                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('students.email')}}</label>
                                        <input type="email" value="{{ old('email', $student->email) }}" name="email" class="form-control">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('students.password')}}</label>
                                        <input type="password" value="{{ old('password') }}" name="password" class="form-control">
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>


                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('students.name_ar')}}</label>
                                        <input type="text" value="{{ old('name_ar', $student->getTranslation('name', 'ar')) }}" name="name_ar" class="form-control">
                                        @error('name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('students.name_en')}}</label>
                                        <input type="text" value="{{ old('name_en', $student->getTranslation('name', 'en')) }}" name="name_en" class="form-control">
                                        @error('name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('students.date_of_birth')}}</label>
                                        <div class='input-group date'>
                                            <input class="form-control" value="{{ old('date_birth', $student->date_birth) }}" type="text"  id="datepicker-action" name="date_birth" data-date-format="yyyy-mm-dd"  required>
                                        </div>
                                        @error('date_birth')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender">{{trans('students.gender')}} : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="gender_id">
                                            <option selected disabled>{{trans('parents.choose')}}...</option>
                                            @foreach($genders as $gender)
                                                <option  value="{{ $gender->id }}" {{ $gender->id == old('gender_id', $student->gender_id) ? 'selected' : '' }} >{{ $gender->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nal_id">{{trans('students.nationality')}} : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="nationality_id">
                                            <option selected disabled>{{trans('parents.choose')}}...</option>
                                            @foreach($nationalities as $nationality)
                                                <option  value="{{ $nationality->id }}" {{ $nationality->id == old('nationality_id', $student->nationality_id) ? 'selected' : '' }} >{{ $nationality->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bg_id">{{trans('students.blood_type')}} : </label>
                                        <select class="custom-select mr-sm-2" name="blood_id">
                                            <option selected disabled>{{trans('parents.choose')}}...</option>
                                            @foreach($bloods as $blood)
                                                <option value="{{ $blood->id }}" {{ $blood->id == old('blood_id', $student->blood_id) ? 'selected' : '' }} >{{ $blood->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('students.student_information')}}</h6><br>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('students.grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="grade_id">
                                                <option selected disabled>{{trans('parents.choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option  value="{{ $grade->id }}" {{ $grade->id == old('grade_id', $student->grade_id) ? 'selected' : '' }} >{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="classroom_id">{{trans('students.classrooms')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="classroom_id">
                                                @foreach($classrooms as $classroom)
                                                    <option value="{{ $classroom->id }}" {{ $classroom->id == old('classroom_id', $student->classroom_id) ? 'selected' : '' }} >{{ $classroom->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('students.section')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id">
                                                @foreach($sections as $section)
                                                    <option value="{{ $section->id }}" {{ $section->id == old('section_id', $student->section_id) ? 'selected' : '' }} >{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="parent_id">{{trans('students.parent')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="parent_id">
                                                <option selected disabled>{{trans('parents.choose')}}...</option>
                                                @foreach($parents as $parent)
                                                    <option value="{{ $parent->id }}" {{ $parent->id == old('parent_id', $student->parent_id) ? 'selected' : '' }} >{{ $parent->father_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="academic_year">{{trans('students.academic_year')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="academic_year">
                                                <option selected disabled>{{trans('parents.choose')}}...</option>
                                                @php
                                                    $current_year = date("Y");
                                                @endphp
                                                @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                                    <option value="{{ $year }}" {{ $year == old('academic_year', $student->academic_year) ? 'selected' : '' }} >{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Attachments:</label>
                                            <input type="file" accept="image/*" value="{{ old('images') }}" name="images[]" multiple>
                                        </div>
                                    </div>

                                </div>

                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('parents.update')}}</button>
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


