@extends('layouts.master')
@section('css')

@section('title')
    {{ __('main.grades_list') }}
@stop

@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ __('main.grades_list') }}</h4>
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
                {{ trans('grades.add_grade') }}
            </button>
            <br><br>
          <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('grades.name') }}</th>
                    <th>{{ __('grades.notes') }}</th>
                    <th>{{ __('grades.processes') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $grade)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $grade->name }}</td>
                        <td>{{ $grade->notes }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#edit{{ $grade->id }}"
                                    title="{{ __('grades.edit') }}"><i
                                    class="fa fa-edit"></i>{{ __('grades.edit') }}</button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#delete{{ $grade->id }}"
                                    title="{{ __('grades.delete') }}"><i
                                    class="fa fa-trash"></i>{{ __('grades.delete') }}</button>
                        </td>
                    </tr>
            <!-- edit_modal_Grade -->
            <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('grades.add_grade') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- edit_form -->
                        <form action="{{ route('grades.update', $grade->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $grade->id }}">
                                <div class="col">
                                    <label for="Name" class="mr-sm-2">{{ trans('grades.stage_name_ar') }}
                                        :</label>
                                    <input id="name" type="text" name="name" value="{{ old('name', $grade->getTranslation('name', 'ar')) }}" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="name_en"  class="mr-sm-2">{{ trans('grades.stage_name_en') }}
                                        :</label>
                                    <input type="text" value="{{ old('name_en', $grade->getTranslation('name', 'en')) }}" class="form-control" name="name_en">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('grades.notes') }}
                                    :</label>
                                <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                                    rows="3">{{ old('notes', $grade->notes) }}</textarea>
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

        <!-- delete_modal_Grade -->
        <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                            id="exampleModalLabel">
                            {{ trans('grades.delete_grade') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    @if(count($grade->classrooms) > 0)
                        <div class="modal-body">
                                {{ trans('grades.delete_action_required') }}
                                ({{ $grade->name }})
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('grades.close') }}</button>
                                </div>
                        </div>
                    @else
                        <div class="modal-body">
                            <form action="{{ route('grades.destroy', $grade->id) }}" method="post">
                                @method('Delete')
                                @csrf
                                {{ trans('grades.warning_grade') }}
                                {{ $grade->name }} ?
                                <input id="id" type="hidden" name="id" class="form-control"
                                       value="{{ $grade->id }}">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('grades.close') }}</button>
                                    <button type="submit"
                                            class="btn btn-danger">{{ trans('grades.submit') }}</button>
                                </div>
                            </form>
                        </div>
                    @endif


                </div>
            </div>
        </div>

        @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>{{ __('grades.name') }}</th>
                    <th>{{ __('grades.notes') }}</th>
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
                    {{ trans('Grades_trans.add_Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('grades.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ trans('grades.stage_name_ar') }}
                                :</label>
                            <input id="Name" type="text" value="{{ old('name') }}" name="name" class="form-control">
                        </div>
                        <div class="col">
                            <label for="name_en" class="mr-sm-2">{{ trans('grades.stage_name_en') }}
                                :</label>
                            <input type="text" value="{{ old('name_en') }}" class="form-control" name="name_en">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ trans('grades.notes') }}
                            :</label>
                        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                            rows="3">{{ old('notes') }}</textarea>
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
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
