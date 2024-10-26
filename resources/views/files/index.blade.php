@extends($layout)

@section('konten')
    <div class="container">
        <h1 class="my-4">NDG Drive Storage</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tombol Buat Folder Baru -->
        <button class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#createFolderModal">Buat Folder
            Baru</button>
        <a href="{{ route('file.create') }}" class="btn btn-primary mb-3">Upload File baru</a>

        <!-- Modal Buat Folder Baru -->
        <div class="modal fade" id="createFolderModal" tabindex="-1" aria-labelledby="createFolderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createFolderModalLabel">Buat Folder Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('file.index') }}" method="GET">
                        <div class="modal-body">
                            <label for="new_folder_name" class="form-label">Nama Folder Baru</label>
                            <input type="text" id="new_folder_name" name="new_folder_name" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Buat Folder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Filter & Tabel File -->
        <div class="d-flex align-items-center justify-content-between mt-2">
            <form action="{{ route('file.index') }}" method="GET" class="form-inline d-flex" style="color: black;">
                <div class="input-group mr-2" style="color: black;">
                    <input type="text" name="search" id="search" class="form-control font-weight-bold"
                        style="color: black;" value="{{ request('search') }}" placeholder="Pencarian">
                </div>
                <input type="date" id="updated_at" name="updated_at" value="{{ request()->get('updated_at') }}">
                <button type="submit" name="action" value="search" class="btn btn-danger ml-2">Cari</button>
            </form>
        </div>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Ukuran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr class="{{ $item->is_folder ? 'folder-row' : 'file-row' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($item->is_folder)
                                <a href="{{ route('file.index', ['path' => $item->path]) }}">
                                    <i class="fa fa-folder mr-2" aria-hidden="true"></i> {{ $item->file_name }}
                                </a>
                            @else
                                <a href="{{ Storage::url($item->file_path) }}" target="_blank">
                                    @if (in_array(pathinfo($item->file_name, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ Storage::url($item->file_path) }}" alt="{{ $item->file_name }}"
                                            style="width: 50px; height: auto; margin-right: 10px;">
                                    @else
                                        <img src="{{ asset('icons/file-icon.png') }}" alt="{{ $item->file_name }}"
                                            style="width: 50px; height: auto; margin-right: 10px;">
                                    @endif
                                    {{ $item->file_name }}
                                </a>
                            @endif
                        </td>
                        <td>
                            @if ($item->is_folder)
                                -
                            @else
                                {{ number_format($item->file_size / 1048576, 2) }} MB
                            @endif
                        </td>
                        <td>
                            @if ($item->is_folder)
                                <a href="{{ route('file.index', ['path' => $item->path]) }}"
                                    class="btn btn-info btn-sm">Buka</a>
                            @else
                                <a href="{{ route('file.download', $item->id) }}"
                                    class="btn btn-primary btn-sm">Download</a>
                                <a href="{{ route('file.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('file.destroy', $item->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf

                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada file atau folder yang diunggah.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
