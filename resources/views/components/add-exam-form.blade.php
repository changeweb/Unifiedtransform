<form class="form-horizontal" action="{{url('exams/create')}}" method="post">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('term') ? ' has-error' : '' }}">
        <label for="term" class="col-md-4 control-label">@lang('Terms')</label>

        <div class="col-md-6">
            <select id="term" class="form-control" name="term">
               <option value="1">@lang('1st Term')</option>
               <option value="2">@lang('2nd Term')</option>
               <option value="3">@lang('3rd Term')</option>
            </select>

            @if ($errors->has('term'))
                <span class="help-block">
                    <strong>{{ $errors->first('term') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('exam_name') ? ' has-error' : '' }}">
        <label for="exam_name" class="col-md-4 control-label">@lang('Examination Name')</label>

        <div class="col-md-6">
            <input id="exam_name" type="text" class="form-control" name="exam_name" value="{{ old('exam_name') }}" placeholder="@lang('Semester 1 Exam 2018, Final Exam 2019, ...')" required>

            @if ($errors->has('exam_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('exam_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
        <label for="start_date" class="col-md-4 control-label">@lang('Start Date')</label>

        <div class="col-md-6">
            <input id="start_date" type="text" class="form-control" name="start_date" value="{{ old('start_date') }}" placeholder="@lang('5th April...')" required>

            @if ($errors->has('start_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('start_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
        <label for="end_date" class="col-md-4 control-label">@lang('End Date')</label>

        <div class="col-md-6">
            <input id="end_date" type="text" class="form-control" name="end_date" value="{{ old('end_date') }}" placeholder="@lang('20th April...')" required>

            @if ($errors->has('end_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('end_date') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('classes') ? ' has-error' : '' }}">
        <label for="classes" class="col-md-4 control-label">@lang('For Class')</label>

        <div class="col-md-6">
            @foreach ($classes as $class)
                @if(in_array($class->id, $assigned_classes->pluck('class_id')->toArray()))
                    <div class="checkbox">
                        {{$class->class_number}} @lang('already assigned to Exam') <b>
                        @foreach($assigned_classes as $assigned_class)
                            @if($assigned_class->class_id == $class->id)
                                {{$assigned_class->exam->exam_name}}
                                @break
                            @endif
                        @endforeach
                        </b>
                    </div>
                @else
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="classes[]" value="{{$class->id}}"> {{$class->class_number}}
                    </label>
                </div>
                @endif
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
            <a href="javascript:history.back()" class="btn btn-danger" style="margin-right: 2%;" role="button">@lang('Cancel')</a>
            <button type="submit" class="btn btn-success">@lang('Save')</button>
        </div>
    </div>
</form>
