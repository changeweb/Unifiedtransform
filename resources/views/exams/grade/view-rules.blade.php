@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-file-text"></i> View Grading Rule
                    </h1>
                    @include('session-messages')
                    <div class="mb-4 mt-4">
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">System Name</th>
                                    <th scope="col">Points</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col">Starts At</th>
                                    <th scope="col">Ends At</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($gradeRules)
                                    @foreach ($gradeRules as $gradeRule)
                                    <tr>
                                        <td>{{$gradeRule->gradingSystem->system_name}}</td>
                                        <td>{{$gradeRule->point}}</td>
                                        <td>{{$gradeRule->grade}}</td>
                                        <td>{{$gradeRule->start_at}}</td>
                                        <td>{{$gradeRule->end_at}}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{route('exam.grade.system.rule.delete')}}" role="button" class="btn btn-sm btn-primary" onclick="event.preventDefault();
                                                     document.getElementById('delete-form-{{$gradeRule->id}}').submit();"><i class="bi bi-trash2"></i> Delete</a>
                                                <form id="delete-form-{{$gradeRule->id}}" action="{{ route('exam.grade.system.rule.delete') }}" method="POST" class="d-none">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$gradeRule->id}}">
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
