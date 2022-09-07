@extends('layouts.master')

@section('title')
    {{ __('questions.edit_question') }}
@stop

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route('questions.update', $question->id) }}" method="post" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{ __('questions.question_name') }}</label>
                                        <input type="text" name="title" value="{{ old('title', $question->title) }}" id="input-name"
                                               class="form-control form-control-alternative" autofocus>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ __('questions.answers') }}</label>
                                        <textarea name="answers" class="form-control" id="exampleFormControlTextarea1"
                                                  rows="4">{{ old('answers', $question->answers) }}</textarea>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title"> {{ __('questions.right_answer') }}</label>
                                        <input type="text" name="right_answer" value="{{ old('right_answer', $question->right_answer) }}" id="input-name"
                                               class="form-control form-control-alternative" autofocus>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="quiz_id"> {{ __('quizzes.quiz_name') }} : <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="quiz_id">
                                                <option selected disabled>{{ __('main.choose') }}</option>
                                                @foreach($quizzes as $quiz)
                                                    <option value="{{ $quiz->id }}" {{ $quiz->id == old('quiz_id', $question->quiz_id) ? 'selected' : '' }}>{{ $quiz->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Grade_id">{{ __('questions.score') }} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="score">
                                                <option selected disabled>{{ __('main.choose') }}</option>
                                                <option value="5" {{ $question->score == 5 ? 'selected' : '' }}>5</option>
                                                <option value="10" {{ $question->score == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ $question->score == 15 ? 'selected' : '' }}>15</option>
                                                <option value="20" {{ $question->score == 20 ? 'selected' : '' }}>20</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{ __('main.submit') }}</button>
                            </form>
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
