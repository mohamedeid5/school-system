@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('teachers.Add_Teacher') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('teachers.Add_Teacher') }}
@stop
<!-- breadcrumb -->
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
                            <form action="{{route('teachers.store')}}" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('teachers.email')}}</label>
                                        <input type="email" value="{{ old('email') }}" name="email" class="form-control">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('teachers.password')}}</label>
                                        <input type="password" value="{{ old('password') }}" name="password" class="form-control">
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>


                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('teachers.name_ar')}}</label>
                                        <input type="text" value="{{ old('name_ar') }}" name="name_ar" class="form-control">
                                        @error('name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('teachers.name_en')}}</label>
                                        <input type="text" value="{{ old('name_en') }}" name="name_en" class="form-control">
                                        @error('name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputCity">{{trans('teachers.specialization')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="specialization_id">
                                            <option selected disabled>{{trans('parents.choose')}}...</option>
                                            @foreach($specializations as $specialization)
                                                <option value="{{$specialization->id}}" {{ old('specialization_id') == $specialization->id ? 'selected': '' }} >{{$specialization->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('specialization_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputState">{{trans('teachers.gender')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="gender_id">
                                            <option selected disabled>{{trans('teachers.choose')}}...</option>
                                            @foreach($genders as $gender)
                                                <option value="{{$gender->id}}" {{ old('gender_id') == $gender->id ? 'selected': '' }}>{{$gender->type}}</option>
                                            @endforeach
                                        </select>
                                        @error('gender_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('teachers.joining_date')}}</label>
                                        <div class='input-group date'>
                                            <input class="form-control" value="{{ old('joining_date') }}" type="text"  id="datepicker-action" name="joining_date" data-date-format="yyyy-mm-dd"  required>
                                        </div>
                                        @error('joining_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{trans('teachers.address')}}</label>
                                    <textarea class="form-control" name="address"
                                              id="exampleFormControlTextarea1" rows="4"
                                    >{{ old('address') }}</textarea>
                                    @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('parents.next')}}</button>
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
