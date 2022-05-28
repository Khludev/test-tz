@extends('layouts.manager')
@section('content')
    <table class="table table-striped">
        <tr>
            <td>User</td>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <td>User ID</td>
            <td>{{$user->id}}</td>
        </tr>
        <tr>
            <td>Title</td>
            <td>{{$app->title}}</td>
        </tr>
        <tr>
            <td>Message</td>
            <td>{{$app->message}}</td>
        </tr>
        <tr>
            <td>File</td>
            <td><a target="_blank" href="{{url('storage/' . $app->attached_file)}}">{{$app->attached_file}}</a></td>
        </tr>
        <tr>
            <td>Created</td>
            <td>{{$app->created_at}}</td>
        </tr>
    </table>
@endsection
