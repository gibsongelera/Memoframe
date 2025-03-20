@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cloud File Storage</h2>
    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <label><input type="checkbox" name="use_cloud"> Upload to Cloud</label>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    
    <h3 class="mt-3">Uploaded Files</h3>
    <ul class="list-group">
        @foreach($files as $file)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $file->filename }}
                <form action="{{ route('files.destroy', $file->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
