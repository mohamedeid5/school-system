<div class="modal fade" id="delete_quiz{{$quiz->id}}" tabindex="-1"
     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('quizzes.destroy', $quiz->id)}}" method="post">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;"
                        class="modal-title" id="exampleModalLabel">{{ __('main.delete') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> {{ trans('main.Warning_Grade') }} {{$quiz->name}}</p>
                    <input type="hidden" name="id" value="{{$quiz->id}}">
                </div>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('main.close') }}</button>
                        <button type="submit"
                                class="btn btn-danger">{{ trans('main.submit') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
