@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Pendaftaran Mahasiswa</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Pendaftaran Mahasiswa</div>
      </div>
    </div>

    <div class="section-body">
      <div class="alert alert-light alert-has-icon">
        <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Informasi</div>
          <ul style="margin-left: -20px; margin-bottom: 0px">
            <li>Status Baru : Menunggu mahasiswa mengunggah berkas <strong>Permohonan KP & Surat Rekomendasi</strong>.</li>
            <li>Status Diunggah : Berkas telah diunggah dan menunggu konfirmasi admin. </li>
            <li>Status Diterima : Berkas telah diterima dan mahasiswa dapat melanjutkan proses pendaftaran. </li>
            <li>Status Perbaikan : Mahasiswa perlu memperbaiki dan mengunggah kembali berkas <strong>Permohonan KP atau Surat Rekomendasi</strong>.</li>
          </ul> 
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body p-4">
              <div class="table-responsive">
                <table id="datatable" class="table table-striped table-md">
                  <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>SKS Ditempuh</th>
                        <th>IPK</th>
                        <th>Judul Pra Proposal</th>
                        <th>Pembimbing</th>
                        <th>Instansi</th>
                        <th>Status</th>
                        <th width="70px">Aksi</th>
                      </tr>
                  </thead>
                  <tbody class="">
                    <?php $no=0; ?>
                    @foreach ($pendaftaran as $item)     
                      <?php $no++; ?>                   
                      <tr>
                        <td scope="row">{{ $no }}</td>
                        <td scope="row">{{ $item->nama }}</td>
                        <td scope="row">{{ $item->nim }}</td>
                        <td scope="row">{{ $item->sks_ditempuh }}</td>
                        <td scope="row">{{ $item->ipk }}</td>
                        <td scope="row">{{ $item->judul_pra_proposal }}</td>
                        <td scope="row">{{ $item->dosen_pembimbing_kp }}</td>
                        <td scope="row">{{ $item->instansi_kp }}</td>
                        <td scope="row">
                          @if($item->status === 'diunggah') 
                            <h6><span class="badge badge-info">Diunggah</span></h6>
                          @elseif($item->status === 'diterima') 
                            <h6><span class="badge badge-success">Diterima</span></h6>
                          @elseif($item->status === 'perbaikan') 
                            <h6><span class="badge badge-warning">Perbaikan</span></h6>
                          @elseif($item->status === null) 
                            <h6><span class="badge badge-secondary">Baru</span></h6>
                          @endif
                        </td>
                        <td scope="row">
                          <a href="{{ route('pendaftaran.show',$item->id) }}" class="edit btn btn-primary btn-sm">Detail</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    
  <!-- Modal Add New Periode -->
  <div class="modal fade" id="addNewDataModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form id="newDataForm">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Periode</h5>
          </div>
          <div class="modal-body">
            <input type="hidden" name="kode" id="kode">
            <input type="hidden" name="status" value="sementara">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" required="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="closeAddBtn" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" id="confirmAddBtn" class="btn btn-primary" >Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit Periode -->
  <div class="modal fade" id="editDataModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form id="editDataForm">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Ubah Periode</h5>
          </div>
          <div class="modal-body">
            <input type="hidden" id="editDataId">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" id="nama" name="nama" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Status</label>
              <select id="status" name="status" class="custom-select" required>
                <option value="">Pilih</option>
                <option value="sementara">Sementara</option>
                <option value="selesai">Selesai</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="closeEditBtn" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" id="confirmEditBtn" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Delete Periode -->
  <div class="modal fade" id="deleteDataModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Hapus Data Periode</h5>
        </div>
        <div class="modal-body">
          <input type="hidden" id="deleteDataId">
          Anda yakin akan menghapus?
        </div>
        <div class="modal-footer">
          <button type="button" id="closeDeleteBtn" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
          <button type="button" id="confirmDeleteBtn" class="btn btn-primary">Ya</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
  <script>
    $(function () {

      /*------------------------------------------ Render DataTable --------------------------------------------*/ 
      let table = $('#datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        autoWidth: false,
        columnDefs: [
          { className: "dt-center", targets: [ 0, 1, 2, 3 ] }
        ]
      });

    });
  </script>
@endpush