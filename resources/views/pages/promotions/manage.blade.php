@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main.students_list')}}
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

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_all">
                                  {{ __('promotions.put_all_back') }}
                                </button>
                                <br><br>


                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{__('promotions.name')}}</th>
                                            <th class="alert-danger">{{__('promotions.old_grade')}}</th>
                                            <th class="alert-danger">{{__('promotions.old_classroom')}}</th>
                                            <th class="alert-danger">{{__('promotions.old_section')}}</th>
                                            <th class="alert-danger">{{__('promotions.academic_year')}}</th>
                                            <th class="alert-success">{{__('promotions.new_grade')}}</th>
                                            <th class="alert-success">{{__('promotions.new_classroom')}}</th>
                                            <th class="alert-success">{{__('promotions.new_section')}}</th>
                                            <th class="alert-success">{{__('promotions.academic_year_new')}}</th>
                                            <th>{{trans('main.processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$promotion->student->name}}</td>
                                                <td>{{$promotion->f_grade->name}}</td>
                                                <td>{{$promotion->f_classroom->name}}</td>
                                                <td>{{$promotion->f_section->name}}</td>
                                                <td>{{$promotion->academic_year}}</td>
                                                <td>{{$promotion->t_grade->name}}</td>
                                                <td>{{$promotion->t_classroom->name}}</td>
                                                <td>{{$promotion->t_section->name}}</td>
                                                <td>{{$promotion->academic_year_new}}</td>


                                                <td>
                                                    <a href="{{route('students.edit',$promotion->id)}}"
                                                       class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_all{{ $promotion->id }}"
                                                            title="{{ trans('grades.delete') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                    <a href="{{route('students.show',$promotion->id)}}"
                                                       class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i
                                                            class="far fa-eye"></i></a>
                                                </td>
                                            </tr>
                                   @include('pages.promotions.delete_all')
                                   @include('pages.promotions.delete_one')
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
