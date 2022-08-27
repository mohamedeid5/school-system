@extends('layouts.master')

@section('title')
    {{ __('fees.fees_invoices') }}
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
                                            <th>{{ __('students.student_name') }}</th>
                                            <th>{{ __('fees.fee_type') }}</th>
                                            <th>{{ __('fees.amount') }}</th>
                                            <th>{{ __('main.grade') }}</th>
                                            <th>{{ __('main.classroom') }}</th>
                                            <th>{{ __('main.description') }}</th>
                                            <th>{{ __('main.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($fee_invoices as $fee_invoice)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$fee_invoice->student->name}}</td>
                                                <td>{{$fee_invoice->fee->title}}</td>
                                                <td>{{ number_format($fee_invoice->amount, 2) }}</td>
                                                <td>{{$fee_invoice->grade->name}}</td>
                                                <td>{{$fee_invoice->classroom->name}}</td>
                                                <td>{{$fee_invoice->description}}</td>
                                                <td>
                                                    <a href="{{ route('fee-invoices.edit', $fee_invoice->id) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_fee{{ $fee_invoice->id }}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.fees.invoices.delete_invoice')
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
