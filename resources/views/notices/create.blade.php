@extends('layouts.app')

@section('title', 'Add Notice')
@section('content')
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">Add Notice</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @component('components.file-uploader',['upload_type'=>'notice'])
                    @endcomponent
                    @component('components.uploaded-files-list',['files'=>$files,'upload_type'=>'notice'])
                    @endcomponent
                </div>
            </div>
        </div>
@endsection
