@extends('layouts.manager')
@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>App id</th>
            <td>Title</td>
            <th>Message</th>
            <th>User</th>
            <td>Email</td>
            <td>File</td>
            <td>Viewed</td>
            <th>Created</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($apps as $app)
            <tr>
                <td>{{$app->id}}</td>
                <td>{{$app->title}}</td>
                <td>{{$app->message}}</td>
                <td>{{$app->name}}</td>
                <td>{{$app->email}}</td>
                <td><a target="_blank" href="{{url('storage/' . $app->attached_file)}}">Open file</a></td>
                <td>{{$app->viewed ? 'true' : 'false'}}</td>
                <td>{{$app->created_at}}</td>
                <td>
                    <form method="POST" action="{{route('manager.reply', $app->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input class="{{$app->viewed ? '' : 'text-success'}}" type="submit" value="Reply">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {!! $apps->links()  !!}
    </div>
@endsection
