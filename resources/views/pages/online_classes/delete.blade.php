<!-- Deleted inFormation Student -->
<div class="modal fade" id="online_classes{{$onlineClass->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('main.delete')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('online-classes.destroy', $onlineClass->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('main.deleted')}}</h5>
                    <input type="text" readonly value="{{$onlineClass->name}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.close')}}</button>
                        <button  class="btn btn-danger">{{trans('main.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
