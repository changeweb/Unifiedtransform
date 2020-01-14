@extends('layouts.app')

@section('title', __('Course Students'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-8" id="main-container">
            <br>
            <h4>
                @lang('Form') {{$section->class->class_number}}{{$section->section_number}}
            </h4>
            <div class="panel panel-default">
                {{-- {{$students}} --}}
              @if($students->first())
                <div class="panel-body">
                    <table id="myTable" class="table table-data-div table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center" scope="col">@lang('#')</th>
                            <th class="text-center" scope="col">@lang('TCT ID')</th>
                            <th class="text-center" scope="col">@lang('Status')</th>
                            <th class="text-center" scope="col">@lang('Student Name')</th>
                            <th class="text-center" scope="col">@lang('House')</th>
                            {{-- <th scope="col">@lang('Grade History')</th> --}}
                        </tr>
                        </thead>
                        <tbody>
                        @for ($i = 1; $i < $max_loop + 1; $i++)
                            <tr>
                            @php $student = \App\StudentInfo::where(
                                    [
                                    'form_id' => $section->id,
                                    'form_num' => $i,
                                    'session' => now()->year,
                                    ])->first();
                            @endphp
                            <td class="text-center">{{$i}}</td>
                            @if($student)
                                <td class="text-center">{{$student->student->student_code}}</td>
                                <td class="text-center">{{($student->student->active)?'Active / '.ucfirst($student->group):'Inactive / '.ucfirst($student->student->inactive->type)}}  
                                <td>
                                    <a href="{{url('user/'.$student->student->student_code)}}">{{($student->student->name == '')?$student->student->given_name.' '.$student->student->lst_name:$student->student->name}}</a>
                                </td>
                                <td class="text-center">
                                    {{$student->house->house_name}}
                                </td>
                                {{-- <td><a class="btn btn-xs btn-success" role="button" href="{{url('grades/'.$student->student->id)}}">@lang('View Grade History')</a></td> --}}
                            @else
                                <td colspan="4"></td>
                            @endif
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
              @else
                <div class="panel-body">
                    @lang('No Related Data Found.')
                </div>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection
