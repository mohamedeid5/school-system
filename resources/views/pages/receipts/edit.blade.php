@extends('layouts.master')

@section('title')
{{ __('fees.edit_receipt') }}
@stop

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <form action="{{route('student-receipts.update', $studentReceipt->id)}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('fees.amount') }}<span class="text-danger">*</span></label>
                                    <input  class="form-control" name="debit" value="{{$studentReceipt->debit}}" type="number" >
                                    <input  type="hidden" name="student_id" value="{{$studentReceipt->student->id}}" class="form-control">
                                    <input  type="hidden" name="id"  value="{{$studentReceipt->id}}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('main.description') }}<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$studentReceipt->description}}</textarea>
                                </div>
                            </div>

                        </div>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{__('main.submit')}}</button>
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
