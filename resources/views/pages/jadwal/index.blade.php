@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Daftar Jadwal</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Daftar Jadwal</div>
      </div>
    </div>

    <div class="section-body">
      <div class="alert alert-light alert-has-icon">
        <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Informasi</div>
          <ul style="margin-left: -20px; margin-bottom: 0px">
            <li>Tidak dapat menambah jadwal baru jika tipe yang sama telah tersedia.</li>
            <li>Tidak dapat tambah/ubah/hapus jadwal jika status periode telah selesai.</li>
          </ul> 
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button id="showAddModalBtn" type="button" class="btn btn-primary">
                Tambah <i class="fas fa-plus-square"></i>
              </button>
            </div>
            <div class="card-body p-4">
              <div class="table-responsive">
                <table id="datatable" class="table table-striped table-md">
                  <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Tipe</th>
                        <th>Aksi</th>
                      </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    
  <!-- Modal Add New Jadwal -->
  <div class="modal fade" id="addNewDataModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form id="newDataForm">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jadwal</h5>
          </div>
          <div class="modal-body">
            <input type="hidden" name="periode_id" value="{{request()->segment(3)}}">
            <div class="form-group">
              <label>Tanggal</label>
              <input type="date" name="tanggal" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Jam</label>
              <input type="text" name="jam" class="form-control" placeholder="Contoh : 10:00 - 11:00" required="">
            </div>
            <div class="form-group">
              <label>Tipe</label>
              <select name="tipe" class="custom-select" id="">
                <option value="" selected>Pilih</option>
                <option value="pembekalan">Pembekalan</option>
                <option value="pelepasan">Pelepasan</option>
                <option value="penarikan">Penarikan</option>
                <option value="ujian">Ujian</option>
              </select>
            </div>
            <div class="form-group float-right">
              <button type="button" id="closeAddBtn" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" id="confirmAddBtn" class="btn btn-primary" >Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit Jadwal -->
  <div class="modal fade" id="editDataModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form id="editDataForm">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Ubah Jadwal</h5>
          </div>
          <div class="modal-body">
            <input type="hidden" id="editDataId">
            <input type="hidden" name="periode_id" value="{{request()->segment(3)}}">
            <div class="form-group">
              <label>Tanggal</label>
              <input type="date" id="tanggal" name="tanggal" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>Jam</label>
              <input type="text" id="jam" name="jam" class="form-control" placeholder="Contoh : 10:00 - 11:00" required="">
            </div>
            <div class="form-group">
              <label>Tipe</label>
              <select id="tipe" name="tipe" class="custom-select" id="">
                <option value="" selected>Pilih</option>
                <option value="pembekalan">Pembekalan</option>
                <option value="pelepasan">Pelepasan</option>
                <option value="penarikan">Penarikan</option>
                <option value="ujian">Ujian</option>
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

  <!-- Modal Delete Jadwal -->
  <div class="modal fade" id="deleteDataModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5>Hapus Jadwal</h5>
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
      var periodeId = "{{ request()->segment(3) }}";

      let url = '{{ route('jadwal-periode.datatable', ':id') }}'; url = url.replace(':id', periodeId);

      let table = $('#datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        autoWidth: false,
        ajax: url,
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'tanggal', name: 'tanggal'},
          {data: 'jam', name: 'jam'},
          {data: 'tipe', name: 'tipe'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
          { className: "dt-center", targets: [ 0, 1, 2, 3 ] }
        ]
      });

      // /*------------------------------------------ Show modal button add new jadwal --------------------------------------------*/ 
      $('#showAddModalBtn').click(function () {
        $('#addNewDataModal').modal('show');
      });

      // /*------------------------------------------ Create new jadwal --------------------------------------------*/ 
      $('#newDataForm').submit(function (e) {
        e.preventDefault();
        $('#confirmAddBtn').html('Menyimpan...');
      
        // disable button while editing
        $("#confirmAddBtn").prop("disabled",true); 
        $("#closeAddBtn").prop("disabled",true);

        $.ajax({
          data: $('#newDataForm').serialize(),
          url: "{{ route('jadwal-periode.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            $('#newDataForm').trigger("reset");
            $('#addNewDataModal').modal('hide');
            table.ajax.reload();
            Swal.fire({
              title: 'Berhasil',
              text: 'Jadwal berhasil disimpan',
              icon: 'success',
              confirmButtonText: 'OK'
            })
          },
          error: function (data) {
            let html = "";
            const { status, message } = data.responseJSON;

            for (const key in message) {
              html += `<p style="">${message[key]}</p>`
            }
            Swal.fire({
              title: 'Terjadi kesalahan',
              html: status === 'validation error' ? html : message,
              icon: status === 'validation error' || status === 'warning' ? 'warning' : 'error',
              confirmButtonText: 'OK'
            })
          },
          complete: function(data) {
            $('#confirmAddBtn').html('Simpan');

            // enable button
            $("#confirmAddBtn").prop("disabled",false); 
            $("#closeAddBtn").prop("disabled",false);
          }
        });
      });

      // /*------------------------------------------ Show modal button edit jadwal --------------------------------------------*/
      $(document).on('click', '.show-edit-modal', function () {
        
        let dataId = $(this).data('id');
        let tanggal = $(this).data('tanggal');
        let jam = $(this).data('jam');
        let tipe = $(this).data('tipe');
        $('#editDataModal').modal('show');

        $('#editDataId').val(dataId);
        $('#tanggal').val(tanggal);
        $('#jam').val(jam);
        $('#tipe').val(tipe);
      });

      // /*------------------------------------------ Edit data jadwal --------------------------------------------*/ 
      $('#editDataForm').submit(function (e) {
        e.preventDefault();
        $('#confirmEditBtn').html('Menyimpan...');
      
        let dataId = $('#editDataId').val();
        let url = '{{ route('jadwal-periode.update', ':id') }}'; url = url.replace(':id', dataId);

        // disable button while editing
        $("#confirmEditBtn").prop("disabled",true); 
        $("#closeEditBtn").prop("disabled",true);

        $.ajax({
          data: $('#editDataForm').serialize(),
          url: url,
          type: "PATCH",
          dataType: 'json',
          success: function (data) {
            $('#editDataForm').trigger("reset");
            $('#editDataModal').modal('hide');
            table.ajax.reload();
            Swal.fire({
              title: 'Berhasil',
              text: 'Jadwal berhasil disimpan',
              icon: 'success',
              confirmButtonText: 'OK'
            })
          },
          error: function (data) {
            let html = "";
            const { status, message } = data.responseJSON;

            for (const key in message) {
              html += `<p style="">${message[key]}</p>`
            }
            Swal.fire({
              title: 'Terjadi kesalahan',
              html: status === 'validation error' ? html : message,
              icon: status === 'validation error' || status === 'warning' ? 'warning' : 'error',
              confirmButtonText: 'OK'
            })
          },
          complete: function(data) {
            $('#confirmEditBtn').html('Simpan');

            // enable button
            $("#confirmEditBtn").prop("disabled",false); 
            $("#closeEditBtn").prop("disabled",false);
          }
        });
      });

      // /*------------------------------------------ Show modal delete jadwal --------------------------------------------*/ 
      $(document).on('click', '.show-delete-modal', function () {
        $('#deleteDataModal').modal('show');
        $('#deleteDataId').val($(this).data("id"));
      });

      // /*------------------------------------------ Delete data jadwal --------------------------------------------*/ 
      $('#confirmDeleteBtn').click(function (e) {
        $(this).html('Menghapus...');

        let dataId = $('#deleteDataId').val();
        let url = '{{ route('jadwal-periode.destroy', ':id') }}'; url = url.replace(':id', dataId);

        // disable button while deleting
        $("#confirmDeleteBtn").prop("disabled",true); 
        $("#closeDeleteBtn").prop("disabled",true);

        $.ajax({
          type: "DELETE",
          url : url,
          success: function (data) {
            $('#deleteDataModal').modal('hide');
            table.ajax.reload();
            Swal.fire({
              title: 'Berhasil',
              text: 'Jadwal berhasil dihapus',
              icon: 'success',
              confirmButtonText: 'OK'
            })
          },
          error: function (data) {
            const { status, message } = data.responseJSON;
            Swal.fire({
              title: 'Terjadi kesalahan',
              text: message,
              icon: 'error',
              confirmButtonText: 'OK'
            })
          },
          complete: function(data) {
            $('#confirmDeleteBtn').html('Ya'); 

            // enable button
            $("#confirmDeleteBtn").prop("disabled",false);
            $("#closeDeleteBtn").prop("disabled",false);
          }
        });
      });

    });
  </script>
@endpush