<!-- Deleted inFormation Student -->
<div class="modal fade" id="delete_payment{{$payment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ __('main.delete') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('payments.destroy', $payment->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{$payment->id}}">
                    <h5 style="font-family: 'Cairo', sans-serif;">{{ __('main.are_you_sure') }}</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.close')}}</button>
                        <button  class="btn btn-danger">{{__('main.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
