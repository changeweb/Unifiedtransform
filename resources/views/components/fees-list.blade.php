<div class="table-responsive">
  <table class="table table-bordered table-data-div table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">@lang('Fee Name')</th>
        <th scope="col">@lang('Select')</th>
      </tr>
    </thead>
    <tbody>
      @foreach($fees as $fee)
      <tr>
        <td>{{($loop->index + 1)}}</td>
        <td>{{$fee->fee_name}}</td>
        <td>
          <div class="form-check">
            <input class="form-check-input position-static" type="checkbox" value="{{$fee->fee_name}}" name="isSelected" aria-label="Select">
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
