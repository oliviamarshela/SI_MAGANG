<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>SI KP</title>

        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

        <!-- Datatables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>

    <body>
        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar">
                    <form class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        </ul>
                    </form>
                    <ul class="navbar-nav navbar-right">
                        {{-- <?php 
                            $pemberitahuan = App\Models\Pemberitahuan::where('user_id', Auth::id())->where('dibaca', 0)->orderBy('created_at','DESC')->paginate(5);
                        ?> --}}

                        {{-- @if(Auth::user()->role == 'pegawai')
                            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg {{count($pemberitahuan) > 0 ? " beep" : ""}}"><i class="far fa-bell"></i></a>
                                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                                    <div class="dropdown-header">Pemberitahuan
                                    </div>
                                    <div class="dropdown-list-content dropdown-list-icons">
                                        @foreach ($pemberitahuan as $item)                                            
                                            <a href="{{ route('pemberitahuan.detail',$item->id) }}" class="dropdown-item dropdown-item-unread">
                                                <div class="dropdown-item-icon bg-primary text-white">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                                <div class="dropdown-item-desc">
                                                    @if($item->status === 'terdaftar_periode')
                                                        Terdaftar Periode
                                                    @elseif($item->status === 'rekomendasi_naik_pangkat')
                                                        Direkomendasikan Pengajuan Naik Pangkat
                                                    @elseif($item->status === 'batal_rekomendasi_naik_pangkat')
                                                        Batal Direkomendasikan Pengajuan Naik Pangkat
                                                    @elseif($item->status === 'perbaikan_berkas')
                                                        Perbaikan Berkas Pengajuan Naik Pangkat
                                                    @elseif($item->status === 'berkas_diterima')
                                                        Berkas Pengajuan Naik Pangkat Diterima
                                                    @elseif($item->status === 'sk_kp_dikirim')
                                                        SK Kenaikan Pangkat Dikirim
                                                    @endif
                                                    <div class="time text-primary">{{$item->created_at->translatedFormat('l, d/m/Y')}}</div>
                                                </div>
                                            </a>
                                        @endforeach
                                        @if (count($pemberitahuan) <= 0)
                                            <div class="text-center" style="font-size : 15px">Tidak tersedia.</div>
                                        @endif

                                    </div>
                                    <div class="dropdown-footer text-center">
                                        <a href="{{ route('pemberitahuan.index') }}">Lihat Semua <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif

                        @if(Auth::user()->role == 'admin')
                            <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg {{count($pemberitahuan) > 0 ? " beep" : ""}}"><i class="far fa-bell"></i></a>
                                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                                    <div class="dropdown-header">Pemberitahuan
                                    </div>
                                    <div class="dropdown-list-content dropdown-list-icons">
                                        @foreach ($pemberitahuan as $item)                                            
                                            <a href="{{ route('pemberitahuan.detail',$item->id) }}" class="dropdown-item dropdown-item-unread">
                                                <div class="dropdown-item-icon bg-primary text-white">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                                <div class="dropdown-item-desc">
                                                    @if($item->status === 'semua_sk_kp_dikirim')
                                                        Semua Pegawai Telah Menerima SK KP
                                                    @endif
                                                    <div class="time text-primary">{{$item->created_at->translatedFormat('l, d/m/Y')}}</div>
                                                </div>
                                            </a>
                                        @endforeach
                                        @if (count($pemberitahuan) <= 0)
                                            <div class="text-center" style="font-size : 15px">Tidak tersedia.</div>
                                        @endif

                                    </div>
                                    <div class="dropdown-footer text-center">
                                        <a href="{{ route('pemberitahuan.index') }}">Lihat Semua <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </li>
                        @endif --}}
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                {{-- @if(Auth::user()->image)
                                    <img alt="image" src="{{asset('image/'.Auth::user()->image.'')}}" class="rounded-circle mr-1" style="object-fit: cover; width: 30px; height: 30px; border: 1px solid rgb(235, 235, 235)">
                                @else
                                @endif --}}
                                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block">{{Auth::user()->name ?? '-'}}</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                {{-- <a href="{{ route('profil') }}" class="dropdown-item has-icon">
                                    <i class="far fa-user"></i> Profil
                                </a>
                                <div class="dropdown-divider"></div> --}}
                                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="main-sidebar">
                    @include('layouts.sidebar')
                </div>

                <!-- Main Content -->
                <div class="main-content">
                    @yield('content')
                </div>

                <footer class="main-footer">
                    @include('layouts.footer')
                </footer>

                @include('sweetalert::alert')
            </div>
        </div>

        <!-- General JS Scripts -->
        <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/modules/popper.js') }}"></script>
        <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
        <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
        <script src="{{ asset('assets/js/stisla.js') }}"></script>
        
        <!-- JS Libraies -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

        <!-- Page Specific JS File -->
        <!-- Datatables -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

        <!-- Template JS File -->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>

        <script>
            $(function () {
                /*------------------------------------------ Pass Header Token --------------------------------------------*/ 
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
            });
        </script>

        @stack('scripts')
    </body>
</html>