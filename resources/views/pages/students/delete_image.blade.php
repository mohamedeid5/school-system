<!-- Deleted information Student -->
<div class="modal fade" id="Delete_img{{$attachment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('students.delete')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('delete.attachment')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$attachment->id}}">
                    <input type="hidden" name="student_id" value="{{$attachment->imageable->id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('students.delete_attachment_title')}}</h5>
                    <input type="text" name="name" readonly value="{{$attachment->name}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('students.close')}}</button>
                        <button  class="btn btn-danger">{{trans('students.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
