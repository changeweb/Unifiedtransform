@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3"><i class="bi bi-file-plus"></i> Create Grading System</h1>
                    @include('session-messages')
                    <div class="row">
                        <div class="col-md-5 mb-4">
                            <div class="p-3 border shadow-sm bg-light">
                                <form action="{{route('exam.grade.system.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                                    <div>
                                        <p class="mt-2">Select class:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                        <select class="form-select" name="class_id" required>
                                            @isset($school_classes)
                                                @foreach ($school_classes as $school_class)
                                                <option value="{{$school_class->id}}">{{$school_class->class_name}}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <div>
                                        <p class="mt-2">Select semester:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                        <select class="form-select" aria-label=".form-select-sm" name="semester_id" required>
                                            @isset($semesters)
                                                @foreach ($semesters as $semester)
                                                <option value="{{$semester->id}}" {{($semester->id === request()->query('semester_id'))?'selected':''}}>{{$semester->semester_name}}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <div class="mt-2">
                                        <p>Grading System name<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                        <input type="text" class="form-control" placeholder="Grading System 1" aria-label="Grading System 1" name="system_name" required>
                                    </div>
                                    <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="bi bi-check2"></i> Create</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
