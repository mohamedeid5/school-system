@extends('layouts.master')

@section('title')
    {{ __('fees.edit_invoice') }}
@stop
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">


                    <form class=" row mb-30" action="{{ route('fee-invoices.update', $fee_invoice->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">

                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ __('students.student_name') }}</label>
                                    <select class="fancyselect" name="student_id" required disabled>
                                        <option value="{{ $fee_invoice->student_id }}">{{ $fee_invoice->student->name }}</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label for="Name_en" class="mr-sm-2">{{ __('fees.fee_type') }}</label>
                                    <div class="box">
                                        <select class="fancyselect" name="fee_id" required>
                                            <option value="">{{ __('main.choose') }}</option>
                                            @foreach($fees as $fee)
                                                <option value="{{ $fee->id }}" {{ $fee->id == $fee_invoice->fee_id ? 'selected' : '' }}>{{ $fee->title }}</option>
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
                                                <option value="{{ $fee->amount }}" {{ $fee->amount == $fee_invoice->fee->amount ? 'selected' : '' }}>{{ $fee->amount }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="description" class="mr-sm-2">{{ __('main.description') }}</label>
                                    <div class="box">
                                        <input type="text" class="form-control" value="{{ $fee_invoice->description }}" name="description" required>
                                    </div>
                                </div>





                                <input type="hidden" name="grade_id" value="{{$fee_invoice->grade_id}}">
                                <input type="hidden" name="classroom_id" value="{{$fee_invoice->classroom_id}}">

                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('main.submit') }}</button>

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
