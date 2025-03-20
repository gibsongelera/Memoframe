@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">My Drive</h2>
    <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    <div class="row mt-4">
        @foreach ($files as $file)
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <p>{{ $file->name }}</p>
                    <a href="{{ route('files.download', $file->id) }}" class="btn btn-success btn-sm">Download</a>
                    <form action="{{ route('files.delete', $file->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
