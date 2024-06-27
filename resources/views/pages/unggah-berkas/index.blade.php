@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Berkas Pendaftaran</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Berkas Pendaftaran</div>
      </div>
    </div>

    <div class="section-body">
      <div class="alert alert-light alert-has-icon">
        <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Informasi</div>
          <ul style="margin-left: -20px; margin-bottom: 0px">
            <li>Unggah berkas Permohonan KP dan akan dikonfirmasi oleh admin.</li>
            <li>Berkas dapat diunggah kembali jika diperlukan.</li>
          </ul> 
        </div>
      </div>
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h4>Permohonan KP & Surat Rekomendasi</h4>
          </div>
            <div class="card-body p-4">
                @if(!$pendaftaran)
                  <div class="alert alert-warning alert-has-icon">
                    <div class="alert-icon"><i class="fas fa-info"></i></div>
                    <div class="alert-body">
                        <p>Anda belum mendaftar.</p>
                    </div>
                  </div>
                @else
                  @if($unggahBerkas && $pendaftaran->status === "diunggah")
                      <div class="alert alert-success alert-has-icon">
                          <div class="alert-icon"><i class="fas fa-check"></i></div>
                          <div class="alert-body">
                              <p>Berkas telah diunggah.</p>
                          </div>
                      </div>
                  @endif
                  @if($unggahBerkas && $pendaftaran->status === "perbaikan")
                      <div class="alert alert-warning alert-has-icon">
                          <div class="alert-icon"><i class="fas fa-info"></i></div>
                          <div class="alert-body">
                              <p>Unggah kembali berkas anda.</p>
                          </div>
                      </div>
                  @endif
                  <form method="POST" action="{{ route('unggah-berkas.store') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                          <label>PERMOHONAN KP & SURAT REKOMENDASI</label>
                          @if($unggahBerkas)
                              <a class="btn" href="{{ asset($unggahBerkas->permohonan_kp) }}" target="blank">Lihat</a>
                          @endif
                          @if($pendaftaran?->status !== 'diterima')
                            <input type="file" name="permohonan_kp" class="form-control" required="">
                            <div style="color: rgb(168, 168, 168); font-size: 13px; font-weight: normal;" class="mt-1">Max : 250KB</div>
                          @endif
                      </div>
                      @if($pendaftaran?->status !== 'diterima')
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary" >Simpan</button>
                        </div>
                      @endif
                  </form>
                @endif
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <h4>Surat Balasan Instansi</h4>
          </div>
            <div class="card-body p-4">
              @if(!$pendaftaran)
              <div class="alert alert-warning alert-has-icon">
                <div class="alert-icon"><i class="fas fa-info"></i></div>
                <div class="alert-body">
                    <p>Anda belum mendaftar.</p>
                </div>
              </div>
              @elseif($pendaftaran && $pendaftaran?->status !== "diterima")
                <div class="alert alert-warning alert-has-icon">
                  <div class="alert-icon"><i class="fas fa-info"></i></div>
                  <div class="alert-body">
                      <p>Belum dapat diakses.</p>
                  </div>
                </div>
              @elseif($pendaftaran?->status === "diterima")
                @if($unggahBerkas?->surat_balasan_instansi)
                    <div class="alert alert-success alert-has-icon">
                        <div class="alert-icon"><i class="fas fa-check"></i></div>
                        <div class="alert-body">
                            <p>Berkas telah diunggah.</p>
                        </div>
                    </div>
                @endif
                <form method="POST" action="{{ route('unggah-balasan-instansi') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label>SURAT BALASAN INSTANSI</label>
                      @if($unggahBerkas?->surat_balasan_instansi)
                          <a class="btn" href="{{ asset($unggahBerkas->surat_balasan_instansi) }}" target="blank">Lihat</a>
                      @endif
                      <input type="file" name="surat_balasan_instansi" class="form-control" required="">
                      <div style="color: rgb(168, 168, 168); font-size: 13px; font-weight: normal;" class="mt-1">Max : 250KB</div>
                  </div>
                  <div class="float-right">
                      <button type="submit" class="btn btn-primary" >Simpan</button>
                  </div>
                </form>
              @endif
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection