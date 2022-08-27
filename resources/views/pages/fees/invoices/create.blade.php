@extends('layouts.master')

@section('title')
    اضافة فاتورة جديدة
@stop
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">


                    <form class=" row mb-30" action="{{ route('fee-invoices.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="list_fees">
                                    <div data-repeater-item>
                                        <div class="row">

                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">{{ __('students.student_name') }}</label>
                                                <select class="fancyselect" name="student_id" required>
                                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                </select>
                                            </div>

                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">{{ __('fees.fee_type') }}</label>
                                                <div class="box">
                                                    <select class="fancyselect" name="fee_id" required>
                                                        <option value="">{{ __('main.choose') }}</option>
                                                        @foreach($fees as $fee)
                                                            <option value="{{ $fee->id }}" {{ $fee->id == old('fee_id') ? 'selected' : '' }}>{{ $fee->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">{{ __('fees.amount') }}</label>
                                                <div class="box">
                                                    <select class="fancyselect" name="amount" required>
                                                        <option value="">{{ __('main.choose') }}</option>
                                                        @foreach($fees as $fee)
                                                            <option value="{{ $fee->amount }}" {{ $fee->id == old('amount') ? 'selected' : '' }}>{{ $fee->amount }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="description" class="mr-sm-2">{{ __('main.description') }}</label>
                                                <div class="box">
                                                    <input type="text" class="form-control" value="{{ old('description') }}" name="description" required>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="name_en" class="mr-sm-2">{{ trans('main.processes') }}:</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{ trans('main.delete_row') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button" value="{{ trans('main.add_row') }}"/>
                                    </div>
                                </div><br>
                                <input type="hidden" name="grade_id" value="{{$student->grade_id}}">
                                <input type="hidden" name="classroom_id" value="{{$student->classroom_id}}">

                                <button type="submit" class="btn btn-primary">{{ __('main.submit') }}</button>
                            </div>
                        </div>
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
