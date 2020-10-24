@extends('layouts.app')

@section('title', __('Impersonate'))

@section('content')
<div class="container">
    <div class="panel panel-default">
        <table class="table">
            <thead>
                <tr>
                    <th>@lang('ID')</th>
                    <th>@lang('Name')</th>
                    <th>@lang('Role')</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($other_users as $other_user)
                <form method="POST" action="{{ url('/user/config/impersonate') }}">
                    {{ csrf_field() }}
                    <tr>
                        <td>{{ $other_user->id }}</td>
                        <td>{{ $other_user->name }}</td>
                        <td>{{ $other_user->role }}</td>
                        <td>
                            <input type="hidden" name="id" value="{{$other_user->id}}" />
                            <button class="btn btn-default">@lang('Impersonate')</button>
                        </td>
                    </tr>
                </form>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
