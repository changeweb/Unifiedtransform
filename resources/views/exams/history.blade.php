@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3"><i class="bi bi-distribute-vertical"></i> Exam History</h1>
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-dark my-3">
                                <div class="card-header bg-transparent border-dark">
                                    <i class="bi bi-diagram-2"></i> Class 1
                                </div>
                                <div class="card-body text-dark">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                    Section #1
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="mb-4">
                                                        <!-- timeline item 1 -->
                                                        <div class="row">
                                                            <!-- timeline item 1 left dot -->
                                                            <div class="col-auto text-center flex-column d-none d-sm-flex">
                                                                <div class="row h-50">
                                                                    <div class="col">&nbsp;</div>
                                                                    <div class="col">&nbsp;</div>
                                                                </div>
                                                                <h5 class="m-2">
                                                                    <span class="badge rounded-pill bg-light border">&nbsp;</span>
                                                                </h5>
                                                                <div class="row h-50">
                                                                    <div class="col border-end">&nbsp;</div>
                                                                    <div class="col">&nbsp;</div>
                                                                </div>
                                                            </div>
                                                            <!-- timeline item 1 event content -->
                                                            <div class="col py-2">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col fs-4">Quiz 1</div>
                                                                        <div class="col text-end">Jan 9th 2021 9:00 AM</div>
                                                                    </div>
                                                                    <div class="row text-muted">
                                                                        <div class="col">Belongs to: First Semester</div>
                                                                        <div class="col text-end">Starts: Jan 9th 2021 - Ends: Jan 15th 2021</div>
                                                                    </div>
                                                                
                                                                <p class="card-text">
                                                                    <span class="badge bg-secondary">Course: Math</span>
                                                                    <span class="badge bg-dark">Marks: 100</span>
                                                                    <span class="badge bg-primary">Category: Quiz</span>
                                                                </p>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->
                                                        <!-- timeline item 2 -->
                                                        <div class="row">
                                                            <div class="col-auto text-center flex-column d-none d-sm-flex">
                                                            <div class="row h-50">
                                                                <div class="col border-end">&nbsp;</div>
                                                                <div class="col">&nbsp;</div>
                                                            </div>
                                                            <h5 class="m-2">
                                                                <span class="badge rounded-pill bg-light border">&nbsp;</span>
                                                            </h5>
                                                            <div class="row h-50">
                                                                <div class="col border-end">&nbsp;</div>
                                                                <div class="col">&nbsp;</div>
                                                            </div>
                                                            </div>
                                                            <div class="col py-2">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                <div class="float-right">Tue, Jan 10th 2019 8:30 AM</div>
                                                                <h4 class="card-title">Day 2 Sessions</h4>
                                                                <p class="card-text">Sign-up for the lessons and speakers that coincide with your course syllabus. Meet and greet with instructors.</p>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->
                                                        <!-- timeline item 3 -->
                                                        <div class="row">
                                                            <!-- timeline item 1 left dot -->
                                                            <div class="col-auto text-center flex-column d-none d-sm-flex">
                                                                <div class="row h-50">
                                                                    <div class="col border-end">&nbsp;</div>
                                                                    <div class="col">&nbsp;</div>
                                                                </div>
                                                                <h5 class="m-2">
                                                                    <span class="badge rounded-pill bg-light border">&nbsp;</span>
                                                                </h5>
                                                                <div class="row h-50">
                                                                    <div class="col border-end">&nbsp;</div>
                                                                    <div class="col">&nbsp;</div>
                                                                </div>
                                                            </div>
                                                            <!-- timeline item 1 event content -->
                                                            <div class="col py-2">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                <div class="float-right text-muted">Mon, Jan 9th 2019 7:00 AM</div>
                                                                <h4 class="card-title">Day 1 Orientation</h4>
                                                                <p class="card-text">Welcome to the campus, introduction and get started with the tour.</p>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->
                                                    </div>
                                                    <!--container-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
