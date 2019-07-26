@if(Auth::user()->role == 'admin')
<div class="well">
    <form class="form-inline" action="{{url('users/export/students-xlsx')}}" method="get">
        <div class="form-group">
            <label for="export-year">@lang('Export in Excel by Year'): </label>
            <input type="hidden" name="type" value="{{$type}}">
            <input class="form-control input-sm datepicker" id="export-year" name="year" required>
        </div>
        <button type="submit" class="btn btn-sm btn-default"><i class="material-icons">get_app</i> Excel</button>
    </form>
</div>
<script>
    $(function () {
        $('.datepicker').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
    })

</script>
@endif
