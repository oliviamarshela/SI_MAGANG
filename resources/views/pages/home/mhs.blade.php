<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <section class="section">
                    <div class="section-body">
                        <div class="row">
                            <div class="col-10">
                                <h2 class="section-title">Selamat Datang</h2>
                                <p class="section-lead">Halaman informasi untuk pengajuan Kerja Praktek.</p>
                            </div>
                            <div class="col-2">
                                <img src="{{ asset('assets/img/logo.png') }}" class="float-right" width="80" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                    </div>
                </section>

                <table class="table table-bordered table-md">
                    <tr>
                        <th colspan="2">INFORMASI PENDAFTARAN KP</th>
                    </tr>
                    <tr>
                        <td width="300px">Periode</td>
                        <td>{{ $periode?->nama ?? "-" }}</td>
                    </tr>
                    <tr>
                        <td>Jadwal Pembekalan</td>
                        <td>{{ $jadwalPembekalan?->tanggal->translatedFormat('l, d F Y') ?? "-" }}, {{ $jadwalPembekalan?->jam ?? "-" }}</td>
                    </tr>
                    <tr>
                        <td>Jadwal Pelepasan</td>
                        <td>{{ $jadwalPelepasan?->tanggal->translatedFormat('l, d F Y') ?? "-" }}, {{ $jadwalPelepasan?->jam ?? "-" }}</td>
                    </tr>
                    <tr>
                        <td>Jadwal Penarikan</td>
                        <td>{{ $jadwalPenarikan?->tanggal->translatedFormat('l, d F Y') ?? "-" }}, {{ $jadwalPenarikan?->jam ?? "-" }}</td>
                    </tr>
                    <tr>
                        <td>Jadwal Ujian</td>
                        <td>{{ $jadwalUjian?->tanggal->translatedFormat('l, d F Y') ?? "-" }}, {{ $jadwalUjian?->jam ?? "-" }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if(!$pendaftaran)    
            <div class="alert alert-light alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Info</div>
                    Anda belum terdaftar untuk pengajuan <strong>Permohonan KP</strong>.
                </div>
            </div>
        @elseif($pendaftaran && $pendaftaran?->status === null)    
            <div class="alert alert-light alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Info</div>
                    Anda telah mendaftar, lanjut untuk menggunggah berkas <strong>Permohonan KP & Surat Rekomendasi</strong>.
                </div>
            </div>
        @elseif($pendaftaran && $pendaftaran?->status === 'diunggah')    
            <div class="alert alert-light alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Info</div>
                    Anda telah menggunggah berkas <strong>Permohonan KP & Surat Rekomendasi</strong>, dan akan dikonfirmasi oleh admin.
                </div>
            </div>
        @elseif($pendaftaran && $pendaftaran?->status === 'perbaikan')    
            <div class="alert alert-light alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Info</div>
                    Anda perlu memperbaiki dan menggunggah kembali berkas <strong>Permohonan KP & Surat Rekomendasi</strong>.
                    <p class="mt-4"><strong>Keterangan Perbaikan : {{$unggahBerkas?->keterangan_konfirmasi ?? "-"}}</strong></p>
                </div>
            </div>
        @elseif($pendaftaran && $pendaftaran?->status === 'diterima' && $unggahBerkas?->surat_balasan_instansi === null)    
            <div class="alert alert-light alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Info</div>
                    <ul style="margin-left: -20px; margin-bottom: 0px">
                        <li>Berkas telah diterima, anda dapat mengunduh Surat Pengantar Instansi.</li>
                        <li>Setelah menerima surat balasan dari Instansi, anda dapat mengunggah surat.</li>
                    </ul>
                    <a href="{{route('pengantar-instansi')}}" class="mt-4 btn btn-primary" target="blink">Surat Pengantar Instansi <i class="fas fa-download"></i></a> 
                </div>
            </div>
        @elseif($pendaftaran && $pendaftaran?->status === 'diterima' && $unggahBerkas?->surat_balasan_instansi && !$laporan)    
            <div class="alert alert-light alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Info</div>
                    <p>Anda dapat mengunggah Laporan Akhir KP jika telah tersedia.</p>
                </div>
            </div>
        @elseif($laporan)    
            <div class="alert alert-light alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Info</div>
                    <p>Anda telah mengunggah <strong>Laporan KP</strong>.</p>
                </div>
            </div>
        @endif
    </div>
</div>
