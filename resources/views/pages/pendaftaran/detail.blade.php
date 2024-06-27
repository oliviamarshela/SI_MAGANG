@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Pendaftaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Detail Pendaftaran</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-10">

                    <div class="card">
                        <div class="card-header">
                            <h4>Status : </h4>
                            @if($pendaftaran?->status === 'diunggah') 
                                <h6 style="margin-top: 6px"><span class="badge badge-info">Diunggah</span></h6>
                            @elseif($pendaftaran?->status === 'diterima') 
                                <h6 style="margin-top: 6px"><span class="badge badge-success">Diterima</span></h6>
                            @elseif($pendaftaran?->status === 'perbaikan') 
                                <h6 style="margin-top: 6px"><span class="badge badge-warning">Perbaikan</span></h6>
                            @elseif($pendaftaran?->status === null) 
                                <h6 style="margin-top: 6px"><span class="badge badge-secondary">Baru</span></h6>
                            @endif
                        </div>
                        <div class="card-body">
                            
                            <div class="row">      
                                <div class="col-md-6 col-12">
                                    <div class="" style="">
                                        <div class="" style="font-weight: bold">Nama Lengkap</div>
                                        {{ $pendaftaran->nama ?? "-" }}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="" style="">
                                        <div class="" style="font-weight: bold">NIM</div>
                                        {{ $pendaftaran->nim ?? "-" }}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">      
                                <div class="col-md-6 col-12">
                                    <div class="" style="">
                                        <div class="" style="font-weight: bold">Program Studi</div>
                                        {{ $pendaftaran->prodi ?? "-" }}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="" style="">
                                        <div class="" style="font-weight: bold">SKS Ditempuh</div>
                                        {{ $pendaftaran->sks_ditempuh ?? "-" }}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">      
                                <div class="col-md-6 col-12">
                                    <div class="" style="">
                                        <div class="" style="font-weight: bold">Judul Pra Proposal</div>
                                        {{ $pendaftaran->judul_pra_proposal ?? "-" }}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="" style="">
                                        <div class="" style="font-weight: bold">IPK</div>
                                        {{ $pendaftaran->ipk ?? "-" }}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">      
                                <div class="col-md-6 col-12">
                                    <div class="" style="">
                                        <div class="" style="font-weight: bold">Dosen Pembimbing KP</div>
                                        {{ $pendaftaran->dosen_pembimbing_kp ?? "-" }}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="" style="">
                                        <div class="" style="font-weight: bold">NIP</div>
                                        {{ $pendaftaran->nip ?? "-" }}
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">      
                                <div class="col-md-6 col-12">
                                    <div class="" style="">
                                        <div class="" style="font-weight: bold">Instansi KP</div>
                                        {{ $pendaftaran->instansi_kp ?? "-" }}
                                    </div>
                                </div>
                            </div>
                            
                            <hr>

                            @if(!$berkas)
                                <div class="alert alert-warning alert-has-icon">
                                    <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                                    <div class="alert-body">
                                        <div class="alert-title">Informasi</div>
                                        <p>Mahasiswa belum mengunggah <strong>Permohonan KP & Surat Rekomendasi</strong></p>
                                    </div>
                                </div>
                            @else
                                <div class="">
                                    <a href="{{ asset($berkas->permohonan_kp) }}" class="btn btn-outline-secondary" target="blank">Lihat Permohonan KP & Surat Rekomendasi <i class="far fa-file-pdf"></i></a>
                                    @if($berkas->surat_balasan_instansi)
                                        <a href="{{ asset($berkas->surat_balasan_instansi) }}" class="btn btn-outline-secondary" target="blank">Lihat Surat Balasan Instansi <i class="far fa-file-pdf"></i></a>
                                    @endif
                                </div>
                            @endif

                            @if($pendaftaran?->status === "diunggah")
                                <br>
                                <form method="POST" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data">
                                    @csrf     
                                    <h6>Konfirmasi Pendaftaran</h6>                    
                                    <input type="hidden" name="pendaftaran_id" value="{{request()->segment(2)}}">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="custom-select" required="">
                                            <option value="" selected>Pilih</option>
                                            <option value="diterima">Terima</option>
                                            <option value="perbaikan">Perbaikan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan (Opsional)</label>
                                        <input type="text" name="keterangan_konfirmasi" class="form-control" >
                                      </div>
                                    <div class="float-right">
                                        <button type="submit" id="confirmAddBtn" class="btn btn-primary" >Simpan</button>
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