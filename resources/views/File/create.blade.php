@extends($layout)

@section('konten')
    <div class="container">
        <h1 class="my-4">Upload File</h1>

        <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Choose file</label>
                <input type="file" name="file" class="form-control" id="file">
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
@endsection
