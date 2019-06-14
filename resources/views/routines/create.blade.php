@extends('layouts.app')

@section('title', 'Add Routine')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">Add Routine
                </div>
                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#routine-form" aria-controls="routine-form" role="tab" data-toggle="tab">Using
                                    Form</a>
                            </li>
                            <li role="presentation">
                                <a href="#routine-upload" aria-controls="routine-upload" role="tab" data-toggle="tab">By
                                    Upload</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="routine-form">
                                <form class="form-horizontal" style="font-size: 14px;" action="" method="post">
                                    <div class="form-group">
                                        <label for="class-name" class="col-sm-2 control-label">Class</label>
                                        <div class="col-sm-2">
                                            <select class="form-control input-sm">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <label for="section" class="col-sm-2 control-label">Section</label>
                                        <div class="col-sm-2">
                                            <select class="form-control input-sm">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="classTime" class="col-sm-1 control-label">Time</label>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control input-sm" id="classTime"
                                                placeholder="Time">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control input-sm" id="classTime"
                                                placeholder="Time">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control input-sm" id="classTime"
                                                placeholder="Time">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control input-sm" id="classTime"
                                                placeholder="Time">
                                        </div>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control input-sm" id="classTime"
                                                placeholder="Time">
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn btn-danger btn-xs">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="courseName" class="col-sm-1 control-label">Saturday</label>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control input-sm" id="courseName"
                                                placeholder="Course">
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn btn-danger btn-xs">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="courseName" class="col-sm-1 control-label">Sunday</label>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control input-sm" id="courseName"
                                                placeholder="Course">
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn btn-danger btn-xs">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="courseName" class="col-sm-1 control-label">Monday</label>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control input-sm" id="courseName"
                                                placeholder="Course">
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn btn-danger btn-xs">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="courseName" class="col-sm-1 control-label">Tuesday</label>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control input-sm" id="courseName"
                                                placeholder="Course">
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn btn-danger btn-xs">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="courseName" class="col-sm-1 control-label">Wednesday</label>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control input-sm" id="courseName"
                                                placeholder="Course">
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn btn-danger btn-xs">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="courseName" class="col-sm-1 control-label">Thursday</label>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control input-sm" id="courseName"
                                                placeholder="Course">
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn btn-danger btn-xs">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="courseName" class="col-sm-1 control-label">Friday</label>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control input-sm" id="courseName"
                                                placeholder="Course">
                                        </div>
                                        <div class="col-sm-1">
                                            <button class="btn btn-danger btn-xs">
                                                <i class="material-icons">add</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger btn-sm">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="routine-upload">
                                @component('components.file-uploader',['upload_type'=>'routine'])
                                @endcomponent
                                @component('components.uploaded-files-list',['files'=>$files,'parent'=>($section_id !==
                                0)?'section':'','upload_type'=>'routine'])
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #routine-form {
        padding-top: 2%;
    }

</style>
@endsection
