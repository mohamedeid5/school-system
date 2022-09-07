@extends('layouts.master')

@section('title')
    {{ __('quizzes.quizzes_list') }}
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
                                <a href="{{route('quizzes.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ __('quizzes.add_new_quiz') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('quizzes.quiz_name') }}</th>
                                            <th>{{ __('main.teacher_name') }}</th>
                                            <th>{{ __('main.grade') }}</th>
                                            <th>{{ __('main.classroom') }}</th>
                                            <th>{{ __('main.section') }}</th>
                                            <th>{{ __('main.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quiz)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$quiz->name}}</td>
                                                <td>{{$quiz->teacher->name}}</td>
                                                <td>{{$quiz->grade->name}}</td>
                                                <td>{{$quiz->classroom->name}}</td>
                                                <td>{{$quiz->section->name}}</td>
                                                <td>
                                                    <a href="{{route('quizzes.edit',$quiz->id)}}"
                                                       class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_quiz{{ $quiz->id }}" title="حذف"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.quizzes.delete')
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
