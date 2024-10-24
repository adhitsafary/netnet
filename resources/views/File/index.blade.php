@extends($layout)

@section('konten')
    <div class="container">
        <h1 class="my-4">Daftar file TerUpload</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <form action="{{ route('file.store') }}" class="mb-3" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
                <label for="file" class="form-label">Choose file</label>
                <input type="file" name="file" class="form-control" id="file">
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama File</th>
                    <th>Ukuran file</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($files as $file)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $file->file_name }}</td>
                        <td>{{ $file->file_size }} bytes</td>
                        <td>
                            <a href="{{ Storage::url($file->file_path) }}" class="btn btn-success">Lihat</a>
                            <a href="{{ route('file.download', $file->id) }}" class="btn btn-success">Download</a>

                            <a href="{{ route('file.edit', $file->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('file.destroy', $file->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada File Tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
