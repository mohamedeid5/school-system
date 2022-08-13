@extends('layouts.master')
@section('css')

@section('title')
    Sections
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ __('sections.sections') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Page Title</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ __('sections.add_section') }}
                    </button>
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <h5 class="card-title">Accordion border</h5>
                                <div class="accordion accordion-border">
                                    @foreach($grades as $grade)
                                    <div class="acd-group">
                                        <a href="#" class="acd-heading">{{ $grade->name }}</a>
                                        <div class="acd-des">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">classroom</th>
                                                    <th scope="col">{{ __('sections.status') }}</th>
                                                    <th scope="col">processes</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($grade->sections as $section)
                                                <tr>
                                                    <th scope="row">{{ $section->id }}</th>
                                                    <td>{{ $section->name }}</td>
                                                    <td>{{ $section->classroom->name }}</td>
                                                    <td>
                                                        @if($section->getStatus() == 'active')
                                                            <span class="badge badge-success">{{ $section->getStatus() }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ $section->getStatus() }}</span>

                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                                data-target="#edit{{ $section->id }}"
                                                                title="{{ __('sections.edit') }}"><i
                                                                class="fa fa-edit"></i>{{ __('sections.edit') }}</button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                                data-target="#delete{{ $section->id }}"
                                                                title="{{ __('sections.delete') }}"><i
                                                                class="fa fa-trash"></i>{{ __('sections.delete') }}</button>
                                                    </td>
                                                </tr>

                                                    <!-- edit model -->
                                                <div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                                    {{ trans('grades.edit') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form action="{{ route('sections.update', $section->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="Name" class="mr-sm-2">{{ trans('grades.stage_name_ar') }}
                                                                                :</label>
                                                                            <input id="name" type="text" name="name" value="{{ old('name', $section->getTranslation('name', 'ar')) }}" class="form-control">
                                                                        </div>
                                                                        <div class="col">
                                                                            <label for="name_en"  class="mr-sm-2">{{ trans('grades.stage_name_en') }}
                                                                                :</label>
                                                                            <input type="text" value="{{ old('name_en', $section->getTranslation('name', 'en')) }}" class="form-control" name="name_en">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label for="name_en" class="mr-sm-2">{{ trans('sections.grade') }}
                                                                                :</label>
                                                                            <div class="form-group">
                                                                                <select class="form-control choose-grade" name="grade_id" id="choose-grade">
                                                                                    <option value="">choose grade</option>
                                                                                    @foreach($grades as $grade)
                                                                                        <option value="{{ $grade->id }}" {{ old('grade_id',  $section->grade_id) == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <br><br>
                                                                        <div class="col">
                                                                            <label for="name_en" class="mr-sm-2">{{ trans('sections.classroom') }}
                                                                                :</label>
                                                                            <div class="form-group">
                                                                                <select class="form-control fill-classroom" name="classroom_id" id="fill-classroom">
                                                                                    @foreach($section->grade->classrooms as $classroom)
                                                                                        <option value="{{ $classroom->id }}" {{ old('classroom_id', $section->classroom_id) == $classroom->id ? 'selected' : '' }}>{{ $classroom->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                        </div>

                                                                            <div class="col">
                                                                                <select class="select" name="teacher_id[]" multiple data-mdb-option-height="44" >
                                                                                    @foreach($teachers as $teacher)
                                                                                        <option
                                                                                            value="{{ $teacher->id }}"
                                                                                            {{ in_array($teacher->id, old('teacher_id', $section->teachers->pluck('id')->toArray())) ? 'selected' : ''  }}
                                                                                            data-mdb-secondary-text="Secondary text"
                                                                                        >
                                                                                            {{ $teacher->name }}
                                                                                        </option>
                                                                                    @endforeach

                                                                                </select>
                                                                        </div>

                                                                    </div>
                                                                        <br><br>

                                                                        <div class="col">
                                                                            <label for="status" class="mr-sm-2">{{ __('sections.status') }}:</label>
                                                                            <div class="form-group">
                                                                                <select class="form-control" name="status">
                                                                                    <option value="1" {{ old('status', $section->status) == 1 ? 'selected' : '' }}>{{ __('sections.active') }}</option>
                                                                                    <option value="0" {{ old('status', $section->status) == 0 ? 'selected' : '' }}>{{ __('sections.inactive') }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>


                                                                    <br><br>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('grades.close') }}</button>
                                                                <button type="submit" class="btn btn-success">{{ trans('grades.submit') }}</button>
                                                            </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- delete_modal_classroom -->
                                                <div class="modal fade" id="delete{{ $section->id }}" tabindex="-1" role="dialog"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                    id="exampleModalLabel">
                                                                    {{ __('classrooms.delete') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('sections.destroy', $section->id) }}" method="post">
                                                                    @method('Delete')
                                                                    @csrf
                                                                    {{ trans('grades.warning_grade') }}
                                                                    {{ $section->name }} ?
                                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                                           value="{{ $section->id }}">
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">{{ trans('grades.close') }}</button>
                                                                        <button type="submit"
                                                                                class="btn btn-danger">{{ trans('grades.delete') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->



    <!-- add_modal_section -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('sections.add_section') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('sections.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="Name" class="mr-sm-2">{{ __('sections.stage_name_ar') }}
                                    :</label>
                                <input id="Name" type="text" value="{{ old('name') }}" name="name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="name_en" class="mr-sm-2">{{ __('sections.stage_name_en') }}
                                    :</label>
                                <input type="text" value="{{ old('name_en') }}" class="form-control" name="name_en">
                            </div>
                        </div>
                        <!-- grade name -->
                        <div class="row">
                            <div class="col">
                        <div class="form-group">
                            <label for="name_en" class="mr-sm-2">{{ __('sections.grade_name') }}
                                <select class="form-control choose-grade" id="choose-grade" name="grade_id" style="width: 221px">
                                    <option value="">choose grade</option>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                 @endforeach
                                </select>
                        </div>
                            </div>

                        <!-- classroom name -->
                            <div class="col">

                        <div class="form-group">
                            <label for="name_en" class="mr-sm-2">{{ __('sections.classroom_name') }}
                                <select class="form-control custom-select fill-classroom" id="fill-classroom" name="classroom_id">
                                    <option value="">choose</option>
                                </select>
                        </div>
                        </div>
                        </div>
                        <!-- teacher name -->
                        <div class="row">
                            <div class="col">
                                <select class="select" name="teacher_id[]" multiple data-mdb-option-height="44" style="width: 216px">
                                    @foreach($teachers as $teacher)
                                    <option
                                        value="{{ $teacher->id }}"
                                        data-mdb-secondary-text="Secondary text"
                                        {{ in_array($teacher->id, old('teacher_id', [])) ? 'selected' : '' }}
                                    >
                                        {{ $teacher->name }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('sections.close') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('sections.submit') }}</button>
                </div>
                </form>

            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')

    <script>
        $('.choose-grade').change(function (){

            const grade_id = $(this).val();
            if (grade_id) {

                $.ajax({
                    url: "{{ URL::to('classes') }}/" + grade_id,
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('.fill-classroom').empty();
                        $.each(data, function (key, value){
                           $('.fill-classroom').append('<option value="' + key + '"> '+ value +' </option>');
                        });
                    }
                })
            }

        });
    </script>
@endsection
