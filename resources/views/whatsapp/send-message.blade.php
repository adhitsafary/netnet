@extends($layout)

@section('konten')
    <div class="ml-5 mr-5 mb-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4>Kirim Pesan WhatsApp</h4>
            </div>
            <div class="card-body">

                {{-- Notifikasi sukses --}}
                @if (session('status'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert"
                        style="background-color: #009b08; color: #1dff1d; border-color: #ffeeba;">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                            style="background-color: #fff3cd; color: #856404;"></button>
                    </div>
                @endif


                {{-- Form Filter --}}
                <form action="{{ route('message.create') }}" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <input type="text" name="search" placeholder="Nama Pelanggan"
                                class="form-control border-primary" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="text" name="alamat_plg" placeholder="Alamat" class="form-control border-primary"
                                value="{{ request('alamat_plg') }}">
                        </div>
                        <div class="col-md-2 mb-3">
                            <select name="tgl_tagih_plg" id="tgl_tagih_plg" class="form-control border-primary"
                                onchange="this.form.submit();">
                                <option value="">Tanggal Tagih</option>
                                @for ($i = 1; $i <= 33; $i++)
                                    <option value="{{ $i }}"
                                        {{ request('tgl_tagih_plg') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <button type="submit" class="btn btn-success w-100">Filter</button>
                        </div>
                    </div>
                </form>

                {{-- Form Kirim Pesan --}}
                <form action="{{ route('message.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="target" class="form-label">Pilih Target:</label>
                        <select name="target[]" id="target" class="form-control form-control-lg border-primary" multiple
                            style="height: 300px; font-size: 1.2rem;" onchange="updateMessage()">
                            @foreach ($pelanggan as $item)
                                <option value="{{ $item->no_telepon_plg }}"
                                    data-tgl_tagih="{{ \Carbon\Carbon::now()->setDay($item->tgl_tagih_plg)->format('d F Y') }}"
                                    data-nama="{{ $item->nama_plg }}" data-paket="{{ $item->paket_plg }}"
                                    data-alamat="{{ $item->alamat_plg }}" data-harga="{{ $item->harga_paket }}"
                                    data-alamat="{{ $item->alamat_plg }}">
                                    {{ $item->nama_plg }} - {{ $item->no_telepon_plg }} - {{ $item->alamat_plg }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Preview pesan yang akan dikirim --}}
                    <div class="form-group mb-3">
                        <label for="message" class="form-label">Pesan:</label>
                        <textarea name="message" id="message" class="form-control border-primary" rows="10" required>{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 w-100">Kirim Pesan</button>
                </form>
            </div>
            <br>
        </div>
    </div>

    <script>
        function updateMessage() {
            let select = document.getElementById('target');
            let message = '';

            for (let option of select.selectedOptions) {
                let tglTagih = option.getAttribute('data-tgl_tagih');
                let nama = option.getAttribute('data-nama');
                let alamat = option.getAttribute('data-alamat');
                let paket = option.getAttribute('data-paket');
                let harga = option.getAttribute('data-harga');
                let bulan = new Date().toLocaleString('default', {
                    month: 'long',
                    year: 'numeric'
                });

                message += `*NET | NET. DIGITAL-WiFi*\n\n`;
                message += `*PELANGGAN*\n`;
                message += `*YTH:*\n`;
                message += `*${nama} - ${alamat}*\n\n`;
                message += `*PEMBERITAHUAN*\n`;
                message += `Tagihan Bulan : ${bulan}\n`;
                message += `Jenis Paket : ${paket}\n`;
                message += `Biaya Paket : Rp. ${harga}\n`;
                message += `Masa aktif s/d ${tglTagih}\n`;
                message += `Ket : *BELUM TERBAYAR*\n`;
                message += `INFO TAMBAHAN:\n`;
                message += 'Dimohon untuk Melampirkan bukti pembayaran apabila sudah melakukan pembayaran.\n';
                message +=
                    'dan Apabila Telat Melakukan Pembayaran Iuran Wifi Akan di Kenakan Pemutusan Sementara Internet Yaitu (Isolir)\n\n';
                message += `PEMBAYARAN:\n\n`;
                message += `- via transfer : rek BCA : 3770198576 atas nama *Ruslandi* \n`;
                message += `- *Jemput Pembayaran dikenakan biaya jasa pengambilan Rp.5000*\n\n`;
                message += `Admin     : 0857-5922-9720 (Agis)\n`;
                message += `CS        : 0857-9392-0206\n`;
                message += `Marketing  : 0857-2222-0169 (Gilang)\n\n`;
            }

            document.getElementById('message').value = message;
        }
    </script>
@endsection
