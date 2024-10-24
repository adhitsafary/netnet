@extends($layout)

@section('konten')
    <div class="container">
        <h1 class="my-4">Edit File</h1>

        <form action="{{ route('file.update', $file->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Current File: {{ $file->file_name }}</label><br>
                <input type="file" name="file" class="form-control" id="file">
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
        </form>
    </div>
@endsection
