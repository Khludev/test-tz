@extends('layouts.client')
@section('content')
    <form action="{{route('client.app.create')}}" class="card p-2" method="POST" enctype="multipart/form-data">
        <fieldset {{$create_app_access ? 'disabled="disabled' : ''}}>
            @if($create_app_access)
                <div class="text-info">
                    Entry creation is limited to one per day. Last- {{$create_app_access->created_at}}
                    <a class="text-success" href="{{route('client.app.resetDate')}}">Reset date</a>
                </div>
            @endif
            @csrf
            <input type="hidden" name="create_app_access" value="1">
            @error('create_app_access')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="card-header">New application</div>
            <div class="mb-3 mt-2">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="form-control @error('title') is-invalid @enderror" id="title">
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="message"
                          rows="3">{{ old('message') }}</textarea>
                @error('message')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">File</label>
                <p class="text-info">max size:512, mimes:jpg,bmp,png,pdf,docx,doc,ms-doc,msword</p>
                <input class="form-control @error('attached_file') is-invalid @enderror" type="file" name="file"
                       id="file">
                @error('attached_file')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input class="form-control btn-success" type="submit" name="submit" value="Send">
            </div>
        </fieldset>
    </form>
@endsection
