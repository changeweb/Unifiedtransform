@extends('layouts.app')

@section('title', 'Add Routine')

@section('content')
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
                    @component('components.file-uploader',['upload_type'=>'routine'])
                    @endcomponent
                    @component('components.uploaded-files-list',['files'=>$files,'upload_type'=>'routine'])
                    @endcomponent
                </div>
            </div>
        </div>
@endsection
