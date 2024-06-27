@extends('layouts.app')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Daftar Periode</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Daftar Periode</div>
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
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody class="">
                    <?php $no=0; ?>
                    @foreach ($periode as $item)     
                      <?php $no++; ?>                   
                      <tr>
                        <th scope="row">{{ $no }}</th>
                        <th scope="row">{{ $item->nama }}</th>
                        <th scope="row">
                          @if($item->status === 'sementara')
                            <h6><span class="badge badge-warning">Sementara</span></h6>
                          @elseif($item->status === 'selesai')
                            <h6><span class="badge badge-success">Selesai</span></h6>
                          @endif
                        </th>
                        <th scope="row">
                          <a href="{{ route('jadwal-periode.index',$item->id) }}" class="edit btn btn-primary btn-sm">Kelola Jadwal</a>
                        </th>
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