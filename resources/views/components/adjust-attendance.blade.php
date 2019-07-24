@if(count($attendances) > 0)
<div class="col-md-6">
    <h5>@lang('Attendance List of This Term')</h5>
    <form action="{{url('attendance/adjust')}}" method="POST">
        {{ csrf_field() }}
        <table class="table table-striped table-hover table-condensed">
            <tr>
                <th>#</th>
                <th>@lang('Status')</th>
                <th>@lang('Date')</th>
            </tr>
            @foreach ($attendances as $att)
                <input type="hidden" name="att_id[]" value="{{$att->id}}">
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input position-static" type="checkbox" aria-label="Present" name="isPresent[]">
                        </div>
                    </td>
                    <td>
                        @if($att->present === 0)
                            <span class="label label-danger attdState">@lang('Absent')</span>
                        @endif
                    </td>
                    <td>{{$att->created_at}}</td>
                </tr>
            @endforeach
        </table>
        <a href="javascript:history.back()" class="btn btn-sm btn-primary" style="margin-right: 2%;" role="button">@lang('Cancel')</a>
        <input type="submit" class="btn btn-sm btn-danger" value="Submit"/>
    </form>
</div>
<script>
  $('input[type="checkbox"]').change(function() {
      var attdState = $(this).parent().parent().parent().find('.attdState').removeClass('label-danger label-success');
      if($(this).is(':checked')){
        attdState.addClass('label-success').text(@json( __('Present')));
      } else {
        attdState.addClass('label-danger').text(@json( __('Absent')));
      }
  });
</script>
@endif