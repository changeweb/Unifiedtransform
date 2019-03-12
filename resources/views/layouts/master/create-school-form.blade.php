<button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#schoolModal">+ Create School</button>
<!-- Modal -->
<div class="modal fade" id="schoolModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form class="form-horizontal" method="POST" action="{{ url('create-school') }}">
    {{ csrf_field() }}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create School</h4>
      </div>
      <div class="modal-body">
          <div class="form-group{{ $errors->has('school_name') ? ' has-error' : '' }}">
              <label for="school_name" class="col-md-4 control-label">School Name</label>

              <div class="col-md-6">
                  <input id="school_name" type="text" class="form-control" name="school_name" value="{{ old('school_name') }}" placeholder="School Name" required>

                  @if ($errors->has('school_name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('school_name') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('school_medium') ? ' has-error' : '' }}">
              <label for="school_medium" class="col-md-4 control-label">School Medium</label>

              <div class="col-md-6">
                <select id="school_medium" class="form-control" name="school_medium">
                  <option selected="selected">Bangla</option>
                  <option>English</option>
                </select>

                  @if ($errors->has('school_medium'))
                      <span class="help-block">
                          <strong>{{ $errors->first('school_medium') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('school_established') ? ' has-error' : '' }}">
              <label for="school_established" class="col-md-4 control-label">School Established</label>

              <div class="col-md-6">
                  <input id="school_established" type="text" class="form-control" name="school_established" value="{{ old('school_established') }}" placeholder="School Established" required>

                  @if ($errors->has('school_established'))
                      <span class="help-block">
                          <strong>{{ $errors->first('school_established') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
          <div class="form-group{{ $errors->has('school_about') ? ' has-error' : '' }}">
              <label for="school_about" class="col-md-4 control-label">About</label>

              <div class="col-md-6">
                  <textarea id="school_about" class="form-control" rows="3" name="school_about" placeholder="About School" required>{{ old('school_about') }}</textarea>

                  @if ($errors->has('school_about'))
                      <span class="help-block">
                          <strong>{{ $errors->first('school_about') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    </form>
  </div>
</div>
