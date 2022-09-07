@extends('layouts.master')

@section('title')
    {{ __('main.online_classes') }}
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
                                <a href="{{route('online-classes.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ __('online_classes.add_new_class') }}</a>
                                <a href="{{route('indirect.create')}}" class="btn btn-primary btn-sm" role="button"
                                   aria-pressed="true">{{ __('online_classes.add_new_indirect_class') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ __('main.grade') }}</th>
                                            <th>{{ __('main.classroom') }}</th>
                                            <th>{{ __('main.section') }}</th>
                                            <th>{{ __('main.teacher_name') }}</th>
                                            <th>{{ __('online_classes.topic') }}</th>
                                            <th>{{ __('online_classes.start_time') }}</th>
                                            <th>{{ __('online_classes.duration') }}</th>
                                            <th>{{ __('online_classes.class_url') }}</th>
                                            <th>{{ __('main.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($onlineClasses as $onlineClass)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$onlineClass->grade->name}}</td>
                                                <td>{{ $onlineClass->classroom->name }}</td>
                                                <td>{{$onlineClass->section->name}}</td>
                                                <td>{{$onlineClass->user->name}}</td>
                                                <td>{{$onlineClass->topic}}</td>
                                                <td>{{$onlineClass->start_time}}</td>
                                                <td>{{$onlineClass->duration}}</td>
                                                <td class="text-danger"><a href="{{$onlineClass->join_url}}" target="_blank">{{ __('online_classes.join_now') }}</a></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#online_classes{{$onlineClass->id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.online_classes.delete')
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
