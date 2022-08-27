@extends('layouts.master')

@section('title')
    {{ __('fees.processing_fees') }}
@stop

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ __('main.name') }}</th>
                                            <th>{{ __('fees.amount') }}</th>
                                            <th>{{ __('main.description') }}</th>
                                            <th>{{ __('main.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($processingFees as $processingFee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$processingFee->student->name}}</td>
                                                <td>{{ number_format($processingFee->amount, 2) }}</td>
                                                <td>{{$processingFee->description}}</td>
                                                <td>
                                                    <a href="{{route('processing-fees.edit',$processingFee->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_processing{{$processingFee->id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.fees.processing.delete')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
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
