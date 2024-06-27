<aside>
    <div class="sidebar-brand">
        <a href="index.html">SI KERJA PRAKTEK</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">SI-KP</a>
    </div>
    <ul class="sidebar-menu">
        <li class="{{ request()->segment(1) == '' ? 'active' : '' }}"><a class="nav-link" href="{{ route('home') }}"><i class="far fa-square"></i> <span>Dashboard</span></a></li>

        
        @if(Auth::user()->role == 'admin')
            <li class="{{ request()->segment(1) == 'mahasiswa' ? 'active' : '' }}"><a class="nav-link" href="{{ route('mahasiswa.index') }}"><i class="fas fa-users"></i> <span>Mahasiswa</span></a></li>
            <li class="{{ request()->segment(1) == 'periode' ? 'active' : '' }}"><a class="nav-link" href="{{ route('periode.index') }}"><i class="far fa-calendar"></i> <span>Periode</span></a></li>
            <li class="{{ request()->segment(1) == 'jadwal' ? 'active' : '' }}"><a class="nav-link" href="{{ route('daftar-periode.index') }}"><i class="far fa-calendar"></i> <span>Jadwal</span></a></li>
            <li class="{{ request()->segment(1) == 'pendaftaran' ? 'active' : '' }}"><a class="nav-link" href="{{ route('pendaftaran.index') }}"><i class="far fa-file"></i> <span>Pendaftaran</span></a></li>
            <li class="{{ request()->segment(1) == 'laporan-kp' ? 'active' : '' }}"><a class="nav-link" href="{{ route('laporan-kp.index') }}"><i class="far fa-file"></i> <span>Laporan KP</span></a></li>
        @endif

        @if(Auth::user()->role == 'mhs')
            <li class="{{ request()->segment(1) == 'mendaftar' ? 'active' : '' }}"><a class="nav-link" href="{{ route('mendaftar.index') }}"><i class="fas fa-file"></i> <span>Mendaftar</span></a></li>
            <li class="{{ request()->segment(1) == 'unggah-berkas' ? 'active' : '' }}"><a class="nav-link" href="{{ route('unggah-berkas.index') }}"><i class="fas fa-upload"></i> <span>Unggah Berkas</span></a></li>
            <li class="{{ request()->segment(1) == 'unggah-laporan' ? 'active' : '' }}"><a class="nav-link" href="{{ route('unggah-laporan.index') }}"><i class="fas fa-upload"></i> <span>Unggah Laporan</span></a></li>
        @endif
    </ul> 
</aside>