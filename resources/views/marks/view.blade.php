@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-cloud-sun"></i> View Marks
                    </h1>
                    <h5><i class="bi bi-diagram-2"></i> Class 1, Section #1 </h5>
                    <h5><i class="bi bi-compass"></i> Course: Math </h5>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th scope="col">#ID</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Quiz 1</th>
                                        <th scope="col">Quiz 2</th>
                                        <th scope="col">Quiz 1</th>
                                        <th scope="col">Quiz 2</th>
                                        <th scope="col">Midterm</th>
                                        <th scope="col">Quiz 3</th>
                                        <th scope="col">Quiz 4</th>
                                        <th scope="col">Assignment 1</th>
                                        <th scope="col">Assignment 2</th>
                                        <th scope="col">Practical</th>
                                        <th scope="col">Final</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>1012</th>
                                            <td>hamsterclover</td>
                                            <td>4,230</td>
                                            <td>9</td>
                                            <td>3</td>
                                            <td>9</td>
                                            <td>3</td>
                                            <td>2020-01-24 19:52:28</td>
                                            <td>2018-05-21 22:10:21</td>
                                            <td>2020-01-24 19:52:28</td>
                                            <td>4,230</td>
                                            <td>4,230</td>
                                            <td>9</td>
                                        </tr>
                                        <tr>
                                            <th>1013</th>
                                            <td>cellofruit</td>
                                            <td>4,126</td>
                                            <td>9</td>
                                            <td>3</td>
                                            <td>7</td>
                                            <td>3</td>
                                            <td>2020-01-21 11:05:16</td>
                                            <td>2019-02-05 17:41:19</td>
                                            <td>2020-01-24 19:52:28</td>
                                            <td>4,230</td>
                                            <td>4,230</td>
                                            <td>9</td>
                                        </tr>
                                        <tr>
                                            <th>1014</th>
                                            <td>enchantingsun</td>
                                            <td>4,085</td>
                                            <td>5</td>
                                            <td>4</td>
                                            <td>9</td>
                                            <td>3</td>
                                            <td>2020-01-22 18:44:33</td>
                                            <td>2019-03-28 12:16:02</td>
                                            <td>2020-01-24 19:52:28</td>
                                            <td>4,230</td>
                                            <td>4,230</td>
                                            <td>9</td>
                                        </tr>
                                        <tr>
                                            <th>1015</th>
                                            <td>antdory</td>
                                            <td>4,139</td>
                                            <td>7</td>
                                            <td>5</td>
                                            <td>9</td>
                                            <td>3</td>
                                            <td>2020-01-25 18:12:58</td>
                                            <td>2019-06-07 11:44:37</td>
                                            <td>2020-01-24 19:52:28</td>
                                            <td>4,230</td>
                                            <td>4,230</td>
                                            <td>9</td>
                                        </tr>
                                    </tbody>
                                </table>
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
