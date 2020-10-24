<div class="table-responsive">
    <form action="{{url('school/promote-students')}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="section_id" value="{{$section_id}}">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">@lang('Code')</th>
                    <th scope="col">@lang('Name')</th>
                    <th scope="col">@lang('Left School')</th>
                    <th scope="col">@lang('From Session')</th>
                    <th scope="col">@lang('To Session')</th>
                    <th scope="col">@lang('From Section')</th>
                    <th scope="col">@lang('To Section')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $key=>$student)
                <tr>
                    <th scope="row">{{ ($loop->index + 1) }}</th>
                    <td><small>{{$student->student_code}}</small></td>
                    <td>
                        <small><a href="{{url('student/'.$student->student_code)}}">{{$student->name}}</a></small>
                    </td>
                    <td>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="left_school{{$loop->index}}"> @lang('Left')
                            </label>
                        </div>
                    </td>
                    <td>
                        <small>
                            {{$student->session}}
                            @if($student->session == now()->year || $student->session > now()->year)
                            <span class="label label-success">@lang('Promoted/New')</span>
                            @else
                            <span class="label label-danger">@lang('Not Promoted')</span>
                            @endif
                        </small>
                    </td>
                    <td>
                        <input class="form-control datepicker" name="to_session[]"
                            value="{{date('Y', strtotime('+1 year'))}}">
                    </td>
                    <td style="text-align: center;">
                        <small>@lang('Class'): {{$student->section->class->class_number}} - @lang('Section'):
                            {{$student->section->section_number}}</small>
                    </td>
                    <td>
                        <select id="to_section" class="form-control" name="to_section[]" required>
                            @foreach($classes as $class)
                            @foreach($class->sections as $section)
                            <option value="{{$section->id}}">
                                @lang('Class'): {{$class->class_number}} -
                                @lang('Section'): {{$section->section_number}}
                            </option>
                            @endforeach
                            @endforeach
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="text-align:center;">
            <input type="submit" class="btn btn-primary" value="@lang('Submit')">
        </div>
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
