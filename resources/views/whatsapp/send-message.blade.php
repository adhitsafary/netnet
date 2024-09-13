@extends('layout')

@section('konten')
    <div class="container mt-5">
        <h4>Kirim Pesan WhatsApp</h4>
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('message.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="target">Pilih Target:</label>
                <select name="target[]" id="target" class="form-control" multiple>
                    @foreach($pelanggan as $item)
                        <option value="{{ $item->no_telepon_plg }}">
                            {{ $item->nama_plg }} - {{ $item->no_telepon_plg }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="message">Pesan:</label>
                <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Kirim Pesan</button>
        </form>
    </div>
@endsection
