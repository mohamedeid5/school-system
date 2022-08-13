@extends('layouts.master')
@section('title')
    {{ __('fees.add_new_fee') }}
@stop
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">


                    <form method="post" action="{{ route('fees-type.update', $type->id) }}" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputEmail4">{{ __('main.arabic_name') }}</label>
                                <input type="text" value="{{ old('title_ar', $type->getTranslation('title', 'ar')) }}" name="title_ar" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4">{{ __('main.english_name') }}</label>
                                <input type="text" value="{{ old('title_en', $type->getTranslation('title', 'en')) }}" name="title_en" class="form-control">
                            </div>

                        </div>


                        <button type="submit" class="btn btn-primary">{{ __('main.submit') }}</button>

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
