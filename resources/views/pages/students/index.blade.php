@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    Students
@stop
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('students.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('students.add_student') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('students.name')}}</th>
                                            <th>{{trans('students.email')}}</th>
                                            <th>{{trans('students.gender')}}</th>
                                            <th>{{trans('students.grade')}}</th>
                                            <th>{{trans('students.classroom')}}</th>
                                            <th>{{trans('students.section')}}</th>
                                            <th>{{trans('students.academic_year')}}</th>
                                            <th>{{trans('students.processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($students as $student)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->email}}</td>
                                                <td>{{$student->gender->type}}</td>
                                                <td>{{$student->grade->name}}</td>
                                                <td>{{$student->classroom->name}}</td>
                                                <td>{{$student->section->name}}</td>
                                                <td>{{$student->academic_year}}</td>
                                                <td>
                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{ __('main.processes') }}
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="{{route('students.show',$student->id)}}"><i style="color: #ffc107" class="far fa-eye "></i>&nbsp;{{ __('students.show_student') }}</a>
                                                            <a class="dropdown-item" href="{{route('students.edit',$student->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;{{ __('students.edit_student') }}</a>
                                                            <a class="dropdown-item" href="{{ route('fee-invoices.show', $student->id )}}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp;{{ __('students.add_fee_invoice') }}&nbsp;</a>
                                                            <a class="dropdown-item" href="{{ route('student-receipts.show', $student->id )}}"><i style="color: #0000cc" class="fa fa-money"></i>&nbsp;{{ __('fees.student_receipt') }}&nbsp;</a>
                                                            <a class="dropdown-item" href="{{ route('processing-fees.show', $student->id )}}"><i style="color: #0000cc" class="fa fa-money"></i>&nbsp;{{ __('fees.processing_fees') }}&nbsp;</a>
                                                            <a class="dropdown-item" href="{{ route('payments.show', $student->id )}}"><i style="color: #0000cc" class="fa fa-money"></i>&nbsp;{{ __('fees.payment') }}&nbsp;</a>
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_student{{ $student->id }}" title="{{ __('main.delete') }}"><i class="fa fa-trash"></i>{{ __('main.delete') }}</button>
                                                        </div>
                                                    </div>


                                                </td>
                                            </tr>

                                            <div class="modal fade" id="delete_student{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('students.destroy', $student->id)}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('students.destroy') }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p> {{ trans('My_Classes_trans.Warning_Grade') }}</p>
                                                                <input type="hidden" name="id"  value="{{$student->id}}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
