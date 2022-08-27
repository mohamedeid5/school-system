<!-- Deleted inFormation Student -->
<div class="modal fade" id="delete_fee{{$fee_invoice->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('main.delete')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('fee-invoices.destroy', $fee_invoice->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{$fee_invoice->id}}">
                    <h5 style="font-family: 'Cairo', sans-serif;">{{ __('main.are_you_sure') }}</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.close')}}</button>
                        <button  class="btn btn-danger">{{trans('main.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
