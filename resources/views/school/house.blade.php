@extends('layouts.app')

@section('title', __('All Houses'))

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>

        <div class="col-md-10" id="main-container">
            <h4>@lang('All Houses')</h4>
            <br>
            <a href="{{url('#')}}" class="btn btn-sm btn-success"><i class="material-icons">import_export</i> Export all houses</a>
            @include('layouts.master.add-house-form') <!--NEW HOUSE BUTTON -->
            <hr>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                    {{-- <span class="error">{{ $error}}</span> --}}
                @endforeach
                <br>
            @endif
   

            <table id="house_table" class='table'>
                <thead>
                    <th class="text-center">House Name</th>
                    <th class="text-center">Active</th>
                    <th class="text-center">Student Count</th>
                    <th class="text-center">Last Session</th>
                    <th class="text-center">View Students</th>
                    <th class="text-center">Edit House</th>
                </thead>
                <tbody>
                    @foreach ($houses as $house)
                        <tr>
                            <td>{{$house->house_name.' ('.$house->house_abbrv.')'}}</td>
                            <td class="text-center">{{($house->active)?"Yes":"No"}}</td>
                            @php 
                                $count = \App\StudentInfo::where('session', now()->year)->where('house_id', $house->id)->count('id');
                            @endphp
                            <td class="text-center">{{($count == 0)?'-':$count}}</td>
                            <td class="text-center">{{\App\StudentInfo::where('house_id', $house->id)->max('session')}}</td>
                            <td class="text-center">
                                <a role="button" class="btn btn-primary btn-xs" href="{{url('house/tct_students/'.$house->id)}}"><i class="material-icons">visibility</i> @lang('View Students')</a>
                            </td>
                            <td class="text-center">
                                @include('layouts.master.edit-house-form')
                            </td>
                        </tr>
                    @endforeach


                </tbody>

            </table>


        </div>
    </div>
</div>
@endsection
