@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3"><i class="bi bi-calendar4-range"></i> Routine</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url()->previous()}}">Classes</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Section Routine</li>
                        </ol>
                    </nav>
                    @php
                        function getDayName($weekday) {
                            if($weekday == 1) {
                                return "MONDAY";
                            } else if($weekday == 2) {
                                return "TUESDAY";
                            } else if($weekday == 3) {
                                return "WEDNESDAY";
                            } else if($weekday == 4) {
                                return "THURSDAY";
                            } else if($weekday == 5) {
                                return "FRIDAY";
                            } else if($weekday == 6) {
                                return "SATURDAY";
                            } else if($weekday == 7) {
                                return "SUNDAY";
                            } else {
                                return "Noday";
                            }
                        }
                    @endphp
                    @if(count($routines) > 0)
                    <div class="bg-white p-3 border shadow-sm">
                        <table class="table table-bordered text-center">
                            </thead>
                            <tbody>
                                @foreach($routines as $day => $courses)
                                    <tr><th>{{getDayName($day)}}</th>
                                        @php
                                            $courses = $courses->sortBy('start');
                                        @endphp
                                        @foreach($courses as $course)
                                            <td>
                                                <span>{{$course->course->course_name}}</span>
                                                <div>{{$course->start}} - {{$course->end}}</div>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="p-3 bg-white border shadow-sm">No routine.</div>
                    @endif
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
