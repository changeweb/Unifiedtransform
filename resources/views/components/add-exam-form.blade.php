<form class="form-horizontal" action="{{url('exams/create')}}" method="post">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('term') ? ' has-error' : '' }}">
        <label for="term" class="col-md-4 control-label">Terms</label>

        <div class="col-md-6">
            <select id="term" class="form-control" name="term">
               <option value="1">1st Term</option>
               <option value="2">2nd Term</option>
               <option value="3">3rd Term</option>
            </select>

            @if ($errors->has('term'))
                <span class="help-block">
                    <strong>{{ $errors->first('term') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('exam_name') ? ' has-error' : '' }}">
        <label for="exam_name" class="col-md-4 control-label">Examination Name</label>

        <div class="col-md-6">
            <input id="exam_name" type="text" class="form-control" name="exam_name" value="{{ old('exam_name') }}" placeholder="Semester 1 Exam 2018, Final Exam 2019, ..." required>

            @if ($errors->has('exam_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('exam_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('exam_start_date') ? ' has-error' : '' }}">
        <label for="exam_start_date" class="col-md-4 control-label">Start Date</label>

        <div class="col-md-6">
            <input id="exam_start_date" type="text" class="form-control" name="exam_start_date" value="{{ old('exam_start_date') }}" placeholder="5th April..." required>

            @if ($errors->has('exam_start_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('exam_start_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('exam_end_date') ? ' has-error' : '' }}">
        <label for="exam_end_date" class="col-md-4 control-label">End Date</label>

        <div class="col-md-6">
            <input id="exam_end_date" type="text" class="form-control" name="exam_end_date" value="{{ old('exam_end_date') }}" placeholder="20th April..." required>

            @if ($errors->has('exam_end_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('exam_end_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('classes') ? ' has-error' : '' }}">
        <label for="classes" class="col-md-4 control-label">For Class</label>

        <div class="col-md-6">
            @foreach ($classes as $class)
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="classes[]" value="{{$class->id}}"> {{$class->class_number}}
                    </label>
                </div>
            @endforeach

            @if ($errors->has('classes'))
                <span class="help-block">
                    <strong>{{ $errors->first('classes') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
            <a href="javascript:history.back()" class="btn btn-danger" style="margin-right: 2%;" role="button">Cancel</a>
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </div>
</form>
