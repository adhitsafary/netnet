<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Karyawan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Form Absensi Karyawan</h2>
        <form action="{{ url('/absensi') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">Nama Karyawan</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="" disabled selected>Pilih Karyawan</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->user->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="status_hadir" class="form-label">Status Kehadiran</label>
                <select name="status_hadir" id="status_hadir" class="form-select" required>
                    <option value="hadir">Hadir</option>
                    <option value="tidak hadir">Tidak Hadir</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Absensi</button>
        </form>
    </div>
</body>
</html>
