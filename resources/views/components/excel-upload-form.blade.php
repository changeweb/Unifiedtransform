<form action="{{url('users/import/user-xlsx')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="{{$type}}">
    <div class="form-group">
        <input type="file" name="file">
    </div>
    <input type="submit" class="btn btn-default btn-sm" value="@lang('Upload')">
</form>
