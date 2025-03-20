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
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#renameModal-{{ $file->id }}">Rename</button>
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#shareModal-{{ $file->id }}">Share</button>
                </div>
            </div>
        </div>

        <!-- Rename Modal -->
        <div class="modal fade" id="renameModal-{{ $file->id }}" tabindex="-1" aria-labelledby="renameModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('files.rename', $file->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="renameModalLabel">Rename File</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" name="new_name" class="form-control" value="{{ $file->name }}" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Share Modal -->
        <div class="modal fade" id="shareModal-{{ $file->id }}" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('files.share', $file->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="shareModalLabel">Share File</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="email" name="email" class="form-control" placeholder="Enter email to share with" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Share</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
