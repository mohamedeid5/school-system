@extends('layouts.master')
@section('title')
    {{ __('fees.edit_fee') }}
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <form action="{{route('fees.update', $fee->id)}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{ __('main.arabic_name') }}</label>
                                <input type="text" value="{{ old('title_ar', $fee->getTranslation('title','en')) }}" name="title_ar" class="form-control">
                                <input type="hidden" value="{{ $fee->id }}" name="id" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4">{{ __('main.english_name') }}</label>
                                <input type="text" value="{{ old('title_en', $fee->getTranslation('title','en')) }}" name="title_en" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{ __('fees.amount') }}</label>
                                <input type="number" value="{{ old('amount', $fee->amount) }}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">{{ __('main.grade') }}</label>
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}" {{$grade->id == old('grade_id', $fee->grade_id) ? 'selected' : ""}}>{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{ __('main.classroom') }}</label>
                                @if(!old('classroom_id'))
                                <select class="custom-select mr-sm-2" name="classroom_id">
                                    <option value="{{ $fee->classroom_id }}"  >{{$fee->classroom->name}}</option>

                                </select>
                                @else
                                    <select class="custom-select mr-sm-2" name="classroom_id">
                                        @foreach($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}" {{ $classroom->id == old('classroom_id') ? 'selected' : '' }}  >{{ $classroom->name }}</option>
                                        @endforeach

                                    </select>
                                @endif
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{ __('main.year') }}</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" {{$year == old('year', $fee->year) ? 'selected' : ' '}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputState">{{ __('main.fee_type') }}</label>
                                <select class="custom-select mr-sm-2" name="fee_type_id">
                                    <option selected disabled>{{trans('main.choose')}}...</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ $type->id == old('fee_type_id', $fee->fee_type_id) ? 'selected' : '' }}>{{ $type->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{ __('main.notes') }}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                      rows="4">{{ old('description', $fee->description) }}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{ __('main.submit') }}</button>

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
@endsection
