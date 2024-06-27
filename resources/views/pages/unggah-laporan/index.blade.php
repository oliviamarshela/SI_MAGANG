@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Laporan KP</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Laporan KP</div>
      </div>
    </div>

    <div class="section-body">
      <div class="alert alert-light alert-has-icon">
        <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Informasi</div>
          <ul style="margin-left: -20px; margin-bottom: 0px">
            <li>Unggah kedua berkas dibawah dan akan dikonfirmasi oleh admin.</li>
            <li>Berkas dapat diunggah kembali jika diperlukan.</li>
          </ul> 
        </div>
      </div>
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h4>Laporan Kerja Praktek</h4>
          </div>
            <div class="card-body p-4">
              @if($pendaftaran?->status === "diterima" && $unggahBerkas?->surat_balasan_instansi)
                @if($laporan)
                  <div class="alert alert-success alert-has-icon">
                      <div class="alert-icon"><i class="fas fa-check"></i></div>
                      <div class="alert-body">
                          <p>Laporan telah diunggah.</p>
                      </div>
                  </div>
                @endif

                <form method="POST" action="{{ route('unggah-laporan.store') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label>Laporan</label>
                      @if($laporan)
                          <a class="btn" href="{{ asset($laporan->file) }}" target="blank">Lihat</a>
                      @endif
                      <input type="file" name="file" class="form-control" required="">
                      <div style="color: rgb(168, 168, 168); font-size: 13px; font-weight: normal;" class="mt-1">Max : 10MB</div>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" required=""></textarea>
                </div>
                  <div class="float-right">
                      <button type="submit" class="btn btn-primary" >Simpan</button>
                  </div>
                </form>
              @else
                <div class="alert alert-warning alert-has-icon">
                  <div class="alert-icon"><i class="fas fa-info"></i></div>
                  <div class="alert-body">
                      <p>Belum dapat diakses.</p>
                  </div>
                </div>
              @endif
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection