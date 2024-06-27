@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Daftar Periode</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Daftar Periode Magang</div>
      </div>
    </div>

    <div class="section-body">
      <div class="alert alert-light alert-has-icon">
        <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
        <div class="alert-body">
          <div class="alert-title">Informasi</div>
          <ul style="margin-left: -20px; margin-bottom: 0px">
            <li>Jika status pendaftaran belum diterima, <strong>FORM PERMOHONAN</strong> masih bisa diubah jika dibutuhkan.</li>
            <li>Setelah mendaftar, unduh <strong>Form Permohonan & Surat Rekomendasi</strong> untuk diunggah dan akan dikonfirmasi oleh admin.</li>
            <li>Jika status pendaftaran sudah diterima, data tidak dapat diubah.</li>
          </ul> 
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            @if($pendaftaran)
              <div class="card-header">
                <a href="{{route('permohonan-kp')}}" class="btn btn-secondary" target="blink">Form Permohonan <i class="fas fa-download"></i></a>
              </div>
            @endif
            <div class="card-body p-4">

              @if(!$pendaftaran)                  
                <div class="alert alert-warning alert-has-icon">
                  <div class="alert-body">
                    <div class="alert-title">Informasi</div>
                    <p>Input Data <strong>FORM PERMOHONAN KERJA PRAKTIK</strong> untuk mulai mendaftar.</p>
                  </div>
                </div>
              @else
                <div class="table-responsive">
                  <table class="table table-bordered table-md">
                    <tr>
                      <th colspan="2">FORM PERMOHONAN KERJA PRAKTIK</th>
                    </tr>
                    <tr>
                      <td width="300px">NIM</td>
                      <td>{{ $pendaftaran->nim ?? "-" }}</td>
                    </tr>
                    <tr>
                      <td>NAMA</td>
                      <td>{{ $pendaftaran->nama ?? "-" }}</td>
                    </tr>
                    <tr>
                      <td>PROGRAM STUDI</td>
                      <td>{{ $pendaftaran->prodi ?? "-" }}</td>
                    </tr>
                    <tr>
                      <td>SKS DI TEMPUH</td>
                      <td>{{ $pendaftaran->sks_ditempuh ?? "-" }}</td>
                    </tr>
                    <tr>
                      <td>JUDUL PRA PROPOSAL KP</td>
                      <td>{{ $pendaftaran->judul_pra_proposal ?? "-" }}</td>
                    </tr>
                    <tr>
                      <td>DOSEN PEMBIMBING AKADEMIK</td>
                      <td>{{ $pendaftaran->dosen_pembimbing_kp ?? "-" }}</td>
                    </tr>
                    <tr>
                      <td>NIP</td>
                      <td>{{ $pendaftaran->nip ?? "-" }}</td>
                    </tr>
                    <tr>
                      <td>INSTANSI KP</td>
                      <td>{{ $pendaftaran->instansi_kp ?? "-" }}</td>
                    </tr>
                  </table>
                </div>
              @endif

              @if($pendaftaran?->status !== 'diterima')
                @if(!$pendaftaran)
                  <button id="showAddModalBtn" type="button" class="btn btn-primary">
                    Input Data <i class="fas fa-edit"></i>
                  </button>
                @else
                  <button id="showEditModalBtn" type="button" class="btn btn-primary">
                    Edit Data <i class="fas fa-edit"></i>
                  </button>
                @endif
              @endif
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    
  <!-- Modal Pendaftaran -->
  <div class="modal fade" id="addNewDataModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <form id="newDataForm">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">FORM PERMOHONAN KERJA PRAKTIK</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>PERIODE</label>
              <select name="periode_id" class="custom-select" id="" required>
                <option value="" selected>Pilih</option>
                @foreach ($periode as $item)
                    <option value={{$item->id}}>{{$item->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="row">
              <div class="col">                
                <div class="form-group">
                  <label>NIM</label>
                  <input type="text" name="nim" class="form-control" required="">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>NAMA</label>
                  <input type="text" name="nama" class="form-control" required="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>IPK</label>
                  <input type="text" name="ipk" class="form-control" required="">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>SKS DI TEMPUH</label>
                  <input type="text" name="sks_ditempuh" class="form-control" required="">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>PROGRAM STUDI</label>
              <input type="text" name="prodi" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>JUDUL PRA PROPOSAL KP</label>
              <input type="text" name="judul_pra_proposal" class="form-control">
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>DOSEN PEMBIMBING AKADEMIK</label>
                  <input type="text" name="dosen_pembimbing_kp" class="form-control" required="">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>NIP DOSEN</label>
                  <input type="text" name="nip" class="form-control" required="">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>INSTANSI KP</label>
              <input type="text" name="instansi_kp" class="form-control" required="">
            </div>
            <div class="form-group float-right">
              <button type="button" id="closeAddBtn" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" id="confirmAddBtn" class="btn btn-primary" >Mendaftar</button>
            </div>
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
            <div class="form-group">
              <label>PERIODE</label>
              <select class="custom-select" id="" disabled>
                <option value="" selected>Pilih</option>
                @foreach ($periode as $item)
                    <option value={{$item->id}} {{$item->id === $pendaftaran?->periode_id ? 'selected' : ''}}>{{$item->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="row">
              <div class="col">                
                <div class="form-group">
                  <label>NIM</label>
                  <input type="text" name="nim" value="{{$pendaftaran->nim ?? "-"}}" class="form-control" required="">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>NAMA</label>
                  <input type="text" name="nama" value="{{$pendaftaran->nama ?? "-"}}" class="form-control" required="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>IPK</label>
                  <input type="text" name="ipk" value="{{$pendaftaran->ipk ?? "-"}}" class="form-control" required="">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>SKS DI TEMPUH</label>
                  <input type="text" name="sks_ditempuh" value="{{$pendaftaran->sks_ditempuh ?? "-"}}" class="form-control" required="">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>PROGRAM STUDI</label>
              <input type="text" name="prodi" value="{{$pendaftaran->prodi ?? "-"}}" class="form-control" required="">
            </div>
            <div class="form-group">
              <label>JUDUL PRA PROPOSAL KP</label>
              <input type="text" name="judul_pra_proposal" value="{{$pendaftaran->judul_pra_proposal ?? ""}}" class="form-control">
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label>DOSEN PEMBIMBING AKADEMIK</label>
                  <input type="text" name="dosen_pembimbing_kp" value="{{$pendaftaran->dosen_pembimbing_kp ?? "-"}}" class="form-control" required="">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label>NIP DOSEN</label>
                  <input type="text" name="nip" value="{{$pendaftaran->nip ?? "-"}}" class="form-control" required="">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>NIP DOSEN</label>
              <input type="text" name="instansi_kp" value="{{$pendaftaran->instansi_kp ?? "-"}}" class="form-control" required="">
            </div>
            <div class="form-group float-right">
              <button type="button" id="closeAddBtn" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" id="confirmEditBtn" class="btn btn-primary" >Simpan</button>
            </div>
          </div>
        </form>
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
        ajax: "{{ route('periode.datatable') }}",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'nama', name: 'nama'},
          {data: 'status', name: 'status'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
          { className: "dt-center", targets: [ 0, 1, 2, 3 ] }
        ]
      });

      // /*------------------------------------------ Show modal button add new periode --------------------------------------------*/ 
      $('#showAddModalBtn').click(function () {
        $('#addNewDataModal').modal('show');
      });

      // /*------------------------------------------ Create new periode --------------------------------------------*/ 
      $('#newDataForm').submit(function (e) {
        e.preventDefault();
        $('#confirmAddBtn').html('Menyimpan...');
      
        // disable button while editing
        $("#confirmAddBtn").prop("disabled",true); 
        $("#closeAddBtn").prop("disabled",true);

        $.ajax({
          data: $('#newDataForm').serialize(),
          url: "{{ route('mendaftar.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            $('#newDataForm').trigger("reset");
            $('#addNewDataModal').modal('hide');
            table.ajax.reload();
            Swal.fire({
              title: 'Berhasil',
              text: 'Berhasil mendaftar',
              icon: 'success',
              confirmButtonText: 'OK'
            })
            setTimeout(() => {
              location.reload();
            }, 1000);
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

      // /*------------------------------------------ Show modal button edit periode --------------------------------------------*/
      $('#showEditModalBtn').click(function () {
        $('#editDataModal').modal('show');
      });

      // /*------------------------------------------ Edit data periode --------------------------------------------*/ 
      $('#editDataForm').submit(function (e) {
        e.preventDefault();
        $('#confirmEditBtn').html('Menyimpan...');
      
        var pendaftaranId = "{{ $pendaftaran?->id }}";

        let url = '{{ route('mendaftar.update', ':id') }}'; url = url.replace(':id', pendaftaranId);

        // disable button while editing
        $("#confirmEditBtn").prop("disabled",true); 
        $("#closeEditBtn").prop("disabled",true);

        $.ajax({
          data: $('#editDataForm').serialize(),
          url: url,
          type: "PUT",
          dataType: 'json',
          success: function (data) {
            $('#editDataForm').trigger("reset");
            $('#editDataModal').modal('hide');
            table.ajax.reload();
            Swal.fire({
              title: 'Berhasil',
              text: 'Data berhasil disimpan',
              icon: 'success',
              confirmButtonText: 'OK'
            })
            setTimeout(() => {
              location.reload();
            }, 1000);
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

    });
  </script>
@endpush