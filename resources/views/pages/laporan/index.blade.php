@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Daftar Laporan KP</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Daftar Laporan KP</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body p-4">
              <div class="table-responsive">
                <table id="datatable" class="table table-striped table-md">
                  <thead>
                      <tr>
                        <th>No</th>
                        <th>Periode</th>
                        <th>Mahasiswa</th>
                        <th>NIM</th>
                        <th>Keterangan</th>
                        <th>File</th>
                        <th>Tanggal</th>
                        {{-- <th width="70px">Aksi</th> --}}
                      </tr>
                  </thead>
                  <tbody class="">
                    <?php $no=0; ?>
                    @foreach ($laporan as $item)     
                      <?php $no++; ?>                   
                      <tr>
                        <td scope="row">{{ $no }}</td>
                        <td scope="row" width="150px">{{ $item->periode }}</td>
                        <td scope="row" width="200px">{{ $item->nama_mhs }}</td>
                        <td scope="row">{{ $item->nim }}</td>
                        <td scope="row">{{ $item->keterangan }}</td>
                        <td scope="row">
                          <a class="btn" href="{{ asset($item->file) }}" target="blank">Lihat</a>
                        </td>
                        <td scope="row" width="100px">{{ $item->updated_at->translatedFormat("d F Y") }}</td>
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