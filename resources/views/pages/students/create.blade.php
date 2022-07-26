@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('students.add_student')}}
@stop
@endsection
@section('page-header')

<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <form method="post"  action="{{ route('students.store') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('students.personal_information')}}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students.name_ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" name="name_ar" value="{{ old('name_ar') }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students.name_en')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="name_en" value="{{ old('name_en') }}" type="text" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students.email')}} : </label>
                                    <input type="email"  name="email" value="{{ old('email') }}" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('students.password')}} :</label>
                                    <input  type="password" name="password" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{trans('students.gender')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="gender_id">
                                        <option selected disabled>{{trans('parents.choose')}}...</option>
                                        @foreach($genders as $gender)
                                            <option  value="{{ $gender->id }}" {{ $gender->id == old('gender_id') ? 'selected' : '' }} >{{ $gender->type }}</option>
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
                                            <option  value="{{ $nationality->id }}" {{ $nationality->id == old('nationality_id') ? 'selected' : '' }} >{{ $nationality->name }}</option>
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
                                            <option value="{{ $blood->id }}" {{ $blood->id == old('blood_id') ? 'selected' : '' }} >{{ $blood->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{trans('students.date_of_birth')}}  :</label>
                                    <input class="form-control" type="text"  value="{{ old('date_of_birth') }}"  id="datepicker-action" name="date_of_birth" data-date-format="yyyy-mm-dd">
                                </div>
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
                                            <option  value="{{ $grade->id }}" {{ $grade->id == old('grade_id') ? 'selected' : '' }} >{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="classroom_id">{{trans('students.classrooms')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="classroom_id">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{trans('students.section')}} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{trans('students.parent')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="parent_id">
                                        <option selected disabled>{{trans('parents.choose')}}...</option>
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}" {{ $parent->id == old('parent_id') ? 'selected' : '' }} >{{ $parent->father_name }}</option>
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
                                            <option value="{{ $year }}" {{ $year == old('academic_year') ? 'selected' : '' }} >{{ $year }}</option>
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

                        </div><br>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('students.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                let grade_id = $(this).val();
                if(grade_id) {

                    $.ajax({
                        url: "{{ url('classes') }}/" + grade_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data){
                            $('select[name="classroom_id"]').empty();
                            $('select[name="classroom_id"]').append('<option selected disabled >{{trans('parents.choose')}}...</option>');

                            $.each(data, function (key, value){
                                $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    })
                }
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            $('select[name="classroom_id"]').on('change', function () {
                let classroom_id = $(this).val();
                if(classroom_id) {

                    $.ajax({
                        url: "{{ url('get-sections')  }}/" + classroom_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data){
                            $('select[name="section_id"]').empty();
                            $('select[name="section_id"]').append('<option selected disabled >{{trans('parents.choose')}}...</option>');
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    })
                }
            });
        });
    </script>
@endsection
