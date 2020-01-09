{{$users->links()}}
<div class="table-responsive">
<table class="table table-bordered table-data-div table-condensed table-striped table-hover">
  <thead>
    <tr>
        <th scope="col" class="text-center">TCT ID</th>
        <th scope="col" class="text-center">@lang('Status')</th>
        <th scope="col" class="text-center">@lang('Full Name')</th>
        @if($type != 'registered')
        <th scope="col" class="text-center">@lang('Session')</th>
        @endif
        <th scope="col" class="text-center">@lang('Form')</th>
        <th scope="col" class="text-center">@lang('Form #')</th>
        <th scope="col" class="text-center">@lang('House')</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key=>$user)
    <tr>
      {{-- <th scope="row">{{ ($current_page-1) * $per_page + $key + 1 }}</th> --}}
        <td class="text-center"><small>{{$user->student_code}}</small></td>
        <td>
            @if($type == 'registered')
                {{($user->active)?'Active / '.ucfirst($user->studentInfo->group):'Inactive'}}
            @elseif($type == 'archived')
                {{($user->active)?'Graduated / '.ucfirst($user->studentInfo->group):'Inactive'}}
            @endif
            </td>
        <td><small><a href="{{url('user/'.$user->student_code)}}">{{$user->name}}</a></small></td>
        @if($type != 'registered')
            <td class="text-center">
                <small>
                    {{$user->studentInfo['session']}}
                </small>
            </td>
        @endif
        <td class="text-center"><small>{{$user->section->class->class_number}}{{$user->section->section_number}}</small></td>
        <td class="text-center"><small>{{$user->studentInfo->form_num}}</small></td>
        <td  class="text-center" style="white-space: nowrap;"><small>{{$user->studentInfo->house->house_name}}</small></td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{$users->links()}}
