@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-cloud-sun"></i> View Results
                    </h1>
                    <h6>Filter list by:</h6>
                    <div class="mb-4 mt-4">
                        <form action="{{route('course.mark.list.show')}}" method="GET">
                            <div class="row">
                                <div class="col">
                                    <select class="form-select" name="semester_id" required>
                                        @isset($semesters)
                                            @foreach ($semesters as $semester)
                                            <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="col">
                                    <select onchange="getSectionsAndCourses(this);" class="form-select" name="class_id" aria-label="Class">
                                        @isset($classes)
                                            <option selected disabled>Please select a class</option>
                                            @foreach ($classes as $school_class)
                                                <option value="{{$school_class->id}}">{{$school_class->class_name}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-select" id="section-select" name="section_id" required>
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-select" id="course-select" name="course_id" required>
                                    </select>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-counterclockwise"></i> Load List</button>
                                </div>
                            </div>
                        </form>
                        <div class="bg-white border mt-4 p-3 shadow-sm">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Photo</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Total Marks</th>
                                        <th scope="col">Grade Points</th>
                                        <th scope="col">Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($marks)
                                        @foreach ($marks as $mark)
                                        <tr>
                                            <td><i class="bi bi-person-square"></i></td>
                                            <td>{{$mark->student->first_name}} {{$mark->student->last_name}}</td>
                                            <td>{{$mark->final_marks}}</td>
                                            <td>{{$mark->getAttribute('point')}}</td>
                                            <td>{{$mark->getAttribute('grade')}}</td>
                                        </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
<script>
    function getSectionsAndCourses(obj) {
        var class_id = obj.options[obj.selectedIndex].value;

        var url = "{{route('get.sections.courses.by.classId')}}?class_id=" + class_id 

        fetch(url)
        .then((resp) => resp.json())
        .then(function(data) {
            var sectionSelect = document.getElementById('section-select');
            sectionSelect.options.length = 0;
            data.sections.unshift({'id': 0,'section_name': 'Please select a section'})
            data.sections.forEach(function(section, key) {
                sectionSelect[key] = new Option(section.section_name, section.id);
            });

            var courseSelect = document.getElementById('course-select');
            courseSelect.options.length = 0;
            data.courses.unshift({'id': 0,'course_name': 'Please select a course'})
            data.courses.forEach(function(course, key) {
                courseSelect[key] = new Option(course.course_name, course.id);
            });
        })
        .catch(function(error) {
            console.log(error);
        });
    }
</script>
@endsection
