<form action="{{url('school/theme')}}" class="form-inline" method="post">
  {{csrf_field()}}
  <input type="hidden" name="s" value="{{$school->id}}">
  <div class="form-group">
      @include('layouts.theme-select')
      <button type="submit" class="btn btn-success btn-sm">@lang('Submit')</button>
  </div>
</form>
