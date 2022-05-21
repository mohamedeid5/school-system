@extends('layouts.master')
@section('css')

@section('title')
    {{ __('classrooms.classroom_list') }}
@stop

@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ __('classrooms.classroom_list') }}</h4>
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
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('classrooms.add_classroom') }}
                    </button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" id="deleteAll" data-target="">
                        {{ trans('classrooms.delete_selected') }}
                    </button>

                    <form action="{{ route('classrooms.filter.classes') }}" method="get" id="filter_classes">
                        <select class="form-select" name="grade_id" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            @foreach($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </form>

                    <br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="selectall" value="" id="checkAll">
                                        <label class="form-check-label" for="checkAll">
                                            select all
                                        </label>
                                    </div>
                                </th>
                                <th>#</th>
                                <th>{{ __('classrooms.name') }}</th>
                                <th>{{ __('classrooms.grade_name') }}</th>
                                <th>{{ __('classrooms.processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(isset($details))
                                <?php $listClasses = $details;  ?>
                            @else
                                <?php $listClasses = $classrooms;  ?>
                            @endif

                            @foreach ($listClasses as $classroom)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $classroom->id }}" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">

                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $classroom->name }}</td>
                                    <td>{{ $classroom->grade->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $classroom->id }}"
                                                title="{{ __('classrooms.edit') }}"><i
                                                class="fa fa-edit"></i>{{ __('classrooms.edit') }}</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $classroom->id }}"
                                                title="{{ __('classrooms.delete') }}"><i
                                                class="fa fa-trash"></i>{{ __('classrooms.delete') }}</button>
                                    </td>
                                </tr>
                                <!-- edit_modal_Grade -->

                                <div class="modal fade" id="edit{{ $classroom->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                                                <form action="{{ route('classrooms.update', $classroom->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="row">
                                                        <input type="hidden" name="id" value="{{ $classroom->id }}">
                                                        <div class="col">
                                                            <label for="Name" class="mr-sm-2">{{ trans('grades.stage_name_ar') }}
                                                                :</label>
                                                            <input id="name" type="text" name="name" value="{{ old('name', $classroom->getTranslation('name', 'ar')) }}" class="form-control">
                                                        </div>
                                                        <div class="col">
                                                            <label for="name_en"  class="mr-sm-2">{{ trans('grades.stage_name_en') }}
                                                                :</label>
                                                            <input type="text" value="{{ old('name_en', $classroom->getTranslation('name', 'en')) }}" class="form-control" name="name_en">
                                                        </div>
                                                        <div class="col">
                                                            <label for="name_en" class="mr-sm-2">{{ trans('grades.stage_name_en') }}
                                                                :</label>
                                                            <div class="form-group">
                                                                <select class="form-control " name="grade_id">
                                                                    @foreach($grades as $grade)
                                                                        <option value="{{ $grade->id }}" {{ $grade->id == old('grade_id', $classroom->grade->id) ? 'selected' : ''  }}  >{{ $grade->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
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
                                <div class="modal fade" id="delete{{ $classroom->id }}" tabindex="-1" role="dialog"
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
                                                <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="post">
                                                    @method('Delete')
                                                    @csrf
                                                    {{ trans('grades.warning_grade') }}
                                                    {{ $classroom->name }} ?
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="{{ $classroom->id }}">
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
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>{{ __('grades.name') }}</th>
                                <th>{{ __('grades.processes') }}</th>
                            </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- add_modal_Grade -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('classrooms.add_classroom') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('classrooms.store') }}" method="POST">
                            @csrf
                            <div class="repeater">
                                <div data-repeater-list="list_classes">
                                    <div data-repeater-item>
                                        <div class="row">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('classrooms.class_name_ar') }}
                                        :</label>
                                    <input id="Name" type="text" value="{{ old('name') }}" name="name" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="name_en" class="mr-sm-2">{{ trans('classrooms.class_name_en') }}
                                        :</label>
                                    <input type="text" value="{{ old('name_en') }}" class="form-control" name="name_en">
                                </div>
                                <div class="col">
                                    <label for="name_en" class="mr-sm-2">{{ trans('classrooms.grade') }}
                                        :</label>
                                        <div class="form-group">
                                            <select class="form-control " name="grade_id">
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                </div>
                                <div class="col">
                                    <label for="Name_en"
                                           class="mr-sm-2">{{ __('classrooms.processes') }}
                                        :</label>
                                    <input class="btn btn-danger btn-block" data-repeater-delete
                                           type="button" value="{{ __('classrooms.delete') }}" />
                                </div>
                            </div>
                                    </div>
                                </div>

                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button" value="{{ trans('classrooms.add_classroom') }}"/>
                                    </div>

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

        <!-- delete_all_classrooms -->
        <div class="modal fade" id="delete_all" tabindex="-1" role="dialog"
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
                        <form action="{{ route('classrooms.delete.all') }}" method="post">
                            @method('Delete')
                            @csrf
                            {{ trans('grades.warning_grade') }}
                            <input type="text" name="delete_all_id" id="delete_all_id" class="form-control">
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
    </div>


    <!-- row closed -->
@endsection
@section('js')
    <script>
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        //

        $('#deleteAll').click(function(){

            const selected = new Array();

            $('#datatable input[type="checkbox"]:checked').each(function(){
                selected.push(this.value);
            });

            if(selected.length > 0) {
                $('#delete_all').modal('show');
                $('input[id="delete_all_id"]').val(selected)
            }

        });

        $('#filter_classes').change(function (){
            $(this).submit();
        });

    </script>
@endsection
